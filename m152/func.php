<?php
// projet:Realiser un blog
// Auteur:Ania Marostica
// Date:02.02.2023
// Description:page de fonction pour redimensionner une image
function ResizeImage($file, $newSize) {
   /* Vérifier si le fichier est une image. */
    if (!getimagesize($file)) {
        return false;
    }


 /* Affectation de la largeur et de la hauteur de l'image aux variables */
    list($width, $height) = getimagesize($file);

/* Calcul de la nouvelle taille de l'image. */
    if ($width > $height) {
        $dim = $height;
        $x = ($width - $height) / 2;
        $y = 0;
    } else {
        $dim = $width;
        $x = 0;
        $y = ($height - $width) / 2;
    }

  
   /* Il crée une nouvelle image avec les dimensions données. */
    $dst = imagecreatetruecolor($newSize, $newSize);

    /* Vérification du type de fichier, puis création d'une nouvelle image à partir du fichier. */
    $src = null;
    switch (exif_imagetype($file)) {
        case IMAGETYPE_JPEG:
            $src = imagecreatefromjpeg($file);
            break;
        case IMAGETYPE_PNG:
            $src = imagecreatefrompng($file);
            break;
        case IMAGETYPE_GIF:
            $src = imagecreatefromgif($file);
            break;
        default:
            return false;
    }

    // Redimensionnement de l'image source vers l'image de destination
    if (!imagecopyresampled($dst, $src, 0, 0, $x, $y, $newSize, $newSize, $dim, $dim)) {
        return false;
    }

    // Enregistrement de l'image de destination
    switch (exif_imagetype($file)) {
        case IMAGETYPE_JPEG:
            return imagejpeg($dst, $file);
        case IMAGETYPE_PNG:
            return imagepng($dst, $file);
        case IMAGETYPE_GIF:
            return imagegif($dst, $file);
        default:
            return false;
    }
}