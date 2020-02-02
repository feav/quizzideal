<?php

include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/pagination.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");


$title2= '';
$store  = 0;
$filter = '';
$rrorder = '';
$rorder = '';

// results per page
if (isset($_GET['show']) && is_numeric($_GET['show']) && $_GET['show'] > 0)
    $results_per_page = (int)$_GET['show'];
else
    $results_per_page = 10;


// Update coupons //
if (isset($_POST['action']) && $_POST['action'] == "update")
{
    $ids_arr	= array();
    $ids_arr	= $_POST['id_arr'];

    if (count($ids_arr) > 0)
    {
        foreach ($ids_arr as $v)
        {
            $couponid = (int)$v;
            DeleteCoupon($couponid);
        }

        header("Location: ". url_panel ."/coupons.php?msg=deleted");
        exit();
    }

    $sorts_arr	= array();
    $sorts_arr	= $_POST['sort_arr'];

    if (count($sorts_arr) > 0)
    {
        foreach ($sorts_arr as $k=>$v)
        {
            smart_mysql_query("UPDATE cashbackengine_coupons SET sort_order='".(int)$v."' WHERE coupon_id='".(int)$k."'");
        }

        header("Location: ".  url_panel  ."/coupons.php?msg=updated");
        exit();
    }
}

$where = "1=1";

////////////////// filter  //////////////////////
if (isset($_GET['column']) && $_GET['column'] != "")
{
    switch ($_GET['column'])
    {
        case "title": $rrorder = "title"; break;
        case "sort_order": $rrorder = "sort_order"; break;
        case "added": $rrorder = "added"; break;
        case "last_visit": $rrorder = "last_visit"; break;
        case "end_date": $rrorder = "end_date"; break;
        case "retailer_id": $rrorder = "retailer_id"; break;
        case "visists": $rrorder = "visits"; break;
        case "status": $rrorder = "status"; break;
        default: $rrorder = "added"; break;
    }
}
else
{
    $rrorder = "sort_order";
}

if (isset($_GET['order']) && $_GET['order'] != "")
{
    switch ($_GET['order'])
    {
        case "asc": $rorder = "asc"; break;
        case "desc": $rorder = "desc"; break;
        default: $rorder = "asc"; break;
    }
}
else
{
    $rorder = "asc";
}
if (isset($_GET['filter']) && $_GET['filter'] != "")
{
    $filter	= mysqli_real_escape_string($conn, trim(getGetParameter('filter')));
    $where .= " AND (title LIKE '%$filter%' OR code LIKE '%$filter%') ";
}
///////////////////////////////////////////////////////

if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) { $page = (int)$_GET['page']; } else { $page = 1; }
$from = ($page-1)*$results_per_page;

if (isset($_GET['store']) && is_numeric($_GET['store']))
{
    $store = (int)$_GET['store'];
    $where .= " AND retailer_id='$store' ";
    $title2 = GetStoreName($store);
}

$query = "SELECT *, DATE_FORMAT(added, '%e %b %Y') AS date_added, UNIX_TIMESTAMP(end_date) - UNIX_TIMESTAMP() AS time_left, DATE_FORMAT(start_date, '%e %b %Y') AS coupon_start_date, DATE_FORMAT(end_date, '%e %b %Y') AS coupon_end_date, DATE(last_visit) as last_visit_date FROM cashbackengine_coupons WHERE $where ORDER BY $rrorder $rorder, added DESC LIMIT $from, $results_per_page";

$result = smart_mysql_query($query);
$total_on_page = mysqli_num_rows($result);

$query2 = "SELECT * FROM cashbackengine_coupons WHERE ".$where;
$result2 = smart_mysql_query($query2);
$total = mysqli_num_rows($result2);

$cc = 0;

smart_mysql_query("UPDATE cashbackengine_coupons SET status='expired' WHERE end_date <= NOW()");

// delete all expired coupons //
if (isset($_GET['act']) && $_GET['act'] == "delete_expired")
{
    smart_mysql_query("DELETE FROM cashbackengine_coupons WHERE ((end_date <= NOW()) OR status='expired')");
    header("Location: ". url_panel ."/coupons.php?msg=exp_deleted");
    exit();
}

