<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');	
	
	// Votre clé secrète
	$cle_secrete = 'umm5VGuSAs';
	
	// Paramètres envoyées
	$subid = $_REQUEST['subid']; // 0
	$name = $_REQUEST['name'];
	$ipuser = $_REQUEST['ip'];
	$amount = $_REQUEST['amount'];
	$hash = $_REQUEST['hash'];
	
	// On vérifie si la clé secrète est correcte
	if ($hash != md5($cle_secrete)) {
		echo 0; // Clé incorrecte !
		exit();
	}
	
	$tab = explode("-", $subid); 
	$uid = $tab[0];

	$montantRev = (0.30 * $amount) / 1000;
	$data = data(30);

	$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
	$dones_user = $user->fetch(PDO::FETCH_ASSOC);
	$idMembre = $dones_user['hashId'];

	$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'Offerwolf', '".$name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ipuser."')");	
	
	echo 1;
	die();
?>