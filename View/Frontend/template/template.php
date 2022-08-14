<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?= $title ?></title>
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
		<script src="public/css/bootstrap.min.js"></script>
	</head>

	<body>
		<div id="bloc_page">
			<header>
				<div id="header_basic">
					<h1>Bienvenue sur le blog des legendes</h1>
						<div>
							<ul class="menu_header">
								<li><a href="index.php">Home</a></li>
								<li><a href="index.php?action=listArticles">Derniers Articles</a></li>
								<li><a href="index.php?action=destroy">Déconnexion</a></li>
							</ul>
						</div>
						<?php // include('headerMenu.php'); ?>
				</div>
			</header>

			<section>
				<?= $content ?>
			</section>

			<footer>
				<div id="footer_basic">
					<div class="navSocial">
						<ul>
							<li><a href="#twitter"><img src="public/images/reseauxSociaux/Twitter.png" alt="Twitter"></a></li>
							<li><a href="#facebook"><img src="public/images/reseauxSociaux/Facebook.png" alt="Facebook"></a></li>
							<li><a href="#instagram"><img src="public/images/reseauxSociaux/Instagram.png" alt="Instagram"></a></li>
						</ul>
					</div>
					<div class="form_contact">
						<?php include('contact.php'); ?>
					</div>
					<div class="menu_footer">
						<ul class="menu_footer">
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php?action=newBillet">Nouveau billet</a></li>
							<li><a href="index.php?action=validView">Validation des commentaires</a></li>
						</ul>
					</div>
			</footer>
		</div>
	</body>
</html>