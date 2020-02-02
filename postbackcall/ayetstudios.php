<?php
    ini_set('display_errors',1);
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');
	
	if (!empty($_GET['offer_name']) AND !empty($_GET['sid']) AND !empty($_GET['status']) AND !empty($_GET['ip']) AND !empty($_GET['currency_amount']))
	{
        
    //Get parameters
	$uid = $_GET['uid'];
	$trans_id = $_GET['transaction_id'];
	$sub_id = $_GET['sub_id'];
	$status = $_GET['status'];
	$coins = $_GET['currency_amount'];
	$offer_id = $_GET['offer_id'];
	$offer_name = addslashes($_GET['offer_name']);
	$app_id = $_GET['adslot_id'];
	$ip_address = $_GET['ip'];
	
	if ($status == 1)
		{
			$tab = explode("-", $subid); 
			$uid = $tab[0];
			$data = data(30);

			$montantRev = (0.30 * $currency_amount) / 1000;

        $user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
        $dones_user = $user->fetch(PDO::FETCH_ASSOC);
        $idMembre = $dones_user['hashId'];

        $pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'Ayetstudios', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip_address."')");
		
		//$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'Ayetstudios', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip_address."')");
     
	 echo 1;
		}
	}
?>
            