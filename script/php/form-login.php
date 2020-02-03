<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location:membre.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Connexion | GPTBonus</title>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<meta name="robots" content="index, all, follow"/>
		<meta name="author" content="MOREAU&CO SPRL"/>
		<meta name="revisit-after" content="3 days"/>
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
		<!-- Propriété iPhone -->
		<meta name="viewport" content="width=device-width, user-scalable=no"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<!-- Meta CSS -->
		<link type="text/css" rel="stylesheet" href="css/style.02.css" media="all"/>
		<script src="script/js/sweetalert.min.js"></script>
		<link type="text/css" rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all"/>
		<!-- Meta Facebook -->
		<meta name="og:site_name" content=""/>
		<meta name="og:title" content=""/>
		<meta name="og:image" content=""/>
		<meta name="og:description" content=""/>
		<meta name="og:url" content=""/>
		<meta name="og:type" content="website"/>
		<meta name="og:locale" content="fr_BE"/>
		<meta name="og:locale:alternate" content="fr_BE"/>
	</head>
	<body>
		<header class="fixed-first">			
			<!-- Navigation -->
			<nav class="bg-black-opaque absolute-section-2 f-s-13">
				<div class="m-auto p-20">
				<!-- Logo -->
					<div id="menuDeroulant" class="Oswald uppercase f-w-400">
						<li class="m-r-15"><a href="index.php" title="" class="menuUrl">Accueil</a></li><li class="m-r-15"><a href="gagnants.php" title="" class="menuUrlBlue">Derniers gagnants</a></li><li class="m-r-15"><a href="contact.php" title="" class="menuUrl">Contact</a></li><li class="m-r-15"><a href="#" data-popup-open="popup-connexion" title="" class="color-beige button-white p-5-10 b-r-50 f-w-bold"><i class="fa fa-fw fa-sign-in m-r-5"></i> Connexion</a></li>					</div>
            	    <div class="mobile-btn b-r-5" style="float:none;">
            	    	<form method="POST">
		            	    <select name="choixPage" onchange="loadPage(this.value);" style="border:0;background:transparent">
		            	    	<option selected disabled>Sélectionnez une page</option>
		            	    	<option value="/">Accueil</option>
		            	    			            	    	<option value="gagnants.html">Derniers gagnants</option>
		            	    	<option value="gagnants.php">Contact</option>
		            	    	<option value="login.php">Connexion</option>	            	    	</select>
            	    	</form>

						<script>
						<!--
						function loadPage(param) {
							self.location.href = "http://www.quizzdeal.fr"+param;
						}
						-->
						</script>
					</div><div class="clear"></div>
				</div>
			</nav>
		</header>
       
	   <!-- Pop Up Connexion -->
		<div class="popup" data-popup="popup-connexion"><div class="popup-inner bg-white">
			<div class="p-20">
				<div class="float m-b-20">
					<div class="Oswald f-s-24 color-gold uppercase float-left">Espace membre</div>
					<div class="float-right f-s-24 cursor-pointer">
						<i class="fa fa-close" data-popup-close="popup-connexion"></i>
					</div>
				</div>

				<div id="reponseLogin"></div>

				<form id="FormLogin" action="http://www.quizzdeal.fr/script/php/form-login.php" method="POST" class="f-s-13 f-w-light">
					<input type="email" id="email" name="email" value="" placeholder="Entrez votre adresse e-mail" class="input-md b-r-5 m-b-10 f-s-12" />
					<input type="password" id="password" name="password" value="" placeholder="Entrez votre mot de passe" class="input-md b-r-5 m-b-10 f-s-12" />
					
					<div class="float">
								<div class="float-left p-t-10 f-s-13 f-w-bold"><a href="reset.php">Mot de passe perdu ?</a></div>
						<div class="float-right">
							<button id="submitLogin" class="button-blue-degrade p-10-20 b-r-5 color-white f-s-13 cursor-pointer">Je me connecte</button>
						</div>
					</div>
				</form>
			</div>
		</div></div>
		<!-- Fin Pop Up Connexion -->
        <?php
        include('db.php');

        if (isset($_POST['submit'])) {

            /*$ip = gethostbyname($_SERVER["REMOTE_ADDR"]);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http://proxy.mind-media.com/block/proxycheck.php?ip=' . $ip);
            $result = curl_exec($ch);
            curl_close($ch);*/

            //if ($result == 'N') {

                $ip0 = getenv('REMOTE_ADDR');
                $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip0"));
                $country = $geo["geoplugin_countryName"];

                if ($country == 'France' || $country == 'Belgium') {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $password = md5($password);
                    $query0 = mysqli_query($link,"SELECT * FROM users WHERE email='$email' AND password='$password'");

                    if (mysqli_num_rows($query0) == 1) {
                        session_start();
                        $_SESSION['email'] = $email;
                        header("Location:membre.php");
                    } else
                        echo "<div class='error11'><br>Email ou mot passe incorrect</div>";
                } else
                    echo "<div class='error11'><br>Nous acceptons seulement les pays suivants : France , Belgique<br></div>";
            //} else
            //    echo "<div class='error11'><br>Vpn interdit</div>";
        }
        ?>	

       <section class="bg-white absolute-section-1">
			<div class="m-auto content p-40-20">
				<div class="m-b-5 f-s-18 f-w-bold txt-align-left color-gold">Connexion</div>
				<div class="m-b-20 b-b-3-gold"></div>
				
				<div class="container"><div class="row">
					<div class="col-md--12"><div class="bg-light-grey b-r-10 p-20 b-special-grey">
		
						<form method="POST" class="f-s-13 f-w-light">
							<input type="email" id="email" name="Votre email" value="" placeholder="Entrez votre pseudo ou adresse e-mail" class="input-md b-r-5 m-b-10 f-s-12" />
							<input type="password" id="password" name="password" value="" placeholder="Votre mot de passe" class="input-md b-r-5 m-b-10 f-s-12" />
							
							<div class="float">
								<div class="float-left p-t-10 f-s-13 f-w-bold"><a href="reset.php">Mot de passe perdu ?</a></div>
								<div class="float-right">
									<button type="submit" name="submit" value="submit" class="button-blue-degrade p-10-20 b-r-5 color-white f-s-13 cursor-pointer">Je me connecte</button>
								</div>
							</div>
						</form>
					</div></div>
				</div></div>
			</div>
		</section>

        <section class="color-white bg-facebook absolute-section-1">
			<div class="m-auto content p-40-20">				
				<div class="container"><div class="row">
					<div class="col-md-12 txt-align-center">
						<h2 class="f-s-24 Oswald uppercase">Toute notre actu sur Facebook ? Suivez-nous !</h2>
						<div class="f-s-16 m-t-10 f-w-light m-b-20">Pour ne rien rater de notre actualité suivez-nous sur notre Facebook : <strong>GPTBonus.com</strong></div>
						<a href="https://www.facebook.com/gptbonus85/" title="Cliquez ici pour nous suivre" target="_blank"><div class="button bg-white bg-light-grey-hover color-black p-10-20 uppercase f-s-16 f-w-bold b-r-50 color-facebook"><i class="fa fa-facebook-official m-r-5"></i> Suivez-nous sur Facebook</div></a>
					</div>
				</div></div>
			</div>
		</section>
		
		<footer class="absolute-footer-1">
			<div class="bg-dark-grey">
			<!-- Pied-de-page de la page -->
				<div class="m-auto content p-20-0 container"><div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12 line-height f-s-14 sm-m-b-20">
						<div class="f-s-16 f-w-400 m-b-5 color-white Nunito-Light">Accès rapide</div>
						<ul>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="index.html" title="">Accueil</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="contact.html" title="">Contact</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="mentions-legales.html" title="">Mentions légales</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 line-height f-s-14 xs-m-b-20">
						<div class="f-s-16 f-w-400 m-b-5 color-white Nunito-Light">Liens utiles</div>
						
						<ul>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="https://www.facebook.com/gptbonus85/" target="_blank" title="">Page Facebook</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="http://netbusinessrating.com/fr/fiche-17892-gptbonus" target="_blank" title="">Les preuves de paiements</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 line-height f-s-14 sm-m-b-20">
						<div class="f-s-16 f-w-400 m-b-5 color-white Nunito-Light">Partenaires</div>

						<ul>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="https://www.afflight.biz/" title="Plateforme d'affiliation" target="_blank">Plateforme d'affiliation</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="http://www.optimiads.com/" title="Régie Publicitaire" target="_blank">Régie Publicitaire</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="https://www.dj-events.be/" title="Deejay en Belgique" target="_blank">Deejay en Belgique</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12 line-height f-s-14">
						<div class="f-s-16 f-w-400 m-b-10 color-white Nunito-Light">A propos de nous</div>
						
						<div class="txt-align-justify"><strong>Gagner de l'argent et des cadeaux</strong> avec GPTBonus, c'est facile et rapide ! Complétez des offres, téléchargez et testez des applications et des logiciels,... utilisez votre forfait mobile et bien plus encore.</div>
					</div>
				</div></div>
			</div>
			
			<div class="bg-dark-light-grey color-light-grey f-s-13 txt-align-center">
			<!-- Pied-de-page de la page -->
				<div class="m-auto content p-20-10">
					<div class="m-b-10">© Copyright 2017, 2018 - <strong>GPTBonus.com</strong> - Tous droits réservés</div>
					Made with <i class="fa fa-heart color-red"></i> by <a href="http://www.moreauandco.be/" target="_blank" rel="nofollow" class="f-w-bold">MOREAU&CO</a>
				</div>
			</div>
		</footer>

		<script type="text/javascript" src="../ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="../code.jquery.com/jquery-1.12.4.js"></script>
		<script src="../code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="script/js/popup-sweetalert.min.js"></script>
		<script src="script/js/login-register.js"></script>
		
	</body>

<!-- Mirrored from www.gptbonus.com/connexion.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jul 2019 10:26:57 GMT -->
</html>