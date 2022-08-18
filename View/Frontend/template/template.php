<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?= $title ?></title>
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
		<script src="public/js/bootstrap.bundle.min.js"></script>
	</head>

	<body>
		<div id="bloc_page">
			<header>
				<div class="headerPage">
					<img src="Public/images/svg/coding.svg" alt="logoCoding" width="80px" height="80px"></img>
					<h1>Bienvenue sur mon Blog</h1>
				</div>
					<div id="header_basic">
						<nav class="navbar navbar-expand-lg bg-light">
							<div class="container">
								<div class="collapse navbar-collapse menuNavbar row" id="navbarNavDropdown">
									<ul class="navbar-nav">
										<li class="nav-item col-lg-4">
										<a class="nav-link active" aria-current="page" href="index.php">Home</a>
										</li>
										<li class="nav-item col-lg-4">
										<a class="nav-link" href="index.php?action=listArticles">Articles</a>
										</li>
										<li class="nav-item dropdown col-lg-4">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										Profil
										</a>
										<div class="menuDrop">
											<ul class="dropdown-menu bg-light" style="width: 385px">
												<li>
													<?php if(!isset($_SESSION['pseudo'])): ?>
														<div class="formDrop">
															<strong>Formulaire de connexion</strong>
																<?php if(isset($errorMessage)): ?>
																	<div class="alert alert-danger" role="danger">
																		<?php echo $errorMessage; ?>
																	</div><br />
													<?php endif; ?>
															<form action="index.php?action=loginVerify" method="POST">
																	<div class="form-floating">
																		<textarea class="form-control" placeholder="leave a comment here" id="pseudo" name="pseudo"></textarea>
																		<label for="pseudo">Pseudo</label><br />
																	</div>
																	<div class="form-floating">
																		<input type="password" class="form-control" placeholder="Password" id="pwd" name="pwd" />
																		<label for="pwd">Mot de passe</label><br />
																	</div>
																	<div>
																		<button class="btn btn-success" type="submit" value="connexion" name="submit">Envoyer</button>
																	</div>
															</form>
														</div>
													<?php else: ?>
															<div class="alert alert-success" role="alert">
																Bonjour <?php echo $_SESSION['pseudo']; ?>
															</div>
													<?php endif; ?>
												</li>
												<?php if(!isset($_SESSION['pseudo'])): ?>
													<li><hr class="dropdown-divider" href="#"></li>
													<li><a class="dropdown-item" href="index.php?action=registerPage">Inscription</a></li>
												<?php endif; ?>
												<?php if(isset($_SESSION['pseudo'])): ?>
													<li><a class="dropdown-item" href="#">Mon profil</a></li>
													<li><hr class="dropdown-divider" href="#"></li>
													<li><a class="dropdown-item" href="index.php?action=destroy">Deconnexion</a></li>
												<?php endif; ?>
											</ul>
										</div>
										</li>
									</ul>
								</div>
							</div>
						<nav>
			</header>

			<section>
				<div id="content">
					<?= $content ?>
				</div>
			</section>

			<footer>
				<div class="container" id="footer_basic">
						<div class="row">
							<div class="col-lg-3 navSocial">
								<h4>Réseaux Sociaux</h4>
								<ul>
									<li><img src="Public/images/svg/linkedin.svg" alt="linkedin" width="80" height="80"/><a href="#linkedin"> - Linkedin -</a></li>
									<li><img src="public/images/svg/github.svg" alt="github" width="80" height="80" /><a href="https://github.com/Bast-Lcrf" target="blank"> - Github - </a></li>
									<li><img src="public/images/svg/Instagram.svg" alt="Instagram" width="80" height="80" /><a href="#instagram"> - Instagram - </a></li>
								</ul>
							</div>
							<div class="col-lg-6 form_contact">
								<h4>Me contacter</h4>
								<?php include('contact.php'); ?>
							</div>
							<div class="col-lg-3 menu_footer">
								<h4>Liens utiles</h4>
								<ul>
									<li><a href="index.php">Home</a></li>
									<li><a href="index.php?action=#">Qui suis-je</a></li>
									<li><a href="index.php?action=#">Charte protection des données</a></li>
									<li><a href="index.php?action=#">Politiques des cookies</a></li>
								</ul> 
							</div>
						</div>
						<div class="copyright">
							<p>© - <?php if(!isset($_SESSION['pseudo'])): ?>
											Webmaster
									<?php elseif($_SESSION['statut'] == 1): ?>
										<a href="index.php?action=adminZone">Webmaster</a>
									<?php else: ?>
										Webmaster
									<?php endif; ?> 
								- Bastien LECERF - 2022 - Projet 5 - OpenClassrooms
						</div>
				</div>
			</footer>
		</div>
	</body>
</html>