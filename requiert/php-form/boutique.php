<?php
	if (!empty($_POST['commander'])) {
	    //var_dump($_POST['idBoutique'], $mbreIdentVerif);
		if (!empty($_POST['idBoutique']) && $mbreIdentVerif == 1) {
		    //var_dump($_POST['idBoutiqueMontant'], !empty($_POST['idBoutiqueMontant']));
			if (!empty($_POST['idBoutiqueMontant'])) {
				
				$idBoutique = htmlentities($_POST['idBoutique']);
				$idBoutiqueMontant = htmlentities($_POST['idBoutiqueMontant']);
				if ($mbreEuros >= 0.00 && $mbreEuros >= $idBoutiqueMontant) {
					
					$sqlBoutique = $pdo->query("SELECT * FROM boutique WHERE id = '".$idBoutique."'");
					$resultatBoutique = $sqlBoutique->fetch(PDO::FETCH_ASSOC);
					$categorieIdBoutique = addslashes(htmlentities($resultatBoutique['categorieId']));
					$nomBoutique = addslashes(htmlentities($resultatBoutique['nom']));
					$actifBoutique = addslashes(htmlentities($resultatBoutique['actif']));
					
					if ($actifBoutique == 1) {
						$sqlCatBoutique = $pdo->query("SELECT * FROM boutiqueCategorie WHERE id = '".$categorieIdBoutique."'");
						$resultatCatBoutique = $sqlCatBoutique->fetch(PDO::FETCH_ASSOC);
						$nomCatBoutique = addslashes(htmlentities($resultatCatBoutique['nom']));
					
						$reponsConfirm = 'La commande a bien été prise en compte.'; $button = 'false';
						$redirectionLogin = url_site.'/boutique.html'; 
						
						$pdo->exec("INSERT INTO `gagnants` (`id`, `idUser`, `montant`, `type`, `categorie`, `date`, `ip`) VALUES ('', '".$mbreId."', '".$idBoutiqueMontant."', '".$nomBoutique."', '".$nomCatBoutique."', '".date('d/m/Y à H:i:s')."', '".ip."')");
						$pdo->exec("UPDATE users SET euros = euros - '".$idBoutiqueMontant."' WHERE id = '".$mbreId."'") or die ('Erreur : '.mysql_error());
					}
					else { $reponsError = 'Ce cadeau est indisponible.'; $button = 'Fermer'; }
				}
				else { $reponsError = 'Votre solde est inférieur au montant du cadeau demandé.'; $button = 'Fermer'; }
			}
			else { $reponsError = 'Oups, une erreur c\'est produite.'; $button = 'Fermer'; }
		}
		else { $reponsError = 'Oups, une erreur c\'est produite.'; $button = 'Fermer'; }
	}

	if (isset($reponsConfirm)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsConfirm; ?>",
				button: <?= $button; ?>,
				icon: "success",
				closeOnClickOutside: false,
				closeOnEsc: false,
			})<?php if (isset($redirectionLogin)){ ?>,
			setTimeout("window.location='<?= $redirectionLogin; ?>'",3000);<?php } ?>
		</script>
<?php
	}
	
	if (isset($reponsError)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsError; ?>",
				button: <?= $button; ?>,
				icon: "error",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
		</script>
<?php
	}
?>