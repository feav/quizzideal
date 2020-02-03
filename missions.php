<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Les missions';
$meta_description = '';

if (!isset($_SESSION['id'])) {
    header('Location: /connexion.php');
    exit();
}

if (!isset($_SESSION['email_offre'])) {
    header('Location: /infos.php');
    exit(); 
}

$sql = "SELECT id,email,ip FROM users_infos WHERE idUser = {$_SESSION['id']} AND email = '{$_SESSION['email_offre']}'";
// $datas = ['idUser' => $_SESSION['id']];
$req = $pdo->query($sql);
$result = $req->fetch(PDO::FETCH_ASSOC);  

if($result['ip'] != $_SESSION['ip']){
    header('Location: /infos.php');
    exit();
}  

if($result['email'] != $_SESSION['email_offre']){
    header('Location: /infos.php');
    exit();
}


include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
?>

<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">
        <div class="container" style="padding-left: 0; margin-left: 0; width: 100%;"><div class="row">

                <!-- <div class="col-md-4 col-xs-12 xs-m-b-20"> -->
                    <!-- <div class="bg-light-grey b-r-10 p-20 b-special-grey">
                        <div class="f-s-21 bg-blue color-white b-r-5 b-special-grey p-10-20 m-b-20 txt-align-center">
                            <i class="fa fa-money m-r-10"></i> 
                            <strong><?php echo displayMontant($mbreEuros, 6, ' €'); ?></strong><br>(<?= displayMontant($totalAmoundAttente, 2, ' €'); ?>)</span>
                            <div class="f-s-14 uppercase f-w-light m-t-2">solde actuel</div>
                        </div>

                        <a href="#" id="info-prcnt"><div class="float m-b-10 f-s-13 f-w-light transition-1s color-white p-10-20 b-r-5 b-special-grey">
                                <progress id="avancement" value="<?= $mbreBarrePrcnt; ?>" max="100" title="Bonus à <?= displayMontant($mbreBarrePrcnt, 2, ' %'); ?>" style="width:80%;"></progress>
                                <span id="description-barre" class="m-l-10 color-white txt-align-center f-s-10 cursor-pointer" style="float: right;"><i class="fa fa-info p-5 bg-blue bg-blue-hover b-r-50 width-10"></i></span> <script type="text/javascript">
                                    document.querySelector('span#description-barre').onclick = function () {
                                        swal({
                                            text: "Vous avez rempli <?= $mbreBarrePrcnt; ?>% de la barre de bonus.\n\nEncore un petit effort, car une fois à 100%, vous serez crédité automatiquement de 2 euros !!!",
                                            button: "Fermer",
                                            closeOnClickOutside: false,
                                            closeOnEsc: false
                                        });
                                    };
                                </script>
                            </div></a>
                        <div class="clear"></div>
                    </div> -->
                    <?php include('./requiert/inc-menu-right.php'); ?>
                   <!--  <div class="bg-light-grey b-r-10 p-20 b-special-grey m-t-20" style="border: 2px orange solid">
                        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 10px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-money m-r-10"></i> Offerwalls</div>

                        <ul class="offerwall">
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Adgem</button><input type="hidden" name="ow" value="adgem"></form></li>
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">AdWorkMedia</button><input type="hidden" name="ow" value="adworkmedia"></form></li>
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Ayetstudios</button><input type="hidden" name="ow" value="ayetstudios"></form></li>
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Kiwiwall</button><input type="hidden" name="ow" value="kiwiwall"></form></li>
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Offertoro</button><input type="hidden" name="ow" value="offertoro"></form></li>
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Offerwolf</button><input type="hidden" name="ow" value="offerwolf"></form></li>
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Personaly</button><input type="hidden" name="ow" value="personaly"></form></li>
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Superrewards</button><input type="hidden" name="ow" value="superrewards"></form></li>
                            <li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Wannads</button><input type="hidden" name="ow" value="wannads"></form></li>
                        </ul>

                        <div class="clear"></div>
                    </div> -->

                    
                <!-- </div>	 -->

                <div class="col-md-8 col-xs-12">
                    <div class="bg-green color-white p-10-20 f-s-14 b-r-10 b-special-grey m-b-20">Gagnez de l'argent en participant à nos différentes missions ! L'argent sera crédité sur votre compte immédiatement après votre participation.</div>
                    <div class="bg-light-grey b-r-10 p-20 b-special-grey">

                        <?php if (isset($_GET['ow'])) : ?> 

                            <?php $nameOfferwall = htmlentities($_GET['ow']);
                            $hashId = $mbreHashId . '-' . date('YmdH');
                            ?>

                            <?php if ($_POST['ow'] == 'offertoro'): ?>

                                <iframe src="https://www.offertoro.com/ifr/show/19324/<?= $hashId; ?>/7155" frameborder="0" width="100%" height="700px"></iframe>

                            <?php elseif ($_GET['ow'] == 'adscendmedia'): ?>

                                <iframe src="https://adscendmedia.com/adwall/publisher/110911/new/profile/13208?subid1=<?= $hashId; ?>" frameborder="0" width="100%" height="700px"></iframe>

                            <?php elseif ($_GET['ow'] == 'kiwiwall'): ?>

                                <iframe src="https://www.kiwiwall.com/wall/YKDHIm3WzFwpKtrWTxeVpiAacPlUjZoQ/<?= $hashId; ?>" frameborder="0" width="100%" height="700px"></iframe>

                            <?php elseif ($_GET['ow'] == 'wannads'): ?>

                                <iframe src="https://wall.wannads.com/wall?apiKey=5d446e6ca96de949432700&userId=[<?= $hashId; ?>" frameborder="0" width="100%" height="700px"></iframe>

                            <?php elseif ($_GET['ow'] == 'adworkmedia') : ?>

                                <iframe src="http://lockwall.xyz/wall/5lH/<?= $hashId; ?>" frameborder="0" width="100%" height="700px"></iframe>

                            <?php elseif ($_GET['ow'] == 'ptcwall'): ?>

                                <iframe src="http://www.ptcwall.com/index.php?view=ptcwall&pubid=gxqb86469i36vh966z&usrid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

                            <?php elseif ($_GET['ow'] == 'personaly'): ?>

                                <iframe src="https://persona.ly/widget/?appid=91600366dbf74a5808b266c87c32313f&userid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

                            <?php elseif ($_GET['ow'] == 'superrewards'): ?>

                                <iframe src="https://wall.superrewards.com/super/offers?h=uebrmznlgmm.682401188058&uid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

                            <?php elseif ($_GET['ow'] == 'clixwall'): ?>

                                <iframe src="http://www.clixwall.com/wall.php?p=BFXV1-PNF36-RRX05&u=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

                            <?php elseif ($_GET['ow'] == 'offerwolf'): ?>

                                <iframe src="https://ads.offerwolf.com/wall/?idUser=112&appId=72&subid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

                            <?php elseif ($_GET['ow'] == 'ayetstudios'): ?>

                                <iframe src="https://www.ayetstudios.com/offers/web_offerwall/1068/default_adslot?external_identifier=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

                            <?php elseif ($_GET['ow'] == 'adgem'): ?>

                                <iframe src="https://api.adgem.com/v1/wall?appid=956&playerid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

                            <?php endif; ?>    



                        </div>

                    <?php else: //Controle get ow pour l'iframe?>

                        <table rules="none" class="f-s-13 f-w-light">
                            <tr>
                                <th align="center" valign="middle"></th>
                                <th align="left" valign="middle">Nom de l'offre</th>
                                <th align="left" valign="middle">Rémunération</th>
                                <th align="center" valign="middle">Tombola</th>
                            </tr>


                            <?php
                            $maxOffersPerAnnonceurPerDay = 5;
                            $sql = "
        SELECT * 
        FROM
        (   SELECT idoffre, CONCAT(nom, ' [', annonceur, ']') nomAnnonceur, nom, description, remuneration, annonceur, date, quota, image,
            (   SELECT COUNT(*) 
                FROM histo_offers ho 
                WHERE ho.idt = o.nom 
                AND ho.etat != 'Refus&eacute;'
                AND ho.date LIKE '" . date('d/m/Y') . "%'
            ) totalForQuota,
            (   SELECT olo.nom
                FROM offers olo
                JOIN histo_offers holo ON holo.idt = olo.nom 
                WHERE holo.idUser = '$mbreHashId'
                AND holo.etat != 'Refus&eacute;' 
                AND olo.annonceur = o.annonceur 
                ORDER BY holo.date DESC
                LIMIT 1
            ) latestOffer,
            (   SELECT ou.nom 
                FROM offers ou 
                WHERE ou.annonceur = o.annonceur 
                ORDER BY ou.nom 
                DESC LIMIT 1
            ) ultimateOffer
            FROM offers o
            WHERE pays LIKE '%%" . $country_code . "%%' 
            AND premium <= '" . $mbrePremium . "'
            AND actif = 1 
            AND NOT EXISTS 
            (   SELECT *
                FROM histo_offers hoidUser
                WHERE hoidUser.idt = o.nom 
                AND hoidUser.etat != 'Refus&eacute;'
                AND hoidUser.date LIKE '" . date('d/m/Y') . "%'
                AND hoidUser.idUser = '$mbreHashId'
            ) /* offer not done today */
            AND NOT EXISTS 
            (   SELECT * 
                FROM offers oip
                JOIN histo_offers hoip ON hoip.idt = oip.nom
                WHERE hoip.ip = '" . ip . "'
                AND hoip.etat != 'Refus&eacute;'
                AND hoip.date LIKE '" . date('d/m/Y') . "%'
                AND hoip.idUser = '$mbreHashId'
                AND oip.annonceur = o.annonceur
            ) /* no offer from same annonceur unless with different IP */
            AND NOT EXISTS
            (   SELECT COUNT(*)
                FROM offers oa
                JOIN histo_offers hoa ON hoa.idt = oa.nom
                WHERE hoa.etat != 'Refus&eacute;'
                AND hoa.date LIKE '" . date('d/m/Y') . "%'
                AND hoa.idUser = '$mbreHashId'
                AND oa.annonceur = o.annonceur
                HAVING COUNT(*) >= $maxOffersPerAnnonceurPerDay
            ) /* no more than max offers per day per annonceur per member */
            HAVING (totalForQuota < o.quota OR o.quota = 0) 
            AND (o.nom > (CASE WHEN latestOffer = ultimateOffer THEN '' ELSE COALESCE(latestOffer, '') END))
            ORDER BY o.nom ASC
        ) allOffers
        GROUP by annonceur 
        ORDER BY nom
    ";

                            $offers = $pdo->query($sql);
                            $all_offers = $offers->fetchAll(PDO::FETCH_ASSOC);
                            $selected_offers = [];
                            foreach ($all_offers as $dones_offers) {
                                $annonceur = $dones_offers['annonceur'];
                                $idoffre = $dones_offers['idoffre'];
                                $nom = $dones_offers['nom'];
                                $description = $dones_offers['description'];
                                $remuneration = $dones_offers['remuneration'];
                                $imageMissionSrc = $dones_offers['image'];
                                ?>
                                <tr>
                                    <td align="center" valign="middle">
                                        <img src="<?= $imageMissionSrc; ?>" style="width: 100px; height: 51px;">
                                    </td>
                                    <td align="left" valign="middle">
                                        <strong><?= $nom; ?></strong> 
                                        <span class="m-l-5 color-dark border p-5 f-s-10 b-r-5 uppercase"><?= $annonceur; ?></span>
                                        <p><?= $description; ?></p>
                                    </td>		
                                    <td align="left" valign="middle"><?= displayMontant($remuneration, 2, ' €'); ?></td>
                                    <td align="right" valign="middle">1 <img src="/images/if-ticket.png"/></td>
                                    <td align="center" valign="middle">
                                        <!--<form method="POST" target="_blank" style="cursor:pointer;display:inline-block;" action="<?= URL_SITE; ?>/cpl.html"><input type="hidden" name="off_id" value="<?= $idoffre; ?>" /><a title="Accéder à l'offre" onclick="redirectReload(this);"><div class="button color-white display-inline-block p-5-10 bg-orange bg-orange-hover">Cliquez-ici</div></a></form></td>-->
                                        <form method="POST" target="_blank" style="cursor:pointer;display:inline-block;margin-block-end: 0 !important;" action="<?= URL_SITE; ?>/missions-open.php"><input type="hidden" name="off_id" value="<?= $idoffre; ?>" /><a title="Accéder à l'offre" onclick="redirectReload(this);"><div class="button color-white display-inline-block b-r-5 p-5 bg-orange bg-orange-hover" style="font-size: 10px; vertical-align: middle;">Ouvrir</div></a></form></td>

                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    <?php endif; ?>
                </div>

            </div>


        </div>
    </div>
</div>
</section>

<script>
    function redirectReload(elmt) {
        elmt.parentElement.submit();
        setTimeout(function () {
            window.location.reload();
        }, 1000);
    }
</script>
</div>
</div></div>
</section>

<?php
include('./requiert/inc-footer.php');
?>