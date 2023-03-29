<?php
// projet:Realiser un blog
// Auteur:Ania Marostica
// Date:02.02.2023
// Description:page pour la suppression d'un media dans la page edition
require "./BDD.php";
$path = "./images/";

/* Vérifier si l'idMedia est défini. */
if (isset($_GET['idMedia'])) {
    $unlinkAsError = false;
   /* Sélection du média par idMedia. */
    $deleteAMedia = selectMediaByIdMedia($_GET['idMedia']);
  /* Suppression du média du serveur. */
    foreach ($deleteAMedia as $Unmedia) {

        if (!unlink($path . $Unmedia['nomMedia'])) {
            $unlinkAsError = true;
        }
    }
 /* Suppression du média de la base de données. */
    if (!$unlinkAsError) {
        DeleteMedia($_GET['idMedia']);
       
    }
}
?>