<?php
	session_start();

	include('./includes/functions.php');

	if (isset($_SESSION['id']))	{
		$sql = $pdo->query("SELECT * FROM users WHERE id = '".addslashes($_SESSION['id'])."'");
		$resultat = $sql->fetch(PDO::FETCH_ASSOC);
		$mbre_pseudo = $mbrePrenom . " " . $mbreNom;
	
		if ($_GET['a'] == 'refreshmsg')	{
				$us = $pdo->query("SELECT COUNT(*) as nbr_entrees FROM messagerie WHERE lu = 0 AND user2 = '".$mbre_pseudo."'");
				$dones_us = $us->fetch(PDO::FETCH_ASSOC);

				if ($dones_us['nbr_entrees'] == 0) { 
					echo '0'; 
				} else { 
					echo '<strong>'.$dones_us['nbr_entrees'].'</strong>'; 
				}
		}
		
		if ($_GET['a'] == 'refreshpseudo') {
			$keyword = '%'.$_POST['keyword'].'%';
			$sql = "SELECT * FROM users WHERE pseudo LIKE '".$keyword."' AND pseudo != '".$mbre_pseudo."' ORDER BY pseudo DESC LIMIT 0, 5";
			$query = $pdo->prepare($sql);
			$query->execute();
			$list = $query->fetchAll();
			foreach ($list as $rs) {
				if ($_POST['keyword'] != NULL) {
					// put in bold the written text
					//$pseudo_membre = str_replace($_POST['keyword'], ''.$_POST['keyword'].'', $rs['pseudo']);
					// add new option
					echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['pseudo']).'\')">'.$pseudo_membre.'</li>';
				} else { 
					echo ''; 
				}
			}
		}
	}
?>