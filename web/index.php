<?php

include_once('./baseDonnees.php');

$requete = $bd->prepare('SELECT * FROM victoires ORDER BY nombre_victoires DESC');
$requete->execute();
$victoires = $requete->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Victoires Tic Tac Toe - Classement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
</head>
<body>
    <h1>Tic Tac Toe - Classement</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre de victoires</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($victoires as $victoire) {
            ?>
                <tr>
                    <td><?= $victoire['nom'] ?></td>
                    <td><?= $victoire['nombre_victoires'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>