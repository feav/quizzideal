<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	if (!empty($_GET['name']) AND !empty($_GET['rate']) AND !empty($_GET['sub1']) AND !empty($_GET['status']) AND !empty($_GET['ip']))
	{
		$offer = $_GET['name'];
		$coins = $_GET['rate'];
		$subid = $_GET['sub1'];
		$status = $_GET['status'];
		$ip = $_GET['ip'];
	
		if ($status == 1)
		{
			$tab = explode("-", $subid); 
			$uid = $tab[0];
			$data = data(30);

			$montantRev = (0.30 * $coins);

			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];

			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'AdscendMedia', '".$offer."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip."')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());

			echo 1;
		}
	}
?>