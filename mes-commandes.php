<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Mes commandes';
$meta_description = '';

if (!isset($_SESSION['id'])) {
    header('Location: /connexion.html');
    exit();
}

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
?>

<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">
        <div class="container" style="padding-left: 0; margin-left: 0; width: 100%;">
            <div class="row">
                <?php include('./requiert/inc-menu-right.php'); ?>
                <div class="col-md-8 col-xs-12 xs-m-b-20">
                    <div class="bg-light-grey b-r-10 p-20 b-special-grey">
                        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-list m-r-10"></i> Historique de mes commandes</div>


                        <table rules="none" class="f-s-13 f-w-light">
                            <tr>
                                <th align="left" valign="middle">Date</th>
                                <th align="left" valign="middle">Libellé</th>
                                <th align="right" valign="middle">Montant</th>
                                <th align="right" valign="middle">Etat</th>
                            </tr>

                            <?php
                            $messagesParPage = 50;
                            $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM gagnants WHERE idUser = '" . $mbreId . "'");
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
                            $commandes = $pdo->query("SELECT date, type, montant, etat, code FROM gagnants WHERE idUser = '" . $mbreId . "' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
                            $all_commandes = $commandes->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($all_commandes as $dones_commandes) {
                                $etat = $dones_commandes['etat'];
                                if ($etat == 'Valid&eacute;') {
                                    $btn_etat = '<i class="fa fa-check color-green"></i>';
                                } else if ($etat == 'En attente') {
                                    $btn_etat = '<i class="fa fa-clock-o color-green"></i>';
                                } else if ($etat == 'Refus&eacute;') {
                                    $btn_etat = '<i class="fa fa-clock color-red"></i>';
                                }
                                ?>

                                <tr>
                                    <th align="left" valign="middle">Le <?= $dones_commandes['date']; ?></th>
                                    <th align="left" valign="middle"><?= $dones_commandes['type']; ?><?php if ($dones_commandes['code'] != '') echo ' | <strong>' . $dones_commandes['code'] . '</strong>'; ?></th>
                                    <th align="right" valign="middle"><?= displayMontant($dones_commandes['montant'], 2, ''); ?> €</th>
                                    <th align="right" valign="middle"><?= $btn_etat; ?></th>
                                </tr>
    <?php
}
?>
                        </table>
                    </div>
                </div>

                
                
            </div></div>
<?php if ($pageActuelle != 1) {
    $page_p = ($pageActuelle - 1); ?><a href="<?= url_site; ?>/mes-commandes.html?page=<?php echo $page_p; ?>"><div class="bg-grey bg-grey-hover b-r-5 display-inline-block p-5-10">Page précédente</div></a><?php } else { ?><div class="bg-white b-r-5 display-inline-block p-5-10 color-grey cursor-not-allowed">Page précédente</div><?php } ?>
<?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) {
    $page_s = ($pageActuelle + 1); ?><a href="<?= url_site; ?>/mes-commandes.html?page=<?php echo $page_s; ?>"><div class="bg-grey bg-grey-hover b-r-5 p-5-10" style="float : right;">Page suivante</div></a><?php } else { ?><div class="bg-white b-r-5 p-5-10 color-grey cursor-not-allowed" style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>

    </div>
</section>

<?php
include('./requiert/inc-footer.php');
?>