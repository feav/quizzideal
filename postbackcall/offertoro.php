<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	if (!empty($_GET['o_name']) AND !empty($_GET['amount']) AND !empty($_GET['oid']) AND !empty($_GET['user_id']) AND !empty($_GET['sig']))
	{
		$cle_secrete = '93412c8f98936b5138206d834852d663';
		$oid = $_GET['oid'];
		$offer = $_GET['o_name'];
		$coins = $_GET['amount'];
		$subid = $_GET['user_id'];
		$ip = $_GET['ip'];
		$sig = $_GET['sig'];

		$hash = ''.$oid.'-'.$subid.'-'.$cle_secrete.'';

		if ($sig == md5($hash))
		{
			$tab = explode("-", $subid); 
			$uid = $tab[0];
			$data = data(30);

			$montantRev = (0.30 * $coins) / 1000;
			
			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];

			$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'OfferToro', '".$offer."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip."')");

			//$pdo->exec("UPDATE users SET cmonthly = cmonthly + '".$payout."' WHERE idm = '".$sonidm."'") or die ('Erreur : '.mysql_error());

			echo 1;
		}
	}
?>