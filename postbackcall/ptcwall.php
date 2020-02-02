<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

	$user_password = 'SA3V5730aA1GVy0KliGYTubT18pvWX2';
	$sent_pw = $_GET['pwd'];
	$credited = intval($_GET['c']);
	$subid = trim($_GET['usr']);
	$rate = trim($_GET['r']);
	$type  = intval($_GET['t']);
	$transaction = trim($_GET['none']);

		if ($credited == '1')
		{
			$tab = explode("-", $subid); 
			$uid = $tab[0];
			$data = code(30);

			$montantRev = $rate;

			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];
				
			if ($type == '1')
			{
				$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'PTCWall', '".$transaction."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip."')");
			}
	else	if ($type == '2') 
			{	
				$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'PTCWall', '".$transaction."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip."')");
			}
		}
else	if ($credited == '2')
		{
			if($type == '1')
			{
				echo '';
			}
	else	if ($type == '2')
			{
				echo '';
			}
		}
?>