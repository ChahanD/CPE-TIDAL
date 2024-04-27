# Projet Tidal - The Acu Bros

Ce projet est une application web d'acupuncture traditionnelle. Il a été développé par l'équipe The Acu Bros dans le cadre du cours de Projet Tidal à CPE Lyon.

https://github.com/cpe-lyon/projet-tidal-theacu-bros

## Instructions d'installation
Pour lancer le projet, vous devez avoir Docker installé sur votre machine. Ensuite, exécutez la commande suivante dans le répertoire racine du projet :

commande pour lancer le projet : 
```bash 
docker-compose up -d --build`
```

## Instructions d'utilisation
Une fois que l'application est en cours d'exécution, vous pouvez y accéder en ouvrant votre navigateur web et en naviguant vers http://localhost:50180

## Explication du code
Le code de l'application est structuré en plusieurs parties :

- src/controllers/ : Contient les contrôleurs PHP pour les différentes pages de l'application.
    - ***authentification.php*** : Ce fichier gère l'authentification des utilisateurs. Il utilise Twig pour rendre le template authentification.html.twig.
    - ***pathologie.php*** : Ce fichier gère l'affichage des pathologies. Il récupère les symptômes et les méridiens de la base de données, puis utilise Twig pour rendre le template pathologie.html.twig avec ces données.
    - ***rendez-vous.php*** : Ce fichier gère l'affichage des rendez-vous. Il utilise Twig pour rendre le template rendez-vous.html.twig.
    - ***search_pathologie.php*** : Ce fichier gère la recherche de pathologies. Il récupère les critères de recherche de l'utilisateur, effectue une recherche dans la base de données, puis utilise Twig pour rendre le template search_pathologie.html.twig avec les résultats de la recherche.
    - ***search_symptome.php*** : Ce fichier gère la recherche de symptômes. Il fonctionne de manière similaire à search_pathologie.php.
    - ***symptome.php*** Ce fichier gère l'affichage des symptômes. Il récupère les symptômes de la base de données, puis utilise Twig pour rendre le template symptome.html.twig avec ces données.
Chacun de ces fichiers utilise le modèle de base de données défini dans database.php pour interagir avec la base de données.

- src/models/ : Contient le modèle de base de données.
- src/views/ : Contient les templates Twig pour les différentes pages de l'application.
- src/public/ : Contient les fichiers statiques publics, comme les images et les styles CSS.
- scripts/ : Contient les scripts JavaScript pour l'application.

## Normes d’accessibilité de niveau AAA.

Nous avons employé le logiciel Nu Html Checker pour assurer la conformité de notre site web aux normes d'accessibilité de niveau AAA, et pour garantir qu'il est correctement structuré en HTML5. Chaque page de notre site est conçue pour être facilement accessible depuis la page d'accueil, nécessitant au maximum trois interactions, qu'il s'agisse de clics, de raccourcis clavier, ou d'autres moyens d'interaction. De plus, nous avons veillé à ce que la navigation sur notre site soit entièrement réalisable sans l'usage de la souris ou du clavier, rendant ainsi notre site web accessible à tous les utilisateurs, indépendamment de leurs capacités.

## Webographie
- https://twig.symfony.com
- https://getcomposer.org
- https://www.php.net/manual/fr/intro-whatis.php
- https://validator.w3.org/nu/
- https://www.w3schools.com
- https://openclassrooms.com/fr/
- https://unsplash.com/fr
