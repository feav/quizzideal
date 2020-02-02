<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Les derniers gagnants';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
?>
<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">
        <div class="m-b-5 f-s-18 f-w-bold txt-align-left color-gold">Les derniers gagnants</div>
        <div class="m-b-20 b-b-3-gold"></div>

        <div class="bg-light-grey b-r-10 p-20 b-special-grey">
            <table rules="none" class="f-s-13 f-w-light">
                <tr>
                    <th align="left" valign="middle">Date</th>
                    <th align="left" valign="middle">Utilisateur</th>
                    <th align="left" valign="middle">libellé</th>
                    <th align="right" valign="middle">Montant</th>
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

<?php if ($pageActuelle != 1) {
    $page_p = ($pageActuelle - 1); ?><a href="<?= url_site; ?>/gagnants.html?page=<?php echo $page_p; ?>"><div>Page précédente</div></a><?php } else { ?><div>Page précédente</div><?php } ?>
<?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) {
    $page_s = ($pageActuelle + 1); ?><a href="<?= url_site; ?>/gagnants.html?page=<?php echo $page_s; ?>"><div style="float : right;">Page suivante</div></a><?php } else { ?><div style="float : right;">Page suivante</div><?php } ?>
            <div class="clear"></div>
        </div>
    </div>
</section>

<?php
include('./requiert/inc-footer.php');
?>