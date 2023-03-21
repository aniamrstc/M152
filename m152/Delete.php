<?php
require "./BDD.php";
$path = "./images/";
if (isset($_GET['idMedia'])) {
    $unlinkAsError = false;
    $deleteAMedia = selectMediaByIdMedia($_GET['idMedia']);
    foreach ($deleteAMedia as $Unmedia) {

        if (!unlink($path . $Unmedia['nomMedia'])) {
            $unlinkAsError = true;
        }
    }
    if (!$unlinkAsError) {
        DeleteMedia($_GET['idMedia']);
       
    }
}
?>