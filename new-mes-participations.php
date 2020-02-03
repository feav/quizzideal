<?php 
    include('./requiert/new-form/header.php');
    include('./requiert/php-form/login-register.php');
    
    $post_reg_mdp = addslashes(htmlentities("123"));


    $totalMissions = $pdo->query("SELECT COUNT(id) AS 'id' FROM offers WHERE actif = 1");
    $totalMissions = $totalMissions->fetch(PDO::FETCH_ASSOC);
    $totalMissions = $totalMissions['id'];

    $totalMissionsAttente = $pdo->query("SELECT COUNT(id) AS 'id' FROM histo_offers WHERE idUser = $mbreId AND etat = 'En cours'");
    $totalMissionsAttente = $totalMissionsAttente->fetch(PDO::FETCH_ASSOC);
    $totalMissionsAttente = $totalMissionsAttente['id'];

    $totalFilleuls = $pdo->query("SELECT COUNT(id) AS 'id' FROM users WHERE idParrain = $mbreId AND actif = 1");
    $totalFilleuls = $totalFilleuls->fetch(PDO::FETCH_ASSOC);
    $totalFilleuls = $totalFilleuls['id'];

    $totalCommandes = $pdo->query("SELECT COUNT(id) AS 'id' FROM gagnants WHERE idUser = $mbreId AND etat != 'Annulé'");
    $totalCommandes = $totalCommandes->fetch(PDO::FETCH_ASSOC);
    $totalCommandes = $totalCommandes['id'];
    ?>


    <div class="container">
        <div class="row">
            <div>
                <h2>Bonjour <?= $mbrePrenom; ?></h2>
            </div>
            <div class="row">

                    <!-- Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-stat color-1">
                            <div class="dashboard-stat-content"><h4><?= displayMontant($totalMissions, 0, ''); ?></h4> <span>Missions Disponibles</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Management"></i></div>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-stat color-2">
                            <div class="dashboard-stat-content"><h4><?= displayMontant($totalMissionsAttente, 0, ''); ?></h4> <span>Mission En Attente</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Over-Time2"></i></div>
                        </div>
                    </div>

                    
                    <!-- Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-stat color-3">
                            <div class="dashboard-stat-content"><h4><?= displayMontant($totalFilleuls, 0, ''); ?></h4> <span>Filleuls</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4><?= displayMontant($totalCommandes, 0, ''); ?></h4> <span>Commandes</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Credit-Card2"></i></div>
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
<div class="container" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title-page">Historique de mes participations</h1>
            <table class="basic-table" rules="none" class="f-s-13 f-w-light">
                <tr>
                    <th valign="middle">Description</th>
                    <th valign="middle">Etat</th>
                    <th valign="middle">Montant</th>
                    <th valign="middle">Date</th>
                </tr>
				<?php
                                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat != 'Refus&eacute;' AND etat != 'En cours'");
                                $donnees_total = $retour_total->fetch();
                                $total = $donnees_total['total'];
                                $messagesParPage = $total ;
                                $nombreDePages = ceil($total / $messagesParPage);

                                if (isset($_GET['page'])) {
                                    $pageActuelle = intval($_GET['page']);
                                    if ($pageActuelle > $nombreDePages) {
                                        $pageActuelle = $nombreDePages;
                                    }
                                } else {
                                    $pageActuelle = 1;
                                }
                                $premiereEntree = ($pageActuelle - 1) * $messagesParPage;
                                $histoParticipations = $pdo->query("SELECT offerwall, idt, remuneration, date, etat FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat != 'En cours' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
                                $all_histoParticipations = $histoParticipations->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($all_histoParticipations as $dones_histoParticipations) {
                                    $etat = $dones_histoParticipations['etat'];
                                    if ($etat == 'Valid&eacute;') {
                                        $btn_etat = '<li class="paid">Valide</li>';
                                    } else if ($etat == 'En attente') {
                                        $btn_etat = '<li class="unpaid">En Attente</li>';
                                    } else if ($etat == 'Refus&eacute;') {
                                        $btn_etta = '<li class="unpaid">Refuse</li>';
                                    }
                                    ?>

                                <tr>
                                    <td align="left" valign="top"><?= $dones_histoParticipations['idt']; ?></td>
                                    <td align="left" valign="top"><?php echo $dones_histoParticipations['etat']; ?></td>
                                    <td align="left" valign="top"><?= displayMontant($dones_histoParticipations['remuneration'], 6, ''); ?> €</td>
                                    <td align="left" valign="top">Le <?php echo $dones_histoParticipations['date']; ?></td>
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
