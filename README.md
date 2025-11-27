# FeedFlow – Starter Kit (Formation Laravel Avancé)

![Laravel](https://img.shields.io/badge/Laravel-13.x-red?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?style=flat-square)
![Docker](https://img.shields.io/badge/Docker-ready-0db7ed?style=flat-square)
![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)


Plateforme SaaS de création et diffusion de sondages.  
Ce starter kit accompagne la formation **Laravel Avancé** et fournit une base propre, testable et maintenable.

---

## 🚀 Lancer le projet

```bash
# 1. Cloner le projet
git clone https://github.com/M-Thibaud/Feedflow-Starter-Kit.git
cd Feedflow-Starter-Kit

# 2. Copier l’environnement
cp .env.example .env

# 3. Construire les conteneurs
docker compose build

# 4. Lancer l’environnement
docker compose up -d

# 5. Installer et initialiser Laravel
docker exec -it feedflow-app bash -c "
  composer install --no-dev --optimize-autoloader --no-interaction &&
  php artisan key:generate --force &&
  php artisan storage:link &&
  php artisan migrate
"

# 6. Ajouter les données par défaut
docker exec -it feedflow-app php artisan db:seed
````

---

## 🔗 Liens utiles

| Outil       | URL                                            | Info                                           |
| ----------- | ---------------------------------------------- | ---------------------------------------------- |
| Application | [http://localhost:8000](http://localhost:8000) | Interface FeedFlow                             |
| Mailpit     | [http://localhost:8025](http://localhost:8025) | Emails & notifications                         |
| PhpMyAdmin  | [http://localhost:8080](http://localhost:8080) | user : `feedflow_user` / pass : `feedflow2025` |

**Compte test :** `test@feedflow.local` / `password`

---

## 🐳 Commandes Docker utiles

| Action            | Commande                                   |
| ----------------- | ------------------------------------------ |
| Entrer dans l’app | `docker exec -it feedflow-app bash`        |
| Sortir            | `exit`                                     |
| Artisan           | `docker exec -it feedflow-app php artisan` |

---

## 📦 Fonctionnalités réalisées

### ✅ Plateforme SaaS de sondages

* CRUD sondages
* Types de questions : choix unique, multiple, texte, échelle 1–10
* Lien public unique `/s/{token}`
* Formulaire public (anonyme ou identifié)

### ✅ Multi-organisations

* Gestion d’organisations
* Rôles admin / membre
* Switching d’organisation
* Policies complètes

### ✅ Notifications & automatisations

* Email à chaque nouvelle réponse
* Rapport quotidien si +10 réponses
* Fermeture automatique du sondage expiré
* Rapport final envoyé par email

### ✅ Résultats

* 2 graphiques Chart.js
* Détails des réponses

### ✅ Modèle Freemium

* Gratuit : 3 sondages actifs + 100 réponses/mois
* Premium : illimité + thèmes + exports
* Gestion des quotas
* Email lors du changement de forfait (bonus)

### ✅ Autres

* Page Settings (notifications email)
* Dashboard (stats)
* Regroupement des sondages
* Pages Auth (login/register)
* URL cryptée (bonus)
* Tests unitaires pour la création d’un sondage et d’une réponse

---

## 👥 Contributeurs

* **Starter Kit & encadrement :** M. Thibaud
* **Développement :**

| Nom | Rôle | GitHub |
| :--- | :--- | :--- |
| **Mathys Sclafer** | Développeur | [@zinackes](https://github.com/zinackes) |
| **Inès Charfi** | Développeur | [@djelines](https://github.com/djelines) |
| **Clement Seurin le Goffic** | Développeur | [@Cl3m3nt03](https://github.com/Cl3m3nt03) |
| **Matéis Bourlet** | Développeur | [@BourletMateis](https://github.com/BourletMateis) |
| **Célestin Honvault** | Développeur | [@xhuriken](https://github.com/xhuriken) |

---
