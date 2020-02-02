<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
include('./requiert/php-form/login-register.php');

$post_reg_mdp = addslashes(htmlentities("123"));

if (!isset($_SESSION['id'])) {
    $captchaCode = code(5);
    ?>
    <section id="first_section" class="bg-white absolute-section-1">
        <div id="first_block" class="m-auto content p-40-20">				
            <h2 class="f-s-36 xs-f-s-24 Oswald uppercase color-dark-grey txt-align-center m-b--20"><span class="color-beige">Gagner de l'argent et des cadeaux</span> sans bouger de chez soi ?</h2>
            <h3 class="f-s-24 xs-f-s-18 Oswald f-w-light uppercase color-dark-grey txt-align-center">Juste en cliquant, en répondant à des sondages ou en testant des apps</h3>
            <h3 class="f-s-20 xs-f-s-16 Oswald f-w-light uppercase color-dark-grey txt-align-center">Simplement, Rapidement et surtout Gratuitement</h3>
        </div>
    </section>
    <script type="text/javascript">
                function DisplayMsg (){
                    swal({
                        text: "Vous devez etre connecté",
                        button: false,
                        icon: "warning",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                });
                setTimeout("window.location='<?= url_site; ?>connexion.php'", 2000);
                }
        </script>
    <section id="second_section" class="bg-white absolute-section-1">     
        <div id="second_block" class="m-auto content p-40-20">		
            <h2 class="f-s-24 Oswald uppercase centrer">Nos partenaires</h2>
            <div class="container m-t-40">
                <div class="row">
                    <?php
                        $sql = "SELECT cashbackengine_coupons.*, cashbackengine_retailers.retailer_id, cashbackengine_retailers.image  FROM cashbackengine_coupons INNER  JOIN  cashbackengine_retailers ON cashbackengine_coupons.retailer_id = cashbackengine_retailers.retailer_id WHERE cashbackengine_coupons.status = 'active' AND NOW() <= cashbackengine_coupons.end_date ORDER BY cashbackengine_coupons.start_date DESC LIMIT 6";
                        $req = $pdo->query($sql);
                        $coupons = $req->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($coupons as $coupon) :
                            $boutique_image=  strpos($coupon['image'], 'http') !== false ? $coupon['image'] : '/img/' . $coupon['image'];
                            ?>
                            <div class="col-md-2 col-xs-4">
                                <a href="goto2store.php?id=<?php echo $coupon['retailer_id']; ?>&c=<?php echo $coupon['coupon_id']; ?>" class="card b-r-5">
                                    <img src="<?= $boutique_image ?>" alt="<?= $coupon['title']; ?>" style="width:100%; height:75px;">
                                    <div class="card-footer">
                                        <small class="centrer"><?= $coupon['title']; ?></small>
                                    </div>
                                </a>
                            </div>
                    <?php endforeach;?>
                    </div>
                    <!--div class="row m-t-20">
                    <?php
                        /*$sql = "SELECT * FROM cashback WHERE actif = 1 LIMIT 6";
                        $req = $pdo->query($sql);
                        $cashbacks = $req->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($cashbacks as $cashback) :
                    ?>
                    <div class="col-md-2 col-xs-4">
                        <a href="#" onclick="javascript:DisplayMsg();" class="card b-r-5">
                            <img src="<?= $cashback['image']; ?>" class="" alt="<?= $cashback['nom']; ?>" style="width:100%; height:75px;">
                            <div class="card-footer">
                                <small class="centrer"><?= $cashback['nom']; ?></small>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; */?>
                    </div-->
                </div>
            </div>
    </section>

    <section class="bg-light-grey absolute-section-1">
        <div class="m-auto content p-40-20">				
            <div class="container"><div class="row">
                    <div class="col-md-12 txt-align-center">
                        <h2 class="f-s-24 Oswald uppercase">A retrouver dans notre boutique</h2>
                        <div class="f-s-16 m-t-10 f-w-light">Une boutique pleine qui plait à tous...</div>

                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/aw-code.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/carte-app-store-itunes.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/carte-cadeau-amazon.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/carte-psn.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/carte-steam.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/e-carte-google-play.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/neosurf.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/neteller.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/netflix-gift-card.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/paypal.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/paysafecard.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>
                        <div class="col-md-1 m-t-20 col-sm-2 sm-m-t-20 col-xs-4 xs-m-t-20"><img src="img/boutique/pcs.jpg" alt="" class="img-width-100-pc b-r-50 b-special-grey" /></div>

                    </div>
                </div></div>
        </div>
    </section>

    <section class="bg-white absolute-section-1">
        <div class="m-auto content p-40-20 container"><div class="row">
                <div class="col-md-12">
                    <h2 class="Oswald uppercase f-s-24 xs-f-s-21 txt-align-center m-b-20">Faites confiance à <span class="color-gold f-w-bold">Quizzdeal</span></h2>

                    <div class="col-md-4 col-xs-12 txt-align-center xs-m-b-20">
                        <div class="f-s-14 f-w-light m-t-10 bg-light-grey p-20 b-r-5"><i class="fa fa-check-circle color-green m-r-5"></i> Vos données sont sécurisées et ne seront jamais cédées à des sociétés tiers.</div>
                    </div>
                    <div class="col-md-4 col-xs-12 txt-align-center xs-m-b-20">
                        <div class="f-s-14 f-w-light m-t-10 bg-light-grey p-20 b-r-5"><i class="fa fa-check-circle color-green m-r-5"></i> Nous proposons uniquement les meilleures offres afin de vous proposer que de la qualité.</div>
                    </div>
                    <div class="col-md-4 col-xs-12 txt-align-center">
                        <div class="f-s-14 f-w-light m-t-10 bg-light-grey p-20 b-r-5"><i class="fa fa-check-circle color-green m-r-5"></i> Les reversements et envois de cadeaux sont envoyés sous 72H maximum.</div>
                    </div>
                </div>
            </div></div>
    </section>
            
    <section class="color-white bg-facebook absolute-section-1">
        <div class="m-auto content p-40-20">
            <div class="container"><div class="row">
                    <div class="col-md-12 txt-align-center">
                        <?php
                        $query_livredor = $pdo->query("SELECT * FROM livredor WHERE statut=1 GROUP BY date DESC");
                        $livredor = $query_livredor->fetchAll(PDO::FETCH_ASSOC);
                        if (count($livredor) > 0) {
                            ?>
                            <ul id="js-news" class="js-hidden">
                                <?php
                                foreach ($livredor as $livre) {
                                    ?>
                                    <li class="news-item"><br><?php echo "Le " . date('d/m/Y', strtotime($livre->date)) . " à " . date('H:i', strtotime($livre->date)) . " : <br><br><i>" . $livre->message . "</i>"; ?></li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php } ?>
                    </div>
                </div></div>
        </div>
    </section>
    <?php
} else {

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

    <section id="banner_section" style="padding-bottom: 80px;">
        <h1 class="title_welcome"><?= ucfirst(nom_site); ?></h1>
        <div class="banner_center">
            <div class="">
                <p id="welcome">Bonjour <?= $mbrePrenom; ?>,</i></p>
                <p class="welcome">Vos statistiques ci dessous</p>

                <!-- SERVICES -->
                <div id="services-wrap">
                    <section id="services">
                        <!-- SERVICE LIST -->
                        <div class="service-list column4-wrap">
                            <!-- SERVICE ITEM -->
                            <div class="service-item column">
                                <div class="circle medium gradient"></div>
                                <div class="circle white-cover"></div>
                                <div class="circle dark">
                                    <span class="icon-present"></span>
                                </div>
                                <h3><?= displayMontant($totalMissions, 0, ''); ?></h3>
                                <p>Vous avez actuellement <?= displayMontant($totalMissions, 0, ''); ?> missions disponibles</p>
                            </div>
                            <!-- /SERVICE ITEM -->

                            <!-- SERVICE ITEM -->
                            <div class="service-item column">
                                <div class="circle medium gradient"></div>
                                <div class="circle white-cover"></div>
                                <div class="circle dark">
                                    <span class="icon-lock"></span>
                                </div>
                                <h3><?= displayMontant($totalMissionsAttente, 0, ''); ?></h3>
                                <p>Vous avez actuellement <?= displayMontant($totalMissionsAttente, 0, ''); ?> missions en attente de validation</p>
                            </div>
                            <!-- /SERVICE ITEM -->

                            <!-- SERVICE ITEM -->
                            <div class="service-item column">
                                <div class="circle medium gradient"></div>
                                <div class="circle white-cover"></div>
                                <div class="circle dark">
                                    <span class="icon-like"></span>
                                </div>
                                <h3><?= displayMontant($totalFilleuls, 0, ''); ?></h3>
                                <p>Vous avez actuellement <?= displayMontant($totalFilleuls, 0, ''); ?> Filleuls</p>
                            </div>
                            <!-- /SERVICE ITEM -->

                            <!-- SERVICE ITEM -->
                            <div class="service-item column">
                                <div class="circle medium gradient"></div>
                                <div class="circle white-cover"></div>
                                <div class="circle dark">
                                    <span class="icon-diamond"></span>
                                </div>
                                <h3><?= displayMontant($totalCommandes, 0, ''); ?></h3>
                                <p>Vous avez actuellement <?= displayMontant($totalCommandes, 0, ''); ?> commandes disponibles</p>
                            </div>
                            <!-- /SERVICE ITEM -->
                        </div>
                        <!-- /SERVICE LIST -->
                        <div class="clearfix"></div>
                    </section>
                </div>
                <!-- /SERVICES -->

            </div>
        </div>
    </section>

                        <!--<section class="bg-polygones-green absolute-section-1 margin-base">
                                <div class="m-auto content p-40-20 container"><div class="row">
                                        <div class="txt-align-center m-b-40 m-l-20 m-r-20 f-s-24">Bonjour <?= $mbrePrenom; ?>,</div>
                                        
                                        <div class="col-md-3 col-sm-6 col-xs-12 f-s-21 sm-m-b-20 txt-align-center">
                                                <div class="f-s-48 bg-opaque-50 b-white-3 color-white display-inline-block b-r-50 m-b-10 p-20-10" style="height:58px;width:78px;"><?= displayMontant($totalMissions, 0, ''); ?></div><br/>Missions disponibles
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 f-s-18 sm-m-b-20 txt-align-center">
                                                <div class="f-s-48 bg-opaque-50 b-white-3 color-white display-inline-block b-r-50 m-b-10 p-20-10" style="height:58px;width:78px;"><?= displayMontant($totalMissionsAttente, 0, ''); ?></div><br/>Missions en attente de validation
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 f-s-18 sm-m-b-20 txt-align-center">
                                                <div class="f-s-48 bg-opaque-50 b-white-3 color-white display-inline-block b-r-50 m-b-10 p-20-10" style="height:58px;width:78px;"><?= displayMontant($totalFilleuls, 0, ''); ?></div><br/>Filleuls
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 f-s-18 txt-align-center">
                                                <div class="f-s-48 bg-opaque-50 b-white-3 color-white display-inline-block b-r-50 m-b-10 p-20-10" style="height:58px;width:78px;"><?= displayMontant($totalCommandes, 0, ''); ?></div><br/>Commandes
                                        </div>
                                </div></div>
                        </section>-->

    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        unset($_SESSION['passe']);
        ?>
        <script type="text/javascript">
            swal({
                text: "Déconnexion en cours, veuillez patienter...",
                button: false,
                icon: "success",
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
            setTimeout("window.location='<?= url_site; ?>'", 3000);
        </script>
        <?php
    }
}
?>

<?php
include('./requiert/inc-footer.php');
?>