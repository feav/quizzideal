<!DOCTYPE html>
<?php 
	include('./requiert/php-global.php');
	
if (!isset($_SESSION['id'])) {
	?>




	<?php
}else{
	?>




	<?php
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
<script src="script/js/sweetalert.min.js"></script>
</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

	<!-- Header Container
	================================================== -->
	<header id="header-container" class="fixed fullwidth ">

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

							<li><a href="gagnants.php"  >Gagnants</a>
							</li>

							<li><a href="faq.php" >FAQ</a>
							</li>

							<li><a href="contact.html" >Contact</a>
							</li>
							
							
						</ul>
					</nav>
					<div class="clearfix"></div>
					<!-- Main Navigation / End -->
					
				</div>
				<!-- Left Side Content / End -->
				<?php
					if (isset($_SESSION['id'])) {
						?>


				<!-- Right Side Content / End -->
				<div class="right-side">
					<div class="header-widget">
						<!-- <a  href="index.php?action=logout" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Deconnexion</a> -->
						<a href="./profil.php" class="button border with-icon">Mon profil<i class="sl sl-icon-user"></i></a>
					</div>
				</div>

				<?php
					}else{
						?>

				<!-- Right Side Content / End -->
				<div class="right-side">
						<a href="./connexion.php" style="float: right;" class="button border with-icon">Connexion</a>
					</div>
				</div>

				<?php	} ?>
				<!-- Right Side Content / End -->

				<!-- Sign In Popup -->
				<!-- <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

					<div class="small-dialog-header">
						<h3>Deconnexion</h3>
					</div>

				</div> -->
				<!-- Sign In Popup / End -->

			</div>
		</div>
		<!-- Header / End -->

	</header>

<?php
// var_dump(isset($_SESSION['id']));die();
if (isset($_SESSION['id'])) {
	?>



	<!-- Dashboard -->
	<div id="dashboard-">

		<!-- Navigation
		================================================== -->

		<!-- Responsive Navigation Trigger -->
		<a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

		<div class="dashboard-nav">
			<div class="dashboard-nav-inner">

				<ul data-submenu-title="Main">
					<li class="active"><a  href="index.php"><i class="sl sl-icon-settings"></i> Acceuil</a></li>
					<li><a  href="messagerie.php"><i class="sl sl-icon-envelope-open"></i> Messages <span class="nav-tag messages"><?= $nb_MsgNonLu['nbr_entrees']; ?></span></a></li>
					<li><a <?= isset($_SESSION['email_offre']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'] ? 'href="./livredor.php"' : 'href="./infos.php"'?>><i class="sl sl-icon-envelope-open"></i>Livre d'Or</a>
							</li>
					<li><a href="./infos.php"><i class="fa fa-1x fa-users"></i>Gagner de l'argent</a></li>
					<li><a href="./parrainage.php"><i class="fa fa-1x fa-users"></i>Parrainage</a></li>
				</ul>
				
				<ul data-submenu-title="Listings">
					<li><a href="./boutique.php">Boutiques</a></li>
					<li><a href="./mes-commandes.php"><i class="fa fa-1x fa-list"></i>Commandes</a></li>
					<li><a href="./mes-participations.php"><i class="fa fa-1x fa-list"></i>Participations</a></li>
					<li><a href="./coupons.php">  <i class="fa fa-1x fa-money"></i>Coupons</a></li>
					<li><a href="listings-single-page.html"><i class="fas fa-1x fa-money"></i>CashBack</a></li>
					<li><a href="listings-single-page-2.html"> <i class="fas fa-1x fa-money"></i>OfferWalls</a></li>
				</ul>	

				<ul data-submenu-title="Account">
					<!-- <li><a href="dashboard-my-profile.html"><i class="sl sl-icon-user"></i> My Profile</a></li> -->
					<li><a  href="./index.php?action=logout"><i class="sl sl-icon-power"></i> Deconnexion</a></li>
				</ul>
				
			</div>
		</div>
		<!-- Navigation / End -->


		<!-- Content
		================================================== -->
		<div class="dashboard-content">

<?php
}else{
	?>


	<!-- Dashboard -->
	<div id="container">
		<!-- Navigation / End -->


		<!-- Content
		================================================== -->
		<div class="rowt">

	<?php
}
?>
	<div class="clearfix"></div>
<!-- Header Container / End -->
<div class="row">