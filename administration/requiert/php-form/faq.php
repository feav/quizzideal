<?php
	if (!empty($_POST['question'])) { $post_question = htmlspecialchars(addslashes($_POST['question'])); } else { $post_question = null; }
	if (!empty($_POST['reponse'])) { $post_reponse = htmlspecialchars(addslashes($_POST['reponse'])); } else { $post_reponse = null; }
		
	if (!empty($_POST['submit_add'])) {
		$pdo->exec("INSERT INTO `faq` (`id`, `question`, `reponse`) VALUES ('', '".$post_question."', '".$post_reponse."')");
		
		$post_question = null;
		$post_reponse = null;
		
		$reponsConfirm = 'La Q/R a bien été ajoutée.';
	}

	if (!empty($_POST['submit_upd'])) {
		$pdo->exec("UPDATE faq SET question = '".$post_question."', reponse = '".$post_reponse."' WHERE id = '".intval($_GET['id'])."'");

		$reponsConfirm = 'La Q/R a bien été modifiée.';
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