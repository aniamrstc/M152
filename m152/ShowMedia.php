<?php  
require "./BDD.php";
session_start();
/* Il permet au serveur d'accepter les requêtes de n'importe quel domaine. */
header('Access-Control-Allow-Origin: *');
/* Renvoie le résultat de la fonction `SelectMedia` au format JSON. */
echo (json_encode(SelectMedia($_SESSION['idPost'])));


?>