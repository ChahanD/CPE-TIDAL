# Projet Tidal - The Acu Bros

Ce projet est une application web d'acupuncture traditionnelle. Il a été développé par l'équipe The Acu Bros dans le cadre du cours de Projet Tidal à CPE Lyon.
***lien vers notre GitHub:***
https://github.com/cpe-lyon/projet-tidal-theacu-bros

## Instructions d'installation
Pour lancer le projet, vous devez avoir Docker installé sur votre machine. Ensuite, exécutez la commande suivante dans le répertoire racine du projet :

commande pour lancer le projet : 
```bash 
docker-compose up -d --build`
```

## Instructions d'utilisation
Une fois que l'application est en cours d'exécution, vous pouvez y accéder en ouvrant votre navigateur web et en naviguant vers http://localhost:50180

## Structure du code

Le code de l'application est structuré en plusieurs parties :

- src/controllers/ : Contient les contrôleurs PHP pour les différentes pages de l'application.
  - `authentification.php` : Gère l'authentification des utilisateurs.
  - `pathologie.php` : Gère l'affichage des pathologies.
  - `rendez-vous.php` : Gère l'affichage des rendez-vous.
  - `search_pathologie.php` : Gère la recherche de pathologies.
  - `search_symptome.php` : Gère la recherche de symptômes.
  - `symptome.php` : Gère l'affichage des symptômes.
Chacun de ces fichiers utilise le modèle de base de données défini dans database.php pour interagir avec la base de données.
- `src/models/` : Contient le modèle de base de données.
  - `database.php` : Fournit les fonctions pour interagir avec la base de données.

- `src/views/` : Contient les templates Twig pour les différentes pages de l'application.
  - `home.twig` : Template pour la page d'accueil.
  - `login.twig` : Template pour la page de connexion.
  - `register.twig` : Template pour la page d'inscription.
  - `search.twig` : Template pour la page de recherche.

- `src/public/` : Contient les fichiers statiques publics.
  - `images/` : Contient les images utilisées dans l'application.
  - `styles/` : Contient les fichiers CSS pour le style de l'application.

- `scripts/` : Contient les scripts JavaScript pour l'application.
  - `authentification.js` : Gère l'authentification des utilisateurs.
  - `search.js` : Gère la recherche de pathologies et de symptômes.

## Normes d’accessibilité de niveau AAA.

Nous avons employé le logiciel Nu Html Checker pour assurer la conformité de notre site web aux normes d'accessibilité de niveau AAA, et pour garantir qu'il est correctement structuré en HTML5. Chaque page de notre site est conçue pour être facilement accessible depuis la page d'accueil, nécessitant au maximum trois interactions, qu'il s'agisse de clics, de raccourcis clavier, ou d'autres moyens d'interaction. De plus, nous avons veillé à ce que la navigation sur notre site soit entièrement réalisable sans l'usage de la souris ou du clavier, rendant ainsi notre site web accessible à tous les utilisateurs, indépendamment de leurs capacités.

## Contributors
L'ensemble du projet à été réalisé par les éleves 4ETI suivants:
    - Maxime Balleur
    - Alice Esmilaire
    - Chahan Donikian
    - Maxence Di-Meo

## Webographie

- https://twig.symfony.com
- https://getcomposer.org
- https://www.php.net/manual/fr/intro-whatis.php
- https://validator.w3.org/nu/
- https://www.w3schools.com
- https://openclassrooms.com/fr/
- https://unsplash.com/fr
