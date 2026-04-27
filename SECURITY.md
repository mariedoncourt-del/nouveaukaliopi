# SECURITY.md — Plan de remédiation sécurité Kaliopi

Ce document trace les corrections appliquées dans le cadre de la **Section 9 bis**
du cahier des charges (plan de remédiation sécurité). Il sert de référence pour
le déploiement, la recette et l'audit Qualiopi / RGPD.

---

## 1. Corrections P0 livrées (failles bloquantes)

### P0.1 — Migration MD5 → bcrypt
- **Fichiers** : `application/models/WelcomeModel.php`, `application/controllers/Admin.php`, `application/controllers/Prof.php`
- **Mécanisme** : `login_admin()` détecte automatiquement le format du hash stocké.
  - Si bcrypt (`$2y$...`) : `password_verify()` standard, avec re-hash si le coût a évolué.
  - Si MD5 (32 hex) : vérification puis re-hash transparent en bcrypt cost=12.
  - Si format inconnu : rejet + log d'erreur.
- **Côté contrôleur** : le `md5()` côté `Admin::index()` et `Prof::index()` a été supprimé. Le mot de passe est désormais transmis en clair au modèle qui se charge de la vérification.
- **Anti-timing-attack** : si le compte n'existe pas, on consomme tout de même un `password_hash()` factice pour ne pas révéler l'inexistence par mesure de durée.
- **Date butoir branche MD5** : 90 jours après mise en production. Au-delà, la branche legacy peut être retirée du modèle.

