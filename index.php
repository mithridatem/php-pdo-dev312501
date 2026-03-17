<?php
//import du script de connexion à la BDD
include 'database.php';

//Test si le formulaire est soumis
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    //Test si les champs sont remplis
    if (!empty($title) && !empty($description)) {
        //se connecter à la BDD
        $bdd = connect();
        //pour des requête de MAJ
        //1 écrire une requête
        $sql = "INSERT INTO article(title,`description`) VALUE(?, ?)";
        //2 préparer la requête
        $req = $bdd->prepare($sql);
        //3 assigner les paramètres
        $req->bindParam(1, $title, PDO::PARAM_STR);
        $req->bindParam(2, $description, PDO::PARAM_STR);
        //4 exécution de la requête
        $req->execute();
        $id = $bdd->lastInsertId();
        $result = "L'article "  . $title . " a été ajouté en BDD à pour id : " . $id;
    } else {
        $result = "Veuillez remplir les champs";
    }
}

?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article en BDD</title>
</head>

<body>
    <h1>Ajouter un article</h1>
    <form action="" method="post">
        <input type="text" name="title" placeholder="Saisir le titre de l'article">
        <textarea name="description" cols="30" rows="10" placeholder="Saisir la description de l'article"></textarea>
        <input type="submit" value="Ajouter" name="submit">
        <!-- <button type=submit name="submit" value="ajouter">Ajouter un article</button>-->
    </form>
    <p><?= $result ?? "" ?></p>
</body>

</html>