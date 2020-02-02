<?php

include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");


if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    $pn		= (int)$_GET['pn'];
    $rid	= (int)$_GET['id'];

    DeleteRetailer($rid);

    header("Location: " . url_panel . "/retailers.php?msg=deleted&page=".$pn);
    exit();
}

?>