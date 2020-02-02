<?php
error_reporting(E_ERROR | E_PARSE); 
session_start();
//ini_set('display_errors', '1');

include './requiert/bddConnect.php';

if (date_default_timezone_set('Europe/Stockholm') == 0) {
	print "<!-- Error uknown timezone using UTC as default -->\n";
	date_default_timezone_set('UTC');
}

// Define

define("nom_site", "quizzdeal.fr", true);
define("url_site", "https://quizzdeal.fr/", true);
define("url_panel", "https://quizzdeal.fr/administration", true);
define("ip", $_SERVER["REMOTE_ADDR"], true);

/*
define("url_site", "http://localhost:8000", true);
define("url_panel", "http://localhost:8000/administration", true);
*/

if (isset($_GET['parrain'])) {$_SESSION['idParrain'] = $_GET['parrain'];}

function code($longueur) {
	$chaine_code = '';
	$chaine = "123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
	for ($i = 0; $i < $longueur; $i++) {
		$chaine_code .= substr($chaine, (rand() % (strlen($chaine))), 1);
	}
	return $chaine_code;
}

function displayMontant($montant, $chiffres_apres_virgule = 2, $symbole = "?") {
	return number_format($montant, $chiffres_apres_virgule, ',', ' ') . "" . $symbole;
}

if (isset($_GET['parrain']) OR isset($_GET['PARRAIN'])) {$_SESSION['idParrain'] = $_GET['parrain'];}

include "./geoloc/geoipcity.inc";
include "./geoloc/geoipregionvars.php";
$gi = geoip_open(realpath("./geoloc/GeoLiteCity.dat"), GEOIP_STANDARD);
$record = geoip_record_by_addr($gi, ip);
$country_name = $record->country_name;
$country_code = $record->country_code;
geoip_close($gi);

$totalUsers = $pdo->query("SELECT COUNT(*) AS 'exist' FROM users");
$totalUsers = $totalUsers->fetch(PDO::FETCH_ASSOC);
$totalUsers = $totalUsers['exist'];

$totalAmountRevers = $pdo->query("SELECT SUM(montant) AS 'amount' FROM gagnants");
$totalAmountRevers = $totalAmountRevers->fetch(PDO::FETCH_ASSOC);
$totalAmountRevers = $totalAmountRevers['amount'];

if (isset($_SESSION['id'])) {
	$sql = $pdo->query("SELECT * FROM users WHERE id = '" . addslashes($_SESSION['id']) . "'");
	$resultat = $sql->fetch(PDO::FETCH_ASSOC);
	$mbreId = addslashes(htmlentities($resultat['id']));
	$mbreHashId = addslashes(htmlentities($resultat['hashId']));
	$mbreEmail = addslashes(htmlentities($resultat['email']));
	$mbreMdp = addslashes(htmlentities($resultat['mdp']));
	$mbreNom = addslashes(html_entity_decode($resultat['nom']));
	$mbrePrenom = addslashes(html_entity_decode($resultat['prenom']));
	$mbreAdresse = addslashes(html_entity_decode($resultat['adresse']));
	$mbreVille = addslashes(html_entity_decode($resultat['ville']));
	$mbreCodePostal = addslashes(htmlentities($resultat['codePostal']));
	$mbrePays = addslashes(html_entity_decode($resultat['pays']));
	$country_code = addslashes(html_entity_decode($resultat['pays']));
	$mbreEuros = addslashes(html_entity_decode($resultat['euros']));
	$mbreEurosHisto = addslashes(html_entity_decode($resultat['euros_histo']));
	$mbreIdParrain = addslashes(htmlentities($resultat['idParrain']));
	$mbreLevel = addslashes(htmlentities($resultat['level']));
	$mbreBarrePrcnt = addslashes(htmlentities($resultat['barrePrcnt']));
	$mbreBanni = addslashes(htmlentities($resultat['banni']));
	$mbreBanniChat = addslashes(htmlentities($resultat['banni_chat']));
	$mbreIban = addslashes(htmlentities($resultat['iban']));
	$mbreSwift = addslashes(htmlentities($resultat['swift']));
	$mbrePaypal = addslashes(htmlentities($resultat['paypal']));
	$mbreSkrill = addslashes(htmlentities($resultat['skrill']));
	$mbreCodeVerif = addslashes(htmlentities($resultat['code_verif']));
	$mbrePremium = addslashes(htmlentities($resultat['premium']));
	$mbreDateLastCo = addslashes(htmlentities($resultat['datelastco']));
	$mbreTicketTombola = addslashes(htmlentities($resultat['ticketTombola']));
	$mbreIdentRecto = addslashes(htmlentities($resultat['ident_recto']));
	$mbreIdentVerso = addslashes(htmlentities($resultat['ident_verso']));
	$mbreIdentVerif = addslashes(htmlentities($resultat['ident_verif']));
	$mbreNewsletter = addslashes(htmlentities($resultat['news']));

	if ($mbreIdParrain == 0) {$mbreParrain = 'Aucun';} else {
		$sqlParrain = $pdo->query("SELECT * FROM users WHERE id = '" . $mbreIdParrain . "'");
		$resultatParrain = $sqlParrain->fetch(PDO::FETCH_ASSOC);
		$parrainNom = addslashes(htmlentities($resultatParrain['nom']));
		$parrainPrenom = addslashes(htmlentities($resultatParrain['prenom']));
		$mbreParrain = $parrainPrenom . ' ' . substr($parrainNom, 0, 1) . '.';
	}

	if ($mbreBarrePrcnt >= '100.00') {
		$pdo->exec("UPDATE users SET euros = euros + 2, barrePrcnt = barrePrcnt - 100, barrePrcntNb = barrePrcntNb + 1 WHERE id = '" . $mbreId . "'");
	}

	$totalAmoundAttente = $pdo->query("SELECT SUM(remuneration) AS 'montant' FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat = 'En attente'");
	$totalAmoundAttente = $totalAmoundAttente->fetch(PDO::FETCH_ASSOC);
	$totalAmoundAttente = $totalAmoundAttente['montant'];

	$nbMsgNonLu = $pdo->query("SELECT COUNT(*) as nbr_entrees FROM messagerie WHERE titre != '' AND (user = '" . $mbre_pseudo . "' OR  user2 = '" . $mbre_pseudo . "') AND lu = 0");
	$nb_MsgNonLu = $nbMsgNonLu->fetch(PDO::FETCH_ASSOC);

	if ($resultat['pmessage'] != "") {
		$_SESSION['pmessage'] = addslashes(htmlentities($resultat['pmessage']));
	} else {
		unset($_SESSION['pmessage']);
	}
}

