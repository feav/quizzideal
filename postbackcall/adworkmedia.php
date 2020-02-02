<?php
	ini_set('display_errors',1);
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	if (!empty($_GET['campaign_name']) AND !empty($_GET['sid']) AND !empty($_GET['status']) AND !empty($_GET['ip']) AND !empty($_GET['vc_value']))
	{
		$campaign_name = $_GET['campaign_name'];
		$subid = $_GET['sid'];
		$status = $_GET['status'];
		$ip = $_GET['ip'];
		$vc_value = $_GET['vc_value'];
	
		if ($status == 1)
		{
			$tab = explode("-", $subid); 
			$uid = $tab[0];
			$data = data(30);

			$montantRev = (0.30 * $vc_value) / 1000;

			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];

			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'AdWorkMedia', '".$campaign_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip."')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());

			echo 1;
		}
	}
?>