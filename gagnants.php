<?php 
    include('./requiert/new-form/header.php');

    $meta_title = 'Quizzdeal.fr : Les derniers gagnants';
    $meta_description = '';
?>
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
    <div class="container">
        <div class="col-md-12">
            <h1 class="title-page">Les derniers gagnants</h1>
            <table class="basic-table" rules="none" class="f-s-13 f-w-light">
                <tr>
                    <th valign="middle">Date</th>
                    <th valign="middle">Utilisateur</th>
                    <th valign="middle">libellé</th>
                    <th valign="middle">Montant</th>
                </tr>

                <?php
                    $messagesParPage = 50;
                    $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM gagnants WHERE etat != 'Refus&eacute;'");
                    $donnees_total = $retour_total->fetch();
                    $total = $donnees_total['total'];
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

                    $debits = $pdo->query("SELECT * FROM gagnants WHERE etat != 'Refus&eacute;' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
                    $all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($all_debits as $dones_debits)
                    {
                        $sql_userWin = $pdo->query("SELECT nom, prenom FROM users WHERE id = '" . $dones_debits['idUser'] . "' ");
                        $resultat_userWin = $sql_userWin->fetch(PDO::FETCH_ASSOC);
                        $winNom = $resultat_userWin['nom'];
                        $winPrenom = $resultat_userWin['prenom'];
                    ?>
                                <tr>
                                    <td align="left" valign="top">Le <?php echo $dones_debits['date']; ?></td>
                                    <td align="left" valign="top"><?= $winPrenom; ?> <?= substr($winNom, 0, 2); ?>.</td>
                                    <td align="left" valign="top"><?php echo $dones_debits['type']; ?></td>
                                    <td align="right" valign="top"><?php echo displayMontant($dones_debits['montant'], 2, ''); ?> €</td>
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