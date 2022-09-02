<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?= $title ?></title>
		<!--- Style CSS -->
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	</head>

	<body>
		<div id="bloc_page">
			<header>
				<div class="headerPage">
					<img src="Public/images/svg/coding.svg" alt="logoCoding" width="80px" height="80px"></img>
					<h1>Bienvenue sur mon Blog</h1>
					<?php if(isset($_SESSION['pseudo'])): ?>
						<div class="alert alert-success btnLog" role="alert">
							Bonjour <?php echo $_SESSION['prenom']; ?>
						</div>
					<?php endif; ?>
				</div>
					<div id="header_Nav">
						<nav class="navbar navbar-expand-lg header_nav">
							<div class="container-fluid">
								<a class="navbar-brand" href="index.php">L.B - Blog</a>
								<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span></span>
								<span></span>
								<span></span>
								</button>
								<div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
								<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
									<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="index.php">Home</a>
									</li>
									<li class="nav-item">
									<a class="nav-link" href="index.php?action=listArticles">Articles</a>
									</li>
									<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										Profil
									</a>
									<ul class="dropdown-menu">
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
								</ul>
								<ul class="navbar-nav ms-auto">
									<button class="btn">Test</button>
								</ul>
								</div>
							</div>
						</nav>
					</div>
			</header>

			<section>
				<div id="content">
					<?= $content ?>
				</div>
			</section>

			<footer>
				<div class="container" id="footer_basic">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-3 navSocial">
								<h4>Réseaux Sociaux</h4>
								<ul>
									<li><img src="Public/images/svg/linkedin.svg" alt="linkedin" width="80" height="80"/><a href="#linkedin"> - Linkedin -</a></li>
									<li><img src="public/images/svg/github.svg" alt="github" width="80" height="80" /><a href="https://github.com/Bast-Lcrf/projet5-Blog" target="blank"> - Github - </a></li>
									<li><img src="public/images/svg/Instagram.svg" alt="Instagram" width="80" height="80" /><a href="#instagram"> - Instagram - </a></li>
								</ul>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-6 form_contact">
								<h4>Me contacter</h4>
								<?php include('contact.php'); ?>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-3 menu_footer">
								<h4>Liens utiles</h4>
								<ul>
									<li><a href="index.php">Home</a></li>
									<li><a href="index.php?action=me">Qui suis-je</a></li>
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
		<!-- Bootstrap JavaScript  -->
		<script src="public/js/bootstrap.bundle.min.js"></script>
	</body>
</html>