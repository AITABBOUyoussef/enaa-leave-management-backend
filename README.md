# 🏢 ENAA Leave Management System — API Backend

API RESTful robuste et sécurisée conçue pour la digitalisation et la gestion des demandes de congés, d'autorisations d'absence et de la continuité pédagogique au sein de l'École Numérique Ahmed El Hansali (ENAA).

---

## 🚀 Stack Technique

* **Framework:** Laravel 11 / PHP 8.3
* **Base de données:** MySQL 8.0
* **Authentification:** Laravel Sanctum (Token-based API authentication)
* **Autorisations & Rôles:** Spatie Laravel Permission (`employee`, `teacher`, `manager`, `hr`, `admin`)
* **Queue / Notifications:** Laravel Database Queues
* **Tests:** PHPUnit / Pest
* **Conteneurisation:** Docker & Docker Compose

---

## 📂 Architecture Métier (Domain-Driven Services)

Conformément aux exigences architecturales du brief, la logique métier est découplée des contrôleurs dans une couche dédiée de services :

```text
app/
├── Http/Controllers/Api/       # Gestion des requêtes/réponses HTTP
├── Models/                     # Modèles Eloquent & relations
├── Services/                   # Logique métier pure
│   ├── LeaveCalculatorService.php  # Calcul des jours ouvrés (exclusion WE et jours fériés)
│   └── WorkflowEngineService.php   # Gestion de la machine à états (pending_manager -> pending_hr -> approved)
└── Notifications/              # Alertes mail et in-app via Queues
```

---

## 🛠️ Installation Locale

### Prérequis

* PHP >= 8.2 & Composer
* MySQL / MariaDB

### Étapes d'installation

1. **Cloner le projet et naviguer dans le dossier backend :**
   ```bash
   cd enaa-leave-management-backend
   ```

2. **Installer les dépendances Composer :**
   ```bash
   composer install
   ```

3. **Configuration de l'environnement :**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer la base de données dans `.env` :**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=enaa_leave_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Exécuter les migrations et seeders :**
   ```bash
   php artisan migrate --seed
   ```

6. **Lancer le serveur de développement et les workers :**
   ```bash
   php artisan serve
   # Dans un autre terminal pour les notifications :
   php artisan queue:work
   ```

---

## 🔑 Comptes de Test (Seeders)

| Rôle | Email | Mot de passe | Description |
| --- | --- | --- | --- |
| **Teacher (Formateur)** | `teacher@enaa.ma` | `password123` | Accès formulaire avec continuité pédagogique |
| **Manager (N+1)** | `manager@enaa.ma` | `password123` | Validation niveau 1 (`pending_manager`) |
| **RH / Direction** | `hr@enaa.ma` | `password123` | Validation finale N+2, solde & planning |

---

## 🧪 Tests Automatisés

```bash
php artisan test
```
