# Projet Tidal - The Acu Bros

Ce projet est une application web d'acupuncture traditionnelle. Il a été développé par l'équipe The Acu Bros dans le cadre du cours de Projet Tidal à CPE Lyon.

***Lien vers notre GitHub:***
<https://github.com/cpe-lyon/projet-tidal-theacu-bros>

## Instructions d'installation

1) Installation de Docker : Docker est nécessaire pour exécuter votre projet. Si vous ne l'avez pas déjà installé, vous pouvez le télécharger et l'installer à partir du site officiel de Docker. Suivez les instructions d'installation pour votre système d'exploitation.

2) Clonage du projet : Vous devez cloner le projet sur votre machine locale. Ouvrez un terminal et exécutez la commande suivante :
  
  ```bash
  git clone https://github.com/cpe-lyon/projet-tidal-theacu-bros.git
  ```

3) Lancement du projet :  

Pour lancer le projet, vous devez avoir Docker installé sur notre machine. Ensuite, exécutez la commande suivante dans le répertoire racine du projet :

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
  
## Fonctionnalités de l'application

Notre application web d'acupuncture traditionnelle offre les fonctionnalités suivantes :

- Authentification : Les utilisateurs peuvent se connecter à l'application et certaines fonctionnalités comme la recherche dans la page pathologie sont maintenant accessible.
- Visualisation des symptomes / pathologies : Les utilisateurs peuvent voir une liste de tous les symptômes disponibles, ainsi que les pathologies associées à chaque symptôme. Nous avons mis en place une liste d'autocompletation qui s'apparente à une api rest pour chacune des pages et nous avons utilisé une base de données PostgreSQL pour stocker ces informations.
- Prise de rendez-vous : Les utilisateurs peuvent avoir accès à l'agenda des pratiquants afin de prendre rendez-vous.
- API : L'application offre une API qui permet d'obtenir des informations sur les maladies et les utilisateurs. Cette fonctionnalité est gérée par les fichiers getdiseases.php et getusers.php dans le dossier api/.
- Base de données : L'application utilise une base de données pour stocker toutes les informations. La connexion à la base de données est gérée par le fichier database.php dans le dossier models/.
  
## Fonctionnement de l'api REST

L'API REST de notre application permet de récupérer les données de la base de données en utilisant des requêtes HTTP. Les données sont renvoyées au format JSON, grace à une requête HTTP GET. Cette requete est envoyée à l'API en utilisant l'URL suivante : `http://localhost:50180/api/getdiseases.php` ou `http://localhost:50180/api/getusers.php`. Pour getdiseases.php, nous avons utilisé des filtres sur les id des pathologies, leur type, le méridien et leur description. En revanche pour getusers.php, nous avons utilisé des filtres seulement sur les id des utilisateurs. Les données renvoyées par l'API peuvent être utilisées par d'autres applications pour afficher les informations sur les pathologies et les utilisateurs de notre application.

## Normes d’accessibilité de niveau AAA

Nous avons employé le logiciel Nu Html Checker pour assurer la conformité de notre site web aux normes d'accessibilité de niveau AAA, et pour garantir qu'il est correctement structuré en HTML5. Chaque page de notre site est conçue pour être facilement accessible depuis la page d'accueil, nécessitant au maximum trois interactions, qu'il s'agisse de clics, de raccourcis clavier, ou d'autres moyens d'interaction. De plus, nous avons veillé à ce que la navigation sur notre site soit entièrement réalisable sans l'usage de la souris ou du clavier, rendant ainsi notre site web accessible à tous les utilisateurs, indépendamment de leurs capacités.

## Améliorations possibles

Suite à notre entretien, nous avons mis en place l'utilisation d'un point d'entrée unique pour les fichiers .php. Ces derniers devront être placés dans le dossier `controllers/` et devront être appelés via le fichier `index.php` situé à la racine du projet. Pour ce qui concerne les améliorations possibles de notre code, l'utilisation de cookies côté client peut générer des problèmes de sécurité. En effet, les cookies sont stockés sur le navigateur de l'utilisateur et peuvent être modifiés par ce dernier. Il est donc préférable de stocker les informations sensibles côté serveur. Nous aurions aimé implémenter dans la page rendez-vous, un agenda spécifique pour chaques pratiquants ainsi que l'ajout dans la base de donnée des rendez-vous pris par les utilisateurs afin de mettre à jour l'agenda. Mais par manque de temps, nous n'avons pas pu implémenter ces fonctionnalités.

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
