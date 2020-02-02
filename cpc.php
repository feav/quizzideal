<?php
	include('./requiert/php-global.php');

	$off_id = htmlentities($_POST['off_id']);
	
	$retour_total = $pdo->query("SELECT COUNT(*) AS total FROM histo_clics WHERE idUser = '".$mbreHashId."' AND idOffers = '".$off_id."' AND date LIKE '".date('d/m/Y')."%%'");
	$donnees_total = $retour_total->fetch();
	$total = $donnees_total['total'];

	if ($total > 0)
	{
		header('Location: '.url_site.'');
		exit;
	}
	
	$retour_art = $pdo->query("SELECT * FROM offers_clics WHERE idoffre = '".$off_id."' AND actif = 1");
	$dones_art = $retour_art->fetch();

	$id = $dones_art['id'];
	$idoffre = $dones_art['idoffre'];
	$nom = addslashes($dones_art['nom']);
	$url = $dones_art['url'];
	$remuneration = $dones_art['remuneration'];
	$actif = $dones_art['actif'];
	$date = date('d/m/Y à H:i:s');

	$pdo->exec("INSERT INTO `histo_clics` (`id`, `idUser`, `idOffers`, `remuneration`, `date`, `ip`) VALUES ('', '".$mbreHashId."', '".$idoffre."', '".$remuneration."', '".$date."', '".ip."')");
	$pdo->exec("UPDATE `users` SET euros = euros + '$remuneration' WHERE hashId = '$mbreHashId'");

	echo 'Redirection en cours...';
	header('Location: '.$url.'');
	exit;
?>