if (isset($_GET['seenpmessage'])) {
	unset($_SESSION['pmessage']);
	$pdo->Query("UPDATE `users` SET `pmessage`= '' WHERE `id` = " . $mbreId . "");
}

if (isset($_SESSION['pmessage']) && explode("/", $_SERVER['REQUEST_URI'])[(sizeof(explode("/", $_SERVER['REQUEST_URI'])) - 1)] != "avertissement.php") {
	header('Location: avertissement.php');
	exit;
}

$concoursOffresOn = 0;
$concoursParrainagesOn = 0;

$sql_InfosConcours = $pdo->query("SELECT * FROM concours WHERE actif = 1");
$all_InfosConcours = $sql_InfosConcours->fetchAll(PDO::FETCH_ASSOC);
foreach ($all_InfosConcours as $dones_InfosConcours) {
	$idConcours = $dones_InfosConcours['id'];

	if ($idConcours == 3) {$concoursParrainagesOn = 1;}
	if ($idConcours == 4) {$concoursOffresOn = 1;}
}

// Tirage au sort Tombola
$sqlTirageTombola = $pdo->query("SELECT  id, name, dateFin, COUNT(id) as 'countId' FROM tombolas WHERE dateFin <= '" . date('Y-m-d') . "' && idUser = 0  GROUP BY id, name, dateFin");
$resultatTirageTombola = $sqlTirageTombola->fetch(PDO::FETCH_ASSOC);
$countIdTombola = addslashes(htmlentities($resultatTirageTombola['countId']));
$idTombola = addslashes(htmlentities($resultatTirageTombola['id']));
$nameCadeauTombola = addslashes(htmlentities($resultatTirageTombola['name']));
$dateFinTombola = addslashes(htmlentities($resultatTirageTombola['dateFin']));
if ($countIdTombola > 0 && $dateFinTombola . ' 16:00' <= date('Y-m-d H:i')) {
	$sqlTirageWinner = $pdo->query("SELECT * FROM tombolasParticipation WHERE idTombola = '" . $idTombola . "' ORDER BY rand() LIMIT 0,1");
	$resultatWinnerTombola = $sqlTirageWinner->fetch(PDO::FETCH_ASSOC);
	$idUserWinner = addslashes(htmlentities($resultatWinnerTombola['idUser']));

	$pdo->exec("UPDATE tombolas SET idUser = '" . $idUserWinner . "' WHERE id = '" . $idTombola . "'");

	$pdo->exec("INSERT INTO `gagnants` (`id`, `idUser`, `montant`, `type`, `categorie`, `date`, `ip`) VALUES ('', '" . $idUserWinner . "', 0, '" . $nameCadeauTombola . "', 'Tombola', '" . date('d/m/Y à H:i:s') . "', '')");
}
?>