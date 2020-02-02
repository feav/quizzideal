<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Messagerie | Quizzdeal.fr';
	$nomPage = 'messagerie';

	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
?>
<div class="dashboard-body">
    <div class="dashboard-content">
        <section class="bg-light-grey absolute-section-1 margin-base">
            <div class="m-auto content p-40-20 container"><div class="row">
                    <div class="bg-blue color-white b-r-5 uppercase p-10 m-b-15" style="color:white;">Messagerie</div>

                    <?php
                    if (isset($_GET['a'])) { $a = addslashes(htmlentities($_GET['a'])); }
                    if (isset($_GET['idmessage'])) { $idmessage = addslashes(htmlentities($_GET['idmessage'])); }
                    if (isset($_GET['idm'])) { $idm = addslashes(htmlentities($_GET['idm'])); } else { $idm = NULL; }

                    if (empty($a)) {
                        ?>

                        <table width="100%" style="border:1px solid black;" cellpadding="0" cellspacing="0" class="table_1">
                            <tr style="background-color:#000;color:#FFF;font-weight:bold;">
                                <td align="middle">Date</td>
                                <td align="middle">Emetteur</td>
                                <td align="middle">Destinataire</td>
                                <td align="middle">Objet</td>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM messagerie WHERE titre != '' AND (user != '' AND user2 != '') ORDER BY id DESC";
                            foreach  ($pdo->query($sql) as $row) {
                                ?>
                                <tr style="background-color:#FFF;">
                                    <td height="30" align="middle"><?php echo $row['date']; ?></td>
                                    <td align="middle"><?php echo $row['user']; ?></td>
                                    <td align="middle"><?php echo $row['user2']; ?></td>
                                    <td align="middle"><a href="./messagerie.php?a=voir&idmessage=<?php echo $row['id2']; ?>"><?php echo $row['titre']; ?></a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>

                        <?php
                    } else if ($a == 'voir') {
                        $sql = $pdo->query("SELECT titre, user, user2 FROM messagerie WHERE id2 = '" . $idmessage . "'");
                        $Cdones_offer = $sql->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <table width="100%" cellpadding="0" cellspacing="0" class="table_offers">
                            <tr>
                                <th width="95%" align="left" valign="middle"><?php echo $Cdones_offer['titre']; ?></th>
                                <th width="5%" align="left" valign="middle"></th>
                            </tr>

                            <?php
                            $sql = $pdo->query("SELECT user, message, date FROM messagerie WHERE id2 = '" . $idmessage . "'");
                            $dones_buzz = $sql->fetch(PDO::FETCH_ASSOC);
                            ?>

                            <tr>
                                <td height="30" align="left" valign="middle">
                                    <div style="margin-bottom:5px;">
                                        <i><strong><?php echo $dones_buzz['user']; ?></strong>, le <?php echo $dones_buzz['date']; ?></i>
                                    </div>
                                    <hr/>
                                    <?php echo $dones_buzz['message']; ?>
                                </td>
                            </tr>
                            <?php
                            ?>
                        </table>
                        <?php
                    }
                    ?>

                </div></div>
        </section>
    </div>
</div>

<?php
	include('./requiert/inc-footer.php');
?>