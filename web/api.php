<?php

include_once('./baseDonnees.php');

function envoyerReponse($code, $body = null, $exception = null) {
    $statusCodes = array(
        200 => "200 OK",
        400 => "400 Bad Request",
        401 => "401 Unauthorized",
        403 => "403 Forbidden",
        404 => "404 Not found",
        405 => "405 Method Not Allowed",
        500 => "500 Internal Server Error"
    );

    header('HTTP/1.1 '. $statusCodes[$code]);
    header('Content-Type: application/json; charset=utf-8');

    echo $body;

    if ($exception) {
        throw $exception;
    }
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    if (!isset($_POST['nom'])) {
        envoyerReponse(400, 'La requête doit contenir le champ de formulaire "nom".');
        exit();
    }

    $nom = trim($_POST['nom']);

    if (empty($nom)) {
        envoyerReponse(400, 'Le champ "nom" doit être non vide.');
        exit();
    }

    $requete = $bd->prepare("INSERT INTO victoires (nom, nombre_victoires) VALUES (?, 1)
                                ON DUPLICATE KEY UPDATE nom = ?, nombre_victoires = nombre_victoires + 1");
    $requete->execute([$nom, $nom]);

    envoyerReponse(200, 'Victoire enregistrée avec succès.');
} else if ($method == 'GET') {
    if (isset($_GET['nom'])) {
        $nom = trim($_GET['nom']);

        if (empty($nom)) {
            envoyerReponse(400, 'Le paramètre "nom" doit être non vide.');
            exit();
        }

        $requete = $bd->prepare("SELECT nombre_victoires FROM victoires WHERE nom = ?");
        $requete->execute([$nom]);
        $victoire = $requete->fetch();

        if ($victoire) {
            envoyerReponse(200, $victoire['nombre_victoires']);
        } else {
            envoyerReponse(404, 0);
        }
    } else {
        $requete = $bd->prepare("SELECT * FROM victoires ORDER BY nombre_victoires DESC LIMIT 10");
        $requete->execute();
        $victoires = $requete->fetchAll();

        $reponse = "";
        foreach ($victoires as $victoire) {
            $reponse .= $victoire['nom'] . " : " . $victoire['nombre_victoires'] . " victoires\r\n";
        }
        
        envoyerReponse(200, $reponse);
    }
} else {
    envoyerReponse(400);
}
