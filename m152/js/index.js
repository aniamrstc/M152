
/**
 * Il prend l'id du média à supprimer et l'id du post auquel il appartient, puis il appelle le script
 * Delete.php avec l'id du média à supprimer en paramètre, puis il appelle la fonction ShowMedia pour
 * rafraichir la liste des médias
 * @param idMedia - l'identifiant du média que vous souhaitez supprimer
 * @param idPost - l'identifiant du poste
 */
async function deleteMedia(idMedia, idPost) {
    let path = "./Delete.php" + "?idMedia=" + idMedia;
    let myURL = await fetch(path);

    ShowMedia(idMedia, idPost);

}

/**
 * La fonction ShowMedia() est une fonction asynchrone qui prend deux paramètres, idMedia et idPost. La
 * fonction crée ensuite un chemin vers le fichier ShowMedia.php et transmet le paramètre idPost au
 * fichier. La fonction récupère ensuite le chemin et attend la réponse. La réponse est ensuite
 * analysée et la fonction show() est appelée avec les paramètres idMedia et idPost
 * @param idMedia - l'id de la div où le média sera affiché
 * @param idPost - l'identifiant du poste
 */
async function ShowMedia(idMedia, idPost) {

    let pathMedia = "./ShowMedia.php" + "?idPost=" + idPost;
    let myURLMedia = await fetch(pathMedia);
    let myResponse = await myURLMedia.text();
    myText = JSON.parse(myResponse);
    show(idMedia, idPost);

}
/**
 * Il prend un idMedia et un idPost comme paramètres, puis il raffiche la div sans le media qu'on a supprimer
 * @param idMedia - l'identifiant du média
 * @param idPost - l'identifiant du poste
 */
function show(idMedia, idPost) {
    divAllMedia = document.getElementById("media");
    var media = "";
    var typeMedia;
    for (let i = 0; i < myText.length; i++) {

        typeMedia = myText[i]['typeMedia'].split("/")[0]
        media += ' <form method="GET" class="form" style="margin:50px" enctype="multipart/form-data">' + '<div class="col-xs-6 col-sm-4">';
        if (typeMedia == "video") {
            media += '<video class="img-responsive" style=" width:400px;" autoplay loop> <source src=\"images/' + myText[i]['nomMedia'] + '\"> </video>';
        } else if (typeMedia == "audio") {
            media += ' <audio controls style="width:100%"><source src=\"images/' + myText[i]['nomMedia'] + '\"></audio>';

        } else {
            media += ' <img src=\"images/' + myText[i]['nomMedia'] + '\"  class="img-responsive" style=" width:400px;"></img>';
        }
        media += '<input type="button" onclick="' + deleteMedia(idMedia, idPost) + '" name="delete" value="&#x1F5D1;" style="width: 40px;font-size: 25px; margin:5px 0 25px 0"> <input type="hidden" name="idMedia" value="' + myText[i]['idMedia'] + '"></div> </form>';


    }
    if(divAllMedia.innerHTML = media){
    location.reload();
    }
}
