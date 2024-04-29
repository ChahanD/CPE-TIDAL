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
```
src/
├── api/
│   ├── getdiseases.php
│   └── getusers.php
├── controllers/
│   ├── authentification.php
│   ├── pathologie.php
│   ├── rendez-vous.php
│   └── symptome.php
├── index.php
├── models/
│   └── database.php
├── public/
│   ├── images/
│   ├── scripts/
│   └── styles/
├── vendor/
│   └── autoload.php
└── views/
    ├── authentification.twig
    ├── base.twig
    ├── footer.twig
    ├── header.twig
    ├── index.twig
    ├── pathologie.twig
    ├── rendez-vous.twig
    └── symptome.twig
```
Explication des fichiers: 
- `api/` contient les fichiers PHP qui servent à récupérer les données de la base de données.
- `controllers/` contient les fichiers PHP qui servent à gérer les différentes pages de l'application.
- `index.php` est le point d'entrée de l'application.
- `models/` contient les fichiers PHP qui servent à gérer la connexion à la base de données.
- `public/` contient les fichiers statiques (images, scripts, styles) de l'application.
- `vendor/` contient les dépendances PHP du projet.
- `views/` contient les fichiers Twig qui servent à générer les pages HTML de l'application.

## Normes d’accessibilité de niveau AAA.

Nous avons employé le logiciel Nu Html Checker pour assurer la conformité de notre site web aux normes d'accessibilité de niveau AAA, et pour garantir qu'il est correctement structuré en HTML5. Chaque page de notre site est conçue pour être facilement accessible depuis la page d'accueil, nécessitant au maximum trois interactions, qu'il s'agisse de clics, de raccourcis clavier, ou d'autres moyens d'interaction. De plus, nous avons veillé à ce que la navigation sur notre site soit entièrement réalisable sans l'usage de la souris ou du clavier, rendant ainsi notre site web accessible à tous les utilisateurs, indépendamment de leurs capacités.

## Contributors
L'ensemble du projet à été réalisé par les éleves 4ETI suivants:
    - Maxime  Balleur
    - Maxence Di-Meo
    - Chahan  Donikian
    - Alice   Esmilaire

## Webographie

- https://twig.symfony.com
- https://getcomposer.org
- https://www.php.net/manual/fr/intro-whatis.php
- https://validator.w3.org/nu/
- https://www.w3schools.com
- https://openclassrooms.com/fr/
- https://unsplash.com/fr
- https://restfulapi.net

FEEDBACK: 
rest: autocomp
cookie = cote serveur (fallait faire)
point d'entrée fichier .php