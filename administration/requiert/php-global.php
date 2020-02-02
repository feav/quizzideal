<?php
session_start();
ini_set('display_errors', 1);

if (date_default_timezone_set('Europe/Stockholm') == 0) {
	print "<!-- Error uknown timezone using UTC as default -->\n";
	date_default_timezone_set('UTC');
}

include '../requiert/bddConnect.php';

// Define

define("nom_site", "quizzdeal.fr", true);
define("url_site", "http://www.quizzdeal.fr", true);
define("url_panel", "http://www.quizzdeal.fr/administration", true);

/*
define("url_site", "http://localhost:8000", true);
define("url_panel", "http://localhost:8000/administration", true);
*/

define("ip", $_SERVER["REMOTE_ADDR"], true);

unset($_SESSION['id']);

function code($longueur) {
	$chaine_code = '';
	$chaine = "123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
	for ($i = 0; $i < $longueur; $i++) {
		$chaine_code .= substr($chaine, (rand() % (strlen($chaine))), 1);
	}
	return $chaine_code;
}

function number($longueur) {
	$chaine_codeNumber = '';
	$chaine_Number = "0123456789";
	for ($i = 0; $i < $longueur; $i++) {
		$chaine_codeNumber .= substr($chaine_Number, (rand() % (strlen($chaine_Number))), 1);
	}
	return $chaine_codeNumber;
}

function displayMontant($montant, $chiffres_apres_virgule = 2, $symbole = "?") {
	return number_format($montant, $chiffres_apres_virgule, ',', ' ') . "" . $symbole;
}
function addLogEvent($event) {
	$event = $event . "\n";

	file_put_contents("session.log", $event, FILE_APPEND);
}

if (isset($_SESSION['adminid'])) {
	addLogEvent($_SESSION['adminid']);

	/*if (isset($_SESSION['adminid'])) {
		            $sql = $pdo->query("SELECT * FROM users WHERE id = '".$_SESSION['adminid']."'");
		            $resultat = $sql->fetch(PDO::FETCH_ASSOC);
		            $mbreId = addslashes(htmlentities($resultat['id']));
		            $mbreEmail = addslashes(htmlentities($resultat['email']));
		            $mbreMdp = addslashes(htmlentities($resultat['mdp']));
		            $mbreNom = addslashes(html_entity_decode($resultat['nom']));
		            $mbrePrenom = addslashes(html_entity_decode($resultat['prenom']));
		            $mbreAdresse = addslashes(html_entity_decode($resultat['adresse']));
		            $mbreVille = addslashes(html_entity_decode($resultat['ville']));
		            $mbreCodePostal = addslashes(htmlentities($resultat['codePostal']));
		            $mbrePays = addslashes(html_entity_decode($resultat['pays']));
		            $mbreLevel = htmlentities($resultat['level']);

		            if ($mbreLevel < 99) {
		                header('Location: '.url_site.'');
		                exit();
		            }
		        }
		        else {
		            header('Location: '.url_site.'');
		            exit();
	*/
	$sql = $pdo->query("SELECT * FROM users WHERE id = '" . $_SESSION['adminid'] . "'");
	$resultat = $sql->fetch(PDO::FETCH_ASSOC);
	$mbreId = addslashes(htmlentities($resultat['id']));
	$mbreEmail = addslashes(htmlentities($resultat['email']));
	$mbreMdp = addslashes(htmlentities($resultat['mdp']));
	$mbreNom = addslashes(html_entity_decode($resultat['nom']));
	$mbrePrenom = addslashes(html_entity_decode($resultat['prenom']));
	$mbreAdresse = addslashes(html_entity_decode($resultat['adresse']));
	$mbreVille = addslashes(html_entity_decode($resultat['ville']));
	$mbreCodePostal = addslashes(htmlentities($resultat['codePostal']));
	$mbrePays = addslashes(html_entity_decode($resultat['pays']));
	$mbreLevel = htmlentities($resultat['level']);
} else {
	header('Location: ' . url_site . '/admin.php');
	exit();
}
?>