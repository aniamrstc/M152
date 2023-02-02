<?php
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

function InsertMedia($file_type,$file_name,){
    // enregistrement des informations dans la base de données
    $sql = getConnexion()->prepare("INSERT INTO MEDIA (typeMedia, nomMedia, creationDate) VALUES (?,?,DATE(NOW()))");
  $sql->execute([$file_type,$file_name]);
 
}
?>
