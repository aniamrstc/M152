<?php
 require "./BDD.php";
 $submit=filter_input(INPUT_POST,'publish');
 if($submit =="Publish"){ 
    echo"ddd";
    // File upload configuration 
    $targetDir = "images/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($fileNames as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', NOW()),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
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
                            <button class="navbar-toggle" type="button" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="http://usebootstrap.com/theme/facebook" class="navbar-brand logo">b</a>
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <form class="navbar-form navbar-left">
                                <div class="input-group input-group-sm" style="max-width:360px;">
                                    <input class="form-control" placeholder="Search" name="srch-term" id="srch-term"
                                        type="text">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i
                                                class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="./Home.html"><i class="glyphicon glyphicon-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="./Post.html" role="button" data-toggle="modal"><i
                                            class="glyphicon glyphicon-plus"></i> Post</a>
                                </li>
                                <li>
                                    <a href="#"><span class="badge">badge</span></a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="glyphicon glyphicon-user"></i></a>

                                </li>
                            </ul>
                        </nav>
                        
                    </div>

                </div>
                <div class="well" style="height: 100%;">
                    <form method="POST"class="form"style="margin:50px" enctype="multipart/form-data">
                        <h4>Ecrivez un commentaire</h4>
                        <textarea id="w3review" name="w3review" rows="4" cols="50" placeholder="Write something..."></textarea>
                        <h4>Selectionnez un media a envoyer</h4>
                        <input type="file" name="files[]" required multiple accept="image/*">
                        <br>
                        <input type="submit" name="publish"id="publish" value="Publish">

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>