### P0.2 — Protection CSRF + filtrage XSS global
- **Fichier** : `application/config/config.php`
  - `csrf_protection = TRUE`, token name `kaliopi_csrf_token`, expire 7200s, `csrf_regenerate = FALSE` (compatibilité AJAX simultanés).
  - `global_xss_filtering = TRUE` (rustine, l'échappement contextuel via `e()` reste obligatoire).
- **Headers de vue** : ajout de `<?= csrf_meta() ?>` dans `application/views/header.php`, `application/views/admin/header.php`, `application/views/welcome/header.php` (deux balises `<meta name="csrf-token-name">` + `<meta name="csrf-token">`).
- **Footers de vue** : intercepteur jQuery `ajaxSetup()` ajouté dans les trois footers — header `X-CSRF-TOKEN` + injection du token dans le payload pour toute requête non-GET.

### P0.3 — Authentification stagiaire renforcée
- **Fichier** : `application/models/WelcomeModel.php`, méthode `login_public()`
- **Solution minimale livrée** :
  - Acceptation d'un `token_acces` (32 hex, généré par `bin2hex(random_bytes(16))`) en plus de l'`id_formation`.
  - Acceptation optionnelle d'un mot de passe stagiaire bcrypt.
  - Comparaison via `hash_equals()` (anti-timing) et `password_verify()`.
  - Rétrocompatibilité : si la colonne `token_acces` n'existe pas encore, fallback sur l'ancien comportement avec log d'avertissement (déploiement progressif).
- **Trajectoire cible (P2)** : compte apprenant unifié email + mot de passe, indépendant de l'inscription.

### P0.4 — Élimination des injections SQL
- **Fichiers** : `application/models/FormationModel.php`, `application/models/WelcomeModel.php`
- **Statut** : **les 67 sites de concaténation SQL dans FormationModel ont été convertis** en requêtes paramétrées (`$this->db->query("...?", array($var))`). 14 placeholders incorrectement entourés de guillemets ont également été corrigés.
- `WelcomeModel` a été refondu : plus aucune concaténation, utilisation exclusive du Query Builder.
- **Vérification** :
  ```bash
  grep -rnE 'query\(.*\.\s*\$' application/models/ application/controllers/
  # Doit retourner 0 résultat
  ```
- **Recommandation** : ajouter à la CI un linter SAST (PHPStan + phpstan-codeigniter) pour bloquer toute régression.

### P0.5 — Échappement XSS systématique
- **Fichier** : `application/helpers/security_helper.php` (nouveau)
  - `e($value)` — échappement HTML standard
  - `e_attr($value)` — échappement strict pour attributs
  - `e_js($value)` — sérialisation sécurisée JS via `json_encode` avec flags HEX_*
  - `e_url($value)` — `rawurlencode` pour fragments d'URL
  - `csrf_meta()` / `csrf_input()` — helpers CSRF
  - `safe_filename()` / `verify_mime_type()` — helpers upload
- **Fichier** : `application/config/autoload.php` — helper `security` autoloadé (disponible partout).
- **Travail restant** : passer en revue les vues pour remplacer `<?php echo $var ?>` par `<?= e($var) ?>` sur les champs à risque (commentaires d'évaluation `eval_comm`/`sati_comm`, noms d'apprenants, suivis pédagogiques, scénarios).

---

## 2. Corrections P1 livrées (renforcements)

### P1.1 — Rate limiting sur les tentatives de connexion
- **Fichier** : `application/libraries/Rate_limiter.php` (nouveau)
- **Politique** : 5 tentatives / 15 minutes / IP, par action (`admin_login`, `prof_login`).
- **Stockage** : système de fichiers JSON dans `application/cache/rate_limit/` (compatible OVH mutualisé, pas de Redis requis). `.htaccess` `deny all` automatique sur le dossier.
- **Reset** : automatique en cas de connexion réussie.
- **Intégration** : `Admin::index()` et `Prof::index()` chargent et appellent `$this->rate_limiter->allow()` avant la vérification du mot de passe.

### P1.2 — Sessions et encryption_key durcies
- **Fichier** : `application/config/config.php`
  - `encryption_key` lue via `getenv('KALIOPI_ENCRYPTION_KEY')` — **ne JAMAIS la committer**.
  - `sess_cookie_name = 'kaliopi_session'` (renommé pour éviter collision WordPress).
  - `sess_expiration = 3600` (réduit de 7200 à 3600s).
  - `sess_match_ip = TRUE`, `sess_regenerate_destroy = TRUE`.
  - Régénération de l'ID de session après login (`sess_regenerate(TRUE)` dans Admin et Prof).

### P1.3 — En-têtes HTTP de sécurité
- **Fichier** : `.htaccess` racine — réécrit complètement.
- Headers : `X-Content-Type-Options: nosniff`, `X-Frame-Options: SAMEORIGIN`, `Referrer-Policy: strict-origin-when-cross-origin`, `Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=()`.
- CSP : configurée en mode `Content-Security-Policy-Report-Only` pour observation pendant 2-4 semaines avant bascule en mode bloquant.
- HSTS : ligne préparée mais commentée — à activer **uniquement** après confirmation HTTPS-only.
- Cookies : `cookie_secure = TRUE`, `cookie_httponly = TRUE`, `cookie_samesite = 'Lax'`.
- Redirection HTTPS : bloc préparé mais commenté (à activer en prod).
- Blocage de fichiers sensibles : `.htaccess`, `.git*`, `composer.json`, `.env`, `*.bak`, `*.sql`, `*.log`, `*2602.php`, `*~`, `*.swp`.
- Blocage de l'exécution PHP/CGI dans `assets/uploads`, `assets/cv`, `assets/scenarios`, `assets/programmes`, `assets/files`, `assets/videos`, `assets/supports` via `<DirectoryMatch>`.

### P1.4 — Sécurisation des uploads
- **Fichier** : `application/libraries/Secure_upload.php` (nouveau)
- **Fonctionnalités** :
  1. Whitelist par profil (`programme`, `cv`, `scenario`, `support`, `video`, `image`).
  2. Vérification MIME-type RÉEL via `finfo_file()` (pas seulement l'extension).
  3. Refus des doubles extensions (`shell.php.pdf`).
  4. Renommage systématique avec `bin2hex(random_bytes(16))` + extension whitelistée.
  5. Vérification `is_uploaded_file()` (anti-spoofing).
  6. Génération automatique d'un `.htaccess` `deny PHP` dans le dossier de destination.
  7. Permissions `0640` sur les fichiers déposés.
- **Travail restant côté Admin.php** : remplacer les ~12 appels `$this->upload->do_upload('link')` par `$this->secure_upload->process('link', '<profil>', $upload_path)`. Pattern :
  ```php
  // AVANT
  $config_file['upload_path'] = './assets/programmes/';
  $config_file['allowed_types'] = 'jpg';
  $this->load->library('upload', $config_file);
  if ($this->upload->do_upload('link')) {
      $upload_data = $this->upload->data();
      $pdf = $upload_data['file_name'];
  }

  // APRÈS
  $this->load->library('secure_upload');
  $result = $this->secure_upload->process('link', 'programme', './assets/programmes/');
  if ($result['success']) {
      $pdf = $result['file_name'];
  } else {
      $pdf = '';
      log_message('warning', 'Upload programme refusé : ' . $result['error']);
  }
  ```

### P1.6 — Audit log
- **Fichier** : `application/libraries/Audit_log.php` (nouveau)
- **Schéma SQL** : voir section 4 ci-dessous.
- **Usage** :
  ```php
  $this->load->library('audit_log');
  $this->audit_log->record('formation.delete', [
      'table_name' => 'formation',
      'record_id'  => $id,
      'data_before'=> $row_avant_suppression,
  ]);
  ```
- **Filtrage RGPD** : la méthode `safe_encode()` masque automatiquement les champs `password`, `token_acces`, `csrf_token`, etc.
- **Travail restant** : instrumenter les opérations CRUD sensibles dans `Admin.php` (création/modification/suppression de formation, apprenant, formateur, note, attestation).

---

## 3. Hygiène générale livrée

| Action | Statut | Détail |
|---|---|---|
| Suppression des fichiers de backup en prod | Fait | `Admin2602.php`, `Welcome2602.php`, `FormationModel2602.php` retirés via `git rm` |
| Mot de passe SMTP en clair | Fait | `'harena2021'` retiré de `Welcome.php`, lecture via `getenv('KALIOPI_SMTP_PASS')`. **Le compte Gmail concerné DOIT être révoqué et remplacé par un mot de passe d'application Gmail.** |
| Logs activés | Fait | `log_threshold = 1` (Erreurs uniquement) |
| Régénération de session post-login | Fait | `sess_regenerate(TRUE)` dans Admin et Prof |

---

## 4. Migration BDD à appliquer en production

Exécuter ces requêtes SQL **dans cet ordre** sur la base Kaliopi :

```sql
-- ============================================================
-- Migration sécurité Kaliopi - Section 9 bis
-- À jouer une seule fois sur la base de production.
-- ============================================================

-- P0.1 : allonger la colonne password admin (bcrypt = 60 chars, argon2id ~95 chars)
ALTER TABLE admin MODIFY COLUMN password VARCHAR(255) NOT NULL;

-- P0.3 : ajout du token d'accès stagiaire et du mot de passe stagiaire optionnel
ALTER TABLE formation
    ADD COLUMN token_acces VARCHAR(64) NULL AFTER id,
    ADD COLUMN password    VARCHAR(255) NULL,
    ADD COLUMN must_change_password TINYINT(1) NOT NULL DEFAULT 0,
    ADD INDEX idx_formation_token (token_acces);

-- Génération en lot des tokens pour les formations existantes :
-- (script PHP recommandé plutôt que SQL pur pour utiliser random_bytes)
--
-- foreach ($this->db->get('formation')->result() as $row) {
--     $token = bin2hex(random_bytes(16));
--     $this->db->where('id', $row->id)->update('formation', ['token_acces' => $token]);
--     // Envoi par email au stagiaire
-- }

-- P1.6 : table d'audit log
CREATE TABLE audit_log (
    id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_at    DATETIME(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
    user_id       VARCHAR(190) NULL,
    user_role     VARCHAR(50)  NULL,
    action        VARCHAR(100) NOT NULL,
    table_name    VARCHAR(100) NULL,
    record_id     VARCHAR(190) NULL,
    ip            VARCHAR(45)  NULL,
    user_agent    VARCHAR(255) NULL,
    data_before   MEDIUMTEXT   NULL,
    data_after    MEDIUMTEXT   NULL,
    INDEX idx_audit_user (user_id),
    INDEX idx_audit_action (action),
    INDEX idx_audit_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Recommandé : créer un user MySQL `kaliopi_audit` avec uniquement INSERT/SELECT
-- sur audit_log pour empêcher la modification a posteriori des journaux.
```

---

## 5. Variables d'environnement à définir en production

À configurer sur le serveur (OVH : panel "Variables d'environnement" ou
`.htaccess` avec `SetEnv` — **JAMAIS** dans le code) :

```bash
# Clé de chiffrement CodeIgniter (générer une fois, ne jamais changer)
KALIOPI_ENCRYPTION_KEY=$(php -r 'echo bin2hex(random_bytes(32));')

# Identifiants SMTP (mot de passe d'application Gmail recommandé)
KALIOPI_SMTP_HOST=ssl://smtp.gmail.com
KALIOPI_SMTP_PORT=465
KALIOPI_SMTP_USER=harenadesign@gmail.com
KALIOPI_SMTP_PASS=<mot_de_passe_application_gmail>
```

---

## 6. Checklist de recette avant mise en production

- [ ] Migration BDD jouée (admin.password étendu, formation.token_acces ajouté, audit_log créée)
- [ ] Variables d'environnement définies sur le serveur
- [ ] Compte Gmail SMTP `harenadesign@gmail.com` : mot de passe changé + mot de passe d'application généré
- [ ] Tokens générés et envoyés par email aux apprenants actifs
- [ ] Test de connexion admin avec un compte legacy MD5 → vérifier la migration auto vers bcrypt
- [ ] Test de connexion admin avec un compte déjà bcrypt → succès sans re-hash inutile
- [ ] Test de rate limiting : 6 tentatives échouées → blocage 15 min
- [ ] Test CSRF : POST sans token → réponse 403
- [ ] Test AJAX : POST DataTables/QCM → réussite (intercepteur fonctionnel)
- [ ] Test upload : `shell.php.pdf` → refus
- [ ] Test upload : PDF valide → renommage en hash aléatoire
- [ ] Vérification des en-têtes HTTP via securityheaders.com → note A
- [ ] Surveillance des logs CSP-Report-Only pendant 2-4 semaines avant bascule en mode bloquant
- [ ] Activation HSTS (ligne décommentée) seulement après confirmation HTTPS-only

---

## 7. Chantiers restants

**P1 à compléter :**
- Patcher les ~12 sites d'upload dans `Admin.php` pour utiliser `Secure_upload` (pattern P1.4 ci-dessus).
- Instrumenter les opérations CRUD sensibles avec `Audit_log` (pattern P1.6).
- Passer en revue les vues pour remplacer les `echo $var` par `<?= e($var) ?>`.
- Mettre en place RBAC granulaire (table `roles`, `permissions`, `role_permission`).

**P2 (6 mois) :**
- Migration PHP 8.2 + CodeIgniter 4.
- Séparation BDD WordPress / Kaliopi.
- Sauvegardes chiffrées hors site + tests de restauration trimestriels.
- Pentest externe PASSI.
- Politique de gestion des données (durées de conservation RGPD).
- Sensibilisation utilisateurs (1/2 journée).

---

*Document généré le 27/04/2026 — branche `genspark_ai_developer`*
