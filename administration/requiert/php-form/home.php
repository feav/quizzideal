<?php		
	if (!empty($_POST['generer'])) {
		$pdo->exec("UPDATE users SET code_verif = '".number(10)."' WHERE id = '".intval($_POST['generer'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Un code a bien été généré.';
	}
	
	if (!empty($_POST['send'])) {
		$pdo->exec("UPDATE users SET code_verif_date = '".date('Y-m-d')."' WHERE id = '".intval($_POST['send'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Le courrier a bien été envoyé.';
	}
	
	if (!empty($_POST['ident_valider'])) {
		$pdo->exec("UPDATE users SET ident_verif = 1 WHERE id = '".intval($_POST['ident_valider'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Les documents ont bien été validés.';
	}
	
	if (!empty($_POST['ident_refuser'])) {
		$pdo->exec("UPDATE users SET ident_recto = '', ident_verso = '' WHERE id = '".intval($_POST['ident_refuser'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Les documents ont bien été refusés.';
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