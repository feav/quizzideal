<?php


include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/pagination.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");

$title2 = '';
$action = '';
$start_date = '';
$end_date = '';
$filter = '';


// results per page
if (isset($_GET['show']) && is_numeric($_GET['show']) && $_GET['show'] > 0)
    $results_per_page = (int)$_GET['show'];
else
    $results_per_page = 20;


$where = "1=1";

////////////////// filter  //////////////////////
if (isset($_GET['column']) && $_GET['column'] != "")
{
    switch ($_GET['column'])
    {
        case "added": $rrorder = "added"; break;
        case "retailer_id": $rrorder = "retailer_id"; break;
        case "user_id": $rrorder = "user_id"; break;
        case "click_ip": $rrorder = "click_ip"; break;
        default: $rrorder = "added"; break;
    }
}
else
{
    $rrorder = "added";
}

if (isset($_GET['order']) && $_GET['order'] != "")
{
    switch ($_GET['order'])
    {
        case "asc": $rorder = "asc"; break;
        case "desc": $rorder = "desc"; break;
        default: $rorder = "desc"; break;
    }
}
else
{
    $rorder = "desc";
}

if (isset($_GET['filter']) && $_GET['filter'] != "")
{
    $action		= "filter";
    $start_date	= mysqli_real_escape_string($conn, getGetParameter('start_date'));
    $end_date	= mysqli_real_escape_string($conn, getGetParameter('end_date'));
    $filter		= mysqli_real_escape_string($conn, trim(getGetParameter('filter')));
    $where		.= " AND (retailer LIKE '%$filter%' OR click_ip LIKE '%$filter%') ";
    if ($start_date != "")	$where .= " AND added>='$start_date 00:00:00' ";
    if ($end_date != "")	$where .= " AND added<='$end_date 23:59:59' ";
}
///////////////////////////////////////////////////////

if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) { $page = (int)$_GET['page']; } else { $page = 1; }
$from = ($page-1)*$results_per_page;

if (isset($_GET['date']) && $_GET['date'] != "")
{
    $today		= date("Y-m-d");
    $yesterday	= date("Y-m-d", mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));

    $date = trim($_GET['date']);

    switch ($date)
    {
        case "today":		$title2 = "Aujourd'hui";			$where .= " AND date(added)='$today' "; break;
        case "yesterday":	$title2 = "Hier";		$where .= " AND date(added)='$yesterday' "; break;
        case "7days":		$title2 = "7 derniers jours";	$where .= " AND date_sub(curdate(), interval 7 day) <= added "; break;
        case "30days":		$title2 = "30 derniers jours";	$where .= " AND date_sub(curdate(), interval 30 day) <= added "; break;
        default:			$title2 = "";				$where = "";							break;
    }
}

$store = 0;

if (isset($_GET['store']) && is_numeric($_GET['store']))
{
    $store = (int)$_GET['store'];
    $where .= " AND retailer_id='$store' ";
    $title2 = GetStoreName($store);
}

if (isset($_GET['user']) && is_numeric($_GET['user']))
{
    $user = (int)$_GET['user'];
    $where .= " AND user_id='$user' ";
    $title2 = GetUsername($user)."'s";
}

$query = "SELECT *, DATE_FORMAT(added, '%e %b %Y %h:%i:%s %p') AS click_date FROM cashbackengine_clickhistory WHERE $where ORDER BY $rrorder $rorder LIMIT $from, $results_per_page";

$result = smart_mysql_query($query);
$total_on_page = mysqli_num_rows($result);

$query2 = "SELECT * FROM cashbackengine_clickhistory WHERE ".$where;
$result2 = smart_mysql_query($query2);
$total = mysqli_num_rows($result2);

$cc = 0;

// clear clicks history
if (isset($_GET['act']) && $_GET['act'] == "delete_clicks")
{
    smart_mysql_query("DELETE FROM cashbackengine_clickhistory");
    header("Location: ". url_panel ."/clicks.php?msg=clicks_deleted");
    exit();
}


$title = $title2." Historique de click";
require_once ("cashback/inc/header.inc.php");

