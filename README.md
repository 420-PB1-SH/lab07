# Laboratoire 07

Dans ce laboratoire, vous aurez à modifier le code de votre laboratoire 06 pour y ajouter des requêtes HTTP
à l'API d'une application Web qui vous est fournie. Pour ce faire, vous utiliserez les fonctionnalités HTTP du module réseau de SFML. Celles-ci sont
très limitées comparativement à des bibliothèques dédiées entièrement à HTTP (telles que *libcurl*), mais répondent néanmoins à notre
besoin.

L'utilité des requêtes HTTP dans ce laboratoire est d'envoyer les victoires
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
sous `htdocs` (par exemple: "http://localhost/tictactoe" —
n'oubliez pas de préciser le port du serveur Web s'il est différent de 80!). Vous
devriez voir ceci:

![Aperçu de la page Web](./readme-images/page-web.png)

Assurez-vous que ça fonctionne avant de passer à l'étape suivante.

### Étape 3 - Tester l'API

Lancez l'application *Advanced REST Client (ARC)* que vous avez installée au laboratoire 4.

Vous voulez faire une requête POST à l'API de l'application Web
afin d'ajouter une victoire. Sélectionnez donc la méthode POST dans
ARC.

L'API est implémentée dans le fichier `api.php`. Vous devez donc indiquer l'URL de ce fichier. Par exemple:

![Champ URL dans ARC](./readme-images/arc-url.png)

L'information qu'on enverra à l'API sera au format `application/x-www-form-urlencoded`, c'est-à-dire qu'elle
sera encodée comme si les données étaient transmises
à partir d'un formulaire Web. Nous devons donc ajouter
l'en-tête HTTP `Content-Type: application/x-www-form-urlencoded`, comme ceci:

![Configuration de l'en-tête dans ARC](./readme-images/arc-entete.png)

Finalement, on veut que le corps de la requête contienne
un champ "nom" dont la valeur doit être le nom de la personne
à qui on veut ajouter une victoire. Par exemple, si on veut
ajouter une victoire à Alice, on doit procéder ainsi:

![Configuration du corps dans ARC](./readme-images/arc-corps.png)

On peut maintenant exécuter la requête. Si tout va bien,
on devrait obtenir la réponse suivante:

![Aperçu de la réponse dans ARC](./readme-images/arc-reponse.png)

Retournez dans votre navigateur Web et actualisez la page "Tic Tac Toe - Classement". Vous devriez maintenant voir qu'Alice a 1 victoire à son actif!

Exécutez la même requête une deuxième fois, toujours avec le nom "Alice", et observez le résultat après avoir actualisé la
page à nouveau. Faites ensuite la même chose avec un nom différent.

#### Requêtes GET

L'API permet aussi d'utiliser la méthode GET pour récupérer
le classement des 10 meilleurs joueurs. Testez une requête
GET dans ARC et observez le résultat.

Puis, effectuez une requête GET à nouveau, cette fois-ci en
ajoutant `?nom=Alice` à la fin de l'URL. Observez le résultat. À quoi sert le paramètre `?nom` ?

Vous savez maintenant comment utiliser les trois fonctionnalités offertes par l'API.

### Étape 4 - Ajouter le code du laboratoire 06

Ouvrez la solution `lab07.sln` dans Visual Studio.

Regardez le contenu du fichier `main.cpp`. Vous constaterez
que le corps de la fonction `jouer` est vide. Ajoutez-y votre
code de la fonction `jouer` du laboratoire 06 (ou alternativement, celui de la solution du laboratoire 06).

Testez le programme pour s'assurer que tout fonctionne correctement.

### Étape 5 - Demander les noms des joueurs

Pour envoyer une victoire au serveur Web, il faut connaître
le nom du vainqueur. Vous devez donc commencer par modifier
votre jeu de Tic Tac Toe afin que celui-ci demande les noms
des joueurs au début de la partie.

Cela nous permettra aussi de modifier le programme
afin qu'il affiche le nom de l'autre joueur au lieu de "C'est le tour de l'autre joueur". Pour ce faire, il faudra que le serveur et le client s'échangent les noms à
l'aide de messages TCP.

Voici un aperçu de l'exécution du programme après modification:

**Serveur**

```console
TIC TAC TOE
===========
Choisir une option:
1. Créer une partie
2. Joindre une partie
Votre choix: 1

Entrez votre nom: Alice

En attente de l'autre joueur...
L'autre joueur vient de se connecter.

   1 2 3
  -------
a | | | |
  -------
b | | | |
  -------
c | | | |
  -------

C'est votre tour.
Où voulez-vous placer votre x?
ligne colonne : a 1

   1 2 3
  -------
a |x| | |
  -------
b | | | |
  -------
c | | | |
  -------

C'est le tour de Bob.
```

**Client**

```console
TIC TAC TOE
===========

Choisir une option:
1. Créer une partie
2. Joindre une partie

Votre choix: 2
Entrez l'adresse du serveur: 127.0.0.1

Entrez votre nom: Bob

   1 2 3
  -------
a | | | |
  -------
b | | | |
  -------
c | | | |
  -------

C'est le tour de Alice.

Alice a joué.

   1 2 3
  -------
a |x| | |
  -------
b | | | |
  -------
c | | | |
  -------

C'est votre tour.
Où voulez-vous placer votre x?
ligne colonne :
```

### Étape 6 - Envoyer une victoire



## Références utiles

* [Tutoriel « Requêtes web avec HTTP » de SFML](https://www.sfml-dev.org/tutorials/2.5/network-http-fr.php)
* [Documentation de `sf::Http`](https://www.sfml-dev.org/documentation/2.5.1-fr/classsf_1_1Http.php)
