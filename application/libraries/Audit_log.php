<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Audit_log - Journalisation des actions sensibles
 *
 * Section 9 bis - P1.6 du plan de remédiation sécurité Kaliopi.
 *
 * Conformité :
 *  - RGPD article 30 : registre des activités de traitement
 *  - RGPD article 32 : mesures de sécurité (traçabilité des accès)
 *  - Qualiopi indicateur 32 : traçabilité des actions pédagogiques
 *
 * SCHÉMA SQL (à appliquer une fois en base) :
 *
 *   CREATE TABLE audit_log (
 *       id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 *       created_at    DATETIME(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
 *       user_id       VARCHAR(190) NULL,
 *       user_role     VARCHAR(50)  NULL,
 *       action        VARCHAR(100) NOT NULL,
 *       table_name    VARCHAR(100) NULL,
 *       record_id     VARCHAR(190) NULL,
 *       ip            VARCHAR(45)  NULL,
 *       user_agent    VARCHAR(255) NULL,
 *       data_before   MEDIUMTEXT   NULL,
 *       data_after    MEDIUMTEXT   NULL,
 *       INDEX idx_audit_user (user_id),
 *       INDEX idx_audit_action (action),
 *       INDEX idx_audit_created (created_at)
 *   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 *
 * NOTE RGPD : la table doit être en INSERT-only au niveau applicatif.
 * Idéalement créer un user MySQL dédié `kaliopi_audit` avec uniquement
 * les droits SELECT, INSERT (pas UPDATE/DELETE) sur cette table.
 *
 * USAGE :
 *   $this->load->library('audit_log');
 *   $this->audit_log->record('formation.delete', [
 *       'table_name' => 'formation',
 *       'record_id'  => $id,
 *       'data_before'=> $row_avant,
 *   ]);
 */
class Audit_log {

	private $CI;
	private $table = 'audit_log';

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->database();
	}

	/**
	 * Enregistre une entrée d'audit.
	 *
	 * @param string $action Identifiant de l'action (ex: 'admin.login', 'formation.delete')
	 * @param array  $ctx    Contexte : table_name, record_id, data_before, data_after
	 * @return bool
	 */
	public function record($action, array $ctx = []) {
		try {
			$session = $this->CI->session;
			$user_id = null;
			$role    = null;

			if ($session->userdata('logged_admin')) {
				$user_id = $session->userdata('user_id');
				$role    = 'admin';
			} elseif ($session->userdata('logged_prof')) {
				$user_id = $session->userdata('user_id');
				$role    = 'prof';
			} elseif ($session->userdata('logged_in')) {
				$user_id = $session->userdata('id_formation');
				$role    = 'apprenant';
			}

			$row = [
				'action'      => substr((string) $action, 0, 100),
				'user_id'     => $user_id ? substr((string) $user_id, 0, 190) : null,
				'user_role'   => $role,
				'table_name'  => isset($ctx['table_name']) ? substr($ctx['table_name'], 0, 100) : null,
				'record_id'   => isset($ctx['record_id']) ? substr((string) $ctx['record_id'], 0, 190) : null,
				'ip'          => $this->CI->input->ip_address(),
				'user_agent'  => substr((string) $this->CI->input->user_agent(), 0, 255),
				'data_before' => $this->safe_encode($ctx['data_before'] ?? null),
				'data_after'  => $this->safe_encode($ctx['data_after']  ?? null),
			];

			return (bool) $this->CI->db->insert($this->table, $row);
		} catch (\Throwable $e) {
			// Un échec d'audit ne doit JAMAIS faire planter l'action métier.
			log_message('error', 'Audit_log échec : ' . $e->getMessage());
			return false;
		}
	}

	/**
	 * Encode en JSON en filtrant les champs sensibles (RGPD : pas de password en clair).
	 */
	private function safe_encode($data) {
		if ($data === null) {
			return null;
		}
		if (is_array($data) || is_object($data)) {
			$arr = (array) $data;
			$blacklist = ['password', 'mot_de_passe', 'pwd', 'token_acces', 'csrf_token', 'kaliopi_csrf_token'];
			foreach ($blacklist as $k) {
				if (isset($arr[$k])) {
					$arr[$k] = '***REDACTED***';
				}
			}
			return json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
		}
		return (string) $data;
	}
}
