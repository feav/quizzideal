<?php
	// Début : Inscription
	if (!empty($_POST['email'])): $post_email = addslashes(htmlentities($_POST['email'])); else: $post_email = null; endif;
	if (!empty($_POST['message'])): $post_message = addslashes(htmlentities($_POST['message'])); else: $post_message = null; endif;
	
	if (!empty($_POST["submit_send"])) {
		if (!empty($_POST["email"]) && !empty($_POST["message"])) {
			if (preg_match("!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!", $post_email)) {

                            $pdo->exec("INSERT INTO `livredor` (`id`, `email`, `message`, `date`, `statut`) VALUES ('', '".$post_email."', '".$post_message."', NOW(), 0)");
                            
                            $reponsConfirm = 'Votre message nous a bien été envoyé. Il sera soumis à validation avant d\'être publié.';
                            $button = '"Fermer"';

                            $post_email = null;
                            $post_message = null;
			}
			else {
				$reponsError = 'L\'adresse e-mail entrée est incorrecte.';
				$button = '"Fermer"';
			}
		}
		else {
			$reponsError = 'Tout les champs sont requis pour envoyer votre message.';
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