<?php 
    include('./requiert/new-form/header.php');
    include('./requiert/php-form/login-register.php');
    
    
        $sql = "SELECT * FROM parrainage WHERE id = 1";
        $req = $pdo->query($sql);
        $par = $req->fetch(PDO::FETCH_ASSOC);
    ?>


    <div class="">
        <div class="row">
            <div>
                <h2>Parainage</h2>
            </div>
            <div class="row">

                    <!-- Item -->
                    <div class="col-lg-6 col-md-6">
                        <div class="dashboard-stat color-1">
                            <div class="dashboard-stat-content">
                                <h4><?php echo displayMontant($mbreEuros, 3, ''); ?></h4>
                                <span>Gains disponibles (€)</span>
                            </div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Money"></i></div>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="col-lg-6 col-md-6">
                        <div class="dashboard-stat color-2">
                            <div class="dashboard-stat-content">
                                <h4><?php echo  displayMontant($totalAmoundAttente, 2, ''); ?></h4> 
                                <span>Gains en attente (€)</span>
                            </div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Over-Time"></i></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

<style type="text/css">
    a.navigation-table{
        width: 36px;
        font-size: 24px;
        background: #f91942;
        color: #fff;
        height: 36px;
        display: inline-block;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .table.group-nav{
        margin: 6px;
        text-align: right;
        padding-right: 6px;
    }
    .title-page{
        text-align: center;
        font-size: 28px;
        font-weight: 600;
    }
</style>
<div class="" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-12">
            <h4 class="headline centered ">
                DERNIERES TRANSACTIONS 
                <span>Les  <i>10</i> dernieres transactions sur votre compte</span>
            </h4>
            <table class="basic-table" rules="none" class="f-s-13 f-w-light">

                            <tr>
                                    <th align="left" valign="middle">Identifiant</th>
                                    <th align="left" valign="middle">Status</th>
                                    <th align="left" valign="middle">Date</th>
                                    <th align="right" valign="middle">Montant</th>
                            </tr>

                    <?php
                            $histoParticipations = $pdo->query("SELECT offerwall, idt, remuneration, date, etat FROM histo_offers WHERE idUser > 0 AND etat != 'En cours' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i') DESC LIMIT 0,5");
                            $all_histoParticipations = $histoParticipations->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($all_histoParticipations as $dones_histoParticipations) {
                                // var_dump($dones_histoParticipations);die();
                                $etat = $dones_histoParticipations['etat'];
                                if ($etat == 'Valid&eacute;') {
                                    $btn_etat = '<i class="im im-icon-Like color-green"></i>';
                                } else if ($etat == 'En cours') {
                                    $btn_etat = '<i class="im im-icon-Over-Time2 color-orange"></i>';
                                } else if ($etat == 'Refus&eacute;') {
                                    $btn_etat = '<i class="im im-icon-Unlike color-red"></i>';
                                }
                        ?>


                                <tr>
                                    <td align="left" valign="top"> <?php echo $dones_histoParticipations['idt']; ?></td>
                                    <td> <?php echo $btn_etat ?> <?= $etat ?></td>
                                    <td><i><?= $dones_histoParticipations['date']; ?></i></td>
                                    <td><?= displayMontant($dones_histoParticipations['remuneration'], 6, '') ?>€</td>
                                </tr>

                <?php } ?>

                            </table>
            <div class="table group-nav">
                <?php if ($pageActuelle != 1) {
                    $page_p = ($pageActuelle - 1); ?><a class="navigation-table" href="<?= url_site; ?>/gagnants.html?page=<?php echo $page_p; ?>"><i class="fa fa-angle-left"></i></a><?php } else { ?><i class="fa fa-angle-left"></i><?php } ?>
                <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) {
                    $page_s = ($pageActuelle + 1); ?><a class="navigation-table" href="<?= url_site; ?>/gagnants.html?page=<?php echo $page_s; ?>"><i class="fa fa-angle-right"></i></a><?php } else { ?><i class="fa fa-angle-right"></i><?php } ?> 
            </div>
                            <div class="clear"></div> 
        </div>
    </div>
</div>

<?php 
    include('./requiert/new-form/footer.php');
?>
