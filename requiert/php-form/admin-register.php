<?php
	// Début : Connexion
	if (!empty($_POST['email'])): $post_log_email = addslashes(htmlentities($_POST['email'])); else: $post_log_email = null; endif;
	if (!empty($_POST['mdp'])): $post_log_mdp = addslashes(htmlentities($_POST['mdp'])); else: $post_log_mdp = null; endif;
	if (!empty($_POST['captcha'])): $post_log_captcha = addslashes(htmlentities($_POST['captcha'])); else: $post_log_captcha = null; endif;

	if (!empty($_POST["submit_login"])) {
		if (empty($_POST['email']) OR empty($_POST['mdp']) OR empty($_POST['captcha'])) {
			$reponsError = 'Vous devez remplir tous les champs.';
			$button = '"Fermer"';
		}
		else {
			if (isset($_SESSION['adminid'])) {
				$reponsConfirm = 'Désolé mais vous êtes déjà connecté.';
				$button = '"Fermer"';
                                $redirectionLogin = 'administration/index.php';
			}
			else {
				$req = $pdo->prepare('SELECT id, email, mdp, actif, banni, datelastco, level FROM users WHERE email=:email AND level >= 99');
				$req->bindValue(":email", $_POST['email']);
				$req->execute();

				$result_req = $req->fetch(PDO::FETCH_OBJ);

				if (empty($result_req)) {
					$reponsError = 'Les identifiants entrés ne sont pas correct ou vous n\'avez pas accès à l\'admin.';
					$button = '"Fermer"';
				}
				else {
					if ($result_req->actif == 1) {
						if ($result_req->banni == 0) {
							if ($result_req->mdp == sha1(md5($_POST['mdp']))) {
								if ($_POST['captcha'] == $_POST['captchaVerif']) {
									$_SESSION['adminid'] = $result_req->id;
									$_SESSION['email'] = $result_req->email;

									$reponsConfirm = 'Connexion en cours, veuillez patienter...';
									$button = 'false'; 
                                                                        $redirectionLogin = 'administration/index.php';
									$post_log_email = null;
									
								}
								else {
									$reponsError = 'Le Captcha entré est incorrect.';
									$button = '"Fermer"';
								}	
							}
							else {
								$reponsError = 'Les identifiants entrés ne sont pas correct.';
								$button = '"Fermer"';
							}
						}
						else {
							$reponsBanni = 'Oups, il semble que vous avez été banni ! Redirection en cours...';
							$button = 'false'; $redirectionLogin = url_site; $post_log_email = null;
						}
					}
					else {
						$reponsError = 'Votre compte est inactif. Veuillez vérifier vos e-mails et confirmer votre inscription. (Contactez-nous si vous ne trouvez pas cet e-mail)';
						$button = '"Fermer"';
					}
				}
			}
		}
	}
	// Fin : Connexion

	if (isset($reponsConfirm)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsConfirm; ?>",
				button: <?= $button; ?>,
				icon: "success",
				closeOnClickOutside: false,
				closeOnEsc: false,
			})<?php if (isset($redirectionLogin)){ ?>,
			setTimeout("window.location='<?= $redirectionLogin; ?>'",3000);<?php } ?>
		</script>
<?php
	}
	
	if (isset($reponsBanni)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsBanni; ?>",
				button: <?= $button; ?>,
				icon: "warning",
				closeOnClickOutside: false,
				closeOnEsc: false,
			})<?php if (isset($redirectionLogin)){ ?>,
			setTimeout("window.location='<?= $redirectionLogin; ?>'",3000);<?php } ?>
		</script>
<?php
	}
	
	if (isset($reponsError)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsError; ?>",
				button: <?= $button; ?>,
				icon: "error",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		</script>
<?php
	}
?>