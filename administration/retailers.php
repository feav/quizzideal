<?php

include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/pagination.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");


// results per page
if (isset($_GET['show']) && is_numeric($_GET['show']) && $_GET['show'] > 0)
    $results_per_page = (int)$_GET['show'];
else
    $results_per_page = 10;


// Delete retailers //
if (isset($_POST['action']) && $_POST['action'] == "delete")
{
    $ids_arr	= array();
    $ids_arr	= $_POST['id_arr'];

    if (count($ids_arr) > 0)
    {
        foreach ($ids_arr as $v)
        {
            $rid = (int)$v;
            DeleteRetailer($rid);
        }

        header("Location: retailers.php?msg=deleted");
        exit();
    }
}

////////////////// filter  //////////////////////
if (isset($_GET['column']) && $_GET['column'] != "")
{
    switch ($_GET['column'])
    {
        case "title": $rrorder = "title"; break;
        case "added": $rrorder = "added"; break;
        case "visits": $rrorder = "visits"; break;
        case "network_id": $rrorder = "network_id"; break;
        case "cashback": $rrorder = "cashback"; break;
        case "status": $rrorder = "status"; break;
        default: $rrorder = "title"; break;
    }
}
else
{
    $rrorder = "title";
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
    $filter_by = " WHERE (title LIKE '%$filter%' OR program_id='$filter')";
} else {
    $filter = '';
    $filter_by = '';
}
///////////////////////////////////////////////////////

if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) { $page = (int)$_GET['page']; } else { $page = 1; }
$from = ($page-1)*$results_per_page;

if ($rrorder == "cashback")
    $query = "SELECT *, DATE_FORMAT(added, '%e %b %Y') AS date_added, DATE_FORMAT(end_date, '%e %b %Y %h:%i') AS retailer_end_date, UNIX_TIMESTAMP(end_date) - UNIX_TIMESTAMP() AS time_left FROM cashbackengine_retailers $filter_by ORDER BY ABS(cashback) $rorder LIMIT $from, $results_per_page";
else
    $query = "SELECT *, DATE_FORMAT(added, '%e %b %Y') AS date_added, DATE_FORMAT(end_date, '%e %b %Y %h:%i') AS retailer_end_date, UNIX_TIMESTAMP(end_date) - UNIX_TIMESTAMP() AS time_left FROM cashbackengine_retailers $filter_by ORDER BY $rrorder $rorder LIMIT $from, $results_per_page";

$result = smart_mysql_query($query);
$total_on_page = mysqli_num_rows($result);

$query2 = "SELECT * FROM cashbackengine_retailers".$filter_by;
$result2 = smart_mysql_query($query2);
$total = mysqli_num_rows($result2);

$cc = 0;

// delete all expired retailers //
smart_mysql_query("UPDATE cashbackengine_coupons SET status='expired' WHERE end_date <= NOW()");
if (isset($_GET['act']) && $_GET['act'] == "delete_expired")
{
    smart_mysql_query("DELETE FROM cashbackengine_retailers WHERE (( end_date <= NOW()) OR status='expired')");
    header("Location: ". url_panel ."/retailers.php?msg=exp_deleted");
    exit();
}


$title = "Retailers";
require_once ("cashback/inc/header.inc.php");

?>

<div id="addnew">
    <a class="import" href="<?= url_panel ?>/retailers_import.php">Importer Cashback / Revendeur</a>
    <a style="margin-right: 7px;" href="<?= url_panel ?>/retailers.php?act=delete_expired"><img src="<?= url_panel ?>/cashback/images/idelete.png" align="absmiddle" /> Supprimer les cashback expirés</a>
    &nbsp;&nbsp;&nbsp; <a class="addnew" href="<?= url_panel ?>/retailer_add.php">Ajouter un cashback</a>
</div>

<h2>Cashback / Revendeur</h2>

