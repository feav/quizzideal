<?php
	ini_set('display_errors', 1);

	if (!empty($_POST['nom'])) { $post_nom = htmlspecialchars(addslashes($_POST['nom'])); } else { $post_nom = null; }
	if (!empty($_POST['prenom'])) { $post_prenom = htmlspecialchars(addslashes($_POST['prenom'])); } else { $post_prenom = null; }
	if (!empty($_POST['email'])) { $post_email = htmlspecialchars(addslashes($_POST['email'])); } else { $post_email = null; }
	if (!empty($_POST['adresse'])) { $post_adresse = htmlspecialchars(addslashes($_POST['adresse'])); } else { $post_adresse = null; }
	if (!empty($_POST['ville'])) { $post_ville = htmlspecialchars(addslashes($_POST['ville'])); } else { $post_ville = null; }
	if (!empty($_POST['codePostal'])) { $post_codePostal = htmlspecialchars(addslashes($_POST['codePostal'])); } else { $post_codePostal = null; }
	if (!empty($_POST['news'])) { $post_newsletter = htmlspecialchars(addslashes($_POST['news'])); } else { $post_newsletter = null; }
    if (!empty($_POST['parrain'])) { $post_parrain = (int) filter_var($_POST['parrain'], FILTER_SANITIZE_NUMBER_INT); } else { $post_parrain = null; }
	if (!empty($_POST['iban'])) { $post_iban = htmlspecialchars(addslashes($_POST['iban'])); } else { $post_iban = null; }
	if (!empty($_POST['swift'])) { $post_swift = htmlspecialchars(addslashes($_POST['swift'])); } else { $post_swift = null; }
	if (!empty($_POST['paypal'])) { $post_paypal = htmlspecialchars(addslashes($_POST['paypal'])); } else { $post_paypal = null; }
	if (!empty($_POST['skrill'])) { $post_skrill = htmlspecialchars(addslashes($_POST['skrill'])); } else { $post_skrill = null; }

	if (!empty($_POST['code_verif'])) { $post_code_verif = htmlspecialchars(addslashes($_POST['code_verif'])); } else { $post_code_verif = null; }

	if (!empty($_POST['valid_ident']) && !empty($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload2"]["name"])) {
		$target_dir = "images/identites/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

		$target_file = $target_dir . code(35) .'.'. $imageFileType;
		$target_file2 = $target_dir . code(35) .'.'. $imageFileType2;

		// Check if image file is a actual image or fake image
		if (isset($_POST["valid_ident"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			$check2 = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
		    if($check !== false && $check2 !== false) {
		        $uploadOk = 1;
		    } else {
		        $reponsError = "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000000 && $_FILES["fileToUpload2"]["size"] > 500000000) {
		    $reponsError = "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg" && $imageFileType2 != "gif") {
		    $reponsError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $reponsError = "Désolé, les documents n'ont pas été envoyés.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)) {
		        $reponsConfirm = "Les documents ont bien été envoyés.";
		        $pdo->exec("UPDATE users SET ident_recto = '".$target_file."', ident_verso = '".$target_file2."' WHERE id = '".$mbreId."'");
		        
		        $mbreIdentRecto = $target_file;
		        $mbreIdentVerso = $target_file2;
		    } else {
		        $reponsError = "Désolé, une erreur c'est produite. Veuillez réessayer.";
		    }
		}
	}

	if (!empty($_POST['submit_update'])) {
		$pdo->exec("UPDATE users SET nom = '".$post_nom."', prenom = '".$post_prenom."', email = '".$post_email."', adresse = '".$post_adresse."', ville = '".$post_ville."', codePostal = '".$post_codePostal."', iban = '".$post_iban."', swift = '".$post_swift."', paypal = '".$post_paypal."', skrill = '".$post_skrill."', idParrain = '".$post_parrain."', news = '".$post_newsletter."' WHERE id = '".$mbreId."'");
		
		$mbreNom = $post_nom;
		$mbrePrenom = $post_prenom;
		$mbreEmail = $post_email;
		$mbreAdresse = $post_adresse;
		$mbreVille = $post_ville;
		$mbreCodePostal = $post_codePostal;
		$mbreIban = $post_iban;
		$mbreSwift = $post_swift;
		$mbrePaypal = $post_paypal;
		$mbreSkrill = $post_skrill;
		$mbreParrain = $post_parrain;
		
		if ($post_parrain == 0 or $post_parrain == null) { $mbreParrain = 'Aucun'; } else {
			$sqlParrain = $pdo->query("SELECT * FROM users WHERE id = '".$post_parrain."'");
			$resultatParrain = $sqlParrain->fetch(PDO::FETCH_ASSOC);
			$parrainNom = addslashes(htmlentities($resultatParrain['nom']));
			$parrainPrenom = addslashes(htmlentities($resultatParrain['prenom']));
			$mbreParrain = $parrainPrenom.' '.substr($parrainNom, 0, 1).'.';
		}
		
		$mbreNewsletter = $post_newsletter;

		$reponsConfirm = 'Votre profil a bien été modifié.';
	}

	if (!empty($_POST['valid_profil'])) {
		if ($mbreCodeVerif == $post_code_verif) {
			$pdo->exec("UPDATE users SET code_verif = 1 WHERE id = '".$mbreId."'");
			
			$reponsConfirm = 'Votre profil a bien été vérifié.';
			$mbreCodeVerif = 1;
		} else {
			$reponsError = 'Oups, le code est incorrect.';
		}
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