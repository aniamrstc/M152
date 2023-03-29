<?php
require "./BDD.php";
session_start();

/* Sélection des commentaires et des médias dans la base de données. */
$arrayCommentaire = selectCommentaire($_SESSION['idPost']);
$arrayMedia = SelectMedia($_SESSION['idPost']);
/* Filtrer l'entrée du formulaire et l'affecter à une variable. */
$commentaire = filter_input(INPUT_POST, 'commentaire');
$idMedia = filter_input(INPUT_POST, 'idMedia');
$edit = filter_input(INPUT_POST, 'edit');
$path = "./images/";
$targetDir = "images/"; //chemin du dosier ou seront stocker les medias
$allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'mp4', 'mp3'); //tableaux des type accepter
$fileSize = 0; //taille de tout les media contenu dans le dossier
$MaxSizeOneFile = 3 * 1024 * 1024; //taille maximum pour un media 
$MaxSizeAllFile = 70 * 1024 * 1024; //taille maximum pour tout les media
$error = []; //variable pour les messages d'erreurs
/* Vérifier si le bouton d'édition a été cliqué. */
if (isset($_POST['edit'])) {
    getConnexion()->beginTransaction();
    try{
 /* Cette fonction met à jour la publication avec le nouveau commentaire. */
    UpdatePost($commentaire, $_SESSION['idPost']);
    $fileNames = array_filter($_FILES['files']['name']);
    if (!empty($fileNames)) {
       /* boucle for qui parcourt le tableau files et ajoute la taille de chaque
       fichier à la variable . */
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
                    $fileName = basename($_FILES['files']['name'][$key]);
                    //recuperer l'extension du fichier
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    //si le tableaux contient bien le bon type d'extension 
                    if (in_array($fileType, $allowTypes)) {


                        $file_part = pathinfo($fileName);
                        //on met le nom du fichier sans l'extension+un l'uniqid+l'extension
                        $unique_filename = $file_part['filename'] . '_' . uniqid() . '.' . $file_part['extension'];
                        //on concatene le chemin et le non unique puis on le deplace dans notre fichier
                        $full_path = $targetDir . $unique_filename;

                        if (count($error) == 0) {
                            //si le fichier a bien été stocker dans le dossier on insere les données dans la base 
                            if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $full_path)) {
                               /* Ce code vérifie si le fichier existe et si c'est le cas, il insère
                               les données dans la base de données. */
                                if (file_exists($full_path)) {

                                    InsertMedia($_FILES['files']['type'][$key], $unique_filename, $_SESSION['idPost']);
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
    /* redirection vers la page d'accueil. */
    if (count($error) != 0) {
        getConnexion()->rollBack();
    } else {
        getConnexion()->commit();
        header("location:Home.php");
        exit;
    }
}catch (Exception $exception) {
    getConnexion()->rollback();
    throw $exception;
}
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/facebook.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Edition</title>

</head>

<body>
    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="column col-sm-10 col-xs-11" id="main" style="width: 100%;">
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
                    <div class="well" style="height: 100%; background-color:#e9eaed;">
                        <?php foreach ($arrayCommentaire as $unCommentaire) { ?>


                            <div id="media" class="row" style="margin-top: 30px; height:auto;">
                                <?php foreach ($arrayMedia as $media) { ?>
                                    <form method="GET" class="form" style="margin:50px" enctype="multipart/form-data">
                                        <div class="col-xs-6 col-sm-4">
                                           
                                                <?php if (explode("/", $media['typeMedia'])[0] == "video") { ?>
                                                    <video class="img-responsive" style=" width:400px;" autoplay loop>
                                                        <source src="<?= $path . $media['nomMedia'] ?>">
                                                    </video>
                                                <?php } elseif (explode("/", $media['typeMedia'])[0] == "audio") { ?>
                                                    <audio controls style="width:100%">
                                                        <source src="<?= $path . $media['nomMedia'] ?>">
                                                    </audio>
                                                <?php } else { ?>
                                                    <img src="<?= $path . $media['nomMedia'] ?>" alt="... " class="img-responsive" style=" width:400px;">
                                                <?php } ?>
                                         
                                            <input type="button" onclick="deleteMedia(<?= $media['idMedia'] . ',' . $_SESSION['idPost'] ?>)" name="delete" value="&#x1F5D1;" style="width: 40px;font-size: 25px; margin:5px 0 25px 0">
                                            <input type="hidden" name="idMedia" value="<?= $media['idMedia'] ?>">

                                        </div>
                                    </form> <?php } ?>
                            </div>
                            <form method="POST" class="form" style="margin:50px" enctype="multipart/form-data">
                                <h4>Ecrivez un commentaire</h4>

                                <textarea class="form-control" id="commentaire" name="commentaire" rows="10" cols="100"><?= $unCommentaire['commentaire'] ?></textarea>
                                <h4>Selectionner un media </h4>
                                <div>
                                    <input type="file" name="files[]" multiple accept='image/jpg, image/png, image/jpeg, image/gif,video/mp4,audio/mp3' style="display:inline;">
                                    <input class="btn btn-primary" type="submit" name="edit" id="edit" value="edit" style="width: 100px; margin:0 0 25px 0; float:right;">
                                </div>
                            </form>

                        <?php } ?>
                    </div>
                </div>
                <script src="js/index.js"></script>
</body>

</html>