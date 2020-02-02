<?php

//session_start();
//require_once("./cashback/inc/adm_auth.inc.php");
include('./requiert/php-global.php');
require_once("./cashback/inc/config.inc.php");
require_once("./cashback/inc/admin_funcs.inc.php");


if (isset($_POST['action']) && $_POST['action'] == "addnetwork")
{
    unset($errs);
    $errs = array();
    
    $network_name	= mysqli_real_escape_string($conn, getPostParameter('network_name'));
    $subid			= mysqli_real_escape_string($conn, getPostParameter('subid'));
    $csv_format		= mysqli_real_escape_string($conn, $_POST['csv_format']);
    $confirmeds		= mysqli_real_escape_string($conn, str_replace("\r\n", "|", getPostParameter('confirmeds')));
    $pendings		= mysqli_real_escape_string($conn, str_replace("\r\n", "|", getPostParameter('pendings')));
    $declineds		= mysqli_real_escape_string($conn, str_replace("\r\n", "|", getPostParameter('declineds')));

    if(!($network_name))
    {
        $errs[] = "Entrer le nom du programme d'affiliation";
    }
    else
    {
        $check_query = smart_mysql_query("SELECT * FROM cashbackengine_affnetworks WHERE network_name='$network_name'");
        if (mysqli_num_rows($check_query) != 0)
        {
            $errs[] = "Ce réseau d'affiliation existe déjà";
        }
    }

    if (count($errs) == 0)
    {
        $sql = "INSERT INTO cashbackengine_affnetworks SET network_name='$network_name', subid='$subid', csv_format='$csv_format', confirmeds='$confirmeds', pendings='$pendings', declineds='$declineds', status='active', added=NOW(), last_csv_upload=NOW()";

        if (smart_mysql_query($sql))
        {
            header("Location: ". url_panel ."/afftnetwork.php?msg=added");
            exit();
        }
    }
    else
    {
        $errormsg = "";
        foreach ($errs as $errorname)
            $errormsg .= "&#155; ".$errorname."<br/>";
    }

}

$title = "Add New Affiliate Network";
require_once ("cashback/inc/header.inc.php");

?>

    <div id="addnew"><a href="<?= url_panel ?>/affnetwork_edit.php?id=1" target="_blank">exemple de paramètres</a> / <a href="<?= url_panel ?>/cashback/csv_examples/cj_report.csv" style="color: #87CE04"><img src="<?= url_panel ?>/cashback/images/csv.png" align="absmiddle" /> Exemple rapport CSV</a></div>

    <h2>Ajouter un réseau d'affiliation</h2>

