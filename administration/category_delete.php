<?php


include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");


if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    $id = (int)$_GET['id'];

    smart_mysql_query("DELETE FROM cashbackengine_categories WHERE category_id='$id'");
    smart_mysql_query("DELETE FROM cashbackengine_retailer_to_category WHERE category_id='$id'");

    $res = smart_mysql_query("SELECT category_id FROM cashbackengine_categories WHERE parent_id='$id'");

    if (mysqli_num_rows($res) > 0)
    {
        while ($row = mysqli_fetch_array($res))
        {
            smart_mysql_query("DELETE FROM cashbackengine_categories WHERE category_id='".$row['category_id']."'");
        }
    }

    header("Location: ". url_panel ."/categories.php?msg=deleted");
    exit();
}

?>