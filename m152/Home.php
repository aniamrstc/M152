<?php
// projet:Realiser un blog
// Auteur:Ania Marostica
// Date:02.02.2023
// Description:page d'accueil du site
require "./BDD.php";

$post = SelectPost();

$path = "./images/";
$delete = filter_input(INPUT_POST, 'delete');
$deleteAMEdia = filter_input(INPUT_POST, 'deleteAMEdia');


?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link href="assets/css/facebook.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
							
							<ul class="nav navbar-nav">
								<li>
									<a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
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
										<div class="panel-heading"><a href="#" class="pull-right">View all</a>
											<h4>Bootstrap Examples</h4>
										</div>
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
									<?php foreach ($post as $key => $value) {
										$arrayMedia = SelectMedia($value['idPost']);
										$numberOfMediaForAPost = GetNumberOfMediaForAPost($value['idPost']); ?>


										<div class="panel panel-default">
											<?php if ($numberOfMediaForAPost >= 2) { ?>

												<div id="carousel<?= $value['idPost'] ?>" class="carousel slide" data-ride="carousel">
													<div class="carousel-inner" role="listbox">
														<?php
														$isFirst = true;
														foreach ($arrayMedia as $media) {
															if ($delete == "Delete") {
																DeletePost($value['idPost']);
																unlink($path . $media['nomMedia']);
															}
														?>
															<div class="item <?= $isFirst ? 'active' : '' ?> ">

																<?php if (explode("/", $media['typeMedia'])[0] == "video") { ?>
																	<video class="img-responsive" autoplay loop>
																		<source src="<?= $path . $media['nomMedia'] ?>">
																	</video>
																<?php }elseif(explode("/", $media['typeMedia'])[0] == "audio"){?>
																	
																	<?php }else { ?>
																	<img src="<?= $path . $media['nomMedia'] ?>" alt="... " class="img-responsive">
																<?php } ?>
															</div>

														<?php
															$isFirst = false;
														}
														?>

													</div>

													<!-- Controls -->
													<a class="left carousel-control" href="#carousel<?= $value['idPost'] ?>" role="button" data-slide="prev">
														<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
														<span class="sr-only">Previous</span>
													</a>
													<a class="right carousel-control" href="#carousel<?= $value['idPost'] ?>" role="button" data-slide="next">
														<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
														<span class="sr-only">Next</span>
													</a>
												</div>
												<?php foreach ($arrayMedia as $media) {
													if (explode("/", $media['typeMedia'])[0] == "audio") { ?>
														<audio controls>
															<source src="<?= $path . $media['nomMedia'] ?>">
														</audio>
												<?php }
												}
												?>
											<?php } elseif ($numberOfMediaForAPost == 1) {
												if ($deleteAMEdia == "Delete") {
													DeletePost($value['idPost']);
													unlink($path . $arrayMedia[0]['nomMedia']);
												}
											?>

												<!--message du post-->

												<div class="panel-thumbnail">
													<?php if (explode("/", $arrayMedia[0]['typeMedia'])[0] == "video") { ?>
														<video class="img-responsive" autoplay loop>
															<source src="<?= $path . $arrayMedia[0]['nomMedia'] ?>">
														</video>
													<?php } elseif (explode("/", $arrayMedia[0]['typeMedia'])[0] == "audio") { ?>
														<audio controls>
															<source src="<?= $path . $arrayMedia[0]['nomMedia'] ?>">
														</audio>
													<?php } else { ?>
														<img src="<?= $path . $arrayMedia[0]['nomMedia'] ?>" class="img-responsive">
													<?php } ?>
												</div>


											<?php
											} ?>


											<div class="panel-body">
												<p class="lead"><?= $value['commentaire']; ?> </p>
												<form method="POST">
													<!--<input type="submit" name="deleteAMEdia" value='Delete'>-->
													<button class="btn"><i class="fa fa-pencil"></i></button>
													<button class="btn"><i class="fa fa-trash"></i></button>

													<p><?= $value['creationDate'] ?></p>
												</form>
											</div>
										</div>
									<?php } ?>
								</div>
							</div><!--/row-->



						</div><!-- /col-9 -->
					</div><!-- /padding -->
				</div>
				<!-- /main -->

			</div>
		</div>
	</div>

</body>

</html>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<script>
	// Initialize tooltip component
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})


	$(function() {
		$('[data-toggle="popover"]').popover()
	})
</script>