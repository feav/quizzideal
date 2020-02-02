<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	// Your secret key can be found in your apps section by clicking on the "Secret Key" button
	$secret_key = '9rGftl4WfVdIvZKu0ZVc4YymHzCGI0yb';

	// Get parameters
	$status = $_REQUEST['status'];
	$trans_id = $_REQUEST['trans_id'];
	$sub_id = $_REQUEST['sub_id'];
	$sub_id_2 = $_REQUEST['sub_id_2'];
	$gross = $_REQUEST['gross'];
	$coins = $_REQUEST['amount'];
	$offer_id = $_REQUEST['offer_id'];
	$offer_name = addslashes($_REQUEST['offer_name']);
	$app_id = $_REQUEST['app_id'];
	$ip_address = $_REQUEST['ip_address'];
	$signature = $_REQUEST['signature'];

	// Create validation signature
	$validation_signature = md5($sub_id . ':' . $coins . ':' . $secret_key);

	if ($signature != $validation_signature)
	{
	    // Signatures not equal - send error code
		echo 0;
		die();
	}
	
	// Validation was successful. Credit user process.
	echo 1;

		if ($status == 1)
		{
			$tab = explode("-", $sub_id); 
			$uid = $tab[0];
			$data = data(30);

			$montantRev = (0.30 * $coins) / 1000;
			
			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];

			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'KiwiWall', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip_address."')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());
		}
else	if ($status == 2)
		{
			echo '';
		}

		die();
?>
            