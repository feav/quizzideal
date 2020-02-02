<?php

	if (!empty($_POST['bonusInscription'])) { $bonusInscription = htmlspecialchars(addslashes($_POST['bonusInscription'])); } else { $bonusInscription = 0; }
	if (!empty($_POST['bonusAmi'])) { $bonusAmi = htmlspecialchars(addslashes($_POST['bonusAmi'])); } else { $bonusAmi = 0; }
	if (!empty($_POST['commission'])) { $commission = htmlspecialchars(addslashes($_POST['commission'])); } else { $commission = 0; }

	if (!empty($_POST['submit_update'])) {
		$sql = "UPDATE parrainage SET inscription={$bonusInscription}, ami={$bonusAmi}, commission={$commission}";
		$req = $pdo->exec($sql);
		if($req){
			$reponsConfirm = 'Modification reussi.';
		}else{
			$reponsError = "Une erreur est survenu, veillez reessayer plus tard";
		}
	}
	if (isset($reponsConfirm)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsConfirm; ?>",
				icon: "success",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
			setTimeout("window.location='<?= url_site; ?>/administration/index.php'", 1300);
		</script>
<?php
	}
	
	if (isset($reponsError)) {
?>
		<script type="text/javascript">
			swal({
				text: "<?= $reponsError; ?>",
				icon: "error",
				closeOnClickOutside: false,
				closeOnEsc: false,
			});
			setTimeout("window.location='<?= url_site; ?>/administration/index.php'", 1300);
		</script>
<?php
	}
?>