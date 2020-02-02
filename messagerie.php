<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Messagerie';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');

$mbre_pseudo = $mbrePrenom . " " . $mbreNom;
?>
<style>
    .bouton_messagerie {
        background-color: #5b9bdb;
        color: white;
        border: 10px solid #5b9bdb;
        width: 150px;
        border-radius: 5px;
        text-align: center;
    }
</style>

<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">
        <div class="container" style="padding-left: 0; margin-left: 0; width: 100%;">
            <div class="row">
                <?php include('./requiert/inc-menu-right.php'); ?>
                <div class="col-md-8 col-xs-12 xs-m-b-20">
                    <div class="bg-light-grey b-r-10 p-20 b-special-grey">
                        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-book m-r-10"></i> Messagerie</div>

                        <div class="f-s-13 f-w-light m-b-20">
                            <div class="bg-light-grey color-black p-10-20 f-s-14 b-r-10 b-special-grey m-b-20" align="justify">
                                Vous aimez notre site ou vous souhaitez contribuer à son amélioration ?<br />
                                N'hésitez pas à nous le faire savoir en remplissant le Livre d'or.
                            </div>
                            <?php
                            if (isset($_SESSION['id'])) {
                                
                                if (isset($_GET['a'])) {
                                    $a = addslashes(htmlentities($_GET['a']));
                                }
                                if (isset($_GET['idmessage'])) {
                                    $idmessage = addslashes(htmlentities($_GET['idmessage']));
                                }
                                if (isset($_POST['idm'])) {
                                    $idm = addslashes(htmlentities($_GET['idm']));
                                } else {
                                    $idm = NULL;
                                }

                                if (empty($a)) {
                                    ?>

                                    <div style="margin-bottom : 10px; text-align : left;">
                                        <a href="./messagerie.php?a=send" style="text-decoration : none;">
                                            <div class="bouton_messagerie">Envoyer un message</div>
                                        </a>
                                    </div>

                                    <table width="100%" cellpadding="0" cellspacing="0" class="table_offers">
                                        <tr>
                                            <th width="15%" align="middle">Date</th>
                                            <th width="20%" align="middle">De</th>
                                            <th align="middle">Titre</th>
                                        </tr>

                                        <?php
                                        $Cwall = $pdo->query("SELECT COUNT(*) as nbr_entrees FROM messagerie WHERE titre != '' AND (user = '" . $mbre_pseudo . "' OR  user2 = '" . $mbre_pseudo . "')");
                                        $Cdones_offer = $Cwall->fetch(PDO::FETCH_ASSOC);

                                        $i = 0;
                                        if ($Cdones_offer['nbr_entrees'] == 0) {
                                            ?>

                                            <tr>
                                                <td height="30" colspan="3" align="middle">
                                                    Vous n'avez aucun message actuellement...
                                                </td>
                                            </tr>

                                            <?php
                                        } else {
                                            $wall = $pdo->query("SELECT id2, titre, user, user2, date, lu FROM messagerie WHERE titre != '' AND (user = '" . $mbre_pseudo . "' OR user2 = '" . $mbre_pseudo . "') AND user != '' ORDER BY id DESC");
                                            $i = 0;
                                            $all_wall = $wall->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($all_wall as $dones_offer) {

                                                $CwallC = $pdo->query("SELECT COUNT(*) as nbr_entrees FROM messagerie WHERE id2 = '" . $dones_offer['id2'] . "' AND lu = 0 AND user != '" . $mbre_pseudo . "'");
                                                $Cdones_offerC = $CwallC->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <tr>
                                                    <td height="25" align="middle">
                                                        Le <?php echo $dones_offer['date']; ?></td>
                                                    <td height="25" align="middle"><?php echo $dones_offer['user']; ?></td>
                                                    <td align="middle">
                                                        <a href="./messagerie.php?a=voir&idmessage=<?php echo $dones_offer['id2']; ?>" style="text-decoration : none;"><?php if ($Cdones_offerC['nbr_entrees'] > 0) { ?><div style="color : #444; border-bottom : 1px dotted black; display : inline;"><?php echo $dones_offer['titre']; ?></div><?php } else { ?><?php echo $dones_offer['titre']; ?><?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </table>

                                    <div class="erreur" style="font-weight : bold; display : block; color : red;">Les messageries sont contrôlés relativement souvent, la publicité est interdite !
                                    </div>

                                    <?php
                                } else if ($a == 'voir') {
                                    ?>

                                    <div style="margin-bottom : 10px; text-align : left;">
                                        <a href="./messagerie.php" style="text-decoration : none;">
                                            <div class="bouton_messagerie">Retour à la messagerie</div>
                                        </a>
                                    </div>

                                    <?php
                                    $Cwall = $pdo->query("SELECT titre, user, user2 FROM messagerie WHERE id2 = '" . $idmessage . "'");
                                    $Cdones_offer = $Cwall->fetch(PDO::FETCH_ASSOC);

                                    if ($Cdones_offer['user'] == $mbre_pseudo) {
                                        $sonuser = $Cdones_offer['user2'];
                                    } else if ($Cdones_offer['user2'] == $mbre_pseudo) {
                                        $sonuser = $Cdones_offer['user'];
                                    }

                                    if ($Cdones_offer['titre'] != '') {
                                        $pdo->exec("UPDATE messagerie SET lu = '1' WHERE id2 = '" . $idmessage . "' AND user2 = '" . $mbre_pseudo . "'");

                                        if (!empty($_POST['contact_valider'])) {
                                            $message = nl2br(addslashes($_POST['message']));

                                            if ($message == NULL) { //On verifie que les variables précédentes ne soient pas vide
                                                ?>

                                                <div class="erreur" style="margin-top:10px;margin-bottom:5px;display:block;">Veuillez entrer un message valide...</div>

                                                <?php
                                            } else { //Si tout est bon on entre les données dans la BDD et on envoye le mail
                                                ?>
                                                <div class="erreur" style="margin-top:10px;margin-bottom:5px;display:block;">Votre message a bien été envoyé.</div>
                                                <?php
                                                $date = date('d/m/Y à H:i');
                                                $pdo->exec("INSERT INTO `messagerie` (`id2`, `titre`, `message`, `user`, `user2`, `date`) VALUES ('" . $idmessage . "', 'Re: " . $Cdones_offer['titre'] . "', '" . $message . "', '" . $mbre_pseudo . "', '" . $sonuser . "', '" . date('d/m/Y à H:i:s') . "')");
                                            }
                                        }
                                        ?>

                                        <table width="100%" cellpadding="0" cellspacing="0" class="table_offers">
                                            <tr>
                                                <th width="95%" align="left" valign="middle"><?php echo $Cdones_offer['titre']; ?></th>
                                                <th width="5%" align="left" valign="middle"></th>
                                            </tr>

                                            <?php
                                            $wall = $pdo->query("SELECT user, message, date FROM messagerie WHERE id2 = '" . $idmessage . "' ORDER BY id DESC");
                                            $i = 0;
                                            $all_wall = $wall->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($all_wall as $dones_offer) {
                                                ?>
                                                <tr>
                                                    <td height="25" align="left"
                                                        valign="middle" style="border-bottom : 1px solid #444;">
                                                        <div style="margin-bottom:5px;">
                                                            <i><strong><?php if ($dones_offer['user'] == $mbre_pseudo) { ?>Vous<?php
                                                                    } else {
                                                                        echo '<a href="./p-' . $dones_offer['user'] . '.php" target="_blank">' . $dones_offer['user'] . '</a>';
                                                                    }
                                                                    ?></strong>, le <?php echo $dones_offer['date']; ?></i></div>
                                                        <?php echo $dones_offer['message']; ?>
                                                    </td>
                                                    <td align="left" valign="middle" style="border-bottom : 1px solid #444;"></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>

                                        </table>

                                        <div class="bouton_messagerie" style="margin : 10px 0px; background-color : #1a9cd7; display : block;">Envoyer un message :</div>

                                        <div class="row" align="center">
                                            <div class="bg-light-grey p-20 b-r-10 b-5-blue">
                                                <form method="POST">
                                                    <textarea name="message" class="input_basic" style="height : 100px;"placeholder="Entrez ici votre message"></textarea><br/><br/>
                                                    <input type="submit" name="contact_valider" value="Envoyer"/></td>
                                                </form>

                                                <?php
                                            }
                                        } else if ($a == 'send') {
                                            $users_list = array();
                                            $sql = "SELECT id,nom,prenom FROM users WHERE id != '" . $mbreId . "'";
                                            foreach ($pdo->query($sql) as $row) {
                                                $users_list[$row['id']] = $row['prenom'] . " " . $row['nom'];
                                            }

                                            $userC = $pdo->query("SELECT COUNT(*) as nbr_entrees FROM users WHERE id = '" . $idm . "'");
                                            $userCs = $userC->fetch(PDO::FETCH_ASSOC);

                                            if ($idm == NULL OR $userCs['nbr_entrees'] == 1) {
                                                if (!empty($_POST['contact_valider'])) {
                                                    if ($idm == NULL) {
                                                        if (!empty($_POST['idmembre'])) {
                                                            $idmembre = addslashes($_POST['idmembre']);
                                                        } else {
                                                            $idmembre = NULL;
                                                        }
                                                    } else {
                                                        $idmembre = $idm;
                                                    }

                                                    $sujet = addslashes($_POST['sujet']);
                                                    $message = nl2br(addslashes($_POST['message']));

                                                    if ($sujet == NULL or $message == NULL or $idmembre == NULL) { //On verifie que les variables précédentes ne soient pas vide
                                                        $repons = 'Un ou plusieurs champs ne sont pas remplis.';
                                                    } else { //Si tout est bon on entre les données dans la BDD et on envoye le mail
                                                        $idmsg = code(15);

                                                        $user = $pdo->query("SELECT COUNT(*), nom, prenom, email FROM users WHERE id = '" . $idmembre . "'");
                                                        $users = $user->fetch(PDO::FETCH_ASSOC);
                                                        $email = $users['email'];
                                                        $user = $users['prenom'] . " " . $users['nom'];

                                                        if ($users['COUNT(*)'] == 1) {
                                                            $repons = 'Votre message a bien été envoyé.';
                                                            $date = date('d/m/Y à H:i');
                                                            $pdo->exec("INSERT INTO `messagerie` (`id2`, `titre`, `message`, `user`, `user2`, `date`) VALUES ('" . $idmsg . "', '" . $sujet . "', '" . $message . "', '" . $mbre_pseudo . "', '" . $user . "', '" . date('d/m/Y à H:i:s') . "')");
                                                        } else {
                                                            $repons = 'Ce membre n\'existe pas.';
                                                        }
                                                    }
                                                }
                                                ?>

                                                <div style="margin-bottom : 10px; text-align : left;">
                                                    <a href="./messagerie.php" style="text-decoration : none;">
                                                        <div class="bouton_messagerie">Retour à la messagerie</div>
                                                    </a>
                                                </div>

                                                <?php
                                                if (!empty($repons)) {
                                                    ?>

                                                    <div class="erreur" style="margin-bottom : 10px; display : block;"><?php echo $repons; ?></div>

                                                    <?php
                                                }
                                                ?>

                                                <form method="POST" class="user_membre_form">
                                                    <div class="m-b-10"><select name="idmembre">
                                                            <?php
                                                            foreach ($users_list as $id => $infos) {
                                                                echo "<option value='" . $id . "'>" . $infos . "</option>";
                                                            }
                                                            ?>
                                                        </select></div>

                                                    <input type="text" name="sujet" class="input-xs b-r-5 f-s-12 m-b-10 m-r-10" value="" placeholder="Sujet de votre message" /><br/><br/>

                                                    <textarea name="message" class="input-md m-b-10 b-r-5 f-s-12" style="height : 100px;"
                                                              placeholder="Entrez ici votre message"></textarea><br/><br/>

                                                    <input type="submit" name="contact_valider" value="Envoyer" style="width:25%; background-color: #00d7b3; color: white; border: 10px solid #00d7b3; border-radius: 5px; "/>
                                                </form>

                                                <?php
                                            } else {
                                                ?>

                                                <div class="erreur" style="display : block;">Vous n'êtes pas autorisé à envoyer un message à ce membre !</div>

                                                <?php
                                            }
                                        }
                                    } else {
                                        echo $non_connecte;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include('./requiert/inc-footer.php');
?>