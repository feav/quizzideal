<?php
	if (!empty($_POST['idoffre'])) { $post_idoffre = code(30); } else { $post_idoffre = null; }
	if (!empty($_POST['nom'])) { $post_nom = htmlspecialchars(addslashes($_POST['nom'])); } else { $post_nom = null; }
	if (!empty($_POST['url'])) { $post_url = addslashes($_POST['url']); } else { $post_url = null; }
	if (!empty($_POST['description'])) { $post_description = htmlspecialchars(addslashes($_POST['description'])); } else { $post_description = null; }
	if (!empty($_POST['description2'])) { $post_description2 = htmlspecialchars(addslashes($_POST['description2'])); } else { $post_description2 = null; }
	if (!empty($_POST['remuneration'])) { $post_remuneration = htmlspecialchars(addslashes($_POST['remuneration'])); } else { $post_remuneration = null; }
	if (!empty($_POST['pays'])) { $post_pays = htmlspecialchars(addslashes($_POST['pays'])); } else { $post_pays = null; }
	if (!empty($_POST['valid'])) { $post_valid = htmlspecialchars(addslashes($_POST['valid'])); } else { $post_valid = null; }
	if (!empty($_POST['quota'])) { $post_quota = htmlspecialchars(addslashes($_POST['quota'])); } else { $post_quota = null; }
	if (!empty($_POST['montant'])) { $post_montant = htmlspecialchars(addslashes($_POST['montant'])); } else { $post_montant = null; }
	if (!empty($_POST['regie'])) { $post_regie = htmlspecialchars(addslashes($_POST['regie'])); } else { $post_regie = null; }
	if (!empty($_POST['annonceur'])) { $post_annonceur = htmlspecialchars(addslashes($_POST['annonceur'])); } else { $post_annonceur = null; }
	if (!empty($_POST['premium'])) { $post_premium = htmlspecialchars(addslashes($_POST['premium'])); } else { $post_premium = null; }
		
	if (!empty($_POST['submit_add'])) {
		if (!empty($_FILES["imageMission"]["name"]) ) {
			$target_dir = "../images/missions/";
			$target_file = $target_dir . basename($_FILES["imageMission"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$target_file = $target_dir . code(35) .'.'. $imageFileType;

			// Check if image file is a actual image or fake image
			
			$check = getimagesize($_FILES["imageMission"]["tmp_name"]);
			if($check !== false ) {
				$uploadOk = 1;
			} else {
				$reponsError = "File is not an image.";
				$uploadOk = 0;
			}
		
			// Check file size
			if ($_FILES["imageMission"]["size"] > 500000000 ) {
				$reponsError = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$reponsError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$reponsError = "Désolé, les documents n'ont pas été envoyés.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["imageMission"]["tmp_name"], $target_file) ) {
					$reponsConfirm = "Les documents ont bien été envoyés.";
					$post_image=$target_file;
					
				} else {
					$reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";
					$post_image=null;
				}
			}
		}
		

		$pdo->exec("INSERT INTO `offers` (`id`, `idoffre`, `nom`, `url`, `description`, `description2`, `pays`, `remuneration`, `montant`, `valid`, `actif`, `date`, `regie`, `annonceur`, `quota`, `premium`, `image`) VALUES ('', '".$post_idoffre."', '".$post_nom."', '".$post_url."', '".$post_description."', '".$post_description2."', '".$post_pays."', '".$post_remuneration."', '".$post_montant."', '".$post_valid."', '0', '".date('d/m/Y à H:i:s')."', '".$post_regie."', '".$post_annonceur."', '".$post_quota."', '".$post_premium."', '".$post_image."')");
		
		$post_idoffre = null;
		$post_nom = null;
		$post_url = null;
		$post_description = null;
		$post_description2 = null;
		$post_pays = null;
		$post_remuneration = null;
		$post_montant = null;
		$post_valid = null;
		$post_regie = null;
		$post_annonceur = null;
		$post_quota = null;
		$post_premium = null;
		$post_image = null;
		
		$reponsConfirm = 'L\'offre a bien été ajoutée.';
	}

	if (!empty($_POST['submit_upd'])) {
		$post_image=null;
		if (!empty($_FILES["imageMission"]["name"]) ) {
			$target_dir = "../images/missions/";
			$target_file = $target_dir . basename($_FILES["imageMission"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$target_file = $target_dir . code(35) .'.'. $imageFileType;

			// Check if image file is a actual image or fake image
			
			$check = getimagesize($_FILES["imageMission"]["tmp_name"]);
			if($check !== false ) {
				$uploadOk = 1;
			} else {
				$reponsError = "File is not an image.";
				$uploadOk = 0;
			}
		
			// Check file size
			if ($_FILES["imageMission"]["size"] > 500000000 ) {
				$reponsError = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$reponsError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$reponsError = "Désolé, les documents n'ont pas été envoyés.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["imageMission"]["tmp_name"], $target_file) ) {
					$reponsConfirm = "Les documents ont bien été envoyés.";
					$post_image=$target_file;
					
				} else {
					$reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";
					$post_image=null;
				}
			}
		}
		$sql = "UPDATE offers SET nom = '".$post_nom."', url = '".$post_url."', description = '".$post_description."', description2 = '".$post_description2."', pays = '".$post_pays."', remuneration = '".$post_remuneration."', montant = '".$post_montant."', valid = '".$post_valid."', date = '".date('d/m/Y à H:i:s')."', regie = '".$post_regie."', annonceur = '".$post_annonceur."', quota = '".$post_quota."', premium = '".$post_premium."'".($post_image != null ? ",image='".$post_image."'":"")." WHERE id = '".intval($_GET['id'])."'";

		$pdo->exec($sql) or die ('Erreur : '.mysql_error());
		
		$reponsConfirm = 'L\'offre a bien été modifiée.';
	}
	
	if (!empty($_POST['active'])) {
		$pdo->exec("UPDATE offers SET actif = 1 WHERE id = '".intval($_POST['active'])."'") or die ('Erreur : '.mysql_error());

		$reponsConfirm = 'L\'offre a bien été activée.';
	}
	
	if (!empty($_POST['desactive'])) {
		$pdo->exec("UPDATE offers SET actif = 0 WHERE id = '".intval($_POST['desactive'])."'") or die ('Erreur : '.mysql_error());

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