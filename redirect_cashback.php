<?php
include('./requiert/php-global.php');
include('./administration/cashback/inc/functions.inc.php');


define('COUNT_NOTMEMBERS', 0);

if(!isset($_SESSION['id'])){
    header("Location: connexion.php");
    exit();
}

$userid = (int)$_SESSION['id'];

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    $retailer_id = (int)$_GET['id'];
} else {
    header ("Location: cashback.php");
    exit();
}


$query = "SELECT * FROM cashbackengine_retailers WHERE retailer_id='$retailer_id' AND end_date > NOW() AND status='active'";
$req = $pdo->query($query);
$result  = $req->fetch();

if ($result)
{
    $row			= $result;
    $store_name		= $row['title'];
    $cashback		= DisplayCashback($row['cashback']);
    $website_url	= str_replace("{USERID}", $userid, $row['url']);
    
    $sql = 'UPDATE cashbackengine_retailers SET visits = visits + 1 WHERE ( retailer_id = :retailer_id )';
    $stm = $pdo->prepare( $sql );
    $stm->execute(array(':retailer_id' => $retailer_id));
}
else
{
    header ("Location: cashback.php");
    exit();
}


if (isset($_GET['c']) && is_numeric($_GET['c']) && $_GET['c'] > 0)
{
    $coupon_id = (int)$_GET['c'];

    $coupon_query = "SELECT * FROM cashbackengine_coupons WHERE coupon_id='$coupon_id'";
    $coupon_result = $pdo->query($coupon_query)->fetch();

    if ($coupon_result)
    {
        $coupon_row = $coupon_result;
        $coupon_link = $coupon_row['link'];

        if ($coupon_link != "")
        {
            $website_url = str_replace("{USERID}", $userid, $coupon_link);
        }
        
        $stm = $pdo->prepare( 'UPDATE cashbackengine_coupons SET visits = visits + 1, last_visit=NOW()  WHERE ( coupon_id = :coupon_id )' );
        $stm->execute(array(':coupon_id' => $coupon_id));

        $stm = $pdo->prepare( 'UPDATE cashbackengine_coupons SET visits_today = visits_today + 1 WHERE ( coupon_id = :coupon_id AND DATE(last_visit)=DATE(NOW()) )' );
        $stm->execute(array(':coupon_id' => $coupon_id));
        
    }
}

?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cashback</title>
    <meta http-equiv="refresh" content="3; url=<?php echo $website_url; ?>" />
    <link href="./administration/cashback/css/bootstrap.min.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="./administration/cashback/js/html5shiv.js"></script>
    <script src="./administration/cashback/js/respond.min.js"></script>
    <![endif]-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700" rel="stylesheet" type="text/css" />
    <style type="text/css">
        <!--
        body {
            background: #F0F1F2;
            font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        a {
            color: #3498DB;
            text-decoration: none;
        }

        a:hover {
            color: #2674A9;
        }

        .header {
            width: 100%;
            height: 100px;
            background: #FFF;
            padding: 15px 0;
        }

        .container {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 25%;
            left: 35%;
            width: 350px;
        }

        .box {
            position: relative;
            float: left;
            height: 225px;
            width: 400px;
            padding: 0 20px 20px 20px;
            text-align: left;
            border: 1px solid #DDD;
            background: #FFFFFF;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            position: relative;
            -moz-box-shadow: 0 0 5px 5px #E2E2E2;
            -webkit-box-shadow: 0 0 5px 5px #E2E2E2;
            box-shadow: 0 0 5px 5px #E2E2E2;
        }

        .msg {
            font-family: 'Open Sans Condensed', Times, Arial, Verdana, sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #777777;
            line-height: 30px;
            text-align: left;
        }

        .msg .username {
            color:#000;
        }

        .cashback {
            font-family: 'Open Sans Condensed', Times, Arial, Verdana, sans-serif;
            font-size: 24px;
            font-weight: 600;
            color: #84E028;
            line-height: 30px;
            text-align: left;
        }

        .store-name {
            line-height: 30px;
            font-family: 'Open Sans Condensed', Times, Arial, Verdana, sans-serif;
            font-size: 24px;
            font-weight: 500;
            color: #62AAF7;
            text-align: left;
        }

        .logo {
            position: absolute;
            float: right;
            top: 90px;
            right: 15px;
            /*border: 5px solid #F9F9F9;*/
        }

        .info {
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 10px 5px;
            text-align: center;
        }
        -->
    </style>
</head>
<body>
<div class="header"><center><a href="cashback.php"><img src="/img/logo.png" /></a></center></div>
<div class="container">
    <div class="box">
        <p align="center">Redirection <br/><br/></p>
        <div class="msg">
           Redirection en cours de traitement ...
        </div>
        <div class="info"><?php echo str_replace("%url%", $website_url, '<a href="%url%">Cliquez ici </a> si vous n\'êtes pas redirigé dans 5 secondes .'); ?></div>
    </div>
</div>
</body>
</html>