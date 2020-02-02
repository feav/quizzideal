<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
	<title><?php echo $title; ?> | CashbackEngine Admin Panel</title>
	<link href="cashback/css/cashbackengine.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="cashback/js/jquery.min.js"></script>
	<script type="text/javascript" src="cashback/js/jquery.calendrical.js"></script>
	<script type="text/javascript" src="cashback/js/easySlider1.7.js"></script>
	<script type="text/javascript" src="cashback/js/scripts.js" language="javascript"></script>
</head>
<body>

<div id="wrapper">

	<div id="header">
		<div id="logo"><a href="index.php"><img src="./images/logo.gif" border="0" /></a></div>
		<div id="right_header"><a href="<?= url_panel; ?>/">Retour administration principale</a></div>
	</div>

	<div id="content-wrapper">

		<div id="sidebar">
			<ul>
				<li><a href="clicks.php">Historique de click</a></li>
                <li><a href="<?= url_panel; ?>/retailers.php">Cashback</a></li>
				<li><a href="<?= url_panel?>/coupons.php">Coupons</a></li>
				<li><a href="<?= url_panel; ?>/categories.php">Categories</a></li>
				<!--li><a href="countries.php">Countries</a></li-->
				<!--li><a href="csv_import.php">Upload CSV-Report</a></li-->
				<li><a href="<?= url_panel; ?>/afftnetwork.php">Réseaux d'affiliation</a></li>
			</ul>
		</div>

		<div id="content">
