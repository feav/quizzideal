<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	$secret = "cd9a46e686"; // check your app info at www.wannads.com

	$sub_id = isset($_GET['subId']) ? $_GET['subId'] : null;
	$transactionId = isset($_GET['transId']) ? $_GET['transId'] : null;
	$campaign_name = isset($_GET['campaign_name']) ? $_GET['campaign_name'] : null;
	$campaign_name = addslashes($campaign_name);
	$coins = isset($_GET['reward']) ? $_GET['reward'] : null;
	$signature = isset($_GET['signature']) ? $_GET['signature'] : null;
	$status = isset($_GET['status']) ? $_GET['status'] : null;
	$ipuser = isset($_GET['userIp']) ? $_GET['userIp'] : "0.0.0.0";


	// validate signature
	if (md5($sub_id.$transactionId.$coins.$secret) != $signature)
	{
	    echo "ERROR: Signature doesn't match";
	    return;
	}
	else
	{
		if ($status == 1)
		{
			$tab = explode("-", $sub_id); 
			$uid = $tab[0];

			$montantRev = (0.30 * $coins) / 1000;

			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];

			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'Wannads', '".$campaign_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$transactionId."', 'En attente', '".$ipuser."')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());

			echo "1";
		}
else	if ($status == 2)
		{
			echo '';
		}

		die();
	}
?>