<?php
	if (!empty($_POST['nom'])) { $post_nom = htmlspecialchars(addslashes($_POST['nom'])); } else { $post_nom = null; }
	if (!empty($_POST['prenom'])) { $post_prenom = htmlspecialchars(addslashes($_POST['prenom'])); } else { $post_prenom = null; }
	if (!empty($_POST['email'])) { $post_email = htmlspecialchars(addslashes($_POST['email'])); } else { $post_email = null; }
	if (!empty($_POST['idParrain'])) { $post_idParrain = htmlspecialchars(addslashes($_POST['idParrain'])); } else { $post_idParrain = null; }
	if (!empty($_POST['adresse'])) { $post_adresse = htmlspecialchars(addslashes($_POST['adresse'])); } else { $post_adresse = null; }
	if (!empty($_POST['ville'])) { $post_ville = htmlspecialchars(addslashes($_POST['ville'])); } else { $post_ville = null; }
	if (!empty($_POST['codePostal'])) { $post_codePostal = htmlspecialchars(addslashes($_POST['codePostal'])); } else { $post_codePostal = null; }
	if (!empty($_POST['actif'])) { $post_actif = htmlspecialchars(addslashes($_POST['actif'])); } else { $post_actif = null; }
	if (!empty($_POST['premium'])) { $post_premium = htmlspecialchars(addslashes($_POST['premium'])); } else { $post_premium = null; }
	if (!empty($_POST['solde'])) { $post_solde = htmlspecialchars(addslashes($_POST['solde'])); } else { $post_solde = null; }

	if (!empty($_POST['submit_update'])) {
		$pdo->exec("UPDATE users SET nom = '".$post_nom."', prenom = '".$post_prenom."', email = '".$post_email."', idParrain = '".$post_idParrain."', adresse = '".$post_adresse."', ville = '".$post_ville."', codePostal = '".$post_codePostal."', actif = '".$post_actif."', premium = '".$post_premium."' WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Les modifications ont bien été enregistrées !';
	}
		
	if (!empty($_POST['submit_addMontant'])) {
		$pdo->exec("UPDATE users SET euros = euros + '".$post_solde."' WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'utilisateur a bien été crédité de '.$post_solde.' € !';
	}
		
	if (!empty($_POST['submit_delMontant'])) {
		$pdo->exec("UPDATE users SET euros = euros - '".$post_solde."' WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'utilisateur a bien été déduit de '.$post_solde.' € !';
	}
		
	if (!empty($_POST['submit_bannir'])) {
		$pdo->exec("UPDATE users SET banni = 1 WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'utilisateur a bien été banni !';
	}
		
	if (!empty($_POST['submit_debannir'])) {
		$pdo->exec("UPDATE users SET banni = 0 WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'utilisateur a bien été débanni !';
	}
		
	if (!empty($_POST['submit_bannir_chat'])) {
		$pdo->exec("UPDATE users SET banni_chat = 1 WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'utilisateur a bien été banni du chat !';
	}
		
	if (!empty($_POST['submit_debannir_chat'])) {
		$pdo->exec("UPDATE users SET banni_chat = 0 WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'utilisateur a bien été débanni du chat !';
	}
		
	if (!empty($_POST['submit_moderateur'])) {
		$pdo->exec("UPDATE users SET level = 9 WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'utilisateur a bien été nommé Modérateur !';
	}
		
	if (!empty($_POST['submit_stop_moderateur'])) {
		$pdo->exec("UPDATE users SET level = 1 WHERE id = '".intval($_GET['action'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'utilisateur a bien été retiré des Modérateurs !';
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