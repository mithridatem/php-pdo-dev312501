<?php

//Import de la connexion à la BDD
include '../database.php';

//Méthode pour ajouter une category ($_POST)
function add_category(array $category): void
{
    try {
        //1 Se connecter à la BDD
        $bdd = connect();
        //2 Ecrire la requête SQL
        $sql = "INSERT INTO category(category_name) VALUE(?)";
        //3 Préparer la requête
        $req = $bdd->prepare($sql);
        //4 Assigner les paramètres
        $req->bindValue(1, $category["category_name"], PDO::PARAM_STR);
        //5 Exécuter la requête
        $req->execute();
    } catch(PDOException $e) {
        echo "Enregistrement impossible : " . $e->getMessage();
    }
}

//Méthode pour afficher la liste des categories
function find_all_categories(): array
{
    try {
        //1 Se connecter à la BDD
        $bdd = connect();
        //2 Ecrire la requête SQL
        $sql = "SELECT c.id, c.category_name FROM category AS c ORDER BY c.category_name ASC";
        //3 Préparer la requête
        $req = $bdd->prepare($sql);
        //4 Exécuter la requête
        $req->execute();
        //5 Récupérer la réponse de la BDD (Tableau associatif)
        $categories = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur récupération impossible";
    }
    return $categories;
}

//Méthode pour vérifier si la category existe
function is_category_exists(string $name): bool
{
    try {
        //1 Se connecter à la BDD
        $bdd = connect();
        //2 Ecrire la requête SQL
        $sql = "SELECT c.id FROM category AS c WHERE c.category_name = ?";
        //3 Préparer la requête
        $req = $bdd->prepare($sql);
        //4 Assigner les paramètres
        $req->bindParam(1, $name, PDO::PARAM_STR);
        //5 Exécuter la requête
        $req->execute();
        //6 Récupérer la réponse de la BDD
        $category = $req->fetch(PDO::FETCH_ASSOC);
        if (empty($category)) {
            return false;
        }
    } catch(PDOException $e) {
        echo "Erreur récupération impossible";
    }

    return true;
}