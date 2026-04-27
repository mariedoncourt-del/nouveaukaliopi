<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Secure_upload - Couche de sécurité pour les uploads de fichiers
 *
 * Section 9 bis - P1.4 du plan de remédiation sécurité Kaliopi.
 *
 * Apporte par rapport à la librairie CI_Upload native :
 *  1. Vérification du MIME-type RÉEL via finfo_file (pas seulement l'extension)
 *  2. Renommage systématique avec un nom aléatoire (anti path-traversal et anti-collision)
 *  3. Whitelist stricte par profil (programme, cv, scenario, support, video, image)
 *  4. Limite de taille par défaut
 *  5. Refus des doubles extensions (shell.php.pdf)
 *  6. Création automatique d'un .htaccess "deny PHP" dans le dossier de destination
 *
 * USAGE :
 *   $this->load->library('secure_upload');
 *   $result = $this->secure_upload->process('link', 'programme', './assets/programmes/');
 *   if ($result['success']) { $filename = $result['file_name']; }
 *   else { $error = $result['error']; }
 */
class Secure_upload {

	private $CI;

	/**
	 * Profils d'upload autorisés.
	 * Chaque profil définit : extensions, MIME-types, taille max (Ko).
	 */
	private $profiles = [
		'programme' => [
			'extensions' => ['pdf', 'jpg', 'jpeg', 'png'],
			'mimes'      => ['application/pdf', 'image/jpeg', 'image/png'],
			'max_size_kb'=> 10240, // 10 Mo
		],
		'cv' => [
			'extensions' => ['pdf', 'doc', 'docx'],
			'mimes'      => [
				'application/pdf',
				'application/msword',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			],
			'max_size_kb'=> 5120, // 5 Mo
		],
		// Variante CV étendue acceptant le format texte (utilisée pour les pièces de recrutement)
		'cv_etendu' => [
			'extensions' => ['pdf', 'doc', 'docx', 'txt'],
			'mimes'      => [
				'application/pdf',
				'application/msword',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'text/plain',
			],
			'max_size_kb'=> 5120,
		],
		'scenario' => [
			'extensions' => ['pdf', 'doc', 'docx', 'odt'],
			'mimes'      => [
				'application/pdf',
				'application/msword',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'application/vnd.oasis.opendocument.text',
			],
			'max_size_kb'=> 10240,
		],
		'support' => [
			'extensions' => ['pdf', 'ppt', 'pptx', 'odp'],
			'mimes'      => [
				'application/pdf',
				'application/vnd.ms-powerpoint',
				'application/vnd.openxmlformats-officedocument.presentationml.presentation',
				'application/vnd.oasis.opendocument.presentation',
			],
			'max_size_kb'=> 20480, // 20 Mo
		],
		'video' => [
			'extensions' => ['mp4', 'webm', 'mov'],
			'mimes'      => ['video/mp4', 'video/webm', 'video/quicktime'],
			'max_size_kb'=> 102400, // 100 Mo
		],
		'image' => [
			'extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
			'mimes'      => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
			'max_size_kb'=> 5120,
		],
	];

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->helper('security');
	}

	/**
	 * Traite un upload entrant en appliquant tous les contrôles de sécurité.
	 *
	 * @param string $field        Nom du champ HTML <input type="file" name="...">
	 * @param string $profile      Profil d'upload ('programme', 'cv', 'scenario', ...)
	 * @param string $upload_path  Chemin de destination (avec slash final)
	 * @return array ['success' => bool, 'file_name' => string|null, 'error' => string|null]
	 */
	public function process($field, $profile, $upload_path) {

		if (!isset($this->profiles[$profile])) {
			return $this->fail('Profil d\'upload inconnu : ' . $profile);
		}

		if (!isset($_FILES[$field]) || !is_array($_FILES[$field])) {
			return $this->fail('Aucun fichier reçu sur le champ ' . $field);
		}

		$file = $_FILES[$field];

		// Erreurs PHP standards (4 = pas de fichier, pas un échec)
		if ($file['error'] === UPLOAD_ERR_NO_FILE) {
			return ['success' => false, 'file_name' => null, 'error' => null]; // Optionnel
		}
		if ($file['error'] !== UPLOAD_ERR_OK) {
			return $this->fail('Erreur PHP upload : code ' . $file['error']);
		}

		// Vérification que le fichier vient bien d'un upload HTTP (anti-spoofing)
		if (!is_uploaded_file($file['tmp_name'])) {
			log_message('error', 'Tentative de spoofing upload détectée sur ' . $field);
			return $this->fail('Fichier non valide');
		}

		$conf = $this->profiles[$profile];

		// 1. Taille
		if ($file['size'] > $conf['max_size_kb'] * 1024) {
			return $this->fail('Fichier trop volumineux (max ' . $conf['max_size_kb'] . ' Ko)');
		}
		if ($file['size'] === 0) {
			return $this->fail('Fichier vide');
		}

		// 2. Extension (en s'appuyant sur le nom original mais SEULE la dernière extension compte)
		$original_name = $file['name'];

		// Refus des doubles extensions type "shell.php.pdf" : on cherche toute extension
		// dangereuse dans le nom complet, pas uniquement la dernière.
		$dangerous = ['php', 'phtml', 'phar', 'php3', 'php4', 'php5', 'php7', 'php8',
		              'pl', 'py', 'jsp', 'asp', 'aspx', 'sh', 'cgi', 'exe', 'bat', 'htaccess'];
		$lower_name = strtolower($original_name);
		foreach ($dangerous as $bad) {
			if (preg_match('/\.' . preg_quote($bad, '/') . '(\.|$)/', $lower_name)) {
				log_message('warning', 'Upload rejeté pour extension dangereuse : ' . $original_name);
				return $this->fail('Type de fichier interdit');
			}
		}

		$ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
		if (!in_array($ext, $conf['extensions'], true)) {
			return $this->fail('Extension non autorisée. Autorisées : ' . implode(', ', $conf['extensions']));
		}

		// 3. MIME-type RÉEL (lecture des magic bytes via finfo)
		if (!verify_mime_type($file['tmp_name'], $conf['mimes'])) {
			$detected = function_exists('finfo_open')
				? (function() use ($file) {
					$f = finfo_open(FILEINFO_MIME_TYPE);
					$m = finfo_file($f, $file['tmp_name']);
					finfo_close($f);
					return $m;
				})()
				: 'inconnu';
			log_message('warning', 'Upload rejeté pour MIME invalide : ' . $detected . ' (fichier ' . $original_name . ')');
			return $this->fail('Le contenu du fichier ne correspond pas à son extension');
		}

		// 4. Préparation du dossier de destination
		if (!is_dir($upload_path)) {
			if (!@mkdir($upload_path, 0750, true)) {
				return $this->fail('Impossible de créer le dossier ' . $upload_path);
			}
		}
		if (!is_writable($upload_path)) {
			return $this->fail('Dossier non inscriptible : ' . $upload_path);
		}

		// 5. Génère un .htaccess "deny PHP" si absent (ceinture + bretelles)
		$this->ensure_htaccess_deny_php($upload_path);

		// 6. Renommage aléatoire (32 hex + extension whitelistée)
		$safe_name = safe_filename($original_name);
		$dest = rtrim($upload_path, '/') . '/' . $safe_name;

		// 7. Déplacement définitif
		if (!@move_uploaded_file($file['tmp_name'], $dest)) {
			return $this->fail('Échec du déplacement du fichier');
		}

		// 8. Permissions restrictives
		@chmod($dest, 0640);

		log_message('info', 'Upload accepté : ' . $original_name . ' -> ' . $safe_name . ' (profil ' . $profile . ')');

		return [
			'success'       => true,
			'file_name'     => $safe_name,
			'original_name' => $original_name,
			'full_path'     => $dest,
			'size'          => $file['size'],
			'error'         => null,
		];
	}

	private function ensure_htaccess_deny_php($dir) {
		$ht = rtrim($dir, '/') . '/.htaccess';
		if (file_exists($ht)) {
			return;
		}
		$content = "# SECURITY P1.4 - Auto-généré par Secure_upload\n"
		         . "# Empêche l'exécution de scripts PHP/CGI dans ce dossier d'upload\n"
		         . "<FilesMatch \"\\.(php|phtml|phar|php3|php4|php5|php7|php8|pl|py|jsp|asp|sh|cgi)$\">\n"
		         . "    Require all denied\n"
		         . "    <IfModule !mod_authz_core.c>\n"
		         . "        Order deny,allow\n"
		         . "        Deny from all\n"
		         . "    </IfModule>\n"
		         . "</FilesMatch>\n"
		         . "Options -ExecCGI -Indexes\n"
		         . "<IfModule mod_php7.c>\n"
		         . "    php_flag engine off\n"
		         . "</IfModule>\n";
		@file_put_contents($ht, $content);
		@chmod($ht, 0640);
	}

	private function fail($msg) {
		return ['success' => false, 'file_name' => null, 'error' => $msg];
	}
}
