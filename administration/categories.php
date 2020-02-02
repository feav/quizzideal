<?php

include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");


$query = "SELECT * FROM cashbackengine_categories ORDER BY sort_order, name";
$result = smart_mysql_query($query);
$total = mysqli_num_rows($result);

$cc = 0;

$title = "Categories";
require_once ("cashback/inc/header.inc.php");

?>

    <div id="addnew"><a class="addnew" href="category_add.php">Ajouter une catégorie</a></div>

    <h2>Categories</h2>

<?php if ($total > 0) { ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] != "") { ?>
        <div style="width:60%;" class="success_box">
            <?php

            switch ($_GET['msg'])
            {
                case "added":	echo "La catégorie a été ajoutée avec succès"; break;
                case "exists":	echo "Désolé, une catégorie existe déjà avec ce nom"; break;
                case "updated": echo "La catégorie a été mise à jour"; break;
                case "deleted": echo "La catégorie a été supprimé"; break;
            }

            ?>
        </div>
    <?php } ?>

    <table align="center" class="tbl" width="60%" border="0" cellpadding="3" cellspacing="0">
        <tr>
            <th class="noborder" width="5%">&nbsp;</th>
            <th width="65%">Nom de la catégorie</th>
            <th width="15%">Cashback/Revendeur</th>
            <th width="15%">Actions</th>
        </tr>
        <?php $allcategories = array(); $allcategories = CategoriesList(0); foreach ($allcategories as $category_id => $category_name) { $cc++; ?>
            <tr class="<?php if (($cc%2) == 0) echo "even"; else echo "odd"; ?>">
                <td align="center"><img src="<?= url_panel ?>/cashback/images/icons/cat.png" /></td>
                <td align="left" valign="middle" class="row_title"><a href="category_edit.php?id=<?php echo $category_id; ?>"><?php echo $category_name; ?></a></td>
                <td align="center" valign="middle"><?php echo CategoryTotalItems($category_id); ?></td>
                <td nowrap="nowrap" align="center" valign="middle">
                    <a href="<?= url_panel ?>/category_edit.php?id=<?php echo $category_id; ?>" title="Edit"><img border="0" alt="Edit" src="<?= url_panel ?>/cashback/images/edit.png" /></a>
                    <a href="#" onclick="if (confirm('Êtes-vous sûr de vouloir vraiment supprimer cette catégorie ?') )location.href='<?= url_panel ?>/category_delete.php?id=<?php echo $category_id; ?>'" title="Delete"><img src="<?= url_panel ?>/cashback/images/delete.png" border="0" alt="Delete" /></a>
                </td>
            </tr>
        <?php } ?>
    </table>

<?php }else{ ?>
    <div class="info_box">Aucune catégorie enregistré.</div>
<?php } ?>

<?php require_once("./cashback/inc/footer.inc.php"); ?>