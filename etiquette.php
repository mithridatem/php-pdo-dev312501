<?php

//import 
include 'vendor/autoload.php';
include 'database.php';

//1 se connecter à la BDD
$bdd = connect();
$year = 2026;
//2 écrire une requête
$sql = "SELECT a.id, a.title, a.description, a.created_at FROM article AS a WHERE YEAR(created_at) = :annee";
//3 préparer la requête
$req = $bdd->prepare($sql);
//4 executer la requête
$req->execute([
    "annee"=>$year
]);

//5 récupérer le résultat de la requête
$articles = $req->fetchAll(PDO::FETCH_ASSOC);


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    <main>
        <section>
            <!--Boucle pour itérer sur la liste des articles -->
            <?php foreach ($articles as $article) :?>
                <article>
                    <h2><?= $article["title"] ?></h2>
                    <p><?= $article["description"] ?></p>
                    <h3><?= $article["created_at"] ?></h3>
                </article>
            <?php endforeach ?>
        </section>
    </main>
</body>
</html>