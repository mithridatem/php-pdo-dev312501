<?php

include '../env.php';
include '../model/account.php';
include '../tools.php';
include '../vendor/autoload.php';

//tester si le formulaire est soumis
if (isset($_POST["submit"])) {
    $result = create_account($_POST);
}

//Méthode pour ajouter un compte en BDD
function create_account(array $account): string
{
    //1 Nettoyer les entrées utilisateurs
    sanitize_array($account);
    //2 vérifier si les 4 champs sont tous remplis
    if (
        empty($account["firstname"]) || 
        empty($account["lastname"]) ||
        empty($account["email"]) || 
        empty($account["password"])  
    ) {
        return "Les champs ne sont pas tous remplis"; 
    }
       
    //3 Tester si le compte existe déja
    if (is_account_exists($account["email"])) {
        return "Le compte : " . $account["email"] . " existe déja";
    }
    //test si l'image existe
    if (isset($_FILES["image"]) && $_FILES["image"]["tmp_name"] !="") {
        //ajouter la colonne image (account)
        $account["image"] = $_FILES["image"]["name"];
        //chemin temporaire
        $tmp = $_FILES["image"]["tmp_name"];
        //déplacer le fichier
        move_uploaded_file($tmp, "../public/image/" . $account["image"]);
    } 
    //sinon une image par défault
    else {
        $account["image"] = "default.png";
    }
 
    $account["password"] = password_hash($account["password"], PASSWORD_DEFAULT);
    //4 ajouter le compte en BDD
    add_account($account);
    return "Le compte : " . $account["email"] . " a été ajouté en BDD";
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un compte</title>
</head>
<body>
    <h2>Créer un compte</h2>
    <form action="" method="post" enctype="multipart/form-data">

        <input type="text" name="firstname" placeholder="Prénom">
        <input type="text" name="lastname" placeholder="Nom">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="file" name="image">
        <input type="submit" value="Ajouter" name="submit">
    </form>
    <p><?= $result ?? "" ?></p>
</body>
</html>