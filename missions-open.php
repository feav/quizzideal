<?php
	include('./requiert/php-global.php');

	$off_id = htmlspecialchars(addslashes($_POST['off_id']));

		$sql = $pdo->query("SELECT * FROM offers WHERE idoffre = '".$off_id."'");
		$resultat = $sql->fetch(PDO::FETCH_ASSOC);
		$description2 = addslashes(htmlentities($resultat['description2']));
?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Quizzdeal.fr : Les missions</title>
		<meta name="description" content="">
		<meta name="keywords" content="" />
		<!-- CSS -->
        <link type="text/css" rel="stylesheet" href="css/style.20180508.css" />
        <!-- Javascript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
	<body>﻿
	
		<script>
			swal({
				title: "Que dois-tu faire exactement ?",
				text: "<?= $description2; ?>",
				icon: "info",
				buttons: {
					cancel: "Fermer",
					defeat: "Ouvrir",
				},
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					swal("Vous pouvez fermer cette fenêtre !", {
						title: "Redirection effectuée...",
						icon: "success",
						buttons: false
					});
					window.open('./redirect.html?off_id=<?= $off_id; ?>', '_blank');
				}
			});
	
		</script>
		
	</body>
</html>