<?php
	if (!empty($_POST['submit_prevalidation_valider']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM histo_offers WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
			$saremuneration = $dones_idi['remuneration'];

			$pdo->exec("UPDATE histo_offers SET etat = 'En attente' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
					
		$reponsConfirm = 'Offres bien pré-validées.';	
	}

	if (!empty($_POST['submit_prevalidationCashback_valider']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM histo_cashback WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
			// $saremuneration = $dones_idi['remuneration'];

			$pdo->exec("UPDATE histo_cashback SET etat = 'Valid&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
					
		$reponsConfirm = 'Cashback bien pré-validées.';	
	}

	if (!empty($_POST['submit_prevalidation_refuser']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM histo_offers WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
						
			$pdo->exec("UPDATE histo_offers SET etat = 'Refus&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
					
		$reponsConfirm = 'Offres bien refusées.';
	}

if (!empty($_POST['submit_prevalidationCashback_refuser']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM histo_cashback WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
						
			$pdo->exec("UPDATE histo_cashback SET etat = 'Refus&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
					
		$reponsConfirm = 'Cashback bien refusées.';
	}
	
	if (!empty($_POST['submit_validation_valider']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM histo_offers WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
			$saremuneration = $dones_idi['remuneration'];

			$pdo->exec("UPDATE users SET euros = euros + '".$saremuneration."', euros_histo = euros_histo + '".$saremuneration."', barrePrcnt = barrePrcnt + '0.05', ticketTombola = ticketTombola + 1 WHERE hashId = '".$sonidm."'") or die ('Erreur : '.mysql_error());
			$pdo->exec("UPDATE histo_offers SET etat = 'Valid&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
					
		$reponsConfirm = 'Offres bien validées.';	
	}
	
	if (!empty($_POST['submit_validation_refuser']))
	{
		$sonids = $_POST['id'];
		foreach ($sonids as $sonid)
		{
			$did = $pdo->query("SELECT * FROM histo_offers WHERE id = '".$sonid."'");
			$dones_idi = $did->fetch(PDO::FETCH_ASSOC);
			$sonidm = $dones_idi['idUser'];
						
			$pdo->exec("UPDATE histo_offers SET etat = 'Refus&eacute;' WHERE id = '".$sonid."' AND idUser = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
					
		$reponsConfirm = 'Offres bien refusées.';
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