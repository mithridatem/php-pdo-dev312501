<?php

//importer les ressources
include '../env.php';
include '../model/category.php';
include '../tools.php';
include '../vendor/autoload.php';

$categories = find_all_categories();

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des categories</title>
</head>
<body>
    <main>
        <section>
            <a href="/template/add_category.php">Ajouter une categorie</a>
            <?php if(empty($categories)) : ?>
                <p>La liste est vide</p>
            <?php else : ?>
            <ul>
                <?php foreach ($categories as $category) :?>
                    <li id="<?= $category["id"] ?>"><?= $category["name"] ?></li>
                <?php endforeach ?>
            </ul>
            <?php endif ?>
        </section>
    </main>
</body>
</html>