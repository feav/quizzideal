<?php

include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");

$coupon_type = '';

if (isset($_POST['action']) && $_POST['action'] == "add")
{
    unset($errors);
    $errors = array();

    $coupon_type	= mysqli_real_escape_string($conn, getPostParameter('coupon_type'));
    $coupon_title	= mysqli_real_escape_string($conn, getPostParameter('coupon_title'));
    $retailer_id	= (int)getPostParameter('retailer_id');
    $code			= mysqli_real_escape_string($conn, getPostParameter('code'));
    $link			= mysqli_real_escape_string($conn, getPostParameter('link'));
    $start_date		= mysqli_real_escape_string($conn, getPostParameter('start_date'));
    $start_time		= mysqli_real_escape_string($conn, getPostParameter('start_time'));
    $end_date		= mysqli_real_escape_string($conn, getPostParameter('end_date'));
    $end_time		= mysqli_real_escape_string($conn, getPostParameter('end_time'));
    $coupon_start_date	= $start_date." ".$start_time;
    $coupon_end_date	= $end_date." ".$end_time;
    $description	= mysqli_real_escape_string($conn, nl2br(getPostParameter('description')));
    $exclusive		= (int)getPostParameter('exclusive');
    $sort_order		= (int)getPostParameter('sort_order');

    if (!($coupon_type && $coupon_title && $retailer_id))
    {
        $errors[] = "Veuillez vérifier que vous avez renseigné tous les champs avec *";
    }
    else
    {
        if (isset($link) && $link != "")
        {
            if (substr($link, 0, 7) != 'http://' && substr($link, 0, 8) != 'https://')
            {
                $errors[] = "Entrer une url correct genre 'http://' or 'https://'";
            }
            elseif ($link == 'http://' || $link == 'https://')
            {
                $errors[] = "Entrer une url valide";
            }
        }

        if (isset($end_date) && $end_date != "")
        {
            if (strtotime($end_date) < strtotime("now"))
            {
                $errors[] = "La date d'expiration est déjà passé, veuillez renseigner une date dans le futur";
            }
        }
    }

    if (count($errors) == 0)
    {
        $insert_sql = "INSERT INTO cashbackengine_coupons SET coupon_type='$coupon_type', title='$coupon_title', retailer_id='$retailer_id', user_id='0', code='$code', link='$link', start_date='$coupon_start_date', end_date='$coupon_end_date', description='$description', exclusive='$exclusive', sort_order='$sort_order', status='active', added=NOW()";
        $result = smart_mysql_query($insert_sql);
        $new_coupon_id = mysqli_insert_id($conn);

        header("Location: ". url_panel ."/coupons.php?msg=added");
        exit();
    }
    else
    {
        $errormsg = "";
        foreach ($errors as $errorname)
            $errormsg .= "&#155; ".$errorname."<br/>";
    }

}

$cc = 0;

$title = "Ajouter un coupon";
require_once ("cashback/inc/header.inc.php");

?>

    <h2>Ajouter un coupon</h2>


