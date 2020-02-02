<?php
/*include('./requiert/php-global.php');

$meta_title = 'Panel d\'administration : affiliation | Quizzdeal.fr';
$nomPage = 'affiliation';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
*/

//session_start();
//require_once("./cashback/inc/adm_auth.inc.php");
include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");


$query = "SELECT *, DATE_FORMAT(last_csv_upload, '%e %b %Y %h:%i %p') AS stats_update_date FROM cashbackengine_affnetworks ORDER BY status ASC";
$result = smart_mysql_query($query);
$total = mysqli_num_rows($result);

$title = "Affiliate Networks";
require_once("./cashback/inc/header.inc.php");

?>

<div id="addnew">
    <!--a style="color: #87CE04; padding-right: 20px;" href="http://www.cashbackengine.net/c/myproducts.php" target="_blank"><img src="cashback/images/icons/addons.png" align="absmiddle" /> <b>Buy Addons</b></a-->
    <a class="addnew" href="<?= url_panel ?>/afftnetwork_add.php">Ajouter une affiliation</a>
</div>

<h2>Réseaux d'affiliation</h2>

<?php if ($total > 0) { ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] != "") { ?>
        <div style="width:75%;" class="success_box">
            <?php

            switch ($_GET['msg'])
            {
                case "added":	echo "Le réseau d'affiliation a été ajouté avec succès"; break;
                case "updated": echo "Le réseau d'affiliation a été modifié avec succès"; break;
                case "deleted": echo "Le réseau d'affiliation a été supprimé avec succès"; break;
            }

            ?>
        </div>
    <?php } ?>

    <table align="center" class="tbl" width="75%" border="0" cellpadding="5" cellspacing="0">
        <tr>
            <th width="40%">Réseau d'affiliation</td>
            <th width="15%">Les détaillants</td>
            <th width="15%">Mise à jour Cashback</td>
            <th width="15%">Statut</td>
            <th width="15%">Actions</td>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td nowrap="nowrap" style="border-bottom: 1px #DCEAFB dotted;" valign="middle" class="row_title" align="center">
                    <?php if ($row['image'] != "") { ?>
                        <a href="<?= url_panel ?>/affnetwork_edit.php?id=<?php echo $row['network_id']; ?>"><img src="<?= url_panel ?>/cashback/images/networks/<?php echo $row['image']; ?>" alt="<?php echo $row['network_name']; ?>" title="<?php echo $row['network_name']; ?>" align="absmiddle" border="0" /></a>
                    <?php }else{ ?>
                        <a href="<?= url_panel ?>/affnetwork_edit.php?id=<?php echo $row['network_id']; ?>"><?php echo $row['network_name']; ?></a>
                    <?php } ?>
                </td>
                <td align="center" style="border-bottom: 1px #DCEAFB dotted;" valign="middle">
                    <span style="color:#777; background:#EEE; padding:3px 8px; border-radius: 3px;"><?php echo NetworkTotalRetailers($row['network_id']); ?></span>
                </td>
                <td align="center" style="border-bottom: 1px #DCEAFB dotted;" valign="middle"><?php echo ($row['last_csv_upload'] != "0000-00-00 00:00:00") ? $row['stats_update_date'] : "---"; ?></td>
                <td align="center" style="border-bottom: 1px #DCEAFB dotted;" valign="middle">
                    <?php if ($row['status'] == "inactive") echo "<span class='inactive_s'>".$row['status']."</span>"; else echo "<span class='active_s'>".$row['status']."</span>"; ?>
                </td>
                <td nowrap="nowrap" style="border-bottom: 1px #DCEAFB dotted;" align="center" valign="middle">
                    <a href="<?= url_panel ?>/affnetwork_edit.php?id=<?php echo $row['network_id']; ?>" title="Edit"><img src="<?= url_panel ?>/cashback/images/edit.png" border="0" alt="Edit" /></a>
                    <?php if ($row['network_id'] >= 1) { ?><a href="#" onclick="if (confirm('Êtes-vous sûr de vouloir vraiment supprimer ce réseau d\'affiliés?') )location.href='<?= url_panel ?>/affnetwork_delete.php?id=<?php echo $row['network_id']; ?>'" title="Delete"><img src="<?= url_panel ?>/cashback/images/delete.png" border="0" alt="Delete" /></a><?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

<?php }else{ ?>
    <div class="info_box">Aucun réseaux d'affiliation.</div>
<?php } ?>

<?php require_once("./cashback/inc/footer.inc.php"); ?>


