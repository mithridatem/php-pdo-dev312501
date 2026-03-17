<?php

function connect(): PDO
{
     return new PDO(
        'mysql:host=localhost;dbname=demo', 
        'root',
        'root', 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}
