<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	$publisher_hash = '5afc31b973af550011da320c';
	$publisher_secret_key = '1dfd44b7-3a1b-4315-8565-5683b6c4eba9';

	$sub_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
	$offer_name = isset($_GET['offer_name']) ? $_GET['offer_name'] : null;
	$offer_name = urldecode($offer_name);
	$coins = isset($_GET['amount']) ? $_GET['amount'] : null;
	$placement_id = isset($_GET['placement_id']) ? $_GET['placement_id'] : null;
	$pub_signature = isset($_GET['pub_signature']) ? $_GET['pub_signature'] : null;


	// validate signature
	if (md5($sub_id.':'.$publisher_hash.':'.$publisher_secret_key) != $pub_signature)
	{
	    echo "ERROR: Signature doesn't match";
	    return;
	}
	else
	{
			$tab = explode("-", $sub_id); 
			$uid = $tab[0];

			$montantRev = (0.30 * $coins) / 1000;
			$data = data(30);

			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];

			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'Persona.ly', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());

			echo "1";

		die();
	}
?>