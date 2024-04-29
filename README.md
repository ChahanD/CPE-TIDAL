# Projet Tidal - The Acu Bros

Ce projet est une application web d'acupuncture traditionnelle.

Il a été développé par l'équipe "The Acu Bros" dans le cadre du cours de Projet Tidal à CPE Lyon.

***Lien vers notre GitHub :***
<https://github.com/cpe-lyon/projet-tidal-theacu-bros>


## Sommaire

- [Projet Tidal - The Acu Bros](#projet-tidal---the-acu-bros)
  - [Sommaire](#sommaire)
  - [Auteurs](#auteurs)
  - [Instructions d'installation](#instructions-dinstallation)
  - [Instructions d'utilisation](#instructions-dutilisation)
  - [Structure du code](#structure-du-code)
  - [Fonctionnalités de l'application](#fonctionnalités-de-lapplication)
  - [Fonctionnement de l'api REST](#fonctionnement-de-lapi-rest)
  - [Normes d’accessibilité de niveau AAA](#normes-daccessibilité-de-niveau-aaa)
  - [Améliorations](#améliorations)
  - [Autre améliorations possibles](#autre-améliorations-possibles)
  - [Webographie](#webographie)


## Auteurs

- Maxime  Balleur
- Maxence Di-Meo
- Chahan  Donikian
- Alice   Esmilaire


## Instructions d'installation

1) Installation de Docker :

Docker est nécessaire pour exécuter votre projet. Si vous ne l'avez pas déjà installé, vous pouvez le télécharger et l'installer à partir du site officiel de Docker. Suivez les instructions d'installation pour votre système d'exploitation.

2) Clonage du projet :

Vous devez cloner le projet sur votre machine locale. Ouvrez un terminal et exécutez la commande suivante :
  
```bash
git clone https://github.com/cpe-lyon/projet-tidal-theacu-bros.git
```

3) Installation de composer et des dépendances :

Composer est un gestionnaire de dépendances pour PHP. Vous devez installer Composer sur votre machine pour installer les dépendances du projet (Twig et Symfony). Vous pouvez télécharger Composer à partir du [site officiel de Composer](https://getcomposer.org/download/).

Une fois Composer installé, exécutez les commandes suivantes dans le répertoire racine du projet pour installer les dépendances :

```bash
composer install
```

Cette commande installera les dépendances requises pour le projet dans le dossier `vendor`. Il faut ensuite déplacer ce fichier dans le dossier `src/` pour que le projet fonctionne correctement.

L'arborecence du projet doit ressembler à ceci :

```
.
├── src/
│   ├── vendor/
│   │   ├── composer
│   │   ├── symfony
│   │   ├── twig
│   │   └── autoload.php
│   ├── ...
```

4) Lancement du projet :

Pour lancer le projet, vous devez avoir Docker installé sur notre machine. Ensuite, exécutez la commande suivante dans le répertoire racine du projet :

```bash
docker-compose up -d --build`
```


## Instructions d'utilisation

Une fois que l'application est en cours d'exécution, vous pouvez y accéder en ouvrant notre navigateur web et en naviguant vers <http://localhost:50180>.

Pour accéder à l'api rest (page qui n'est pas répertoriée dans la bar de navigation), vous pouvez accéder à l'adresse suivante : <http://localhost:50180/api> (recherche des pathologies) ou <http://localhost:50180/api/getusers.php> (recherche de l'utilisateur).

Puis il est possible d'ajouter des filtres sur la réponse de l'api en ajoutant des paramètres à l'url. Les paramètres disponibles sont : `?id`, `?mer`, `?type` et `?desc` pour les pathologies et `?id` pour les utilisateurs.


## Structure du code

Le code source de l'application est organisé de la manière suivante :

```
src/
├── index.php
├── .htaccess
├── api/
│   ├── getdiseases.php
│   └── getusers.php
├── controllers/
│   ├── home.php
│   ├── authentification.php
│   ├── pathologie.php
│   ├── rendez-vous.php
│   └── symptome.php
├── models/
│   └── database.php
├── public/
│   ├── images/
│   ├── scripts/
│   └── styles/
└── views/
    ├── authentification.html.twig
    ├── base.html.twig
    ├── footer.html.twig
    ├── header.html.twig
    ├── home.html.twig
    ├── pathologie.html.twig
    ├── rendez-vous.html.twig
    └── symptome.html.twig
```

Explication des différents dossiers et fichiers :

- **`index.php`** : C'est le point d'entrée de l'application. Il reçoit toutes les requêtes HTTP, détermine quel contrôleur ou quel fichier API doit être utilisé pour traiter la requête, et renvoie la réponse générée.

- **`controllers/`** : Ce dossier contient les fichiers PHP qui servent à gérer les différentes pages de l'application. Ces fichiers sont appelés par le fichier `index.php` pour générer les réponses HTML. Ils font le lien entre les fichiers dans le dossier `models/` et les fichiers dans le dossier `views/`.

- **`models/`** : Ce dossier contient le fichier PHP qui gère la connexion à la base de données. Ce fichier est utilisé par les fichiers dans le dossier `controllers/` pour récupérer les données de la base de données, et est mis sous forme de classe.

- **`views/`** : Ce dossier contient les fichiers Twig qui servent à générer les pages HTML de l'application. Ces fichiers sont utilisés par les fichiers dans le dossier `controllers/` pour générer les réponses HTML.

- **`public/`** : Ce dossier contient les fichiers statiques (images, scripts, styles) de l'application. Ces fichiers sont utilisés directement par le serveur web lorsque des requêtes sont envoyées pour ces ressources.

- **`api/`** : Ce dossier contient les fichiers PHP qui servent à récupérer les données de la base de données. Ces fichiers peuvent être appelés par l'API REST pour renvoyer les données au format JSON.


## Fonctionnalités de l'application

Notre application web d'acupuncture offre les fonctionnalités suivantes :

- Authentification : Les utilisateurs peuvent se connecter à l'application et certaines fonctionnalités comme la recherche dans la page pathologie sont accessible uniquement aux utilisateurs connectés. Nous avons utilisé des cookies pour stocker les informations de connexion des utilisateurs.

- Visualisation des symptomes/pathologies : Les utilisateurs peuvent voir une liste de tous les symptômes/pathologies disponibles, ainsi que les pathologies/symptômes associées à chaque symptôme/pathologies. Nous avons mis en place une liste d'autocompletation à base d'une API rest qui va chercher la listes de tous les symptomes/pathologies disponibles dans la base de données, puis on ne fait apparaitre que les 10 résultats les plus pertinents grâce à un script js.

- Prise de rendez-vous : Les utilisateurs peuvent avoir accès à l'agenda des pratiquants afin de prendre rendez-vous (généré aléatoirement).

- API : L'application offre une API qui permet d'obtenir des informations sur les maladies et les utilisateurs. Cette fonctionnalité est gérée par les fichiers `getdiseases.php` et `getusers.php` dans le dossier `api/`.

- Base de données : L'application utilise une base de données pour stocker toutes les informations. La connexion à la base de données est gérée par le fichier `database.php` dans le dossier `models/`.


## Fonctionnement de l'api REST

L'API REST de notre application permet de récupérer les données de la base de données en utilisant des requêtes HTTP. Les données sont renvoyées au format JSON, grace à une requête HTTP GET. Cette requete est envoyée à l'API en utilisant l'URL suivante : `http://localhost:50180/api/getdiseases.php` ou `http://localhost:50180/api/getusers.php`.

Pour `getdiseases.php`, nous avons mis à disposition des filtres sur les id des pathologies, leur type, le méridien et leur description. En revanche pour getusers.php, il y a seulement des filtres sur les id des utilisateurs.

Les données renvoyées par l'API peuvent être utilisées par d'autres applications pour afficher les informations sur les pathologies et les utilisateurs de notre application.


## Normes d’accessibilité de niveau AAA

Nous avons employé le site [Nu Html Checker](https://validator.w3.org/nu/) pour assurer la conformité de notre site web aux normes d'accessibilité de niveau AAA, et pour garantir qu'il est correctement structuré en HTML5.

Chaque page de notre site est conçue pour être facilement accessible depuis la page d'accueil, nécessitant au maximum trois interactions, qu'il s'agisse de clics, de raccourcis clavier.

De plus, nous avons veillé à ce que la navigation sur notre site soit entièrement réalisable sans l'usage de la souris ou du clavier, rendant ainsi notre site web accessible à tous les utilisateurs, indépendamment de leurs capacités.


## Améliorations

Suite à notre entretien, nous avons mis en place l'utilisation d'un point d'entrée unique pour les fichiers `.php`. Ce point d'entré se fait par le fichier `index.php` qui va rediriger les requêtes vers les fichiers correspondants dans le dossier `controllers/`. Nous avons aussi ajouté un fichier `.htaccess` pour rediriger les requêtes vers le fichier `index.php`. Puis dans le fichier `index.php`, nous avons ajouté une gestion des erreurs pour les requêtes non trouvées (envoyé vers la page d'accueil).


## Autre améliorations possibles

Pour ce qui concerne les améliorations possibles de notre code, l'utilisation de cookies côté client peut générer des problèmes de sécurité. En effet, les cookies sont stockés sur le navigateur de l'utilisateur et peuvent être modifiés par ce dernier. Il est donc préférable de stocker les informations sensibles côté serveur (notamment la durée de validité de la session de l'utilisateur).

La sécurité de notre application pourrait être améliorée, notamment pour ce qui est de l'authentification des utilisateurs et de l'accès à la base de donnée (qui pourrait être sensible à des attaques par injections SQL).

Nous aurions aussi aimé implémenter dans la page rendez-vous, un agenda spécifique pour plusieurs pratiquants ainsi que l'ajout dans la base de donnée des rendez-vous pris par les utilisateurs afin de mettre à jour l'agenda.

Enfin nous aurions voulu améliorer la gestion des erreurs pour les requêtes non trouvées, en renvoyant une page d'erreur personnalisée.


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
