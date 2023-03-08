# Laboratoire 07

Dans ce laboratoire, vous aurez à modifier le code de votre laboratoire 06 (ou celui de la solution) pour y ajouter des requêtes HTTP
à l'API d'une application Web qui vous est fournie. Pour ce faire, vous utiliserez les fonctionnalités HTTP du module réseau de SFML. Celles-ci sont
très limitées comparativement à des bibliothèques dédiées entièrement à HTTP (telles que *libcurl*), mais répondent néanmoins à notre
besoin.

L'utilité des requêtes HTTP dans ce laboratoire sera d'envoyer les victoires
du jeu de Tic Tac Toe à un serveur Web pour que celui-ci puisse maintenir
un classement des meilleurs joueurs. Ce classement pourra ensuite être affiché
dans le programme à l'aide d'une autre requête d'API.

## Prérequis

* Un serveur de développement incluant Apache, PHP, MySQL et phpMyAdmin (par exemple avec XAMPP)
* Le logiciel *Advanced Rest Client (ARC)* utilisé dans le laboratoire 4

## Consignes

### Étape 1 - Création de la base de données de l'application Web

Dans le dossier `web` de ce dépôt, vous trouverez des fichiers PHP
et un fichier `tictactoe.sql`.

À l'aide de phpMyAdmin, créez une base de données du nom de votre choix (ex: "tictactoe"). Sur cette base de données, exécutez le code
contenu dans `tictactoe.sql` afin de créer la table utilisée par l'API.

### Étape 2 - Mise en place de l'application Web

Dans le dossier `htdocs` de votre serveur Apache, créez un dossier
au nom de votre choix (ex: "tictactoe") pour héberger le code de l'API. Copiez-y les fichiers PHP situés dans le dossier `web` du dépôt.

Ouvrez ensuite le fichier `baseDonnees.php` à partir de l'endroit
où vous l'avez copié. Modifiez les lignes suivantes au besoin:

```php
$hoteBD = 'localhost';
$portBD = 3306;
$nomBD = 'tictactoe';
$utilisateurBD = 'root';
$motDePasseBD = null;
```

Assurez-vous particulièrement que la valeur de la variable `$portBD`
est la bonne (vous pouvez vérifier le port utilisé par MySQL dans 
le panneau de contrôle de XAMPP). Si vous avez nommé votre base de
données autrement que "tictactoe", n'oubliez pas de mettre à jour
cette valeur également.

Ensuite, à l'aide d'un navigateur Web, accédez à l'URL de 
l'application selon le dossier dans lequel vous l'avez placée
sous `htdocs` (par exemple: "http://localhost/tictactoe"). Vous
devriez voir ceci:

![](./readme-images/page-web.png)

Assurez-vous que ça fonctionne avant de passer à l'étape suivante.

### Étape 3 - 

## Références utiles

* [Tutoriel « Requêtes web avec HTTP » de SFML](https://www.sfml-dev.org/tutorials/2.5/network-http-fr.php)
* [Documentation de `sf::Http`](https://www.sfml-dev.org/documentation/2.5.1-fr/classsf_1_1Http.php)
