<?php
include('./requiert/php-global.php');

$meta_title = 'Panel d\'administration : Validations | Quizzdeal.fr';
$nomPage = 'validations';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
include('./requiert/php-form/validations.php');
?>

    <div class="dashboard-body">
        <div class="dashboard-content">
            <?php
            $totalPrevalidation = $pdo->query("SELECT COUNT(id) AS 'id' FROM histo_offers WHERE etat = 'En cours'");
            $totalPrevalidation = $totalPrevalidation->fetch(PDO::FETCH_ASSOC);
            $totalPrevalidation = $totalPrevalidation['id'];

            $totalPrevalidationC = $pdo->query("SELECT COUNT(id) AS 'idC' FROM histo_cashback WHERE etat = 'En attente'");
            $totalPrevalidationC = $totalPrevalidationC->fetch(PDO::FETCH_ASSOC);
            $totalPrevalidationC = $totalPrevalidationC['idC'];


            $totalValidation = $pdo->query("SELECT COUNT(id) AS 'id' FROM histo_offers WHERE etat = 'En attente'");
            $totalValidation = $totalValidation->fetch(PDO::FETCH_ASSOC);
            $totalValidation = $totalValidation['id'];

            // $totalValidationC = $pdo->query("SELECT COUNT(id) AS 'idC' FROM histo_cashback WHERE etat = 'En attente'");
            // $totalValidationC = $totalValidationC->fetch(PDO::FETCH_ASSOC);
            // $totalValidationC = $totalValidationC['idC'];
            ?>
            <!-- HEADLINE -->
            <div class="headline simple primary">
                <h4>Administration de validations</h4>
            </div>
            <!-- /HEADLINE -->
            <section class="bg-light-grey absolute-section-1 margin-base">
                <!-- PACK BOXES -->
                <div class="pack-boxes">
                    <!-- PACK BOX -->
                    <div class="pack-box">
                        <p class="text-header small">Pré-validation</p>
                        <p class="price larger"><?= $totalPrevalidation; ?></p>
                        <p class="credit">Cliquez pour voir les pré-validations</p>
                        <a href="<?= url_panel; ?>/validations.html?action=prevalidation" class="button dark-light">Voir</a>
                    </div>
                    <!-- /PACK BOX -->

                     <!-- PACK BOX -->
                    <div class="pack-box">
                        <p class="text-header small">Pré-validation Cashback</p>
                        <p class="price larger"><?= $totalPrevalidationC; ?></p>
                        <p class="credit">Cliquez pour voir les pré-validations</p>
                        <a href="<?= url_panel; ?>/validations.html?action=prevalidationCashback" class="button dark-light">Voir</a>
                    </div>
                    <!-- /PACK BOX -->

                    <!-- PACK BOX -->
                    <div class="pack-box">
                        <p class="text-header small">Validation</p>
                        <p class="price larger"><?= $totalValidation; ?></p>
                        <p class="credit">Cliquez pour voir les validations</p>
                        <a href="<?= url_panel; ?>/validations.html?action=validation" class="button dark-light">Voir</a>
                    </div>
                    <!-- /PACK BOX -->
                </div>
                <!-- /PACK BOXES -->
            </section>

            <?php
            if (isset($_GET['action'])) {
	            $sqlAction = '';
	            $get_date = ''; 
                $get_date_sql = '';
	            $get_idt = ''; 
                $get_idt_sql = '';
	            
                if ($_GET['action'] == 'prevalidation' || $_GET['action'] == 'prevalidationCashback') { $sqlAction = "WHERE etat = 'En cours'"; } else if ($_GET['action'] == 'validation') { $sqlAction = "WHERE etat = 'En attente'"; } else { $sqlAction = ''; }
                ?>
                <section class="bg-white absolute-section-1">
                    <div class="m-auto content p-40-20">

                        <?php
                        if ($_GET['action'] == 'validation') {

                            if (!empty($_GET['mois'])) { $get_date = $_GET['mois']; $get_date_sql = " AND date LIKE '%%".$get_date."%%'"; } else { $get_date_sql = ''; }
                            if (!empty($_GET['idt'])) { $get_idt = $_GET['idt']; $get_idt_sql = " AND idt LIKE '%%".$get_idt."%%'"; } else { $get_idt_sql = ''; }
                            ?>
                            <form name="form1" method="POST" action="" class="m-b-10">
                                <select name="date" class="m-r-10" onchange="loadPage(this.value);">
                                    <option value="" selected="selected">Sélectionnez une date</option>
                                    <option value="" disabled="disabled">-----</option>
                                    <?php
                                    $m = array('','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');

                                    for($i=(01-1); $i<=11; $i++)
                                    {
                                        $mois = $m[1+($i%12)];

                                        $i2 = $i+1;
                                        if ($i2 < 10) $i2 = '0'.$i2;
                                        ?>
                                        <option value="&mois=<?= $i2.'/'.date('Y'); ?>"<?php if ($get_date == $i2.'/'.date('Y')) { echo ' selected'; } ?>><?= $mois.' '.date('Y'); ?></option>
                                        <?php
                                    }
                                    ?>
                                    <option value="" disabled="disabled">-----</option>
                                    <?php
                                    for($i=(01-1); $i<=11; $i++)
                                    {
                                        $mois = $m[1+($i%12)];

                                        $i2 = $i+1;
                                        if ($i2 < 10) $i2 = '0'.$i2;
                                        ?>
                                        <option value="&mois=<?= $i2.'/'.(date('Y')-1); ?>"<?php if ($get_date == $i2.'/'.(date('Y')-1)) { echo ' selected'; } ?>><?= $mois.' '.(date('Y')-1); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php
                                if (!empty($_GET['mois']))
                                {
                                    ?>
                                    <select name="date" class="m-r-10" onchange="loadPage(this.value);">
                                        <option value="">Sélectionnez une campagne</option>
                                        <?php
                                        $idt = $pdo->query("SELECT * FROM histo_offers $sqlAction $get_date_sql GROUP BY idt ORDER BY idt");
                                        $all_idt = $idt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($all_idt as $dones_idt)
                                        {
                                            ?>
                                            <option value="&mois=<?= $get_date; ?>&idt=<?= $dones_idt['idt']; ?>"<?php if ($get_idt == $dones_idt['idt']) { echo ' selected'; } ?>><?= $dones_idt['idt']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                            </form>

                            <script>
                              <!--
                              function loadPage(param) {
                                self.location.href="http://www.quizzdeal.fr/administration/validations.html?action=validation"+param;
                              }
                              -->
                            </script>
                            <?php
                        }
                        ?>

                        <form method="POST">
                            <table rules="none" cellpadding="10" cellspacing="10" width="100%" bgcolor="#FFF" border="1">
                                <tr>
                                    <th align="left" valign="middle"></th>
                                    <th align="left" valign="middle">Date</th>
                                    <th align="left" valign="middle">Utilisateur / IP</th>
                                    <th align="left" valign="middle">Campagne</th>
                                    <th align="right" valign="middle">Gains</th>
                                </tr>
                                <?php
                                if ($_GET['action'] == 'prevalidation'){
                                $offer = $pdo->query("SELECT * FROM histo_offers $sqlAction $get_date_sql $get_idt_sql ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i:%s') DESC");
                                $all_offers = $offer->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($all_offers as $dones_offers)
                                {
                                    $sql_infoUser = $pdo->query("SELECT * FROM users WHERE hashId = '".$dones_offers['idUser']."'");
                                    $donnees_infoUser = $sql_infoUser->fetch(PDO::FETCH_ASSOC);
                                    $infoUser_nom = $donnees_infoUser['nom'];
                                    $infoUser_prenom = $donnees_infoUser['prenom'];
                                    ?>
                                    <tr>
                                        <td align="left" valign="middle" class="validation"><input type="checkbox" name="id[]" value="<?= $dones_offers['id']; ?>" style="display: block;"/></td>
                                        <td align="left" valign="middle">Le <?= $dones_offers['date']; ?></td>
                                        <td align="left" valign="middle"><?= $infoUser_prenom.' '.substr($infoUser_nom, 0, 1).'.'; ?> <div class="display-inline-block m-l-5 p-5 bg-grey f-s-10 b-r-5 uppercase f-w-light"><?= $dones_offers['ip']; ?></div></td>
                                        <td align="left" valign="middle"><?= $dones_offers['idt']; ?> <div class="display-inline-block m-l-5 p-5 bg-grey f-s-10 b-r-5 uppercase f-w-light"><?php if ($dones_offers['offerwall'] == '') echo 'Mission'; else echo $dones_offers['offerwall']; ?></div></td>
                                        <td align="right" valign="middle"><?= displayMontant($dones_offers['remuneration'], 6, ' €'); ?></td>
                                    </tr>

                                    <?php
                                }
                                ?>
                                <tr>
                                    <td align="left" valign="middle" colspan="2"><input type="button" id="toggle" value="Tout cocher" onClick="do_this()" class="button dark-light cursor-pointer"/></td>
                                    <td align="right" valign="middle" colspan="3">
                                        <input type="submit" name="submit_<?= $_GET['action']; ?>_valider" value="Valider" class="button primary cursor-pointer display-inline-block"/>
                                        <input type="submit" name="submit_<?= $_GET['action']; ?>_refuser" value="Refuser" class="display-inline-block button tertiary cursor-pointer"/></td>
                                </tr>
                            </table></form>
                            <?php
                            } else if($_GET['action'] == 'prevalidationCashback'){
                                $cashback = $pdo->query("SELECT hc.*, u.nom as nomU,u.prenom as prenomU, c.renumeration,c.pourcentage,c.nom,c.typecashback FROM histo_cashback hc, cashback c, users u WHERE hc.idCashback = c.id AND hc.idUser = u.id AND hc.etat = 'En attente' ORDER BY hc.date DESC");
                                $all_cashback = $cashback->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($all_cashback as $dataCashback) {
                                    ?>
                                    <tr>
                                        <td align="left" valign="middle" class="validation"><input type="checkbox" name="id[]" value="<?= $dataCashback['id']; ?>" style="display: block;"/></td>
                                        <td align="left" valign="middle">Le <?= date('d/m/Y H:i:s', strtotime($dataCashback['date']));?></td>
                                        <td align="left" valign="middle"><?= $dataCashback['prenomU'].' '.substr($dataCashback['nomU'], 0, 1).'.'; ?> <div class="display-inline-block m-l-5 p-5 bg-grey f-s-10 b-r-5 uppercase f-w-light"><?= $dataCashback['ip']; ?></div></td>
                                        <td align="left" valign="middle"><?= $dataCashback['nom']; ?> <div class="display-inline-block m-l-5 p-5 bg-grey f-s-10 b-r-5 uppercase f-w-light"><?= $dataCashback['typecashback'] ?></div></td>
                                        <td align="right" valign="middle"><?= displayMontant($dataCashback['renumeration'], 6, $dataCashback['pourcentage']); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                    <tr>
                                    <td align="left" valign="middle" colspan="2"><input type="button" id="toggle" value="Tout cocher" onClick="do_this()" class="button dark-light cursor-pointer"/></td>
                                    <td align="right" valign="middle" colspan="3">
                                        <input type="submit" name="submit_<?= $_GET['action']; ?>_valider" value="Valider" class="button primary cursor-pointer display-inline-block"/>
                                        <input type="submit" name="submit_<?= $_GET['action']; ?>_refuser" value="Refuser" class="display-inline-block button tertiary cursor-pointer"/></td>
                                </tr>
                            </table></form>
                                <?php
                                }
                                ?>
                    </div>
                </section>
                <?php
            }
            ?>
        </div>
    </div>
    <script type="text/javascript">
      function do_this()
      {
        var checkboxes = document.getElementsByName('id[]');
        var button = document.getElementById('toggle');

        if(button.value == 'Tout cocher'){
          for (var i in checkboxes){
            checkboxes[i].checked = 'FALSE';
          }
          button.value = 'Tout décocher'
        }else{
          for (var i in checkboxes){
            checkboxes[i].checked = '';
          }
          button.value = 'Tout cocher';
        }
      }
    </script>



<?php
include('./requiert/inc-footer.php');
?>