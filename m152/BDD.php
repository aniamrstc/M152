<?php
// projet:Realiser un blog
// Auteur:Ania Marostica
// Date:02.02.2023
// Description:page qui contient toute les fonctions de la base de données
require_once "Constante.php";

/**
 * connexion a la basse de données
 *  
 */
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
function InsertMedia($file_type, $file_name, $idPost)
{
    $today = date("Y-m-d H:i:s");
    $sql = getConnexion()->prepare("INSERT INTO MEDIA (typeMedia, nomMedia, creationDate,idPost) VALUES (?,?,?,?)");
    $sql->execute([$file_type, $file_name, $today, $idPost]);
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
    $today = date("Y-m-d H:i:s");
    $myDb = getConnexion();
    $sql = $myDb->prepare("INSERT INTO POST (commentaire,creationDate,modificationDate) VALUES (?,?,?)");
    $sql->execute([$commentaire, $today, $today]);
    return $myDb->lastInsertId();
}
/**
 * Elle renvoie un tableau de tableaux associatifs, chacun contenant les champs commentaire et idPost
 * d'une ligne de la table POST.
 * 
 * @return le commentaire et idPost de la table POST.
 */
function SelectPost()
{
    $myDb = getConnexion();
    $sql = $myDb->prepare("SELECT POST.commentaire,POST.creationDate,POST.idPost from POST ORDER BY POST.creationDate DESC");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
/**
 * Il renvoie le nombre de médias pour une publication.
 * 
 * @param idPost l'identifiant du poste
 * 
 * @return Le nombre de médias pour une publication.
 */
function GetNumberOfMediaForAPost($idPost)
{
    $myDb = getConnexion();
    $sql = $myDb->prepare("SELECT COUNT(idMedia) FROM MEDIA,POST WHERE MEDIA.idPost=POST.idPost AND POST.idPost=? ");
    $sql->execute([$idPost]);
    return $sql->fetch(PDO::FETCH_NUM)[0];
}
/**
 * Il renvoie le nom du média associé à une publication.
 * 
 * @param idPost l'identifiant du poste
 * 
 * @return le nom du média associé à la publication.
 */
function SelectMedia($idPost)
{
    $myDb = getConnexion();
    $sql = $myDb->prepare("SELECT MEDIA.idMedia,MEDIA.nomMedia,MEDIA.typeMedia,POST.idPost FROM MEDIA,POST WHERE MEDIA.idPost=POST.idPost AND POST.idPost=? ");
    $sql->execute([$idPost]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Il supprime un message de la base de données.
 * 
 * @param idPost L'identifiant du message à supprimer.
 */
function DeletePost($idPost)
{
    $myDb = getConnexion();
    $sql = $myDb->prepare("DELETE From POST WHERE POST.idPost=?");
    $sql->execute([$idPost]);
}

/**
 * Il met à jour un poste dans la base de données
 * 
 * @param commentaire le nouveau commentaire
 * @param idPost l'identifiant du poste
 */
function UpdatePost($commentaire, $idPost)
{
    $myDb = getConnexion();
    $sql = $myDb->prepare("UPDATE POST set commentaire=? WHERE idPost=?");
    $sql->execute([$commentaire, $idPost]);
}
/**
 * Il renvoie le commentaire d'un post.
 * 
 * @param idPost l'identifiant du poste
 * 
 * @return Un tableau de tableaux associatifs.
 */
function selectCommentaire($idPost)
{
    $myDb = getConnexion();
    $sql = $myDb->prepare("SELECT commentaire FROM POST WHERE POST.idPost=?");
    $sql->execute([$idPost]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
/**
 * DeleteMedia() supprime un média de la base de données.
 * 
 * @param idMedia l'identifiant du média que vous souhaitez supprimer
 */
function DeleteMedia($idMedia)
{
    $myDb = getConnexion();
    $sql = $myDb->prepare("DELETE From MEDIA WHERE MEDIA.idMedia=?");
    $sql->execute([$idMedia]);
}
/**
 * Il sélectionne toutes les colonnes de la table MEDIA où l'idMedia est égal à l'idMedia passé en
 * paramètre.
 * 
 * @param idMedia l'identifiant du média que vous souhaitez sélectionner
 * 
 * @return Un tableau de tableaux associatifs.
 */
function selectMediaByIdMedia($idMedia)
{
    $myDb = getConnexion();
    $sql = $myDb->prepare("SELECT * FROM MEDIA WHERE MEDIA.idMedia=?");
    $sql->execute([$idMedia]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
