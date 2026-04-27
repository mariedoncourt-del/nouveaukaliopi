<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rate_limiter - Limitation du nombre de tentatives par IP/clé
 *
 * Section 9 bis - P1.1 du plan de remédiation sécurité.
 *
 * Implémentation simple basée sur le système de fichiers (compatible OVH mutualisé,
 * pas de dépendance Redis/Memcached). Pour une montée en charge, basculer sur une
 * table SQL `login_attempts(ip, action, timestamp, success)` ou Redis.
 *
 * Usage :
 *   $this->load->library('rate_limiter');
 *   if (!$this->rate_limiter->allow('admin_login', $ip, 5, 900)) {
 *       // Bloqué : 5 tentatives sur 900s écoulées
 *   }
 *   // En cas de succès :
 *   $this->rate_limiter->reset('admin_login', $ip);
 */
class Rate_limiter {

	private $storage_path;

	public function __construct() {
		$this->storage_path = APPPATH . 'cache/rate_limit/';
		if (!is_dir($this->storage_path)) {
			@mkdir($this->storage_path, 0750, true);
		}
	}

	/**
	 * Vérifie si une nouvelle tentative est autorisée et l'enregistre.
	 *
	 * @param string $action      Identifiant logique de l'action (ex: 'admin_login')
	 * @param string $key         Clé identifiant le client (typiquement l'IP)
	 * @param int    $max         Nombre max de tentatives
	 * @param int    $window_sec  Fenêtre temporelle en secondes
	 * @return bool TRUE si autorisé (et la tentative est comptée), FALSE si bloqué
	 */
	public function allow($action, $key, $max = 5, $window_sec = 900) {
		$file = $this->get_file($action, $key);
		$now = time();
		$attempts = $this->load_attempts($file);

		// Purge des tentatives hors fenêtre
		$attempts = array_filter($attempts, function($ts) use ($now, $window_sec) {
			return ($now - $ts) <= $window_sec;
		});

		if (count($attempts) >= $max) {
			$this->save_attempts($file, $attempts);
			return false;
		}

		$attempts[] = $now;
		$this->save_attempts($file, $attempts);
		return true;
	}

	/**
	 * Réinitialise le compteur après une action réussie.
	 */
	public function reset($action, $key) {
		$file = $this->get_file($action, $key);
		if (file_exists($file)) {
			@unlink($file);
		}
	}

	/**
	 * Renvoie le nombre de tentatives restantes dans la fenêtre.
	 */
	public function remaining($action, $key, $max = 5, $window_sec = 900) {
		$file = $this->get_file($action, $key);
		$now = time();
		$attempts = $this->load_attempts($file);
		$attempts = array_filter($attempts, function($ts) use ($now, $window_sec) {
			return ($now - $ts) <= $window_sec;
		});
		return max(0, $max - count($attempts));
	}

	// ------------------------------------------------------------------------

	private function get_file($action, $key) {
		// Hash pour éviter caractères exotiques dans le nom de fichier
		$hash = sha1($action . '|' . $key);
		return $this->storage_path . $hash . '.json';
	}

	private function load_attempts($file) {
		if (!file_exists($file)) {
			return [];
		}
		$data = @file_get_contents($file);
		if ($data === false) {
			return [];
		}
		$decoded = json_decode($data, true);
		return is_array($decoded) ? $decoded : [];
	}

	private function save_attempts($file, $attempts) {
		@file_put_contents($file, json_encode(array_values($attempts)), LOCK_EX);
		@chmod($file, 0640);
	}
}
