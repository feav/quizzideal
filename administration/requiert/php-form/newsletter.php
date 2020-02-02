<?php
	if (!empty($_POST['submit_newsletter'])) {
		if (isset($_POST['sujet']) AND isset($_POST['message'])) {
			$sujet = $_POST['sujet'];
			
			if ($_POST['type'] == 'Texte') {
					$message = nl2br($_POST['message']);
				} else {
						$message = $_POST['message'];
					}
					
			$message = str_replace("\'", "'", $message);
				
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers .= "From: Newsletter Quizzdeal.fr <newsletter@quizzdeal.fr>\n";
			$headers .= "Reply-To: No Reply <noreply@quizzdeal.fr>\n";

			$liste = $pdo->query("SELECT email FROM users WHERE actif = 1 AND banni = 0 AND news = 1");
			$all_liste = $liste->fetchAll(PDO::FETCH_ASSOC);
			foreach ($all_liste as $donnees)
			{
				$messageM = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<style type="text/css" media="screen">
			body { margin: 0; margin: 10px; color : #444; padding: 0; font-size: 13px; font-family: helvetica, arial, sans-serif; background-color: #f5f5f5; }
			a { color : #444; text-decoration : none; }
			a:hover { text-decoration : underline; }
		</style>
	</head>
	
	<body>
		<div style="font-size : 12px;">
			'.$message.'
		</div>
	</body>
</html>';
						
				$Demail = $donnees['email'];

				mail($Demail, 'Test', $messageM, $headers);
			}
		}
		
		$reponsConfirm = 'La Newsletter a bien été envoyée.';
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