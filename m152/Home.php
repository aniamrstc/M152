<!--
projet:Realiser un blog
Auteur:Ania Marostica
Date:02.02.2023
Description:page d'accueil du site
-->
<!DOCTYPE html>
<html lang="fr">
	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="assets/css/bootstrap.css" rel="stylesheet">
   
        <link href="assets/css/facebook.css" rel="stylesheet">
    </head>
    
    <body>
        
        <div class="wrapper">
			<div class="box">
				<div class="row row-offcanvas row-offcanvas-left">
					
					
				
				  
					
					<div class="column col-sm-10 col-xs-11" id="main" style="width: 100%;">
						
						<!-- NavBar -->
						<div class="navbar navbar-blue navbar-static-top">  
							<div class="navbar-header">
							  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
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
								  <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
								  <div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								  </div>
								</div>
							</form>
							<ul class="nav navbar-nav">
							  <li>
								<a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
							  </li>
							  <li>
								<a href="./Post.php" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
							  </li>
							  <li>
								<a href="#"><span class="badge">badge</span></a>
							  </li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
							  <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
								
							  </li>
							</ul>
							</nav>
						</div>
					
					  
						<div class="padding">
							<div class="full col-sm-9">
							  
							                
								<div class="row">
							
								 <div class="col-sm-5">
								   <!--card de l'Image de profil-->
									  <div class="panel panel-default">
										<div class="panel-thumbnail"><img src="assets/img/profil.jpg" class="img-responsive"></div>
										<div class="panel-body">
										  <p class="lead">Nom du Blog</p>
										  <p>10000 Followers, 154 Posts</p>
										  
										  <p>
											<img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">
										  </p>
										</div>
									  </div>

								   <!--Card de Bootstrap Examples-->
									  <div class="panel panel-default">
										<div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>Bootstrap Examples</h4></div>
										  <div class="panel-body">
											<div class="list-group">
											  <a href="#" class="list-group-item">Modal / Dialog</a>
											  <a href="#" class="list-group-item">Datetime Examples</a>
											  <a href="#" class="list-group-item">Data Grids</a>
											</div>
										  </div>
									  </div>
								  </div>
								  
								 
								  <div class="col-sm-7">
									   <!--Message de bienvenu-->
										<div class="well"> 
										   <form class="form">
											<h4>WELCOME</h4>
											
										  </form>
										</div>
							  
									<!--message du post-->
									   <div class="panel panel-default">
										<div class="panel-thumbnail"><img src="assets/img/lapin.jpeg" class="img-responsive"></div>
										<div class="panel-body">
										  <p class="lead">un lapin</p>
										  <p>1,20000 Followers, 83 Posts</p>
										  
										  <p>
											<img src="assets/img/photo.jpg" height="28px" width="28px">
											<img src="assets/img/photo.png" height="28px" width="28px">
											<img src="assets/img/photo_002.jpg" height="28px" width="28px">
										  </p>
										</div>
									  </div>
									
								  </div>
							   </div><!--/row-->
							  
								
							  
							</div><!-- /col-9 -->
						</div><!-- /padding -->
					</div>
					<!-- /main -->
				  
				</div>
			</div>
		</div>

</body></html>