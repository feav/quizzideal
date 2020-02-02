<?php


include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");


if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    $id = (int)$_GET['id'];

    $query = "SELECT * FROM cashbackengine_categories WHERE category_id='$id'";
    $rs = smart_mysql_query($query);
    $total = mysqli_num_rows($rs);
}


if (isset($_POST["action"]) && $_POST["action"] == "edit")
{
    unset($errors);
    $errors = array();

    $catid					= (int)getPostParameter('catid');
    $catname				= mysqli_real_escape_string($conn, getPostParameter('catname'));
    $category_description	= mysqli_real_escape_string($conn, nl2br(getPostParameter('description')));
    $parent_category		= (int)getPostParameter('parent_id');
    $meta_description		= mysqli_real_escape_string($conn, nl2br(getPostParameter('meta_description')));
    $meta_keywords			= mysqli_real_escape_string($conn, getPostParameter('meta_keywords'));
    $sort_order				= (int)getPostParameter('sort_order');

    if (!($catname && $catid))
    {
        $errors[] = "Veuillez entrer le nom de la catégorie";
    }

    if (count($errors) == 0)
    {
        smart_mysql_query("UPDATE cashbackengine_categories SET parent_id='$parent_category', name='$catname', description='$category_description', category_url='', meta_description='$meta_description', meta_keywords='$meta_keywords', sort_order='$sort_order' WHERE category_id='$catid'");

        header("Location: ". url_panel ."/categories.php?msg=updated");
        exit();
    }
    else
    {
        $errormsg = "";
        foreach ($errors as $errorname)
            $errormsg .= "&#155; ".$errorname."<br/>";
    }
}


$title = "Mise à jour catégorie";
require_once ("cashback/inc/header.inc.php");

?>


    <h2>Mise à jour catégorie</h2>

<?php

if ($total > 0) {

    $row = mysqli_fetch_array($rs);
    ?>

    <?php if (isset($errormsg) && $errormsg != "") { ?>
        <div style="width:95%;" class="error_box"><?php echo $errormsg; ?></div>
    <?php } ?>

    <form action="" method="post">
        <table bgcolor="#F9F9F9" width="100%" cellpadding="2" cellspacing="3"  border="0" align="center">
            <tr>
                <td colspan="2" align="right" valign="top"><font color="red">* dénote le champ obligatoire</font></td>
            </tr>
            <tr>
                <td width="30%" nowrap="nowrap" valign="middle" align="right" class="tb1"><span class="req">* </span>Nom catégorie:</td>
                <td valign="top"><input type="text" name="catname" id="catname" value="<?php echo $row['name']; ?>" size="40" class="textbox" /></td>
            </tr>
            <tr>
                <td nowrap="nowrap" valign="middle" align="right" class="tb1">Catégorie parente:</td>
                <td align="left">
                    <select name="parent_id">
                        <option value=""> ---------- None ---------- </option>
                        <?php CategoriesDropDown (0,"",$row['category_id'],$row['parent_id']); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap" valign="middle" align="right" class="tb1">Description:</td>
                <td align="left" valign="top"><textarea name="description" cols="75" rows="5" class="textbox2"><?php echo strip_tags($row['description']); ?></textarea></select>
                </td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Méta Description:</td>
                <td valign="top"><textarea name="meta_description" cols="75" rows="2" class="textbox2"><?php echo strip_tags($row['meta_description']); ?></textarea></td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Méta Mots-clés:</td>
                <td valign="top"><input type="text" name="meta_keywords" id="meta_keywords" value="<?php echo $row['meta_keywords']; ?>" size="78" style="width: 390px" class="textbox" /></td>
            </tr>
            <tr>
                <td valign="middle" align="right" class="tb1">Ordre de tri:</td>
                <td valign="middle"><input type="text" class="textbox" name="sort_order" value="<?php echo $row['sort_order']; ?>" size="5" /></td>
            </tr>
            <tr>
                <td align="center" colspan="2" valign="bottom">
                    <input type="hidden" name="catid" id="catid" value="<?php echo (int)$row['category_id']; ?>" />
                    <input type="hidden" name="action" id="action" value="edit">
                    <input type="submit" class="submit" name="update" id="update" value="Mettre à jour" />
                    <input type="button" class="cancel" name="cancel" value="Annuler" onClick="javascript:document.location.href= <?= url_panel ?>'/categories.php'" /></td>
            </tr>
        </table>
    </form>

<?php }else{ ?>
    <p align="center">
        Désolé, aucun réseau trouvé.<br/><br/>
        <a class="goback" href="#" onclick="history.go(-1);return false;">Retour</a>
    </p>
<?php } ?>

<?php require_once("./cashback/inc/footer.inc.php"); ?>