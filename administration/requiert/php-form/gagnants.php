<?php
	if (!empty($_POST['code'])) { $post_code = htmlspecialchars(addslashes($_POST['code'])); } else { $post_code = null; }

	if (!empty($_POST['submit_valider']))
	{
		$sonid = $_POST['submit_valider'];

		$did = $pdo->query("SELECT * FROM gagnants WHERE id = '".$sonid."'");
		$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
		$sonidm = $dones_idi['idUser'];
		$sonmontant = $dones_idi['montant'];
		$sontype = $dones_idi['type'];

		$pdo->exec("UPDATE gagnants SET etat = 'Valid&eacute;', code = '".$post_code."', dateSend = '".date('d/m/Y à H:i:s')."' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());

		$sql_infoUser = $pdo->query("SELECT * FROM users WHERE id = '".$sonidm."'");
		$donnes_infoUser = $sql_infoUser->fetch(PDO::FETCH_ASSOC);
		$infoUser_prenom = $donnes_infoUser['prenom'];
		$infoUser_email = $donnes_infoUser['email'];
		$infoUser_idParrain = $donnes_infoUser['idParrain'];
		
		if ($infoUser_idParrain != 0) {
			$montantParrain = ($sonmontant * 15) / 100;
			$pdo->exec("UPDATE users SET euros = euros + '".$montantParrain."' WHERE id = '".$infoUser_idParrain."'") or die ('Erreur : '.mysql_error());
			$pdo->exec("UPDATE users SET eurosParrain = eurosParrain + '".$montantParrain."' WHERE id = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}

			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						</head>
						<body><div style="font-family:arial;font-size:12px;">
							Bonjour '.$infoUser_prenom.',<br/><br/>
							
							Vous avez passé une commande sur '.ucfirst(nom_site).'. Celle-ci a été traitée !<br/><br/>
							
							Nous vous invitons à vous connecter à votre compte pour voir l\'état de votre commande.<br/><br/>
							
							&Agrave; bientôt sur '.ucfirst(nom_site).' !
						</div></body></html>';

			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers .= "From : ".ucfirst(nom_site)." <support@".nom_site.">\n";
			$headers .= "Reply-To: ".ucfirst(nom_site)." <support@".nom_site.">\n";
				
			mail($infoUser_email, ''.ucfirst(nom_site).' : Commande traitée', $message, $headers);

		$reponsConfirm = 'Le commande a bien été envoyée.';	
	}
	
	if (!empty($_POST['submit_refuser']))
	{
		$sonid = $_POST['submit_refuser'];

		$did = $pdo->query("SELECT * FROM gagnants WHERE id = '".$sonid."'");
		$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
		$sonidm = $dones_idi['idUser'];
						
		$pdo->exec("UPDATE gagnants SET etat = 'Refus&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		
		$reponsConfirm = 'Le commande a bien été refusée.';	
	}
	
	if (isset($reponsConfirm)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsConfirm; ?>",
				button: "Fermer",
				icon: "success",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		</script>
<?php
	}
	
	if (isset($reponsError)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsError; ?>",
				button: "Fermer",
				icon: "error",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		</script>
<?php
	}
?>