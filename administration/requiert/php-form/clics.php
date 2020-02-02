<?php
	if (!empty($_POST['idoffre'])) { $post_idoffre = code(30); } else { $post_idoffre = null; }
	if (!empty($_POST['nom'])) { $post_nom = htmlspecialchars(addslashes($_POST['nom'])); } else { $post_nom = null; }
	if (!empty($_POST['url'])) { $post_url = addslashes($_POST['url']); } else { $post_url = null; }
	if (!empty($_POST['remuneration'])) { $post_remuneration = htmlspecialchars(addslashes($_POST['remuneration'])); } else { $post_remuneration = null; }
	if (!empty($_POST['pays'])) { $post_pays = htmlspecialchars(addslashes($_POST['pays'])); } else { $post_pays = null; }
		
	if (!empty($_POST['submit_add'])) {
		$pdo->exec("INSERT INTO `offers_clics` (`id`, `idoffre`, `nom`, `url`, `pays`, `remuneration`, `actif`, `date`) VALUES ('', '".$post_idoffre."', '".$post_nom."', '".$post_url."', '".$post_pays."', '".$post_remuneration."', '0', '".date('d/m/Y à H:i:s')."')");
		
		$post_idoffre = null;
		$post_nom = null;
		$post_url = null;
		$post_remuneration = null;
		$post_pays = null;
		
		$reponsConfirm = 'L\'offre a bien été ajoutée.';
	}

	if (!empty($_POST['submit_upd'])) {
		$pdo->exec("UPDATE offers_clics SET nom = '".$post_nom."', url = '".$post_url."', pays = '".$post_pays."', remuneration = '".$post_remuneration."', date = '".date('d/m/Y à H:i:s')."' WHERE id = '".intval($_GET['id'])."'") or die ('Erreur : '.mysql_error());
		
		$reponsConfirm = 'L\'offre a bien été modifiée.';
	}
	
	if (!empty($_POST['active'])) {
		$pdo->exec("UPDATE offers_clics SET actif = 1 WHERE id = '".intval($_POST['active'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'offre a bien été activée.';
	}
	
	if (!empty($_POST['desactive'])) {
		$pdo->exec("UPDATE offers_clics SET actif = 0 WHERE id = '".intval($_POST['desactive'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'offre a bien été mise en pause.';
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