<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?= $title ?></title>
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
		<script src="public/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div id="bloc_page">
			<header>
			<h1>Bienvenue sur le blog des legendes</h1>
				<div id="header_basic">
						<nav class="navbar navbar-expand-lg bg-light">
							<div class="container-fluid">
								<h2 class="navbar-brand" href="#">Navbar</h2>
									<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>
								<div class="collapse navbar-collapse menuTop" id="navbarNav">
									<ul class="navbar-nav">
										<li class="nav-item">
											<a class="nav-link active" aria-current="page" href="index.php">Home</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="index.php?action=listArticles">Articles</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="index.php?action=destroy">Deconnexion</a>
										</li>
									</ul>
								</div>
							</div>
						</nav>
			</header>

			<section>
				<div id="content">
					<?= $content ?>
				</div>
			</section>

			<footer>
				<div class="container" id="footer_basic">
						<div class="row">
							<div class="col-lg-4 navSocial">
								<h4>Réseaux Sociaux</h4>
								<ul>
									<li><a href="#linkedin"><img src="Public/images/svg/linkedin.svg" alt="linkedin" width="100" height="100"/></a></li>
									<li><a href="https://github.com/Bast-Lcrf" target="blank"><img src="public/images/svg/github.svg" alt="github"width="100" height="100" /></a></li>
									<li><a href="#instagram"><img src="public/images/svg/Instagram.svg" alt="Instagram" width="100" height="100" /></a></li>
								</ul>
							</div>
							<div class="col-lg-4 form_contact">
								<h4>Me contacter</h4>
								<?php include('contact.php'); ?>
							</div>
							<div class="col-lg-4 menu_footer">
								<h4>Liens utiles</h4>
								<ul>
									<li><a href="index.php">Home</a></li>
									<li><a href="index.php?action=#">Mon CV</a></li>
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