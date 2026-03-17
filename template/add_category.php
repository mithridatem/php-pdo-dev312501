<?php
//importer les ressources
include '../env.php';
include '../model/category.php';
include '../tools.php';

//tester si le formulaire est soumis
if (isset($_POST["add_category"])) {
    //appel de la méthode create_category
    $result = create_category($_POST);
}

function create_category(array $category)
{
    //nettoyer les entrées
    $category["category_name"] = sanitize($category["category_name"]);
    //tester si le champs est bien renseigné
    if (empty($category["category_name"])) {
        return "Veuillez renseigné le nom de la categorie";
    }

    //tester si la category existe déja
    if (is_category_exists($category["category_name"])) {
        return "La catégorie : " . $category["category_name"] . " existe déja";
    }

    //ajouter la categorie en BDD
    add_category($category);
    
    return "La catégorie : " . $category["category_name"] . " a été ajouté en BDD";
}   
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une categorie</title>
</head>
<body>
    <h2>Ajouter une categorie</h2>
    <form action="" method="post">
        <input type="text" name="category_name" placeholder="Saisir le nom de la categorie">
        <input type="submit" value="Ajouter" name="add_category">
    </form>
    <p><?= $result ?? "" ?></p>
</body>
</html>