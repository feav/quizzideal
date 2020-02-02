<?php
	include('../requiert/bddConnect.php');
	include('../requiert/genereData.php');

    $secret_password = 'timothee12300';
    $password = $_REQUEST['pwd'];
    $payout = $_REQUEST['c'];
    $user = trim($_REQUEST['u']);
    $type = 1;
    $status = trim($_REQUEST['s']);
    $cname = $_REQUEST['cname'];

    if($password == $secret_password)
    {
	    if ($status == '1')
	    {
	        $tab = explode("-", $user); 
			$uid = $tab[0];

			$user = $pdo->query("SELECT hashId FROM users WHERE hashId = '".$uid."'");
			$dones_user = $user->fetch(PDO::FETCH_ASSOC);
			$idMembre = $dones_user['hashId'];
			
     	    if ($type == '1')
     	    {
      		    $pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$idMembre."', 'hasofferswall', '".$cname."', '".$payout."', '".date('d/m/Y à H:i:s')."', '".date('Y-m-d H:i:s')."', '".$data."', 'En attente', '')");
			}
			else
			{	
				echo '';
			}
			exit('Gains crédités !');
		}
		else
		{
			if($type == '1')
			{
				echo '';
			}
			else
			{
				echo '';
			}
			exit('Done');
		}			
	}
	else
	{
		die('Failed');
	}
?>