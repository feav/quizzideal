<?php
	// Début : Inscription
	if (!empty($_POST['email'])): $post_email = ucfirst(addslashes(htmlentities($_POST['email']))); else: $post_email = null; endif;
	if (!empty($_POST['sujet'])): $post_sujet = ucfirst($_POST['sujet']); else: $post_sujet = null; endif;
	if (!empty($_POST['message'])): $post_message = strtolower(addslashes(htmlentities($_POST['message']))); else: $post_message = null; endif;
	
	if (!empty($_POST["submit_send"])) {
		if (!empty($_POST["email"]) && !empty($_POST["sujet"]) && !empty($_POST["message"])) {
			if (preg_match("!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!", $post_email)) {

					$reponsConfirm = 'Votre message nous a bien été envoyé. Nous vous répondrons dans les 24H maximum.';
					$button = '"Fermer"';

					$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						</head>
						<body><div style="font-family:arial;font-size:12px;">
							'.nl2br(stripslashes($post_message)).'
						</div></body></html>';

					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
					$headers .= "From : ".$post_email." <".$post_email.">\n";
					$headers .= "Reply-To: ".$post_email." <".$post_email.">\n";
				
					mail('support@quizzdeal.fr', ''.utf8_encode(nom_site).' : '.$post_sujet.'', $message, $headers);
									
					$post_email = null;
					$post_sujet = null;
					$post_message = null;
			}
			else {
				$reponsError = 'L\'adresse e-mail entrée est incorrecte.';
				$button = '"Fermer"';
			}
		}
		else {
			$reponsError = 'Tout les champs sont requis pour votre inscription.';
			$button = '"Fermer"';
		}
	}
	// Fin : Inscription

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