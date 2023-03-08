<?php

include_once('./baseDonnees.php');

function sendResponse($code, $body = null, $exception = null) {
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

if ($method !== 'POST') {
    sendResponse(500);
    exit();
}

if (!isset($_POST['nom'])) {
    sendResponse(400, 'La requête doit contenir le champ de formulaire "nom".');
    exit();
}

$nom = trim($_POST['nom']);

if (empty($nom)) {
    sendResponse(400, 'Le champ "nom" doit être non vide.');
    exit();
}

$requete = $bd->prepare("INSERT INTO victoires (nom, nombre_victoires) VALUES (?, 1)
                            ON DUPLICATE KEY UPDATE nom = ?, nombre_victoires = nombre_victoires + 1");
$requete->execute([$nom, $nom]);

sendResponse(200, 'Victoire enregistrée avec succès.');