//smart_mysql_query("UPDATE cashbackengine_coupons SET viewed='1' WHERE viewed='0'");


$title = $title2." Coupons";
require_once ("cashback/inc/header.inc.php");

?>

    <div id="addnew">
        <a class="import" href="coupons_import.php">Import Coupons</a>
        <a style="margin-right: 10px;" href="<?= url_panel ?>/coupons.php?act=delete_expired"><img src="<?= url_panel ?>/cashback/images/idelete.png" align="absmiddle" /> Supprimer les coupons expirés</a> &nbsp;&nbsp;&nbsp; <a class="addnew" href="<?= url_panel ?>/coupon_add.php">Ajouter un coupon </a>
    </div>

    <h2><?php echo $title2; ?> Coupons</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] != "") { ?>
    <div class="success_box">
        <?php

        switch ($_GET['msg'])
        {
            case "added": echo "Le coupon a été ajouté avec succès"; break;
            case "updated": echo "Le coupon a été mis à jour avec succès"; break;
            case "deleted": echo "Le coupon a été supprimé avec succès"; break;
            case "exp_deleted": echo "Tous les coupons expirés ont été supprimés avec succès"; break;
        }

        ?>
    </div>
<?php } ?>


<?php if ($total > 0) { ?>

    <form id="form1" name="form1" method="get" action="">
        <table bgcolor="#F9F9F9" align="center" width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td nowrap="nowrap" width="47%" valign="bottom" align="left">
                    Trier par :
                    <select name="column" id="column" onChange="document.form1.submit()">
                        <option value="sort_order" <?php if ( isset($_GET['column']) && $_GET['column'] == "sort_order") echo "selected"; ?>>Ordre de tri</option>
                        <option value="added" <?php if (isset($_GET['column']) && $_GET['column'] == "added") echo "selected"; ?>>Nouveau</option>
                        <option value="last_visit" <?php if (isset($_GET['column']) && $_GET['column'] == "last_visit") echo "selected"; ?>>Dernier utilisation</option>
                        <option value="retailer_id" <?php if (isset($_GET['column']) && $_GET['column'] == "retailer_id") echo "selected"; ?>>Magasin</option>
                        <option value="title" <?php if (isset($_GET['column']) && $_GET['column'] == "title") echo "selected"; ?>>Titre</option>
                        <option value="end_date" <?php if (isset($_GET['column']) && $_GET['column'] == "end_date") echo "selected"; ?>>Fin le plus tôt</option>
                        <option value="visits" <?php if (isset($_GET['column']) && $_GET['column'] == "visits") echo "selected"; ?>>Popularité</option>
                        <option value="status" <?php if (isset($_GET['column']) && $_GET['column'] == "status") echo "selected"; ?>>Statut</option>
                    </select>
                    <select name="order" id="order" onChange="document.form1.submit()">
                        <option value="desc" <?php if (isset($_GET['order']) && $_GET['order'] == "desc") echo "selected"; ?>>Descendant</option>
                        <option value="asc" <?php if (isset($_GET['order']) && $_GET['order'] == "asc") echo "selected"; ?>>Ascendant</option>
                    </select>
                    &nbsp;&nbsp;Voir:
                    <select name="show" id="show" onChange="document.form1.submit()">
                        <option value="10" <?php if (isset($_GET['show']) && $_GET['show'] == "10") echo "selected"; ?>>10</option>
                        <option value="50" <?php if (isset($_GET['show']) && $_GET['show']== "50") echo "selected"; ?>>50</option>
                        <option value="100" <?php if (isset($_GET['show']) && $_GET['show'] == "100") echo "selected"; ?>>100</option>
                        <option value="111111111" <?php if (isset($_GET['show']) && $_GET['show'] == "111111111") echo "selected"; ?>>Tous</option>
                    </select>
                    <?php if ($store) { ?><input type="hidden" name="store" value="<?php echo $store; ?>" /><?php } ?>
                </td>
                <td nowrap="nowrap" width="30%" valign="middle" align="left">
                    <div style="background: #F7F7F7; padding: 7px; border-radius: 7px;">
                        Magasin: &nbsp;
                        <select name="store" id="store" onChange="document.form1.submit()" style="width: 150px;" class="textbox2">
                            <option value="">--- Tous les magasins ---</option>
                            <?php
                            $sql_retailers = smart_mysql_query("SELECT * FROM cashbackengine_retailers WHERE status='active' ORDER BY title ASC");
                            if (mysqli_num_rows($sql_retailers) > 0)
                            {
                                while ($row_retailers = mysqli_fetch_array($sql_retailers))
                                {
                                    if ($store == $row_retailers['retailer_id']) $selected = " selected=\"selected\""; else $selected = "";
                                    echo "<option value=\"".$row_retailers['retailer_id']."\"".$selected.">".$row_retailers['title']." (".GetStoreCouponsTotal($row_retailers['retailer_id']).")</option>";
                                }
                            }
                            ?>
                        </select>
                        <?php if ($store > 0) { ?><a href="coupons.php"><img align="absmiddle" src="<?= url_panel ?>/cashback/images/icons/delete_filter.png" border="0" alt="Delete Filter" /></a><?php } ?>
                        <br/>
                        <div class="admin_filter">
                            Recherche: <input type="text" name="filter" value="<?php echo $filter; ?>" class="textbox" size="25" /> <input type="submit" class="submit" value="Search" />
                            <?php if (isset($filter) && $filter != "") { ?><a title="Cancel Search" href="<?= url_panel ?>/coupons.php"><img align="absmiddle" src="<?= url_panel ?>/cahsback/images/icons/delete_filter.png" border="0" alt="Cancel Search" /></a><?php } ?>
                        </div>
                    </div>
                </td>
                <td width="35%" valign="bottom" align="right">
                    Montrant <?php echo ($from + 1); ?> - <?php echo min($from + $total_on_page, $total); ?> of <?php echo $total; ?>
                </td>
            </tr>
        </table>
    </form>

    <form id="form2" name="form2" method="post" action="">
        <table align="center" width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <th width="3%"><input type="checkbox" name="selectAll" onclick="checkAll();" class="checkbox" /></th>
                <th width="10%"><b>Ordre de tri</b></th>
                <th width="45%"><b>Magasin &amp; Titre coupon</b></th>
                <th width="17%"><b>Code</b></th>
                <th width="10%"><b>Utilisé / Aujourd'hui</b></th>
                <th width="12%"><b>Date expiration</b></th>
                <th width="10%"><b>Statut</b></th>
                <th width="10%"><b>Actions</b></th>
            </tr>
            <?php while ($row = mysqli_fetch_array($result)) { $cc++; ?>
                <tr class="<?php if (($cc%2) == 0) echo "even"; else echo "odd"; ?>">
                    <td nowrap="nowrap" align="center" valign="middle"><input type="checkbox" class="checkbox" name="id_arr[<?php echo $row['coupon_id']; ?>]" id="id_arr[<?php echo $row['coupon_id']; ?>]" value="<?php echo $row['coupon_id']; ?>" /></td>
                    <td align="center" valign="middle"><input type="text" name="sort_arr[<?php echo $row['coupon_id']; ?>]" value="<?php echo $row['sort_order']; ?>" class="textbox" size="3" /></td>
                    <td align="left" valign="middle" class="row_title">
                        <a href="<?= url_panel ?>/retailer_details.php?id=<?php echo $row['retailer_id']; ?>"><?php echo GetStoreName($row['retailer_id']); ?></a><br/>
                        <b><?php if (strlen($row['title']) > 150) echo substr($row['title'], 0, 150)."..."; else echo $row['title']; ?></b>
                        <?php if ($row['exclusive'] == 1) { ?><span class="exclusive" alt="Exclusive Coupon" title="Exclusive Coupon"></span><?php } ?>
                        <?php if ($row['description'] != "") { ?><br/><?php echo $row['description']; ?><?php } ?>
                    </td>
                    <td align="center" valign="middle"><?php echo ($row['code'] != "") ? $row['code'] : ""; ?></td>
                    <td align="center" valign="middle"><?php echo $row['visits']; ?> <span style="background: #BABABA; color: #FFF; padding: 2px 4px; margin-left: 2px;"><?php echo (date("Y-m-d") == $row['last_visit_date']) ? number_format($row['visits_today']) : "0"; ?></span></td>
                    <td nowrap="nowrap" align="center" valign="middle" title="<?php echo GetTimeLeft($row['time_left']); ?> left"><?php echo ($row['end_date'] != "0000-00-00 00:00:00") ? $row['coupon_end_date'] : "---"; ?></td>
                    <td align="left" valign="middle">
                        <?php
                        switch ($row['status'])
                        {
                            case "active": echo "<span class='active_s'>".$row['status']."</span>"; break;
                            case "inactive": echo "<span class='inactive_s'>".$row['status']."</span>"; break;
                            case "expired": echo "<span class='expired_status' style='margin:0'>".$row['status']."</span>"; break;
                            default: echo "<span class='default_status'>".$row['status']."</span>"; break;
                        }
                        ?>
                    </td>
                    <td nowrap="nowrap" align="center" valign="middle">
                        <a href="<?= url_panel ?>/coupon_details.php?id=<?php echo $row['coupon_id']; ?>&pn=<?php echo $page; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : ''; ?>&order=<?php echo isset($_GET['order']) ? $_GET['order'] : '' ; ?>" title="View"><img src="<?= url_panel ?>/cashback/images/view.png" border="0" alt="View" /></a>
                        <a href="<?= url_panel ?>/coupon_edit.php?id=<?php echo $row['coupon_id']; ?>&pn=<?php echo $page; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : '' ; ?>&order=<?php echo isset($_GET['order']) ? $_GET['order'] : '' ; ?>" title="Edit"><img src="<?= url_panel ?>/cashback/images/edit.png" border="0" alt="Edit" /></a>
                        <a href="#" onclick="if (confirm('Êtes vous sure de vouloir supprimer ce coupon ?') )location.href='<?= url_panel ?>/coupon_delete.php?id=<?php echo $row['coupon_id']; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : ''; ?>&order=<?php echo $_GET['order']; ?>&pn=<?php echo $page?>'" title="Delete"><img src="<?= url_panel ?>/cashback/images/delete.png" border="0" alt="Delete" /></a>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td style="border-top: 1px solid #F5F5F5" colspan="8" align="left">
                    <input type="hidden" name="column" value="<?php echo $rrorder; ?>" />
                    <input type="hidden" name="order" value="<?php echo $rorder; ?>" />
                    <input type="hidden" name="page" value="<?php echo $page; ?>" />
                    <input type="hidden" name="action" value="update" />
                    <input type="submit" class="submit" name="GoUpdate" id="GoUpdate" value="Mise à jour ordre de tri" />&nbsp;
                    <input type="submit" class="submit" style="background: #ADADAD; border: 1px solid #ADADAD;" name="GoDelete" id="GoDelete" value="Supprimer la sélection" />
                </td>
            </tr>
            <tr>
                <td colspan="8" align="center">
                    <?php
                    $params = "";
                    if ($store)		$params .= "store=$store&";

                    echo ShowPagination("coupons",$results_per_page,"coupons.php?".$params."column=$rrorder&order=$rorder&show=$results_per_page&", "WHERE ".$where);
                    ?>
                </td>
            </tr>
        </table>
    </form>

<?php }else{ ?>
    <?php if (isset($filter)) { ?>
        <div class="info_box">Pas de coupons. <a href="<?= url_panel ?>/coupons.php">Rechercher encore &#155;</a></div>
    <?php }else{ ?>
        <div class="info_box">Aucun coupon disponible à cette date. <?php if ($store) { ?><a href="<?= url_panel ?>/coupons.php">Voir tous les coupons &#155;</a><?php } ?></div>
    <?php } ?>
<?php } ?>

<?php require_once("./cashback/inc/footer.inc.php"); ?>