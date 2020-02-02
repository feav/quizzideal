<?php
	if (!empty($_POST['name'])) { $post_name = htmlspecialchars(addslashes($_POST['name'])); } else { $post_name = null; }
		
	if (!empty($_POST['submit_add'])) {
		$pdo->exec("INSERT INTO `bonusLogin` (`id`, `name`) VALUES ('', '".$post_name."')");
		
		$post_name = null;
		
		$reponsConfirm = 'Le cadeau a bien été ajouté.';
	}

	if (!empty($_POST['submit_del'])) {
		$post_deleteCadeau = $_POST['submit_del'];
		$pdo->exec("DELETE FROM `bonusLogin` WHERE id = '".$post_deleteCadeau."'") or die ('Erreur : '.mysql_error());
		
		$reponsConfirm = 'Le cadeau a bien été supprimé.';
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