<?php
// Connexion à la base de donnée
//@ars - update to connect bd locally
$serveur = 'localhost';
$login = 'root';
$passe = 'root';
$base_de_donnee = 'quizz';

/*
$serveur = 'localhost';
$login = 'root';
$passe = 'mahakamsophie1989';
$base_de_donnee = 'cashback';
*/

try {
	$pdo = new PDO('mysql:dbname=' . $base_de_donnee . ';host=' . $serveur, $login, $passe);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Connexion échouée : ' . $e->getMessage();
}
?>