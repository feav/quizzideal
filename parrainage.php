<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Parrainage & Filleuls';
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
        <div class="container" style="padding-left: 0; margin-left: 0; width: 100%;"><div class="row">
            <?php include('./requiert/inc-menu-right.php'); ?>
                <div class="col-md-8 col-xs-12 xs-m-b-20">
                    <div class="bg-light-grey b-r-10 p-20 b-special-grey">
                        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-line-chart m-r-10"></i> Parrainage</div>
                        
                        <div class="f-s-13 f-w-light m-b-20">
                            <div class="bg-light-grey color-black p-10-20 f-s-14 b-r-10 b-special-grey m-b-20" align="justify">
                            Vous souhaitez inviter vos ami(e)s sur Multi-cadeaux et gagner plus d'argent ?
                            Récupérez votre lien de parrainage ci-dessous et partagez-le un maximum.
                            Chaque personne qui s'inscrit via votre lien devient automatiquement votre filleul et vous devenez son parrain. A chaque commande effectuée, vous toucherez 15% du montant de leur commande.
                            </div>
                            
                            <?php
                                $sql = "SELECT * FROM parrainage WHERE id = 1";
                                $req = $pdo->query($sql);
                                $par = $req->fetch(PDO::FETCH_ASSOC);
                            ?>

                            <div class="row">
                                    <div class="col-md-4 centrer">
                                        <div class="badge badge-blue">
                                            <span><?= $par['inscription']?>&nbsp;&euro;</span>
                                        </div>
                                        <p class="badge-infos">
                                            <i class="fa fa-money blue"></i><span class="m-l-5">Bonus Inscription</span>
                                        </p>
                                    </div>
                                    <div class="col-md-4 centrer">
                                        <div class="badge badge-green">
                                            <span><?= $par['ami']?>&nbsp;&euro;</span>
                                        </div>
                                        <p class="badge-infos">
                                            <i class="fa fa-money green"></i><span class="m-l-5">Bonus Parrainage Ami</span>
                                        </p>
                                    </div>
                                    <div class="col-md-4 centrer">
                                        <div class="badge badge-grey">
                                            <span><?= $par['commission']?>&nbsp;&#37;</span>
                                        </div>
                                        <p class="badge-infos">
                                            <i class="fa fa-money grey"></i><span class="m-l-5">Commission de renvoi</span>
                                        </p>
                                    </div>
                            </div>

                            <div class="bg-blue color-white p-20 b-r-10 f-s-13 b-special-grey m-b-20">
                                <div class="m-l-10">Votre lien de parrainage :</div>
                                <input type="text" value="<?= url_site; ?>?parrain=<?= $mbreId; ?>" class="f-s-13 m-t-10 input-md b-r-5 m-b-20" style="border:0;"/>

                                <!-- <div class="m-l-10">Lien de la bannière 468x60 :</div>
                                <input type="text" value="<?= url_site; ?>images/468x60.jpg" alt="Bannière Parrainage" class="f-s-13 m-t-10 input-md b-r-5 m-b-10" style="border:0;"/>

                                <img id="banniere_img" src="<?= url_site; ?>images/468x60.jpg" alt="Bannière Parrainage"/> -->
                            </div>

                            <div class="m-b-5 f-s-16 f-w-bold txt-align-left color-gold">Liste de vos filleuls</div>
                            <div class="m-b-10 b-b-3-gold"></div>


                            <table rules="none" class="f-s-13 f-w-light">
                                <tr>
                                    <th align="left" valign="middle">Utilisateurs</th>
                                    <th align="right" valign="middle">Montant perçu</th>
                                </tr>
                                
<?php
$messagesParPage = 50;
$retour_total = $pdo->query("SELECT COUNT(*) AS total FROM users WHERE idParrain = '" . $mbreId . "'");
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

$commandes = $pdo->query("SELECT * FROM users WHERE idParrain = '" . $mbreId . "' ORDER BY eurosParrain DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
$all_commandes = $commandes->fetchAll(PDO::FETCH_ASSOC);
foreach ($all_commandes as $dones_commandes) {
    ?>

    <tr>
        <td align="left" valign="top"><?= $dones_commandes['prenom'] . ' ' . substr($dones_commandes['nom'], 0, 1) . '.'; ?></td>
        <td align="right" valign="top"><?= displayMontant($dones_commandes['eurosParrain'], 2, ''); ?> €</td>
    </tr>
    </div>
    </div>

    <?php
}
?>		                                
                                
                            </table>
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