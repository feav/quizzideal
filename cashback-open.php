<?php
include('./requiert/php-global.php');
// check if user are logged 
if(!isset($_SESSION['id'])){
	die;
}

$datas = [];

if(!empty($_POST)){
	$datas = [
		'idUser'		=>	(int)$_POST['idU'],
		'idCashback'	=>	(int)$_POST['idC'],
		'ip'			=>	$_POST['ip'],
		'etat'			=>	'En attente'
	];
} 

// check if cashback exist or not

$sql = "SELECT id FROM cashback WHERE id=?";
$req = $pdo->prepare($sql);
$req->execute([$datas['idCashback']]);
$result = $req->fetch();

if(!$result){
	die;
}

$sql = "INSERT INTO histo_cashback (idUser,idCashback,ip,etat) VALUES (:idUser, :idCashback, :ip, :etat)";
$req = $pdo->prepare($sql);
$result = $req->execute($datas);

if($result){
	$response = 'ok';
	echo json_encode($response);
}
?>