<?php if (isset($errormsg) && $errormsg != "") { ?>
    <div class="error_box"><?php echo $errormsg; ?></div>
<?php } elseif (isset($_GET['msg']) && ($_GET['msg']) == "added") { ?>
    <div class="success_box">Le coupon a été ajouté avec succès</div>
<?php } ?>


    <form action="" method="post" name="form1">
        <table bgcolor="#F9F9F9" width="100%" cellpadding="2" cellspacing="3" border="0" align="center">
            <tr>
                <td colspan="2" align="right" valign="top"><font color="red">* indique un champ obligatoire</font></td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Type offre:</td>
                <td valign="top">
                    <select name="coupon_type" id="coupon_type" class="textbox2" style="width: 190px;">
                        <option value="coupon" <?php if ($coupon_type == "coupon") echo "selected='selected'"; ?>>Code coupon</option>
                        <option value="printable" <?php if ($coupon_type == "printable") echo "selected='selected'"; ?>>Coupon imprimable</option>
                        <option value="discount" <?php if ($coupon_type == "discount") echo "selected='selected'"; ?>>Remise / Vente en ligne</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="40%" valign="middle" align="right" class="tb1"><span class="req">* </span>Title:</td>
                <td valign="top"><input type="text" name="coupon_title" id="coupon_title" value="<?php echo getPostParameter('coupon_title'); ?>" size="33" class="textbox" /></td>
            </tr>
            <tr>
                <td nowrap="nowrap" valign="middle" align="right" class="tb1"><span class="req">* </span>Store:</td>
                <td valign="top">
                    <select class="textbox2" id="retailer_id" name="retailer_id" style="width: 190px;">
                        <option value="">--- Sélectionner le magasin ---</option>
                        <?php

                        $sql_retailers = smart_mysql_query("SELECT * FROM cashbackengine_retailers WHERE status='active' ORDER BY title ASC");

                        while ($row_retailers = mysqli_fetch_array($sql_retailers))
                        {
                            if ($retailer_id == $row_retailers['retailer_id']) $selected = " selected=\"selected\""; else $selected = "";

                            echo "<option value=\"".$row_retailers['retailer_id']."\"".$selected.">".$row_retailers['title']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Code coupon :</td>
                <td valign="top"><input type="text" name="code" id="code" value="<?php echo getPostParameter('code'); ?>" size="33" class="textbox" /></td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Lien:</td>
                <td valign="top"><input type="text" name="link" id="link" value="<?php echo getPostParameter('link'); ?>" size="53" class="textbox" /></td>
            </tr>
            <script>
              $(function() {
                $('#start_date').calendricalDate();
                $('#end_date').calendricalDate();
                $('#start_time').calendricalTime({
                  minTime: {hour: 0, minute: 0},
                  maxTime: {hour: 23, minute: 59},
                  timeInterval: 30
                })
                $('#end_time').calendricalTime({
                  minTime: {hour: 0, minute: 0},
                  maxTime: {hour: 23, minute: 59},
                  timeInterval: 30
                })
              });
            </script>
            <tr>
                <td valign="middle" align="right" class="tb1">Date début:</td>
                <td valign="middle"><input type="text" name="start_date" id="start_date" value="<?php echo getPostParameter('start_date'); ?>" size="10"  maxlength="10" class="textbox" /> <input type="text" name="start_time" id="start_time" value="<?php echo getPostParameter('start_time'); ?>" size="6" maxlength="8" class="textbox" /><span class="note">YYYY-MM-DD &nbsp; HH:MM</span></td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Date expiration:</td>
                <td valign="middle"><input type="text" name="end_date" id="end_date" value="<?php echo getPostParameter('end_date'); ?>" size="10"  maxlength="10" class="textbox" /> <input type="text" name="end_time" id="end_time" value="<?php echo getPostParameter('end_time'); ?>" size="6" maxlength="8" class="textbox" /><span class="note">YYYY-MM-DD &nbsp; HH:MM</span></td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Description:</td>
                <td valign="top"><textarea name="description" cols="55" rows="6" class="textbox2"><?php echo getPostParameter('description'); ?></textarea></td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Ordre tri:</td>
                <td valign="middle"><input type="text" class="textbox" name="sort_order" value="<?php echo getPostParameter('sort_order'); ?>" size="5" /></td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Exclusive?</td>
                <td valign="middle"><input type="checkbox" class="checkbox" name="exclusive" value="1" <?php if (getPostParameter('exclusive') == 1) echo "checked=\"checked\""; ?> />&nbsp;Oui!</td>
            </tr>
            <tr>
                <td align="center" colspan="2" valign="bottom">
                    <input type="hidden" name="action" id="action" value="add">
                    <input type="submit" class="submit" name="add" id="add" value="Ajouter le coupon" />
                </td>
            </tr>
        </table>
    </form>

<?php require_once("./cashback/inc/footer.inc.php"); ?>