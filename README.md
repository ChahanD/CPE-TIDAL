# Projet Tidal - The Acu Bros

Ce projet est une application web d'acupuncture traditionnelle. Il a été développé par l'équipe The Acu Bros dans le cadre du cours de Projet Tidal à CPE Lyon.

***Lien vers notre GitHub:***
<https://github.com/cpe-lyon/projet-tidal-theacu-bros>

## Instructions d'installation

Pour lancer le projet, vous devez avoir Docker installé sur notre machine. Ensuite, exécutez la commande suivante dans le répertoire racine du projet :

commande pour lancer le projet :

```bash

docker-compose up -d --build`

```

## Instructions d'utilisation

Une fois que l'application est en cours d'exécution, vous pouvez y accéder en ouvrant notre navigateur web et en naviguant vers <http://localhost:50180>

## Structure du code

Le code source de l'application est organisé de la manière suivante :

```markdown

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

Explication des différents dossiers et fichiers :

- **`api/`** Ce dossier contient les fichiers PHP qui servent à récupérer les données de la base de données. Ces fichiers sont appelés par le fichier index.php lorsque des requêtes HTTP sont envoyées à notre API.
- **`controllers/`** Ce dossier contient les fichiers PHP qui servent à gérer les différentes pages de l'application. Ces fichiers sont appelés par le fichier `index.php` pour traiter les requêtes HTTP et générer les réponses appropriées.
- **`index.php`** C'est le point d'entrée de l'application. Il reçoit toutes les requêtes HTTP, détermine quel contrôleur ou quel fichier API doit être utilisé pour traiter la requête, et renvoie la réponse générée.
- **`models/`** Ce dossier contient les fichiers PHP qui servent à gérer la connexion à l   a base de données. Ces fichiers sont utilisés par les fichiers dans le dossier `api/` pour interagir avec la base de données.
- **`public/`**  Ce dossier contient les fichiers statiques (images, scripts, styles) de l'application. Ces fichiers sont servis directement par le serveur web lorsque des requêtes HTTP sont envoyées pour ces ressources.
- **`vendor/`** Ce dossier contient les dépendances PHP du projet, qui sont installées par Composer. Ces dépendances peuvent être utilisées n'importe où dans notre code en utilisant l'instruction *require* ou *include*.
- **`views/`** Ce dossier contient les fichiers Twig qui servent à générer les pages HTML de l'application. Ces fichiers sont utilisés par les fichiers dans le dossier `controllers/` pour générer les réponses HTML.

## Normes d’accessibilité de niveau AAA

Nous avons employé le logiciel Nu Html Checker pour assurer la conformité de notre site web aux normes d'accessibilité de niveau AAA, et pour garantir qu'il est correctement structuré en HTML5. Chaque page de notre site est conçue pour être facilement accessible depuis la page d'accueil, nécessitant au maximum trois interactions, qu'il s'agisse de clics, de raccourcis clavier, ou d'autres moyens d'interaction. De plus, nous avons veillé à ce que la navigation sur notre site soit entièrement réalisable sans l'usage de la souris ou du clavier, rendant ainsi notre site web accessible à tous les utilisateurs, indépendamment de leurs capacités.

## Améliorations possibles

Suite à notre entretien, nous avons mis en place l'utiliastion d'un point d'entrée unique pour les fichiers .php. Ces derniers devront être placés dans le dossier `api/` et devront être appelés via le fichier `index.php` situé à la racine du projet. Pour ce qui concerne les améliorations possibles de notre code, l'utilisation de cookies côté client peut générer des problèmes de sécurité. En effet, les cookies sont stockés sur le navigateur de l'utilisateur et peuvent être modifiés par ce dernier. Il est donc préférable de stocker les informations sensibles côté serveur. Mais par manque de temps, nous n'avons pas pu implémenter ces fonctionnalités.

## Contributors

L'ensemble du projet à été réalisé par les éleves 4ETI suivants:
    - Maxime  Balleur
    - Maxence Di-Meo
    - Chahan  Donikian
    - Alice   Esmilaire

## Webographie

Voici les liens vers les ressources que nous avons utilisées pour réaliser ce projet:

- <https://www.docker.com>
- <https://www.php.net>
- <https://www.postgresql.org>
- <https://twig.symfony.com>
- <https://getcomposer.org>
- <https://www.php.net/manual/fr/intro-whatis.php>
- <https://validator.w3.org/nu/>
- <https://www.w3schools.com>
- <https://openclassrooms.com/fr/>
- <https://unsplash.com/fr>
- <https://restfulapi.net>
