<?php

include '../database.php';

//Méthode pour ajouter un compte en BDD
function add_account(array $account): void
{
    try {

        //1 se connecter à la BDD,
        $bdd = connect();
        //2 écrire la requête INSERT (account avec tous les champs)
        $sql = "INSERT INTO account(firstname, lastname, email, `password`, `image`) VALUE (?,?,?,?,?)";
        //3 préparer la requête,
        $req = $bdd->prepare($sql);
        //4 assigner les 4 paramètres,
        $req->bindValue(1, $account["firstname"], PDO::PARAM_STR);
        $req->bindValue(2, $account["lastname"], PDO::PARAM_STR);
        $req->bindValue(3, $account["email"], PDO::PARAM_STR);
        $req->bindValue(4, $account["password"], PDO::PARAM_STR);
        $req->bindValue(5, $account["image"], PDO::PARAM_STR);
        //5 exécuter la requête
        $req->execute();

    } catch (PDOException $e) {
        echo "Enregistrement impossible " . $e->getMessage() ;
    }
}

//Méthode pour vérifier si le compte existe en BDD
function is_account_exists(string $email): bool
{
    try {
        //1 Se connecter à la BDD
        $bdd = connect();
        //2 Ecrire la requête SQL
        $sql = "SELECT a.id, a.firstname, a.email, a.password FROM account AS a WHERE a.email = ?";
        //3 Préparer la requête
        $req = $bdd->prepare($sql);
        //4 Assigner le paramètre
        $req->bindParam(1, $email, PDO::PARAM_STR);
        //5 Exécuter la requête
        $req->execute();
        //6 Retourner le resultat de la requête
        $account = $req->fetch(PDO::FETCH_ASSOC);
        if (empty($account)) {
            return false;
        }
    } catch (PDOException $e) {
        echo "Connexion impossible " . $e->getMessage();
    }
    return true;
}