<?php if ($total > 0) { ?>


    <?php if (isset($_GET['msg']) && $_GET['msg'] != "") { ?>
        <div class="success_box">
            <?php

            switch ($_GET['msg'])
            {
                case "added": echo "Le Cashback a été ajouté avec succès"; break;
                case "updated": echo "Le Cashback a été mis à jour"; break;
                case "deleted": echo "Le Cashback a été supprimé"; break;
                case "exp_deleted": echo "Tous les Cashback expirés ont été supprimé"; break;
            }

            ?>
        </div>
    <?php } ?>


    <form id="form1" name="form1" method="get" action="">
        <table bgcolor="#F9F9F9" align="center" width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td nowrap="nowrap" width="47%" valign="middle" align="left">
                    Trier par:
                    <select name="column" id="column" onChange="document.form1.submit()">
                        <option value="title" <?php if (isset($_GET['column']) && $_GET['column'] == "title") echo "selected"; ?>>Nom</option>
                        <option value="visits" <?php if (isset($_GET['column']) && $_GET['column'] == "visits") echo "selected"; ?>>Popularité</option>
                        <option value="added" <?php if (isset($_GET['column']) && $_GET['column'] == "added") echo "selected"; ?>>NOuveau</option>
                        <option value="network_id" <?php if (isset($_GET['column']) && $_GET['column'] == "network_id") echo "selected"; ?>>Réseaux</option>
                        <option value="cashback" <?php if (isset($_GET['column']) && $_GET['column'] == "cashback") echo "selected"; ?>>Cashback</option>
                        <option value="status" <?php if (isset($_GET['column']) && $_GET['column'] == "status") echo "selected"; ?>>Statut</option>
                    </select>
                    <select name="order" id="order" onChange="document.form1.submit()">
                        <option value="desc" <?php if (isset($_GET['order']) && $_GET['order'] == "desc") echo "selected"; ?>>Descendant</option>
                        <option value="asc" <?php if (isset($_GET['order']) && $_GET['order'] == "asc") echo "selected"; ?>>Ascendant</option>
                    </select>
                    &nbsp;&nbsp;Voir:
                    <select name="show" id="show" onChange="document.form1.submit()">
                        <option value="10" <?php if (isset($_GET['show']) && $_GET['show'] == "10") echo "selected"; ?>>10</option>
                        <option value="50" <?php if (isset($_GET['show']) && $_GET['show'] == "50") echo "selected"; ?>>50</option>
                        <option value="100" <?php if (isset($_GET['show']) && $_GET['show'] == "100") echo "selected"; ?>>100</option>
                        <option value="111111111" <?php if (isset($_GET['show']) && $_GET['show'] == "111111111") echo "selected"; ?>>Tous</option>
                    </select>
                </td>
                <td nowrap="nowrap" width="30%" valign="middle" align="left">
                    <div class="admin_filter">
                        <input type="text" name="filter" value="<?php echo $filter; ?>" class="textbox" size="30" title="Title or Program ID" /> <input type="submit" class="submit" value="Search" />
                        <?php if (isset($filter) && $filter != "") { ?><a title="Annuler la recherche" href="<?= url_panel ?>/retailers.php"><img align="absmiddle" src="<?=  url_panel?>/cashback/images/icons/delete_filter.png" border="0" alt="Cancel Search" /></a><?php } ?>
                    </div>
                </td>
                <td width="35%" valign="middle" align="right">
                    Montrant <?php echo ($from + 1); ?> - <?php echo min($from + $total_on_page, $total); ?> of <?php echo $total; ?>
                </td>
            </tr>
        </table>
    </form>

    <form id="form2" name="form2" method="post" action="">
        <table align="center" width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <th width="3%"><input type="checkbox" name="selectAll" onclick="checkAll();" class="checkbox" /></th>
                <th width="10%">ID</th>
                <th width="38%">Titre</th>
                <th width="17%">Réseaux Affiliation</th>
                <th width="10%">Cashback</th>
                <th width="7%">Coupons</th>
                <th width="10%">Visites</th>
                <th width="10%">Statut</th>
                <th width="12%">Date Ajout</th>
                <th width="10%">Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($result)) { $cc++; ?>
                <tr class="<?php if (($cc%2) == 0) echo "even"; else echo "odd"; ?>">
                    <td nowrap="nowrap" align="center" valign="middle"><input type="checkbox" class="checkbox" name="id_arr[<?php echo $row['retailer_id']; ?>]" id="id_arr[<?php echo $row['retailer_id']; ?>]" value="<?php echo $row['retailer_id']; ?>" /></td>
                    <td align="center" valign="middle"><?php echo $row['retailer_id']; ?></td>
                    <td align="left" valign="middle" class="row_title">
                        <a href="<?=url_panel?>/retailer_details.php?id=<?php echo $row['retailer_id']; ?>&pn=<?php echo $page; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : ''; ?>&order=<?php echo isset($_GET['order']) ? $_GET['order'] : ''; ?>">
                            <?php if (strlen($row['title']) > 100) echo substr($row['title'], 0, 100)."..."; else echo $row['title']; ?>
                        </a>
                        <?php if ($row['featured'] == 1) { ?><span class="featured" alt="Featured" title="Featured"></span><?php } ?>
                        <?php if ($row['store_of_week'] == 1) { ?><span class="deal_of_week" alt="Store of the Week" title="Store of the Week"></span><?php } ?>
                        <?php if ($row['network_id'] > 0 && !strstr($row['url'], "{USERID}")){ ?><sup><span class="color: #555;" title="no SUBid parameter"> !</span></sup><?php } ?>
                    </td>
                    <td align="left" valign="middle"><?php echo GetNetworkName($row['network_id']); ?></td>
                    <td align="center" valign="middle"><?php echo DisplayCashback($row['cashback']); ?></td>
                    <td align="center" valign="middle"><a style="color: #000" href="<?=url_panel?>/coupons.php?store=<?php echo $row['retailer_id']; ?>"><?php echo GetStoreCouponsTotal($row['retailer_id']); ?> <img src="<?=  url_panel ?>/cashback/images/icons/coupon.png" align="absmiddle" /></a></td>
                    <td nowrap="nowrap" align="center" valign="middle"><a href="<?= url_panel ?>/clicks.php?store=<?php echo $row['retailer_id']; ?>"><?php echo number_format($row['visits']); ?></a></td>
                    <td align="left" valign="middle">
                        <?php
                        switch ($row['status'])
                        {
                            case "active": echo "<span class='active_s'>".$row['status']."</span>"; break;
                            case "inactive": echo "<span class='inactive_s'>".$row['status']."</span>"; break;
                            case "expired": echo "<span class='expired_status'>".$row['status']."</span>"; break;
                            default: echo "<span class='default_status'>".$row['status']."</span>"; break;
                        }
                        ?>
                    </td>
                    <td nowrap="nowrap" align="center" valign="middle"><?php echo $row['date_added']; ?></td>
                    <td nowrap="nowrap" align="center" valign="middle">
                        <a href="<?= url_panel ?>/retailer_details.php?id=<?php echo $row['retailer_id']; ?>&pn=<?php echo $page; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : ''; ?>&order=<?php echo isset($_GET['order']) ? $_GET['order'] : ''; ?>" title="View"><img src="<?= url_panel ?>/cashback/images/view.png" border="0" alt="View" /></a>
                        <a href="<?= url_panel ?>/retailer_edit.php?id=<?php echo $row['retailer_id']; ?>&pn=<?php echo $page; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : ''; ?>&order=<?php echo isset($_GET['order']) ? $_GET['order'] : ''; ?>" title="Edit"><img src="<?= url_panel ?>/cashback/images/edit.png" border="0" alt="Edit" /></a>
                        <a href="#" onclick="if (confirm('Vous êtes sure de vouloir supprimer ce cashback / revendeur ?') )location.href='<?= url_panel ?>/retailer_delete.php?id=<?php echo $row['retailer_id']; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : ''; ?>&order=<?php echo isset($_GET['order']) ? $_GET['order'] : ''; ?>&pn=<?php echo $page?>'" title="Delete"><img src="<?= url_panel ?>/cashback/images/delete.png" border="0" alt="Delete"/></a>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td style="border-top: 1px solid #F5F5F5" colspan="10" align="left">
                    <input type="hidden" name="column" value="<?php echo $rrorder; ?>" />
                    <input type="hidden" name="order" value="<?php echo $rorder; ?>" />
                    <input type="hidden" name="page" value="<?php echo $page; ?>" />
                    <input type="hidden" name="action" value="delete" />
                    <input type="submit" class="submit" name="GoDelete" id="GoDelete" value="Supprimer la sélection" />
                </td>
            </tr>
            <tr>
                <td colspan="10" align="center">
                    <?php
                    $column = isset($_GET['column']) ? $_GET['column'] : "";
                    $order = isset($_GET['order']) ? $_GET['order'] : "";

                    echo ShowPagination("retailers",$results_per_page,url_panel . "/retailers.php?column=". $column ."&order=". $order  ."&show=$results_per_page&",$filter_by); ?>
                </td>
            </tr>
        </table>
    </form>

<?php }else{ ?>
    <?php if (isset($filter)) { ?>
        <div class="info_box">Aucun Cashback enregistré. <a href="<?= url_panel ?>/retailers.php">Rechercher encore &#155;</a></div>
    <?php }else{ ?>
        <div class="info_box">Aucun cashback de disponible.</div>
    <?php } ?>
<?php } ?>

<?php require_once("./cashback/inc/footer.inc.php"); ?>
