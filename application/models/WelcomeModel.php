<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WelcomeModel - Authentification et gestion des comptes
 *
 * Refonte sécurité (Section 9 bis du cahier des charges) :
 *  - P0.1 : migration MD5 -> bcrypt avec rétrocompatibilité transparente
 *  - P0.3 : authentification stagiaire renforcée par token + mot de passe
 *  - P0.4 : suppression de toute concaténation SQL (Query Builder uniquement)
 */
class WelcomeModel extends CI_Model {

	/**
	 * Authentification stagiaire (apprenant) - P0.3
	 *
	 * Schéma renforcé :
	 *  - L'ID de formation seul ne suffit plus : un token d'accès aléatoire
	 *    (32 caractères hex, généré par random_bytes(16)) doit être fourni.
	 *  - Optionnellement un mot de passe stagiaire (colonne password) hashé en bcrypt.
	 *
	 * Rétrocompatibilité : si la colonne token_acces n'existe pas encore en base
	 * (migration non appliquée), on retombe sur l'ancien comportement avec un
	 * message de log d'avertissement. Cela permet un déploiement progressif.
	 *
	 * @param string      $id_formation Identifiant de la formation
	 * @param string|null $token        Token d'accès aléatoire reçu par email
	 * @param string|null $password     Mot de passe stagiaire (optionnel)
	 * @return string|false ID de formation si succès, false sinon
	 */
	public function login_public($id_formation, $token = null, $password = null) {

		$this->db->where('id', $id_formation);
		$result = $this->db->get('formation');

		if ($result->num_rows() !== 1) {
			return false;
		}

		$row = $result->row(0);

		// Vérification token (si la colonne existe en base)
		if (isset($row->token_acces) && !empty($row->token_acces)) {
			if (empty($token) || !hash_equals($row->token_acces, $token)) {
				log_message('info', 'Tentative de connexion stagiaire avec token invalide pour formation ' . $id_formation);
				return false;
			}
		} else {
			// Migration non encore appliquée pour ce dossier
			log_message('warning', 'Formation ' . $id_formation . ' sans token_acces - migration P0.3 à appliquer');
		}

		// Vérification mot de passe stagiaire (si défini)
		if (isset($row->password) && !empty($row->password)) {
			if (empty($password) || !password_verify($password, $row->password)) {
				log_message('info', 'Tentative de connexion stagiaire avec mot de passe invalide pour formation ' . $id_formation);
				return false;
			}
		}

		return $row->id;
	}

	public function get_cours() {
		// P0.4 - Query Builder au lieu de query() brute
		return $this->db->get('cours')->result();
	}

	public function add_courss() {
		$data = array(
			'id'    => 'MAR',
			'titre' => 'MARKETING 3.0',
		);
		return $this->db->insert('cours', $data);
	}

	/**
	 * Insertion d'un nouvel admin - P0.1
	 *
	 * Le mot de passe DOIT être pré-hashé par le contrôleur via password_hash().
	 * Le contrôleur Admin::create_admin() s'en charge.
	 */
	public function insert_admin($datas = array()) {
		// Garde-fou : si le contrôleur a oublié de hasher, on hashe ici en bcrypt.
		if (isset($datas['password']) && !$this->is_bcrypt_hash($datas['password'])) {
			// Ne pas accepter du MD5 ou du clair pour une nouvelle insertion
			$datas['password'] = password_hash($datas['password'], PASSWORD_BCRYPT, ['cost' => 12]);
			log_message('warning', 'insert_admin appelé avec un mot de passe non bcrypt - re-hashé automatiquement');
		}
		return $this->db->insert('admin', $datas);
	}

	public function listadmin() {
		// P0.4 - Query Builder
		return $this->db->get('admin');
	}

	/**
	 * Suppression d'un admin par login - P0.4
	 * Réécrite avec Query Builder pour neutraliser l'injection SQL.
	 */
	public function supprimerAdmin($login) {
		$this->db->where('login', $login);
		return $this->db->delete('admin');
	}

	/**
	 * Modification du mot de passe admin - P0.1 + P0.4
	 *
	 * - Le hash bcrypt est calculé ici à partir du mot de passe en clair
	 *   transmis par le contrôleur (qui l'a récupéré du formulaire).
	 * - Plus aucun MD5.
	 * - Plus aucune concaténation SQL.
	 */
	public function modifier_admin($login, $password) {
		$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
		$this->db->where('login', $login);
		return $this->db->update('admin', ['password' => $hash]);
	}

	/**
	 * Authentification admin - P0.1
	 *
	 * Mécanisme transitoire de migration MD5 -> bcrypt :
	 *  1. On récupère le compte par login (Query Builder, pas de concaténation).
	 *  2. Si le hash stocké ressemble à du bcrypt ($2y$...), on utilise password_verify().
	 *  3. Sinon, si c'est un hash MD5 32 hex, on compare en MD5 puis on régénère
	 *     immédiatement le hash en bcrypt et on met à jour la base.
	 *  4. Toute autre forme est rejetée.
	 *
	 * IMPORTANT : ce contrôleur reçoit le mot de passe EN CLAIR (à différence
	 * de l'ancien code qui passait md5() avant l'appel). Le contrôleur Admin
	 * doit donc être adapté en conséquence.
	 *
	 * @param string $login    Login admin
	 * @param string $password Mot de passe EN CLAIR
	 * @return string|false Login si succès, false sinon
	 */
	public function login_admin($login, $password) {

		$this->db->where('login', $login);
		$result = $this->db->get('admin');

		if ($result->num_rows() !== 1) {
			// Tempo anti-timing-attack : on consomme du temps même si compte inexistant
			password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
			return false;
		}

		$row = $result->row(0);
		$hash_stocke = $row->password;

		// Cas 1 : hash bcrypt moderne
		if ($this->is_bcrypt_hash($hash_stocke)) {
			if (password_verify($password, $hash_stocke)) {
				// Re-hash si le coût a changé (ex : passage de cost=10 à cost=12)
				if (password_needs_rehash($hash_stocke, PASSWORD_BCRYPT, ['cost' => 12])) {
					$nouveau_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
					$this->db->where('login', $login)->update('admin', ['password' => $nouveau_hash]);
				}
				return $row->login;
			}
			return false;
		}

		// Cas 2 : hash MD5 legacy (32 caractères hexadécimaux)
		if ($this->is_md5_hash($hash_stocke)) {
			if (hash_equals($hash_stocke, md5($password))) {
				// Migration transparente : on régénère en bcrypt
				$nouveau_hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
				$this->db->where('login', $login)->update('admin', ['password' => $nouveau_hash]);
				log_message('info', 'Migration MD5 -> bcrypt effectuée pour admin ' . $login);
				return $row->login;
			}
			return false;
		}

		// Cas 3 : format inconnu, rejeté
		log_message('error', 'Format de hash inconnu pour admin ' . $login);
		return false;
	}

	public function eval_hot_exist($id_formation) {
		// P0.4 - Query Builder
		$this->db->where('id_formation', $id_formation);
		$result = $this->db->get('evaluation_hot');
		return $result->num_rows() >= 1;
	}

	// ------------------------------------------------------------------------
	// Helpers internes
	// ------------------------------------------------------------------------

	private function is_bcrypt_hash($hash) {
		return is_string($hash) && (
			strpos($hash, '$2y$') === 0 ||
			strpos($hash, '$2a$') === 0 ||
			strpos($hash, '$argon2') === 0
		);
	}

	private function is_md5_hash($hash) {
		return is_string($hash) && strlen($hash) === 32 && ctype_xdigit($hash);
	}
}
