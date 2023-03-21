<?php  
require "./BDD.php";
session_start();
header('Access-Control-Allow-Origin: *');
echo (json_encode(SelectMedia($_SESSION['idPost'])));


?>