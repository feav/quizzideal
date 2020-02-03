<!DOCTYPE html>
<?php 
	include('./requiert/php-global.php');

if (!isset($_SESSION['id'])) {
	// header('Location: /connexion.html');
	// exit();
}
?>

<head>

<!-- Basic Page Needs
================================================== -->
<title>Quizzdeal | Cashback &amp; Online Shopping Plaza</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/theme-custom.css">
<link rel="stylesheet" href="assets/css/colors/main.css" id="colors">

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="accueil.php"><img src="assets/images/logo.png" alt=""></a>
				</div>

				<!-- Mobile Navigation -->
				<div class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>


				<!-- Main Navigation -->
				<nav id="navigation" class="style-1">
					<ul id="responsive">

						<li><a class="current" href="index.php">Accueil</a>
						</li>

						<li><a href="./boutique.php">Boutique</a>
							<ul>
								<li><a href="./mes-commandes.php"><i class="fa fa-1x fa-list"></i>Commandes</a>
								</li>
								<li><a href="./mes-participations.php"><i class="fa fa-1x fa-list"></i>Participations</a>
								</li>
								<li><a href="./coupons.php">  <i class="fa fa-1x fa-money"></i>Coupons</a>
								</li>
								<li><a href="listings-single-page.html"><i class="fas fa-1x fa-money"></i>CashBack</a></li>
								<li><a href="listings-single-page-2.html"> <i class="fas fa-1x fa-money"></i>OfferWalls</a></li>
							</ul>
						</li>

						<li><a href="./infos.php">Gagner de l'argent</a>
							<ul>
								<li><a href="./parrainage.php"><i class="fa fa-1x fa-users"></i>Parrainage</a>
								</li>
							</ul>
						</li>
						<li><a <?= isset($_SESSION['email_offre']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'] ? 'href="./livredor.php"' : 'href="./infos.php"'?>>Livre d'Or</a>
						</li>
						
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">
				<div class="header-widget">
					<a  href="index.php?action=logout" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Deconnexion</a>

					<a href="messagerie.php" title="" class="sign-in popup-with-zoom-anim"><i class="fa fa-envelope mes"></i>
						<span class="message_circle mes-text">0</span>
					</a>
					<a href="./profil.php" class="button border with-icon">Mon profil<i class="sl sl-icon-user"></i></a>
				</div>
			</div>
			<!-- Right Side Content / End -->

			<!-- Sign In Popup -->
			<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

				<div class="small-dialog-header">
					<h3>Deconnexion</h3>
				</div>

			</div>
			<!-- Sign In Popup / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->