<?php
	if (!empty($_POST['name'])) { $post_name = htmlspecialchars(addslashes($_POST['name'])); } else { $post_name = null; }
	if (!empty($_POST['image'])) { $post_image = htmlspecialchars(addslashes($_POST['image'])); } else { $post_image = null; }
	if (!empty($_POST['description'])) { $post_description = htmlspecialchars(addslashes($_POST['description'])); } else { $post_description = null; }
	if (!empty($_POST['date'])) { $post_date = htmlspecialchars(addslashes($_POST['date'])); } else { $post_date = null; }
		
	if (!empty($_POST['submit_add'])) {
		$pdo->exec("INSERT INTO `tombolas` (`id`, `name`, `image`, `description`, `dateFin`) VALUES ('', '".$post_name."', '".$post_image."', '".$post_description."', '".$post_date."')");
		
		$post_name = null;
		$post_image = null;
		$post_description = null;
		$post_date = null;
		
		$reponsConfirm = 'Le cadeau tombola a bien été ajouté.';
	}

	if (!empty($_POST['submit_upd'])) {
		$pdo->exec("UPDATE tombolas SET name = '".$post_name."', image = '".$post_image."', description = '".$post_description."', dateFin = '".$post_date."' WHERE id = '".intval($_GET['id'])."'");

		$reponsConfirm = 'Le cadeau tombola a bien été modifié.';
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