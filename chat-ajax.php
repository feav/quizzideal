<?php
	include('./requiert/php-global.php');

	if ($_GET['a'] == 'refreshco')
	{
		if ($mbreBanniChat == 1) {
?>
			<script LANGUAGE="JavaScript">
			document.location.href="./"
			</script>
<?php
		exit();
		}
			
		if ($mbreNom != '' && $mbrePrenom != '')
		{
			$retour = $pdo->query('SELECT COUNT(*) AS \'nbre_entrees\' FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
			$donnees = $retour->fetch(PDO::FETCH_ASSOC);
	
			if ($donnees['nbre_entrees'] == 0) // L'ip ne se trouve pas dans la table, on va l'ajouter
			{
				$pdo->exec("INSERT INTO `connectes`(`ip`, `timestamp`, `idUser`) VALUES('".$_SERVER['REMOTE_ADDR']."', '".time()."', '".$mbreHashId."')");
			}
			else // L'ip se trouve d�j� dans la table, on met juste � jour le timestamp
			{
				$pdo->exec('UPDATE connectes SET timestamp=' . time() . ', idUser=\''.$mbreHashId.'\' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
			}
		}

			$top_connectes = $pdo->query("SELECT COUNT(*), idUser FROM connectes WHERE idUser != '' GROUP BY idUser ORDER BY timestamp");
			$i = 0;
			$all_top_connectes = $top_connectes->fetchAll(PDO::FETCH_ASSOC);
			$j = 0;
			foreach ($all_top_connectes as $dones_connectes)
			{
				$j++;
			}
			foreach ($all_top_connectes as $dones_connectes)
			{
				$us = $pdo->query("SELECT nom, prenom, level FROM users WHERE hashId = '".$dones_connectes['idUser']."'");
				$dones_us = $us->fetch(PDO::FETCH_ASSOC);
				$nom = substr($dones_us['nom'], 0, 2).'.';
				$prenom = $dones_us['prenom'];
?>
					<li class="item-connecte" <?php if ($dones_us['level'] == '99') {
						echo ' style="color: #dc6666; font-weight: bold;"';
					} else if ($dones_us['level'] == '9') {
						echo ' style="color: green; font-weight: bold;"';
					} else if ($dones_us['level'] == '1') {
						echo ' style="color: #444;"';
					} ?>><?php echo $prenom; ?> <?php echo $nom; ?></li><?php
					// if ($i < $j - 1) {
					// 	echo ',';
					// }
				//}

			$i++;
			}

		$timestamp_1min = time() - (60 * 1); // 60 * 1 = nombre de secondes �coul�es en 1min
		$pdo->exec("DELETE FROM connectes WHERE timestamp < '".$timestamp_1min."'");
	}

	if ($_GET['a'] == 'refreshchat')
	{
		$sc = $pdo->query("SELECT id, time, idUser, message FROM tchat ORDER BY time DESC LIMIT 0, 30");
		$i = 0;
		$all_sc = $sc->fetchAll(PDO::FETCH_ASSOC);
		foreach ($all_sc as $dones_chat)
		{
				$id = $dones_chat['id'];
				$us = $pdo->query("SELECT nom, prenom, level FROM users WHERE hashId = '".$dones_chat['idUser']."'");
				$dones_us = $us->fetch(PDO::FETCH_ASSOC);
				
				if ($dones_us['level'] == '1') { $color = '#444444'; }
		else	if ($dones_us['level'] == '99') { $color = '#dc6666'; }
		else	if ($dones_us['level'] == '9') { $color = 'green'; }
		
				$message = $dones_chat['message'];
				$nom = substr($dones_us['nom'], 0, 2).'.';
				$prenom = $dones_us['prenom'];

				$timer = explode(" ",$dones_chat['time']);
				$when = "";

				if (date('Y-m-d', strtotime('-1 day')) == $timer[0])
				{
					$when = "Hier &agrave; ";
				}
		else	if (date('Y-m-d', strtotime('-2 day')) == $timer[0])
				{
					$when = "Avant-hier &agrave;";
				}
?>

		<div style="font-size:12px;padding:5px;<?php if ($i%2==1) { ?>background-color:#efefef;<?php } ?>-moz-border-radius : 5px; -webkit-border-radius : 5px; border-radius : 5px;">
			<span class="f-w-bold f-s-13" style="color:<?= $color; ?>;font-size: 15px"><?= $prenom; ?> <?= $nom; ?></span>
            <span class="f-s-13">[<?= $when.substr($timer[1],0, strlen($timer[1]) - 3); ?>]</span>
			<?php if ($mbreLevel > 1) { ?>
            <a href="<?= url_site; ?>accueil.html?del=1&id=<?= $id; ?>&idUser=<?= $dones_chat['idUser']; ?>&time=<?= $dones_chat['time']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce message ?');">
                    <div style="float:right;background-color:#dc6666;-moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;padding:2px 5px;color:white;margin-left:5px;">Supprimer</div>
                </a>
            <?php } ?>
            <div style="clear:both;margin-bottom:3px;"></div>
			<span style="font-size: 15px"><?= nl2br($message); ?></span>
        </div>
<?php
		$i++;
		}
	}
?>