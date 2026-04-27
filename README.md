# Kaliopi — Gestion d'organisme de formation

Application web PHP/CodeIgniter 3 pour la gestion d'un organisme de formation professionnelle (MAF Formation).

## Architecture

- **Framework** : CodeIgniter 3
- **Langage** : PHP 7.0+
- **Base de données** : MySQL
- **Serveur** : OVH mutualisé (cluster111)

## Modules

| Module | Description |
|--------|-------------|
| Catalogue formations | Programmes de formation par thématique |
| QCM en ligne | Évaluations pédagogiques (départ + intermédiaire) |
| Gestion stagiaires | Conventions, émargement, attestations |
| Facturation | Intégration WooCommerce/EDD |
| Recrutement formateurs | CV, candidatures |
| Administration | Supervision, paramètres |

## Structure CodeIgniter

```
application/
  config/         # Configuration (routes, database, etc.)
  controllers/    # Welcome, Admin, Prof, Kami, Kamo
  models/         # FormationModel, WelcomeModel
  views/          # Templates (header, footer, main, admin, welcome)
  helpers/        # Helpers personnalisés
  libraries/      # DOMPDF, WooCommerce API
  language/       # Français / Anglais
  third_party/    # PHPExcel

system/           # Core CodeIgniter (non versionné)

QCM_*.json        # Bases de questions QCM
```

## Configuration

Copier `application/config/database.php` et modifier :
- hostname
- username
- password
- database

## Sécurité

⚠️ Cette application est un clone d'une application existante. Avant toute mise en production :
- Changer les mots de passe
- Activer le CSRF
- Vérifier les droits fichiers

## Historique

- Récupérée depuis OVH le 27/04/2026
- Cahier des charges disponible dans `/memoire maf/`
