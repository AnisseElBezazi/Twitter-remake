# 🎬 FlixThread - Twitter Remake

FlixThread est un réseau social avec l'UX de Twitter(X) et L'UI de Netflix, permettant aux utilisateurs de discuter dans des salons dédiés à des films et séries populaires.

## Fonctionnalités

- **Système d'Authentification :** Inscription et connexion sécurisées.
<img width="1916" height="996" alt="image" src="https://github.com/user-attachments/assets/d6607cd3-abea-4426-bf00-87c2314e1c33" />
 **Profils Personnalisables :** Modification de la bio, du nom réel, de l'avatar et de la bannière.
  <img width="1919" height="1197" alt="image" src="https://github.com/user-attachments/assets/2f65ef9d-4842-48b9-bc5e-11322a62892f" />


- **Salons Thématiques :** Les discussions sont organisées par salons (films/séries) créés par les administrateurs.
- <img width="374" height="1197" alt="image" src="https://github.com/user-attachments/assets/ff175e27-2f2c-4a55-a6f5-472fc4891d90" />

- **Fils d'Actualité :** Publication textuels ou accompagnés d'image.
- <img width="994" height="1199" alt="image" src="https://github.com/user-attachments/assets/414a0848-01aa-4b94-bed8-0414ea8a13c5" />

- **Commentaires et Likes:** Commentaires sous les posts + Likes (Section like dans la page profil).
- <img width="998" height="1199" alt="image" src="https://github.com/user-attachments/assets/f9d4dffc-b847-4994-996e-1765679da2ba" />

- **Recherche :** Filtrage des salons et des posts via JavaScript.
- **Administration :** Panel permettant d'ajouter ou de supprimer des salons.
- <img width="452" height="1198" alt="image" src="https://github.com/user-attachments/assets/aa6babfa-738d-4828-95d0-c115430f4711" />


## Stack Technique & Environnement

- **Environnement local :** [Laragon](https://laragon.org/) (Recommandé)
- **Backend :** PHP 8.3
- **Base de données :** MySQL
- **Gestionnaires de paquets :** Composer & NPM
- **Frontend :** HTML5, SCSS, JavaScript.

## Installation et Configuration

### 1. Prérequis

- Avoir installé **Laragon** (ou un équivalent comme WAMP/XAMPP).
- Avoir **Node.js** et **Composer** installés sur votre machine.

### 2. Clonage et Dépendances

Clonez le projet dans votre répertoire www de Laragon :

```bash
git clone [https://github.com/AnisseElBezazi/Twitter-remake]
cd Twitter-remake
```

Installez les dépendances Backend (PHP) et Frontend (JS) :

```bash
composer install
npm install
```

### 3. Base de données

1. Créez une base de données MySQL nommée secu_web
2. Importez le fichier dump.sql situé à la racine du projet.

### 4. Variables d'environnement

Créez un fichier .env à la racine du projet et configurez vos accès :

```env
DB_HOST=localhost
DB_DATABASE=secu_web
DB_USERNAME=root
DB_PASSWORD=
```

(projet scolaire raison du partage du .env)

## Sécurité

- **Protection CSRF :** Utilisation de jetons uniques pour chaque formulaire.
- **Validation d'Upload :** Vérifications de formats du contenu et renommage.
- **Sécurisation SQL :** Utilisation systématique de requêtes préparées (PDO) contre les injections SQL.
- **Gestion du Stockage :** Limite de taille des fichier a 2Mo ou 5Mo et suppression des anciens uploads en cas d'édit.
- **Sécuriter XSS** htmlspecialchars().

## Compte admin

- **Adresse email :** test@gmail.com
- **Mot de passe :** Salam92?

## Auteurs

- Projet réalisé par Anisse El Bezazi et Quentin Deglas.
