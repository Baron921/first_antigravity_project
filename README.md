# Global Jobs - Laravel Job Board 🚀

Un portail de recrutement complet et moderne construit avec **Laravel 11+** et **PostgreSQL**, bénéficiant d'une interface graphique professionnelle entièrement calquée sur le célèbre template **JobBox**.

Cette application met en relation des entreprises cherchant à recruter et des candidats à la recherche de nouvelles opportunités.

---

## 🌟 Fonctionnalités Principales

### Pour les Entreprises (Recruteurs)
- **Tableau de Bord Dédié** : Suivi des annonces publiées et du volume de candidatures.
- **Publication d'Offres** : Éditeur complet pour publier des annonces (Titre, Lieu, Salaire, Description).
- **Gestion des Candidatures (ATS)** : 
  - Visualisation des profils ayant postulé.
  - Téléchargement sécurisé du CV (PDF/Word) des candidats.
  - Système de décision en un clic (Accepter ✅ ou Refuser ❌).

### Pour les Candidats
- **Exploration des Emplois** : Interface de recherche fluide avec filtres visuels (Design JobBox).
- **Candidature Rapide** : Formulaire permettant de joindre un message personnalisé et de téléverser son CV.
- **Suivi des Candidatures** : Espace personnel pour voir en temps réel l'avancée de ses candidatures (En attente, Acceptée, Refusée).

### Générales & Techniques
- **Design Premium JobBox** : Intégration complète du CSS JobBox, animations fluides (WOW.js), et responsive design.
- **Authentification Rôles** : Système de login sur-mesure avec Middleware d'autorisation selon le profil (Company / Candidate).
- **Base de données PostgreSQL** : Conception robuste avec clés étrangères et suppression en cascade.

---

## 🛠️ Stack Technique

- **Backend** : PHP 8.2+, Laravel 11/12
- **Base de données** : PostgreSQL
- **Frontend** : Blade Templating, JobBox HTML Template (Bootstrap 5, Vanilla JS)
- **Stockage** : Laravel Storage Local (Pour les CVs)

---

## 🚀 Installation Locale

Suivez ces étapes pour exécuter le projet sur votre machine locale.

### 1. Prérequis
- `PHP` (>= 8.2)
- `Composer`
- `PostgreSQL` installé et en cours d'exécution.

### 2. Cloner le projet
```bash
git clone https://github.com/Baron921/first_antigravity_project.git
cd first_antigravity_project
```

### 3. Installer les dépendances
```bash
composer install
npm install
```

### 4. Configuration de l'environnement
Copiez le fichier de configuration et générez la clé d'application Laravel :
```bash
cp .env.example .env
php artisan key:generate
```

Configurez votre `.env` pour le connecter à votre instance PostgreSQL locale :
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=jobboard
DB_USERNAME=votre_nom_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

### 5. Base de données & Stockage
Créez les tables (Migrations) et liez le dossier de stockage pour que l'application puisse distribuer visuellement les CVs téléversés :
```bash
php artisan migrate
php artisan storage:link
```

### 6. Lancer l'application
Démarrez le serveur de développement Laravel :
```bash
php artisan serve
```

Le site est maintenant accessible à cette adresse : **http://localhost:8000** 🎉

---

## 📸 Aperçu

Le design du site inclut une grande bannière de recherche, des grilles d'emplois sous forme de "Cartes", ainsi qu'une vue détaillée avec barre latérale pour la postulation. L'esthétique met à profit la typographie *Plus Jakarta Sans* et les ombres vectorielles interactives.

---
**Développé avec passion via Antigravity Assistant.**
