<?php
	include('./requiert/new-form/header.php');

if(isset($_SESSION['id'])){
    header("Location: accueil.php");
    exit();
}


$meta_title = 'Quizzdeal.fr : Connexion';
	$meta_description = '';

	include('./requiert/php-form/login-register.php');
	
	$captchaCode = code(5);


?>
<style type="text/css">
	@media(min-width: 768px){
		.wrapper-register{
			border-right: 1px solid #dad8d8;
		}		
	}
	.title-connexion{
		font-size: 20px;
	    text-align: center;
	    margin-bottom: 22px;
	}

</style>
<section class="bg-white absolute-section-1">
	<div class="m-auto content p-40-20">
		<h1 class="title-page">Inscription / Connexion</h1>
		
		<div class="container" style="margin-top: 40px;">
			<div class="row">				
			<div class="col-md-1"></div>
			<div class="col-md-5 col-xs-12 wrapper-register"><div class="bg-light-grey b-r-10 p-20 b-special-grey">
				<form id="FormRegister" method="POST" >
					<h3 class="m-b-10 f-s-18 f-w-bold txt-align-left title-connexion">Rejoignez-nous gratuitement</h3>
					
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
						<input type="submit"  name="submit_register" value="Inscription" class="button-blue-degrade color-white b-r-5 f-s-13 submit-md">
					</div>
				</form>
			</div></div>	
			<div class="col-md-5 col-xs-12"><div class="bg-light-grey b-r-10 p-20 b-special-grey">

				<form method="POST" class="f-s-13 f-w-light">
				    <h3 class="m-b-10 f-s-18 f-w-bold txt-align-left title-connexion">Connexion</h3>
					<input type="email" id="email" name="email" value="<?= $post_reg_email; ?>" placeholder="Entrez votre adresse e-mail" class="input-md b-r-5 m-b-10 f-s-12" />
					<input type="password" id="mdp" name="mdp" value="" placeholder="Entrez votre mot de passe" class="input-md b-r-5 m-b-10 f-s-12" />
					<div class="m-b-10 f-s-18 f-w-bold txt-align-center">Captcha => <strong><?= $captchaCode; ?></strong></div>
		            <input type="text" id="captcha" name="captcha" placeholder="Entrez ici le Captcha" required="required" class="input-md m-b-10 b-r-5"/>
					<div class="txt-align-center">
						<input type="submit" id="submit" name="submit_login" value="Je me connecte" class="button-blue-degrade color-white b-r-5 f-s-13 submit-md">
						<input type="hidden" name="captchaVerif" value="<?= $captchaCode; ?>"/>
					</div>
				</form>
			</div></div>
		</div></div>
	</div>
</section>

<?php
	include('./requiert/new-form/footer.php');
?>