<?php
	ini_set('display_errors', 1);

	if (!empty($_POST['submit_tombola']))
	{
		if (intval($_POST['nombreTickets']) > 0)
		{
			if ($mbreTicketTombola > 0 && $mbreTicketTombola >= intval($_POST['nombreTickets']))
			{
				$pdo->exec("UPDATE users SET ticketTombola = ticketTombola - '".intval($_POST['nombreTickets'])."' WHERE id = '".$mbreId."'");

				for($i=1; $i<=intval($_POST['nombreTickets']); $i++)
				{
					$pdo->exec("INSERT INTO `tombolasParticipation` (`id`, `idUser`, `idTombola`) VALUES ('', '".$mbreId."', '".intval($_POST['submit_tombola'])."')");
				}

				$reponsConfirm = 'Votre participation a bien été prise en compte.';
				
				$mbreTicketTombola = $mbreTicketTombola - intval($_POST['nombreTickets']);
			}
			else
			{
				$reponsError = 'Oups, vous n\'avez pas assez de Tickets pour participer.';
			}
		}
		else
		{
			$reponsError = 'Oups, vous n\'avez pas assez de Tickets pour participer.';
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