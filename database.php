<?php

function connect(): PDO
{
    //Import du fichier environnement
    include 'env.php';
    //Création d'un objet PDO
    return new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '',
        DB_USERNAME,
        DB_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}
