<?php


include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");



if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    $pn			= (int)$_GET['pn'];
    $couponid	= (int)$_GET['id'];

    $query = "SELECT *, DATE_FORMAT(added, '%e %b %Y %h:%i %p') AS date_added, DATE_FORMAT(last_visit, '%e %b %Y %h:%i %p') AS last_used, DATE_FORMAT(start_date, '%e %b %Y %h:%i') AS coupon_start_date, DATE_FORMAT(end_date, '%e %b %Y %h:%i') AS coupon_end_date, UNIX_TIMESTAMP(end_date) - UNIX_TIMESTAMP() AS time_left, DATE(last_visit) as last_visit_date FROM cashbackengine_coupons WHERE coupon_id='$couponid' LIMIT 1";
    $result = smart_mysql_query($query);
    $total = mysqli_num_rows($result);

    smart_mysql_query("UPDATE cashbackengine_coupons SET viewed='1' WHERE coupon_id='$couponid' AND viewed='0'");
}


$title = "Détails coupon";
require_once ("cashback/inc/header.inc.php");

?>

    <h2>Détail coupon</h2>

<?php if ($total > 0) { $row = mysqli_fetch_array($result); ?>

    <img src="<?= url_panel ?>/images/icons/scissors.png" style="position: absolute; right: 150px; top: 18px;" />
    <table bgcolor="#F9F9F9" style="border: 1px dashed #eee;" width="100%" cellpadding="3" cellspacing="3"  border="0" align="center">
        <?php if ($row['exclusive'] == 1) { ?>
            <tr>
                <td colspan="2" align="right" align="right" valign="top"><img src="<?=  url_panel?>/images/icons/featured.png" align="absmiddle" /> <span style="color:#EF8407;">Exclusive  Coupon</span></td>
            </tr>
        <?php } ?>
        <?php if ($row['coupon_type'] != "") { ?>
            <tr>
                <td valign="top" align="right" class="tb1">Type offre:</td>
                <td valign="top">
                    <b>
                        <?php
                        switch ($row['coupon_type'])
                        {
                            case "coupon": echo "Code coupon"; break;
                            case "printable": echo "Coupon imprimable"; break;
                            case "discount": echo "Remise / Vente en ligne"; break;
                            default: echo $row['coupon_type']; break;
                        }
                        ?>
                    </b>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td width="45%" valign="middle" align="right" class="tb1">Titre:</td>
            <td valign="top"><b><?php echo $row['title']; ?></b></td>
        </tr>
        <?php if ($row['retailer_id'] > 0) { ?>
            <tr>
                <td valign="top" align="right" class="tb1">Magasin:</td>
                <td valign="top"><a href="retailer_details.php?id=<?php echo $row['retailer_id']; ?>"><?php echo GetStoreName($row['retailer_id']); ?></a></td>
            </tr>
        <?php } ?>
        <?php if ($row['code'] != "") { ?>
            <tr>
                <td valign="top" align="right" class="tb1">Code coupon:</td>
                <td valign="top"><?php echo $row['code']; ?></td>
            </tr>
        <?php } ?>
        <?php if ($row['link'] != "") { ?>
            <tr>
                <td valign="top" align="right" class="tb1">Lien:</td>
                <td valign="top"><?php echo $row['link']; ?></td>
            </tr>
        <?php } ?>
        <?php if ($row['start_date'] != "0000-00-00 00:00:00") { ?>
            <tr>
                <td valign="top" align="right" class="tb1">Date début:</td>
                <td valign="top"><?php echo $row['coupon_start_date']; ?></td>
            </tr>
        <?php } ?>
        <?php if ($row['end_date'] != "0000-00-00 00:00:00") { ?>
            <tr>
                <td valign="top" align="right" class="tb1">Date fin:</td>
                <td valign="top"><?php echo $row['coupon_end_date']; ?></td>
            </tr>
            <tr>
                <td valign="top" align="right" class="tb1">Expire dans:</td>
                <td valign="top"><?php if ($row['end_date'] != "0000-00-00 00:00:00") { echo GetTimeLeft($row['time_left']); }else{ echo "----"; } ?></td>
            </tr>
        <?php } ?>
        <?php if ($row['description'] != "") { ?>
            <tr>
                <td valign="top" align="right" class="tb1">Description:</td>
                <td valign="top"><?php echo $row['description']; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td valign="top" align="right" class="tb1">Ordre tri:</td>
            <td valign="top"><?php echo $row['sort_order']; ?></td>
        </tr>
        <tr>
            <td valign="top" align="right" class="tb1">Visits:</td>
            <td valign="top"><?php echo number_format($row['visits']); ?></td>
        </tr>
        <tr>
            <td valign="top" align="right" class="tb1">Visit aujourd'hui:</td>
            <td valign="top"><?php echo (date("Y-m-d") == $row['last_visit_date']) ? number_format($row['visits_today']) : "0"; ?></td>
        </tr>
        <?php if ($row['last_visit'] != "0000-00-00 00:00:00") { ?>
            <tr>
                <td valign="top" align="right" class="tb1">Dernier utilisation:</td>
                <td valign="top"><?php echo $row['last_used']; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td valign="top" align="right" class="tb1">Envoyer par :</td>
            <td valign="top">
                <?php if ($row['user_id'] == "0") { ?>
                    Administrateur
                <?php }elseif ($row['user_id'] == "11111111") { ?>
                    Anonyme
                <?php }elseif ($row['user_id'] > 0) { ?>
                    <a href="<?= url_panel ?>/user_details.php?id=<?php echo $row['user_id']; ?>" class="user"><?php echo GetUsername($row['user_id']); ?></a>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td valign="top" align="right" class="tb1">Date Ajout:</td>
            <td valign="top"><?php echo $row['date_added']; ?></td>
        </tr>
        <tr>
            <td valign="middle" align="right" class="tb1">Statut:</td>
            <td valign="top">
                <?php
                switch ($row['status'])
                {
                    case "active": echo "<span class='active_s'>".$row['status']."</span>"; break;
                    case "inactive": echo "<span class='inactive_s'>".$row['status']."</span>"; break;
                    case "expired": echo "<span class='expired_status' style='margin: 0;'>".$row['status']."</span>"; break;
                    default: echo "<span class='default_status'>".$row['status']."</span>"; break;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2" valign="bottom">
                <input type="button" class="submit" name="edit" value="Mise à jour coupon" onClick="javascript:document.location.href='<?= url_panel ?>/coupon_edit.php?id=<?php echo $row['coupon_id']; ?>&pn=<?php echo $pn; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : '' ; ?>&order=<?php echo isset($_GET['order']) ? $_GET['order'] : '' ; ?>'" /> &nbsp;
                <input type="button" class="cancel" name="cancel" value="Retour" onClick="javascript:document.location.href='<?= url_panel ?>/coupons.php?page=<?php echo $pn; ?>&column=<?php echo isset($_GET['column']) ? $_GET['column'] : '' ; ?>&order=<?php echo isset($_GET['order']) ? $_GET['order'] : ''; ?>'" />
            </td>
        </tr>
    </table>

<?php }else{ ?>
    <p align="center">Pas de coupon disponible.<br/><br/><a class="goback" href="#" onclick="history.go(-1);return false;">Retour</a></p>
<?php } ?>

<?php require_once("./cashback/inc/footer.inc.php"); ?>