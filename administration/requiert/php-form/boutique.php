<?php
	if (!empty($_POST['nomCategorie'])) { $post_nomCategorie = htmlspecialchars(addslashes($_POST['nomCategorie'])); } else { $post_nomCategorie = null; }
	if (!empty($_POST['nomCadeau'])) { $post_nomCadeau = htmlspecialchars(addslashes($_POST['nomCadeau'])); } else { $post_nomCadeau = null; }
	if (!empty($_POST['imageCadeau'])) { $post_imageCadeau = htmlspecialchars(addslashes($_POST['imageCadeau'])); } else { $post_imageCadeau = null; }
	if (!empty($_POST['montantCadeau'])) { $post_montantCadeau = htmlspecialchars(addslashes($_POST['montantCadeau'])); } else { $post_montantCadeau = null; }
		
	if (!empty($_POST['submit_addCategorie'])) {
		$pdo->exec("INSERT INTO `boutiqueCategorie` (`id`, `nom`) VALUES ('', '".$post_nomCategorie."')");
		
		$post_nomCategorie = null;
		
		$reponsConfirm = 'La catégorie a bien été ajoutée.';
	}
	
	if (!empty($_POST['deleteCategorie'])) {
		$post_deleteCategorie = $_POST['deleteCategorie'];
		$pdo->exec("DELETE FROM `boutiqueCategorie` WHERE id = '".$post_deleteCategorie."'") or die ('Erreur : '.mysql_error());
		
		$reponsConfirm = 'La catégorie a bien été supprimée.';
	}
	
	if (!empty($_POST['submit_addCadeau'])) {
		$pdo->exec("INSERT INTO `boutique` (`id`, `categorieId`, `nom`, `image`, `actif`) VALUES ('', '".intval($_GET['idCat'])."', '".$post_nomCadeau."', '".$post_imageCadeau."', '1')");
		
		$post_nomCadeau = null;
		$post_imageCadeau = null;
		
		$reponsConfirm = 'Le cadeau a bien été ajouté.';
	}

	if (!empty($_POST['deleteCadeau'])) {
		$post_deleteCadeau = $_POST['deleteCadeau'];
		$pdo->exec("DELETE FROM `boutique` WHERE id = '".$post_deleteCadeau."'") or die ('Erreur : '.mysql_error());
		
		$reponsConfirm = 'Le cadeau a bien été supprimé.';
	}

	if (!empty($_POST['submit_addMontant'])) {
		$pdo->exec("INSERT INTO `boutiqueMontant` (`id`, `boutiqueId`, `montant`) VALUES ('', '".intval($_GET['idBoutique'])."', '".$post_montantCadeau."')");
		
		$post_montantCadeau = null;
		
		$reponsConfirm = 'Le montant a bien été ajouté.';
	}
	
	if (!empty($_POST['deleteMontant'])) {
		$post_deleteMontant = $_POST['deleteMontant'];
		$pdo->exec("DELETE FROM `boutiqueMontant` WHERE id = '".$post_deleteMontant."'") or die ('Erreur : '.mysql_error());
		
		$reponsConfirm = 'Le montant a bien été supprimé.';
	}
	
	if (!empty($_POST['submit_updBoutique'])) {
		$pdo->exec("UPDATE boutique SET nom = '".$post_nomCadeau."', image = '".$post_imageCadeau."' WHERE id = '".intval($_GET['idBoutique'])."'");
		
		$reponsConfirm = 'Le cadeau a bien été modifié.';
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