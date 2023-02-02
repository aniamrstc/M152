<?php
// projet:Realiser un blog
// Auteur:Ania Marostica
// Date:02.02.2023
// Description:page qui contient toute les fonctions de la base de données
require_once "Constante.php";
function getConnexion()
{
    static $myDb = null;

    if ($myDb === null) {
        try {
            $myDb = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
            $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            die("Erreur :" . $e->getMessage());
        }
    }
    return $myDb;
}

/**
 *insertion des images dans la base de donnée.
 * 
 * @param file_type le type du media
 * @param file_name le nom du media
 * @param idPost l'id du dernier post
 */
function InsertMedia($file_type, $file_name,$idPost)
{

    $sql = getConnexion()->prepare("INSERT INTO MEDIA (typeMedia, nomMedia, creationDate,idPost) VALUES (?,?,DATE(NOW()),?)");
    $sql->execute([$file_type, $file_name,$idPost]);
}
/**
 * insere des nouveau post dans la base de données
 * 
 * @param commentaire le commentaire saisi
 * 
 * @return The le dernier id 
 */
function InsertPost($commentaire)
{

    $myDb = getConnexion();
    $sql=$myDb->prepare("INSERT INTO POST (commentaire,creationDate,modificationDate) VALUES (?,DATE(NOW()),DATE(NOW()))");
    $sql->execute([$commentaire]);
    return $myDb->lastInsertId();

}
?>