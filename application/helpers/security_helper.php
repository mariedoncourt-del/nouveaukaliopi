<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * security_helper - Helpers d'échappement et de sécurité pour les vues
 *
 * Section 9 bis - P0.5 du plan de remédiation sécurité Kaliopi.
 *
 * USAGE DANS LES VUES :
 *   <?= e($variable) ?>                       // échappement HTML standard
 *   <?= e_attr($variable) ?>                  // pour attributs HTML (alias plus strict)
 *   <?= e_js($variable) ?>                    // pour insertion dans du JavaScript inline
 *   <?= e_url($variable) ?>                   // pour URL (paramètres GET, hrefs)
 *   <?= csrf_meta() ?>                        // injecte les meta CSRF dans <head>
 *
 * IMPORTANT : ces fonctions ne remplacent PAS la validation côté contrôleur.
 * Elles sont la dernière ligne de défense au moment du rendu.
 */

if (!function_exists('e')) {
	/**
	 * Échappement HTML standard (équivalent htmlspecialchars + html_escape CI).
	 * Sûr par défaut, accepte les valeurs null sans warning.
	 */
	function e($value) {
		if ($value === null || $value === false) {
			return '';
		}
		if (is_array($value) || is_object($value)) {
			$value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
		return htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	}
}

if (!function_exists('e_attr')) {
	/**
	 * Échappement pour attributs HTML (encode aussi les caractères de contrôle).
	 */
	function e_attr($value) {
		if ($value === null || $value === false) {
			return '';
		}
		return htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8', true);
	}
}

if (!function_exists('e_js')) {
	/**
	 * Échappement pour insertion sécurisée dans du JavaScript.
	 * Utilise json_encode qui produit toujours une chaîne JS valide et sûre.
	 *
	 * Exemple :
	 *   <script>var titre = <?= e_js($formation['nom']) ?>;</script>
	 */
	function e_js($value) {
		return json_encode($value, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
	}
}

if (!function_exists('e_url')) {
	/**
	 * Échappement pour fragments d'URL (paramètres, segments).
	 */
	function e_url($value) {
		if ($value === null || $value === false) {
			return '';
		}
		return rawurlencode((string) $value);
	}
}

if (!function_exists('csrf_meta')) {
	/**
	 * Génère les balises meta CSRF à inclure dans le <head> du layout principal.
	 * Le JS (header.php) lit ces meta pour injecter le token dans toutes les
	 * requêtes AJAX via $.ajaxSetup().
	 */
	function csrf_meta() {
		$CI =& get_instance();
		$name = $CI->security->get_csrf_token_name();
		$hash = $CI->security->get_csrf_hash();
		return '<meta name="csrf-token-name" content="' . e_attr($name) . '">' . "\n"
		     . '<meta name="csrf-token" content="' . e_attr($hash) . '">';
	}
}

if (!function_exists('csrf_input')) {
	/**
	 * Génère un champ <input type="hidden"> contenant le token CSRF.
	 * À insérer dans tous les formulaires <form> POST qui n'utilisent pas form_open().
	 */
	function csrf_input() {
		$CI =& get_instance();
		return '<input type="hidden" name="' . e_attr($CI->security->get_csrf_token_name())
		     . '" value="' . e_attr($CI->security->get_csrf_hash()) . '">';
	}
}

if (!function_exists('safe_filename')) {
	/**
	 * Génère un nom de fichier aléatoire sûr en conservant l'extension.
	 * Utilisé pour les uploads (P1.4).
	 */
	function safe_filename($original_filename) {
		$ext = pathinfo($original_filename, PATHINFO_EXTENSION);
		$ext = preg_replace('/[^a-zA-Z0-9]/', '', $ext);
		$ext = strtolower(substr($ext, 0, 10));
		$random = bin2hex(random_bytes(16));
		return $random . ($ext ? '.' . $ext : '');
	}
}

if (!function_exists('verify_mime_type')) {
	/**
	 * Vérifie le MIME-type réel d'un fichier uploadé via finfo (pas l'extension).
	 *
	 * @param string $file_path Chemin du fichier
	 * @param array  $allowed   Liste blanche de MIME-types autorisés
	 * @return bool
	 */
	function verify_mime_type($file_path, array $allowed) {
		if (!file_exists($file_path) || !function_exists('finfo_open')) {
			return false;
		}
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime  = finfo_file($finfo, $file_path);
		finfo_close($finfo);
		return in_array($mime, $allowed, true);
	}
}
