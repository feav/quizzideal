<?php

include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    $network_id = (int)$_GET['id'];

    smart_mysql_query("DELETE FROM cashbackengine_affnetworks WHERE network_id='$network_id'");

    header("Location: ". url_panel ."/afftnetwork.php?msg=deleted");
    exit();
}

?>