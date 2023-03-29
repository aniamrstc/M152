<?php

// projet:Realiser un blog
// Auteur:Ania Marostica
// Date:02.02.2023
// Description:page permettant de faire des posts

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);

require "./BDD.php";
//initialisation variable
$submit = filter_input(INPUT_POST, 'publish');
$commentaire = filter_input(INPUT_POST, 'commentaire');
$targetDir = "images/"; //chemin du dosier ou seront stocker les medias
$allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/gif', 'video/mp4', 'audio/mpeg'); //tableaux des type accepter
$fileSize = 0; //taille de tout les media contenu dans le dossier
$MaxSizeOneFile = 3 * 1024 * 1024; //taille maximum pour un media 
$MaxSizeAllFile = 70 * 1024 * 1024; //taille maximum pour tout les media
$error = []; //variable pour les messages d'erreurs

if ($submit == "Publish") {
    //lancement de la transaction
    /* Démarrage d'une transaction. */
    
/* Démarrage d'une transaction. */
    getConnexion()->beginTransaction();
    try {
      /* Vérifier si la variable commentaire n'est pas vide. */
        if (!empty($commentaire)) {
            /* Insertion d'un article dans la base de données. */
            $idPost = InsertPost($commentaire);
            $fileNames = array_filter($_FILES['files']['name']);
            if (!empty($fileNames)) {
               /*une boucle for qui parcourt le tableau files et ajoute la taille de
               chaque fichier à la variable . */
                for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
                    $file = $_FILES['files'];
                    $fileSize += $file['size'][$i];
                }
                //si la taille de tout les fichier est est plus petit ou equal a 70 mega on execute
                if ($fileSize <= $MaxSizeAllFile) {
                    foreach ($fileNames as $key => $val) {
                        $file = $_FILES['files'];
                        //si la taille d'un fichier est plus petit ou egal a 3 mega on execute
                        if ($file['size'][$key] <= $MaxSizeOneFile) {
                           /* Obtenir le nom de fichier du fichier en cours de téléchargement. */
                            $fileName = basename($_FILES['files']['name'][$key]);
                            //recuperer l'extension du fichier
                            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                            //si le tableaux contient bien le bon type d'extension 
                            if (in_array($_FILES['files']['type'][$key], $allowTypes)) {

                                
                                $file_part = pathinfo($fileName);
                                //on met le nom du fichier sans l'extension+un l'uniqid+l'extension
                                $unique_filename = $file_part['filename'] . '_' . uniqid() . '.' . $file_part['extension'];
                                //on concatene le chemin et le non unique puis on le deplace dans notre fichier
                                $full_path = $targetDir . $unique_filename;

                                if (count($error) == 0) {
                                    //si le fichier a bien été stocker dans le dossier on insere les données dans la base 
                                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $full_path)) {
                                      /* Vérifier si le fichier existe et si c'est le cas, c'est
                                      insérer le type de fichier, le nom de fichier unique et
                                      l'idPost dans la base de données. */
                                        if (file_exists($full_path)) {

                                            InsertMedia($_FILES['files']['type'][$key], $unique_filename, $idPost);
                                        }
                                    }
                                } else {
                                    $error[] = "l'importation n'a pas marcher";
                                }

                                //sinon le message d'erreur prend la valeur suivante
                            } else {
                                $error[] = "ce type de media n'est pas accepter";
                            }
                            //sinon le message d'erreur prend la valeur suivante
                        } else {
                            $error[] = 'le poid de ce media est trop lourd';
                        }
                    }
                    //sinon le message d'erreur prend la valeur suivante
                } else {
                    $error[] = 'le dossier est trop plein pour ajouter de nouveau media';
                }
            }
            /* Annuler la transaction en cas d'erreurs. */
            if (count($error) != 0) {
                getConnexion()->rollBack();
            } else {
                getConnexion()->commit();
                header("location:Home.php");
                exit;
            }
        } else {
            $error[] = "vous devez saisir un commentaire";
        }
      
    }
    catch (PDOException $exception) {
        getConnexion()->rollback();
        throw $exception;
    }
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <link href="assets/css/facebook.css" rel="stylesheet">
    <title>Post</title>
</head>

<body>

    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">
                <div class=" col-sm-10 col-xs-11" id="main" style="width: 100%;">

                    <!-- NavBar -->
                    <div class="navbar navbar-blue navbar-static-top">
                        <div class="navbar-header">
                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="#" class="navbar-brand logo">b</a>
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="./Home.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="./Post.php" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
                                </li>

                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>

                                </li>
                            </ul>
                        </nav>

                    </div>

                </div>
                <div class="well" style="height: 100%;">
                    <form method="POST" class="form" style="margin:50px" enctype="multipart/form-data">
                        <h4>Ecrivez un commentaire</h4>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="10" cols="100" placeholder="Write something..."></textarea>
                        <h4>Selectionner un media </h4>
                        <input type="file" name="files[]" multiple accept='<?php  $type=""; foreach($allowTypes as $unType){$type.=$unType.",";}echo rtrim($type,",")?>'>
                        <br>
                        <input class="btn btn-primary" type="submit" name="publish" id="publish" value="Publish">
                        <p> <?php
                            if (count($error) >= 0) {
                                foreach ($error as $uneError) {
                                    echo $uneError . "\n";
                                }
                            }
                            ?></p>


                    </form>

                </div>
            </div>
        </div>
    </div>

    
</body>

</html>