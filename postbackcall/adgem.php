<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');
        
        function addLogEvent($event)
        {
            $event = $event."\n";

            file_put_contents("adgem.log", $event, FILE_APPEND);
        }

        foreach($_GET as $key => $value)
        {
            $event .= $key." : ".$value."<br>";
        }
        addLogEvent($event);
        
	// Get parameters
	/*$uid = $_GET['uid'];
	$trans_id = $_GET['transaction_id'];
	$sub_id = $_GET['sub_id'];
	$coins = $_GET['currency_amount'];
	$offer_id = $_GET['offer_id'];
	$offer_name = addslashes($_GET['offer_name']);
	$app_id = $_GET['adslot_id'];
	$ip_address = $_GET['ip'];

        $montantRev = (0.30 * $coins) / 1000;

        $user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
        $dones_user = $user->fetch(PDO::FETCH_ASSOC);
        $idMembre = $dones_user['hashId'];

        $pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'Ayetstudios', '".$offer_name."', '".$montantRev."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '".$ip_address."')");
*/
?>
            