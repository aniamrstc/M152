<?php

require("./BDD.php");

$path = "./images/";

$file = filter_input(INPUT_GET,'file');

$media=selectMediaByIdMedia($file);
if($media==[]){
    header("HTTP/1.1 404 Not Found");
    exit;
}
$media=$media[0];
http_response_code(200);
header('Content-Type:'.$media['typeMedia']);
header('Content-Length:'.filesize($path.$media['nomMedia']));
echo file_get_contents($path.$media['nomMedia']);
exit(0);