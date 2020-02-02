<?php
	include('./requiert/php-global.php');

if(isset($_SESSION['id'])){
    header("Location: accueil.php");
    exit();
}


$meta_title = 'Quizzdeal.fr : Connexion';
	$meta_description = '';

	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/login-register.php');
	
	$captchaCode = code(5);


?>
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

				<form id="FormLogin" method="POST" class="f-s-13 f-w-light">
					<input type="email" id="email" name="email" value="<?= $post_log_email; ?>" placeholder="Entrez votre adresse e-mail" class="input-md b-r-5 m-b-10 f-s-12" />
					<input type="password" id="mdp" name="mdp" value="" placeholder="Entrez votre mot de passe" class="input-md b-r-5 m-b-10 f-s-12" />
					<div class="m-b-10 f-s-18 f-w-bold txt-align-center">Captcha => <strong><?= $captchaCode; ?></strong></div>
                    <input type="text" id="captcha" name="captcha" placeholder="Entrez ici le Captcha" required="required" class="input-md m-b-10 b-r-5"/>
					<div class="float">
								<!--<div class="float-left p-t-10 f-s-13 f-w-bold"><a href="/mdp-perdu.html">Mot de passe perdu ?</a></div>-->
						<div class="float-right">
							<button id="submit" name="submit_login" value="submit_login" class="button-blue-degrade p-10-20 b-r-5 color-white f-s-13 cursor-pointer">Je me connecte</button>
							<input type="hidden" name="captchaVerif" value="<?= $captchaCode; ?>"/>
						</div>
					</div>
				</form>
			</div>
		</div></div>
		<!-- Fin Pop Up Connexion -->
    <section class="bg-white absolute-section-1">
			<div class="m-auto content p-40-20">
				<div class="m-b-5 f-s-18 f-w-bold txt-align-left color-gold">Inscription / Connexion</div><br><br>
				<div class="m-b-20 b-b-3-gold"></div>
				
				<div class="container"><div class="row">				
					<div class="col-md-1"></div>
					<div class="col-md-5 col-xs-12"><div class="bg-light-grey b-r-10 p-20 b-special-grey">
						<form id="FormRegister" method="POST" >
							<div class="m-b-10 f-s-18 f-w-bold txt-align-left">Rejoignez-nous gratuitement<br /><br /></div>
							
							<div class="row">
								<div class="col-md-6 col-xs-12">
									<input id="votreprénomRegister" type="text" name="prenom" value="<?php echo $post_reg_prenom; ?>" required placeholder="Votre prénom" class="input-md m-b-10 b-r-5 f-s-12"/>
								</div>
								<div class="col-md-6 col-xs-12">
									<input id="votrenomRegister" type="text" name="nom" value="<?php echo $post_reg_nom; ?>" required placeholder="Votre nom" class="input-md m-b-10 b-r-5 f-s-12" />
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-xs-12">
									<input id="votreemailRegister" type="email" name="email" value="<?php echo $post_reg_email; ?>" required placeholder="Votre email" class="input-md m-b-10 b-r-5 f-s-12" />
								</div>
								<div class="col-md-6 col-xs-12">
								   <input id="votrepwdRegister" type="password" name="password" value="" required placeholder="Votre mot de passe" class="input-md m-b-10 b-r-5" />
								</div>
							</div>
							<select name="news" class="input-md m-b-10 b-r-5">
								<option value="0">Je ne m'inscris pas à la newsletter</option>
								<option value="1">Je m'inscris à la newsletter</option>
							</select>
							<div class="m-b-10 f-s-18 f-w-bold txt-align-center">Captcha => <?= $captchaCode; ?></div>
							<input type="text" id="captcha" name="captcha" placeholder="Entrez ici le Captcha" required class="input-md m-b-10 b-r-5" />
							<div class="m-b-10 f-s-18 f-w-bold txt-align-center">J'autorise Quizzdeal à conserver mes données personnelles transmises via ce formulaire. Aucune exploitation commerciale ne sera faite des données conservées.<br/><input type='checkbox' name='rgpd' value='' required style="margin-left: 0;"></div>
							<div class="txt-align-center">
								<input type="hidden" name="captchaVerif" value="<?= $captchaCode; ?>"/>
								<input type="hidden" name="idParrain" value="<?= isset($_SESSION['idParrain']) ? $_SESSION['idParrain'] : ''; ?>" />
								<button type="submit" name="submit_register" value="submit_register" class="button-blue-degrade color-white b-r-5 f-s-13 submit-md">Inscription</button>
							</div>
						</form>
					</div></div>	
					<div class="col-md-5 col-xs-12"><div class="bg-light-grey b-r-10 p-20 b-special-grey">
		
						<form method="POST" class="f-s-13 f-w-light">
						    <div class="m-b-10 f-s-18 f-w-bold txt-align-left">Connexion<br /><br /></div>
							<input type="email" id="email" name="email" value="<?= $post_reg_email; ?>" placeholder="Entrez votre adresse e-mail" class="input-md b-r-5 m-b-10 f-s-12" />
					<input type="password" id="mdp" name="mdp" value="" placeholder="Entrez votre mot de passe" class="input-md b-r-5 m-b-10 f-s-12" />
					<div class="m-b-10 f-s-18 f-w-bold txt-align-center">Captcha => <strong><?= $captchaCode; ?></strong></div>
                    <input type="text" id="captcha" name="captcha" placeholder="Entrez ici le Captcha" required="required" class="input-md m-b-10 b-r-5"/>
					<div class="txt-align-center">
								<!--<div class="float-left p-t-10 f-s-13 f-w-bold"><a href="/mdp-perdu.html">Mot de passe perdu ?</a></div>-->

							<button id="submit" name="submit_login" value="submit_login" class="button-blue-degrade color-white b-r-5 f-s-13 submit-md">Je me connecte</button>
							<input type="hidden" name="captchaVerif" value="<?= $captchaCode; ?>"/>
				
							</div>
						</form>
					</div></div>
				</div></div>
			</div>
		</section>

<?php
	include('./requiert/inc-footer.php');
?>