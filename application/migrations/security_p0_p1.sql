-- =============================================================================
-- Kaliopi - Migration SQL Sécurité (Section 9 bis P0 + P1)
-- =============================================================================
-- À exécuter UNE SEULE FOIS sur la base de production, après sauvegarde complète.
-- Préalable : `mysqldump --single-transaction --routines kaliopi > backup_avant_secu.sql`
-- =============================================================================

-- -----------------------------------------------------------------------------
-- P0.1 - Élargissement de la colonne password admin pour accueillir bcrypt (60 car)
-- -----------------------------------------------------------------------------
-- Les hash MD5 actuels (32 caractères) restent compatibles : ils seront migrés
-- automatiquement vers bcrypt lors de la prochaine connexion réussie de chaque
-- admin (cf. WelcomeModel::login_admin()).
ALTER TABLE `admin`
    MODIFY COLUMN `password` VARCHAR(255) NOT NULL;

-- -----------------------------------------------------------------------------
-- P0.3 - Authentification stagiaire renforcée (token + mot de passe)
-- -----------------------------------------------------------------------------
-- Token d'accès aléatoire (32 caractères hex, généré par random_bytes(16))
-- transmis par email au stagiaire en complément de l'ID de formation.
ALTER TABLE `formation`
    ADD COLUMN `token_acces` VARCHAR(64) DEFAULT NULL COMMENT 'Token aléatoire P0.3',
    ADD COLUMN `password` VARCHAR(255) DEFAULT NULL COMMENT 'Mot de passe stagiaire bcrypt',
    ADD COLUMN `password_doit_changer` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Force le changement à la 1ère connexion',
    ADD INDEX `idx_token_acces` (`token_acces`);

-- Génération du token initial pour toutes les formations existantes
-- (à exécuter via un script PHP dédié pour utiliser random_bytes - voir scripts/generate_tokens.php)
-- UPDATE `formation` SET `token_acces` = UNHEX(REPLACE(UUID(), '-', ''))
-- WHERE `token_acces` IS NULL;

-- -----------------------------------------------------------------------------
-- P1.6 - Table d'audit log (RGPD art. 30 + Qualiopi indicateur 32)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `audit_log` (
    `id`              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`         VARCHAR(100)    DEFAULT NULL,
    `role`            VARCHAR(32)     DEFAULT NULL COMMENT 'admin/prof/apprenant/anonymous',
    `action`          VARCHAR(32)     NOT NULL    COMMENT 'CREATE/UPDATE/DELETE/LOGIN_OK/LOGIN_KO/...',
    `table_affected`  VARCHAR(64)     DEFAULT NULL,
    `record_id`       VARCHAR(100)    DEFAULT NULL,
    `ip`              VARCHAR(45)     DEFAULT NULL COMMENT 'IPv4 ou IPv6',
    `user_agent`      VARCHAR(255)    DEFAULT NULL,
    `data_before`     MEDIUMTEXT      DEFAULT NULL COMMENT 'Snapshot JSON avant modification',
    `data_after`      MEDIUMTEXT      DEFAULT NULL COMMENT 'Snapshot JSON après modification',
    `note`            VARCHAR(500)    DEFAULT NULL,
    `created_at`      DATETIME        NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_user_id` (`user_id`),
    INDEX `idx_action` (`action`),
    INDEX `idx_created_at` (`created_at`),
    INDEX `idx_table_affected` (`table_affected`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Journal d''audit RGPD/Qualiopi - INSERT ONLY';

-- IMPORTANT : pour rendre la table immuable au niveau MySQL, créer un utilisateur
-- applicatif aux droits restreints :
--
--   CREATE USER 'kaliopi_app'@'localhost' IDENTIFIED BY 'MOT_DE_PASSE_FORT';
--   GRANT SELECT, INSERT, UPDATE, DELETE ON kaliopi.* TO 'kaliopi_app'@'localhost';
--   -- Mais pour audit_log, on retire UPDATE et DELETE :
--   REVOKE UPDATE, DELETE ON kaliopi.audit_log FROM 'kaliopi_app'@'localhost';
--   FLUSH PRIVILEGES;

-- -----------------------------------------------------------------------------
-- P1.5 (anticipé) - Table de rôles et permissions (préparation pour granulaire)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
    `id`       INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `code`     VARCHAR(32)  NOT NULL,
    `libelle`  VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `roles` (`code`, `libelle`) VALUES
    ('super_admin', 'Super administrateur'),
    ('admin',       'Administrateur'),
    ('gestionnaire','Gestionnaire'),
    ('formateur',   'Formateur'),
    ('apprenant',   'Apprenant');

CREATE TABLE IF NOT EXISTS `permissions` (
    `id`       INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `code`     VARCHAR(64)  NOT NULL,
    `libelle`  VARCHAR(150) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `role_permission` (
    `role_id`       INT UNSIGNED NOT NULL,
    `permission_id` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`role_id`, `permission_id`),
    CONSTRAINT `fk_rp_role`       FOREIGN KEY (`role_id`)       REFERENCES `roles`(`id`)       ON DELETE CASCADE,
    CONSTRAINT `fk_rp_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ajout d'une colonne role_id sur la table admin existante
ALTER TABLE `admin`
    ADD COLUMN `role_id`         INT UNSIGNED DEFAULT NULL,
    ADD COLUMN `last_login_at`   DATETIME     DEFAULT NULL,
    ADD COLUMN `last_login_ip`   VARCHAR(45)  DEFAULT NULL,
    ADD COLUMN `failed_attempts` INT UNSIGNED NOT NULL DEFAULT 0,
    ADD COLUMN `locked_until`    DATETIME     DEFAULT NULL,
    ADD CONSTRAINT `fk_admin_role` FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE SET NULL;

-- Par défaut, on attribue le rôle 'admin' à tous les comptes existants
UPDATE `admin` a
JOIN   `roles` r ON r.code = 'admin'
SET    a.role_id = r.id
WHERE  a.role_id IS NULL;

-- -----------------------------------------------------------------------------
-- P1.2 - Table de sessions (recommandé : sess_driver = 'database' en config.php)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id`         VARCHAR(128) NOT NULL,
    `ip_address` VARCHAR(45)  NOT NULL,
    `timestamp`  INT UNSIGNED NOT NULL DEFAULT 0,
    `data`       BLOB         NOT NULL,
    PRIMARY KEY (`id`, `ip_address`),
    INDEX `idx_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================================================
-- Fin de la migration sécurité P0 + P1
-- =============================================================================