<?php if (isset($errormsg) && $errormsg != "") { ?>
    <div class="error_box"><?php echo $errormsg; ?></div>
<?php } ?>

    <form action="" method="post">
        <table width="100%" align="center" cellpadding="2" cellspacing="3"  border="0">
            <tr>
                <td nowrap="nowrap" valign="middle" align="right" class="tb1">
                    Nom du réseau
                </td>
                <td valign="top"><input type="text" name="network_name" id="network_name" value="<?php echo getPostParameter('network_name'); ?>" size="40" class="textbox" /></td>
            </tr>
            <tr>
                <td bgcolor="#F9F9F9" nowrap="nowrap" colspan="2" valign="top" align="center">
                    <p>Veuillez entrer un enregistrement de votre rapport CSV dans le champ ci-dessous. Et remplacez les valeurs nécessaires par nos variables requises.</p>
                    <p>
                    <table width="60%" align="center" cellpadding="2" cellspacing="3"  border="0">
                        <tr valign="middle"><td align="right"><b>{TRANSACTIONID}</b></td><td align="left">- Identifiant transaction (ID Commande)</td></tr>
                        <tr valign="middle"><td align="right"><b>{PROGRAMID}</b></td><td align="left">- ID de programme de votre réseau d'affiliation</td></tr>
                        <tr valign="middle"><td align="right"><b>{USERID}</b></td><td align="left">- SubID (SID)</td></tr>
                        <tr valign="middle"><td align="right"><b>{AMOUNT}</b></td><td align="left">- Montant de la vente</td></tr>
                        <tr valign="middle"><td align="right"><b>{COMMISSION}</b></td><td align="left">- Montant de la commission</td></tr>
                        <tr valign="middle"><td align="right"><b>{STATUS}</b></td><td align="left">- État de la transaction</td></tr>
                    </table>
                    </p>
                    <p>
                    <table width="100%" align="center" cellpadding="2" cellspacing="2" border="0">
                        <tr valign="middle"><td align="left"><font color="#FF9213"><b><u>Exemple de format CSV:</u></b></font></td></tr>
                        <tr valign="middle"><td align="left"><b>ligne originale de votre rapport CSV</b>:</td></tr>
                        <tr valign="middle"><td bgcolor="#EFDFFB" align="left">"4th Jan 2015","Sale","945643431","sim_sale","closed","No","40.95","12.28","3201921","UNIBET","296"</td></tr>
                        <tr valign="middle"><td align="left"><b>doit être remplacé par</b>:</td></tr>
                        <tr valign="middle"><td bgcolor="#E3FBD8" align="left">"4th Jan 2015","Sale","<span style="color: #E72085;">{TRANSACTIONID}</span>","sim_sale","<span style="color: #E72085;">{STATUS}</span>","No","<span style="color: #E72085;">{AMOUNT}</span>","<span style="color: #E72085;">{COMMISSION}</span>","<span style="color: #E72085;">{PROGRAMID}</span>","UNIBET","<span style="color: #E72085;">{USERID}</span>"</td></tr>
                    </table>
                    </p>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap" valign="middle" align="right" class="tb1">Format CSV:</td>
                <td valign="top"><textarea wrap="off" cols="120" rows="1" name="csv_format" class="textbox2"><?php echo getPostParameter('csv_format'); ?></textarea></td>
            </tr>
            <tr>
                <td nowrap="nowrap" valign="middle" align="right" class="tb1">États de transaction:<br/><span class="help">(un statut par ligne)</span></td>
                <td align="center" valign="top">
                    <table bgcolor="#F9F9F9" style="border: 1px solid #DDDDDD" width="100%" align="left" cellpadding="2" cellspacing="3"  border="0">
                        <tr>
                            <td align="center" valign="top">
                                <font color="#07D706"><b>Confirmé</b></font><br/><br/>
                                <textarea wrap="off" cols="20" rows="2" name="confirmeds" class="textbox2"><?php echo getPostParameter('confirmeds'); ?></textarea>
                            <td>
                            <td align="center" valign="top">
                                <font color="#F37007"><b>en attendant</b></font><br/><br/>
                                <textarea wrap="off" cols="20" rows="2" name="pendings" class="textbox2"><?php echo getPostParameter('pendings'); ?></textarea>
                            <td>
                            <td align="center" valign="top">
                                <font color="#FF000A"><b>Refusé</b></font><br/><br/>
                                <textarea wrap="off" cols="20" rows="2" name="declineds" class="textbox2"><?php echo getPostParameter('declineds'); ?></textarea>
                            <td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td nowrap="nowrap" valign="middle" align="right" class="tb1">Paramètre SubID:</td>
                <td valign="top"><input type="text" name="subid" id="subid" value="<?php echo getPostParameter('subid'); ?>" size="8" class="textbox" /><span class="note">Nom paramètre SubID</span></td>
            </tr>
            <tr>
                <td colspan="2" align="center" valign="middle">
                    <input type="hidden" name="action"id="action" value="addnetwork" />
                    <input type="submit" name="add" id="add" class="submit" value="Ajouter le réseau" />
                    <input type="button" class="cancel" name="cancel" value="Annuler" onClick="javascript:document.location.href='affnetwork.php'" />
                </td>
            </tr>
        </table>
    </form>


<?php require_once("./cashback/inc/footer.inc.php"); ?>


