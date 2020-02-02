<?php
	if (!empty($_POST['contenu'])) { $post_contenu = htmlspecialchars(addslashes($_POST['contenu'])); } else { $post_contenu = null; }

	if (!empty($_POST['submit_upd'])) {
		$pdo->exec("UPDATE pages SET contenu = '".$post_contenu."' WHERE id = '".intval($_GET['id'])."'");

		$reponsConfirm = 'La page a bien été modifiée.';
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