?>

    <div id="addnew">
        <a href="javascript:void(0);" class="search" onclick="$('#admin_filter').toggle('slow');">Recherche</a>
        <a href="#" onclick="if (confirm('êtes vous sure de vouloir vider l\'historique ?') )location.href='<?= url_panel ?>/clicks.php?act=delete_clicks'" title="Delete"><img src="<?= url_panel ?>/cashback/images/idelete.png" align="absmiddle" /> Vider l'historisque</a>
    </div>

    <h2><?php echo $title2; ?> Historique de clique</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] != "") { ?>
    <div class="success_box">
        <?php

        switch ($_GET['msg'])
        {
            case "deleted": echo "La suppression a été ok"; break;
            case "clicks_deleted": echo "L'historique a été vidé"; break;
        }

        ?>
    </div>
<?php } ?>

<?php if (!empty($store)) { ?>
    <div style="width: 99%; background: #F7F7F7; border-bottom: 1px solid #EEE; padding: 10px 4px; text-align: right;">
        Total cashback visité : <span style="color: #FFF; background: #D67208; padding: 2px 4px;"><?php echo GetVisitsTotal($store); ?></span> &nbsp;&nbsp;&nbsp;&nbsp;
        Visite membre : <span style="color: #FFF; background: #61E236; padding: 2px 4px;"><?php echo GetMembersVisitsTotal($store); ?></span> &nbsp;&nbsp;&nbsp;&nbsp;
        Visite anonyme: <span style="color: #FFF; background: #8C8C8C; padding: 2px 4px;"><?php echo GetGuestsVisitsTotal($store); ?></span>
    </div>
<?php } ?>


    <form id="form1" name="form1" method="get" action="">
        <table bgcolor="#F9F9F9" align="center" width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <td colspan="3" valign="middle" align="center">
                    <div class="admin_filter" id="admin_filter" style="<?php if (!isset($_GET['search']) || !$_GET['search']){ ?>display: none;<?php } ?> background: #F7F7F7; border-radius: 5px; padding: 8px;">
                        Recherche: <input type="text" name="filter" value="<?php echo $filter; ?>" class="textbox" size="35" title="Store Name or IP address" />&nbsp;&nbsp;
                        Date: <input type="text" name="start_date" id="start_date" value="<?php echo $start_date; ?>" size="10" maxlength="10" class="textbox" /> - <input type="text" name="end_date" id="end_date" value="<?php echo $end_date; ?>" size="10" maxlength="10" class="textbox" />
                        <input type="hidden" name="action" value="filter" />
                        <input type="submit" class="submit" name="search" value="recherche" />
                        <?php if ((isset($filter) && $filter != "") || $start_date || $end_date) { ?><a title="Cancel Search" href="<?= url_panel ?>/clicks.php"><img align="absmiddle" src="<?=  url_panel?>/cashback/images/icons/delete_filter.png" border="0" alt="Cancel Search" /></a><?php } ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap" width="47%" valign="middle" align="left">
                    Trier part:
                    <select name="column" id="column" onChange="document.form1.submit()">
                        <option value="added" <?php if (isset($_GET['column']) && $_GET['column'] == "added") echo "selected"; ?>>Date</option>
                        <option value="retailer_id" <?php if (isset($_GET['column']) && $_GET['column'] == "retailer_id") echo "selected"; ?>>Cashback</option>
                        <option value="user_id" <?php if (isset($_GET['column']) && $_GET['column'] == "user_id") echo "selected"; ?>>Utilisateur</option>
                        <option value="click_ip" <?php if (isset($_GET['column']) && $_GET['column'] == "click_ip") echo "selected"; ?>>Adresse IP</option>
                    </select>
                    <select name="order" id="order" onChange="document.form1.submit()">
                        <option value="desc" <?php if (isset($_GET['order']) && $_GET['order'] == "desc") echo "selected"; ?>>Descendant</option>
                        <option value="asc" <?php if (isset($_GET['order']) && $_GET['order'] == "asc") echo "selected"; ?>>Ascendant</option>
                    </select>
                    &nbsp;&nbsp;Voir:
                    <select name="show" id="show" onChange="document.form1.submit()">
                        <option value="20" <?php if (isset($_GET['order']) && $_GET['order'] == "20") echo "selected"; ?>>20</option>
                        <option value="50" <?php if (isset($_GET['order']) && $_GET['order'] == "50") echo "selected"; ?>>50</option>
                        <option value="100" <?php if (isset($_GET['order']) && $_GET['order'] == "100") echo "selected"; ?>>100</option>
                        <option value="111111111" <?php if (isset($_GET['order']) && $_GET['order'] == "111111111") echo "selected"; ?>>Tous</option>
                    </select>
                </td>
                <td nowrap="nowrap" width="30%" valign="middle" align="left">
                    <div style="background: #F7F7F7; padding: 7px 15px; border-radius: 7px;">
                        Magasin:
                        <select name="store" id="store" onChange="document.form1.submit()" style="width: 150px;" class="textbox2">
                            <option value="">--- Tous les magasins ---</option>
                            <?php
                            $sql_retailers = smart_mysql_query("SELECT * FROM cashbackengine_retailers ORDER BY title ASC");
                            if (mysqli_num_rows($sql_retailers) > 0)
                            {
                                while ($row_retailers = mysqli_fetch_array($sql_retailers))
                                {
                                    if ($store == $row_retailers['retailer_id']) $selected = " selected=\"selected\""; else $selected = "";
                                    if ($row_retailers['visits'] == 0) $vletter = ""; elseif ($row_retailers['visits'] == 1) $vletter = " visit"; else $vletter = " visits";
                                    echo "<option value=\"".$row_retailers['retailer_id']."\"".$selected.">".$row_retailers['title']." (".number_format($row_retailers['visits']).$vletter.")</option>";
                                }
                            }
                            ?>
                        </select>
                        <?php if ($store > 0) { ?><a href="<?= url_panel ?>/clicks.php"><img align="absmiddle" src="<?= url_panel ?>/cashback/images/icons/delete_filter.png" border="0" alt="Delete Filter" /></a><?php } ?>
                    </div>
                </td>
                <td nowrap="nowrap" width="35%" valign="middle" align="right">
                    <?php if ($total > 0) { ?>
                        Showing <?php echo ($from + 1); ?> - <?php echo min($from + $total_on_page, $total); ?> of <?php echo $total; ?>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </form>


<?php if ($total > 0) { ?>

    <form id="form2" name="form2" method="post" action="">
        <table align="center" class="tbl" width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
                <th width="15%"><b>Id click</b></th>
                <th width="22%"><b>Membre</b></th>
                <th width="30%"><b>Cashback / Magasin</b></th>
                <th width="15%"><b>Adresse IP</b></th>
                <th width="20%"><b>Date</b></th>
            </tr>
            <?php while ($row = mysqli_fetch_array($result)) { $cc++; ?>
                <tr height="25" class="<?php if (($cc%2) == 0) echo "even"; else echo "odd"; ?>">
                    <td nowrap="nowrap" align="center" valign="middle"><?php echo $row['click_id']; //$row['click_ref'] ?></td>
                    <td align="left" valign="middle"><a href="#" class="user"><?php echo GetUsername($row['user_id']); ?></a></td>
                    <td align="left" valign="middle"><a href="<?= url_panel ?>/retailer_details.php?id=<?php echo $row['retailer_id']; ?>"><?php echo GetStoreName($row['retailer_id']); ?></a></td>
                    <td align="center" valign="middle"><?php echo $row['click_ip']; ?></td>
                    <td nowrap align="center" valign="middle"><?php echo $row['click_date']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </form>

    <?php
    $columns    =   isset($_GET['column']) ? $_GET['column'] : '';
    $order      =   isset($_GET['order']) ? $_GET['order'] : '';
    echo ShowPagination("clickhistory",$results_per_page,"clicks.php?column=". $columns ."&order=". $order ."&action=$action&show=$results_per_page&", "WHERE ".$where); ?>

<?php }else{ ?>
    <?php if (isset($filter)) { ?>
        <div class="info_box">Aucun résultat. <a href="clicks.php">Rechercher encore &#155;</a></div>
    <?php }else{ ?>
        <div class="info_box">Aucun click à cette date.</div>
    <?php } ?>
<?php } ?>

<?php require_once("./cashback/inc/footer.inc.php"); ?>


