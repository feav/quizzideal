<?php

include('./requiert/php-global.php');
include('./administration/cashback/inc/functions.inc.php');

$meta_title = 'Quizzdeal.fr : Les cashback';
$meta_description = '';

if(!isset($_SESSION['id'])){
    header("Location: connexion.php");
    exit();
}

$userid	= (int)$_SESSION['id'];

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    $retailer_id	= (int)$_GET['id'];
    $click_ip		= getenv("REMOTE_ADDR");
    $coupon_id = '';
    if (isset($_GET['c']) && is_numeric($_GET['c']) && $_GET['c'] > 0){
        $coupon_id = (int)$_GET['c'];
    }

    $query = "SELECT * FROM cashbackengine_retailers WHERE retailer_id='$retailer_id'";
    $req = $pdo->query($query);
    $row = $req->fetch();

    if ($row) {
        // show landing page
        if ($coupon_id)
            $goto = "redirect_cashback.php?id=".$retailer_id."&c=".$coupon_id;
        else
            $goto = "redirect_cashback.php?id=".$retailer_id;

        if ($coupon_id)
        {
            $coupon_result = $pdo->query("SELECT * FROM cashbackengine_coupons WHERE coupon_id='$coupon_id'")->fetch();
            if ($coupon_result)
            {
                $coupon_link = $coupon_result['link'];
                if ($coupon_link != "")
                {
                    $goto = str_replace("{USERID}", $userid, $coupon_link);
                }
            }
        }
        
        $stm = $pdo->prepare( 'UPDATE cashbackengine_retailers SET visits = visits + 1 WHERE  retailer_id = :retailer_id ' );
        $stm->execute(array(':retailer_id' => $retailer_id));
       
        // update coupon visits
        if (isset($coupon_id) && is_numeric($coupon_id))
        {
            $stm = $pdo->prepare( 'UPDATE cashbackengine_coupons SET visits = visits + 1, last_visit=NOW()  WHERE ( coupon_id = :coupon_id )' );
            $stm->execute(array(':coupon_id' => $coupon_id));

            $stm = $pdo->prepare( 'UPDATE cashbackengine_coupons SET visits_today = visits_today + 1 WHERE ( coupon_id = :coupon_id AND DATE(last_visit)=DATE(NOW()) )' );
            $stm->execute(array(':coupon_id' => $coupon_id));

        }

        // save click info //
        $click_ref = GenerateRandString(10, "0123456789");
        $pdo->exec("INSERT INTO cashbackengine_clickhistory SET click_ref='$click_ref', user_id='$userid', retailer_id='$retailer_id', retailer='". $row['title'] ."', click_ip='$click_ip', added=NOW()");
        if ($goto != "")
        {
            // redirect user
            header("Location: ".$goto);
            exit();
        }
    } else {
        header("Location: cashback.php");
        exit();
    }
}
else
{
    header("Location: connexion.php");
    exit();
}

?>