<?php
	if (!empty($_POST['description'])) { $post_description = htmlspecialchars(addslashes($_POST['description'])); } else { $post_description = null; }
	if (!empty($_POST['dateDebut'])) { $post_dateDebut = htmlspecialchars(addslashes($_POST['dateDebut'])); } else { $post_dateDebut = null; }
	if (!empty($_POST['dateFin'])) { $post_dateFin = htmlspecialchars(addslashes($_POST['dateFin'])); } else { $post_dateFin = null; }
	if (!empty($_POST['gagnant1'])) { $post_gagnant1 = htmlspecialchars(addslashes($_POST['gagnant1'])); } else { $post_gagnant1 = null; }
	if (!empty($_POST['gagnant2'])) { $post_gagnant2 = htmlspecialchars(addslashes($_POST['gagnant2'])); } else { $post_gagnant2 = null; }
	if (!empty($_POST['gagnant3'])) { $post_gagnant3 = htmlspecialchars(addslashes($_POST['gagnant3'])); } else { $post_gagnant3 = null; }
	if (!empty($_POST['gagnant4'])) { $post_gagnant4 = htmlspecialchars(addslashes($_POST['gagnant4'])); } else { $post_gagnant4 = null; }
	if (!empty($_POST['gagnant5'])) { $post_gagnant5 = htmlspecialchars(addslashes($_POST['gagnant5'])); } else { $post_gagnant5 = null; }

	if (!empty($_POST['submit_upd'])) {
		$pdo->exec("UPDATE concours SET description = '".$post_description."', dateDebut = '".$post_dateDebut."', dateFin = '".$post_dateFin."', gagnant1 = '".$post_gagnant1."', gagnant2 = '".$post_gagnant2."', gagnant3 = '".$post_gagnant3."', gagnant4 = '".$post_gagnant4."', gagnant5 = '".$post_gagnant5."' WHERE id = '".intval($_GET['id'])."'");

		$reponsConfirm = 'Les informations du concours ont bien été modifiées.';
	}
	
	if (!empty($_POST['active'])) {
		$pdo->exec("UPDATE concours SET actif = 1 WHERE id = '".intval($_POST['active'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Le concours a bien été activé.';
	}
	
	if (!empty($_POST['desactive'])) {
		$pdo->exec("UPDATE concours SET actif = 0 WHERE id = '".intval($_POST['desactive'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'Le concours a bien été mis en pause.';
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