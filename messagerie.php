<?php
include('./requiert/new-form/header.php');

$meta_title = 'Quizzdeal.fr : Messagerie';
$meta_description = '';

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
    .container-wrapper{
        background: #f7f7f7;
    }
    .messages-box{
        padding: 0;
        margin-bottom: 35px;
        box-shadow: 0 0 12px 0 rgba(0,0,0,0.06);
        border-radius: 4px;
        background-color: #fff;
    }
    .send-new-msg{
        text-align: right;
        background: #fff;
        border-radius: 5px 5px 0 0;
        padding: 0;
        padding: 8px 0;
    }
</style>

    
<div class="container-wrapper">
    <div class="container">

    <h1 class="title-page">Messagerie</h1>

    <div class="row">
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
            <div class="col-md-8 col-md-offset-2 send-new-msg" style="text-align : right;">
                <a href="./messagerie.php?a=send" class="button">
                    Envoyer un message
                </a>
            </div>
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
                    ?>
                    <div class="messages-box col-md-8 col-md-offset-2">
                        
                        <div class="messages-inbox">
                            <ul>
                                <?php
                                foreach ($all_wall as $dones_offer) {

                                    $CwallC = $pdo->query("SELECT COUNT(*) as nbr_entrees FROM messagerie WHERE id2 = '" . $dones_offer['id2'] . "' AND lu = 0 AND user != '" . $mbre_pseudo . "'");
                                    $Cdones_offerC = $CwallC->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <li class="unread">
                                        <a href="javascript:void()" style="cursor: default;">
                                            <div class="message-avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>

                                            <div class="message-by">
                                                <div class="message-by-headline">
                                                    <h5><?php echo $dones_offer['user']; ?></h5>
                                                    <span><?php echo $dones_offer['date']; ?></span>
                                                </div>
                                                <p><?php if ($Cdones_offerC['nbr_entrees'] > 0) { ?><div style="color : #444; border-bottom : 1px dotted black; display : inline;"><?php echo $dones_offer['titre']; ?></div><?php } else { ?><?php echo $dones_offer['titre']; ?><?php } ?></p>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="erreur" style="font-weight : bold; display : block; color : red;">Les messageries sont contrôlés relativement souvent, la publicité est interdite !
                        </div>
                    </div>
                    <!-- Pagination 
                    <div class="clearfix"></div>
                    <div class="pagination-container margin-top-30 margin-bottom-0">
                        <nav class="pagination">
                            <ul>
                                <li><a href="#" class="current-page">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                    End -->
                <?php }
                ?>
            <?php
        } else if ($a == 'voir') {
            ?>
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

                        <div class="notification error closeable">
                            <p><span>Error!</span> Veuillez entrer un message valide...</p>
                            <a class="close" href="#"></a>
                        </div>

                        <?php
                    } else { //Si tout est bon on entre les données dans la BDD et on envoye le mail
                        ?>
                        <div class="notification success closeable">
                            <p><span>Success!</span> Votre message a bien été envoyé.</p>
                            <a class="close" href="#"></a>
                        </div>
                        <?php
                        $date = date('d/m/Y à H:i');
                        $pdo->exec("INSERT INTO `messagerie` (`id2`, `titre`, `message`, `user`, `user2`, `date`, `minute`) VALUES ('" . $idmessage . "', 'Re: " . $Cdones_offer['titre'] . "', '" . $message . "', '" . $mbre_pseudo . "', '" . $sonuser . "', '" . date('d/m/Y H:i:s') . "', '" . date('i') . "')");
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

                        <?php
                        if (!empty($repons)) {
                            ?>

                            <div class="notification success closeable col-md-8 col-md-offset-2">
                                <p><?php echo $repons; ?></p>
                                <a class="close" href="#"></a>
                            </div>

                            <?php
                        }
                        ?>

                        <form method="POST" class="user_membre_form  col-md-8 col-md-offset-2">
                            <div style="text-align : left;">
                                <a href="./messagerie.php"  style="text-decoration : none;     margin: 10px 0; display: inline-block;">
                                    <i class="fa fa-angle-left" style="font-size: 20px;"></i> Retour à la messagerie
                                </a>
                            </div>
                            <div class="m-b-10"><select name="idmembre">
                                    <?php
                                    foreach ($users_list as $id => $infos) {
                                        echo "<option value='" . $id . "'>" . $infos . "</option>";
                                    }
                                    ?>
                                </select></div>

                            <input type="text" name="sujet" class="input-xs b-r-5 f-s-12 m-b-10 m-r-10" value="" placeholder="Sujet de votre message" />

                            <textarea name="message" class="input-md m-b-10 b-r-5 f-s-12" style="height : 100px;"
                                      placeholder="Entrez ici votre message"></textarea>

                            <input type="submit" name="contact_valider" value="Envoyer"/>
                        </form>

                        <?php
                    } else {
                        ?>

                        <div class="notification error closeable">
                            <p><span>Error!</span> Vous n'êtes pas autorisé à envoyer un message à ce membre !</p>
                            <a class="close" href="#"></a>
                        </div>

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

<?php
include('./requiert/new-form/footer.php');
?>