<?php
require_once __DIR__ . '/../config/database.php';
$db = new Database;
global $conn;
$conn = $db->getConnection();

//retourne les colonnes de la requete avec en parametre la query sql 
//et un tableau de parametre si il y en a 
function requete($sql,$execute_var=null){
    global $conn;

    $dsn = $conn->prepare($sql);

    if ($execute_var === null) {
        $dsn->execute();
    } else {
        $dsn->execute($execute_var);
    }

    $res = $dsn->fetchAll(PDO::FETCH_ASSOC);
    
    return $res;
}

//renvoie les catégories princpales
function get_cat(){
    global $conn;

    $sql = "SELECT id,nom_categorie FROM `_categorie` WHERE id_categorie_sup IS NULL";
    $dsn = $conn->prepare($sql);

    $dsn->execute();
   
    $res = $dsn->fetchAll(PDO::FETCH_ASSOC);
    
    return $res;
}