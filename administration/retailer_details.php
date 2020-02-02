<?php

include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    $pn			= (int)$_GET['pn'];
    $reviewid	= (int)$_GET['id'];

    $query = "SELECT *, DATE_FORMAT(added, '%e %b %Y %h:%i %p') AS date_added FROM cashbackengine_reviews WHERE review_id='$reviewid' LIMIT 1";
    $result = smart_mysql_query($query);
    $total = mysqli_num_rows($result);
}


$title = "Détails cashback";
require_once ("cashback/inc/header.inc.php");

?>

    <h2>Détails Cashback</h2>

<?php if ($total > 0) {

    $row = mysqli_fetch_array($result);

    ?>
    <table bgcolor="#F9F9F9" width="90%" cellpadding="2" cellspacing="3"  border="0" align="center">
        <tr>
        <tr>
            <td width="45%" valign="middle" align="right" class="tb1">Par:</td>
            <td valign="top"><a href="user_details.php?id=<?php echo $row['user_id']; ?>" class="user"><?php echo GetUsername($row['user_id']); ?></a></td>
        </tr>
        <tr>
            <td width="30%" valign="middle" align="right" class="tb1">Magasin:</td>
            <td width="70%" valign="top"><a href="retailer_details.php?id=<?php echo $row['retailer_id']; ?>"><?php echo GetStoreName($row['retailer_id']); ?></a></td>
        </tr>
        <tr>
            <td width="30%" valign="middle" align="right" class="tb1">Évaluation:</td>
            <td width="70%" valign="top"><img src="<?= url_panel ?>/cashback/images/icons/rating-<?php echo $row['rating']; ?>.gif" alt="<?php echo $row['rating']; ?> of 5" title="<?php echo $row['rating']; ?> of 5" /></td>
        </tr>
        <tr>
            <td width="30%" valign="middle" align="right" class="tb1">Titre:</td>
            <td width="70%" valign="top"><b><?php echo $row['review_title']; ?></b></td>
        </tr>
        <tr>
            <td valign="top" align="right" class="tb1">Revue:</td>
            <td valign="top"><?php echo $row['review']; ?></td>
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
                    case "pending": echo "<span class='pending_status'>En attente d'approbation</span>"; break;
                    case "active": echo "<span class='active_s'>".$row['status']."</span>"; break;
                    case "inactive": echo "<span class='inactive_s'>".$row['status']."</span>"; break;
                    default: echo "<span class='default_status'>".$row['status']."</span>"; break;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2" valign="bottom">
                <input type="button" class="submit" name="edit" value="Modifier la critique" onClick="javascript:document.location.href='review_edit.php?id=<?php echo $row['review_id']; ?>&page=<?php echo $pn; ?>&column=<?php echo $_GET['column']; ?>&order=<?php echo $_GET['order']; ?>'" /> &nbsp;
                <input type="button" class="cancel" name="cancel" value="Retour" onClick="javascript:document.location.href='reviews.php?page=<?php echo $pn; ?>&column=<?php echo $_GET['column']; ?>&order=<?php echo $_GET['order']; ?>'" />
            </td>
        </tr>
    </table>

<?php }else{ ?>
    <p align="center">Désolé, aucun commentaire trouvé.<br/><br/><a class="goback" href="#" onclick="history.go(-1);return false;">Retour</a></p>
<?php } ?>

<?php require_once("./cashback/inc/footer.inc.php"); ?>