<?php
	include('./requiert/php-global.php');

	$off_id = $_POST['off_id'];

	$maxOffersPerAnnonceurPerDay = 10;

	// On selectionne les informations de la campagne
	$sql = "SELECT id, idoffre, nom, url, remuneration, actif, regie, annonceur, quota,
		(   SELECT COUNT(*) 
			FROM histo_offers ho 
			WHERE ho.idt = o.nom 
			AND ho.etat != 'Refus&eacute;'
			AND ho.date LIKE '".date('d/m/Y')."%'
		) totalForQuota,
		(   SELECT olo.nom
			FROM offers olo
			JOIN histo_offers holo ON holo.idt = olo.nom 
			WHERE holo.idUser = '$mbreHashId'
			AND holo.etat != 'Refus&eacute;' 
			AND olo.annonceur = o.annonceur 
			ORDER BY holo.date DESC
			LIMIT 1
		) latestOffer,
		(   SELECT ou.nom 
			FROM offers ou 
			WHERE ou.annonceur = o.annonceur 
			ORDER BY ou.nom 
			DESC LIMIT 1
		) ultimateOffer
		FROM offers o
		WHERE pays LIKE '%%".$country_code."%%' 
		AND premium <= '".$mbrePremium."'
		AND actif = 1 
		AND NOT EXISTS 
		(   SELECT *
			FROM histo_offers hoidUser
			WHERE hoidUser.idt = o.nom 
			AND hoidUser.etat != 'Refus&eacute;'
			AND hoidUser.date LIKE '".date('d/m/Y')."%'
			AND hoidUser.idUser = '$mbreHashId'
		) /* offer not done today */
		AND NOT EXISTS 
		(   SELECT * 
			FROM offers oip
			JOIN histo_offers hoip ON hoip.idt = oip.nom
			WHERE hoip.ip = '".ip."'
			AND hoip.etat != 'Refus&eacute;'
			AND hoip.date LIKE '".date('d/m/Y')."%'
			AND hoip.idUser = '$mbreHashId'
			AND oip.annonceur = o.annonceur
		) /* no offer from same annonceur unless with different IP */
		AND NOT EXISTS
		(   SELECT COUNT(*)
			FROM offers oa
			JOIN histo_offers hoa ON hoa.idt = oa.nom
			WHERE hoa.etat != 'Refus&eacute;'
			AND hoa.date LIKE '".date('d/m/Y')."%'
			AND hoa.idUser = '$mbreHashId'
			AND oa.annonceur = o.annonceur
			HAVING COUNT(*) >= $maxOffersPerAnnonceurPerDay
		) /* no more than max offers per day per annonceur per member */
		AND idoffre = '$off_id'
		HAVING (totalForQuota < o.quota OR o.quota = 0) 
		AND (o.nom > (CASE WHEN latestOffer = ultimateOffer THEN '' ELSE COALESCE(latestOffer, '') END))
		ORDER BY o.nom ASC
	";

	$art = $pdo->query($sql);
	$dones_art = $art->fetch(PDO::FETCH_ASSOC);

	if (empty($dones_art))
	{
		header('Location: '.url_site.'');
		exit;
	}

	$id = $dones_art['id'];
	$idoffre = $dones_art['idoffre'];
	$nom = addslashes($dones_art['nom']);
	$url = $dones_art['url'];
	$remuneration = $dones_art['remuneration'];
	$actif = $dones_art['actif'];
	$annonceur = $dones_art['annonceur'];
	$regie = $dones_art['regie'];
		
	if (isset($_SESSION['id'])) {
		$rand = rand(100000000000000,999999999999999);

		function data($longueur) {
			$data = '';
			$chaine = "azertyuiopqsdfghjklmwxcvbn1234567890AZERTYUIOPQSDFGHJKLMWXCVBN";
			for ($i = 0; $i < $longueur; $i++) {
				$data .= substr($chaine, (rand() % (strlen($chaine))), 1);
			}
			return $data;
		}
		$data = data(20);

		$url = str_replace('#IDM', $data, $url);
		$date = date('d/m/Y à H:i:s');
		
		$pdo->exec("INSERT INTO `histo_offers` (`id`, `idUser`, `offerwall`, `idt`, `regie`, `remuneration`, `date`, `dateUsTime`, `data`, `etat`, `ip`) VALUES ('', '".$mbreHashId."', 'Mission', '".$nom."', '".$regie."', '".$remuneration."', '".$date."', '".date('Y-m-d H:i:s')."', '".$data."', 'En cours', '".ip."')");
	}
	else {
		$url = str_replace('#IDM', '', $url);
	}

	echo 'Redirection en cours...';
	header('Location: '.$url.'');
	//echo '<br/>'.$url;
	exit;
?>