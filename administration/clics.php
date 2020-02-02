<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Clics | Quizzdeal.fr';
	$nomPage = 'clics';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/clics.php');
?>
    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
<?php if (!isset($_GET['action'])):?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline statement primary">
                <h4>Administration des clics</h4>
                <a href="<?= url_panel; ?>/clics.html?action=add" class="button primary">Ajouter un offre</a>
            </div>
            <!-- /HEADLINE -->

            <!-- TRANSACTION LIST -->
            <div class="transaction-list">
                <form method="post">
                    <!-- TRANSACTION LIST HEADER -->
                    <div class="transaction-list-header">
                        <div class="transaction-list-header-date admin-s1">
                            <p class="text-header small">HASH ID</p>
                        </div>
                        <div class="transaction-list-header-author admin-s1">
                            <p class="text-header small">Nom de l'offre</p>
                        </div>
                        <div class="transaction-list-header-item admin-s1">
                            <p class="text-header small">Rémunération</p>
                        </div>
                        <div class="transaction-list-header-detail admin-s1">
                            <p class="text-header small">Etat</p>
                        </div>

                    </div>
                    <!-- /TRANSACTION LIST HEADER -->
                    <?php //Bloc requete SQL pour la prochaine boucle
                    $messagesParPage = 50;
                    $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM offers_clics");
                    $donnees_total = $retour_total->fetch();
                    $total = $donnees_total['total'];
                    $nombreDePages = ceil($total / $messagesParPage);

                    if (isset($_GET['page'])) { $pageActuelle = intval($_GET['page']);
                        if ($pageActuelle > $nombreDePages) {
                            $pageActuelle = $nombreDePages;
                        }
                    } else {
                        $pageActuelle = 1;
                    }
                    $premiereEntree = ($pageActuelle - 1) * $messagesParPage;
                    $offer = $pdo->query("SELECT * FROM offers_clics ORDER BY nom LIMIT ".$premiereEntree.", ".$messagesParPage."");
                    $all_offers = $offer->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($all_offers as $dones_offers)://Boucle all_offers?>
                        <?php
                        //if ($dones_offers['actif'] == 1) { $dones_offers['actif'] = 'Actif'; $boutonActif = '<a href="" class="m-r-5"><div class="display-inline-block button bg-red bg-red-hover color-white p-5-10 b-r-50 uppercase">Mettre en pause</div></a>'; } else if ($dones_offers['actif'] == 0) { $dones_offers['actif'] = 'Inactif'; $boutonActif = '<a href="" class="m-r-5"><div class="display-inline-block button bg-green bg-green-hover color-white p-5-10 b-r-50 uppercase">Activer</div></a>'; }
                        if ($dones_offers['actif'] == 1) {
                            $dones_offers['actif'] = 'Actif';
                            $boutonActif = '<button name="desactive" value="'.$dones_offers['id'].'" class="button secondary ">Pause</button>';
                        } else if ($dones_offers['actif'] == 0) {
                            $dones_offers['actif'] = 'Inactif';
                            $boutonActif = '<button name="active" value="'.$dones_offers['id'].'" class="button primary">Activer</button>';
                        }
                        ?>
                        <!-- TRANSACTION LIST ITEM -->
                        <div class="transaction-list-item">
                            <div class="transaction-list-item-date admin-s1">
                                <p><?= $dones_offers['idoffre']; ?></p>
                            </div>
                            <div class="transaction-list-item-author admin-s1">
                                <p class="category primary"><?= utf8_encode($dones_offers['nom']); ?></p>
                            </div>
                            <div class="transaction-list-item-detail admin-s1">
                                <p><?= displayMontant($dones_offers['remuneration'], 2, ' €'); ?></p>
                            </div>
                            <div class="transaction-list-item-code">
                                <p><?= $dones_offers['actif']; ?></p>
                            </div>
                            <div class="transaction-list-item-price flexy">
                                <?= $boutonActif; ?>
                                <a href="<?= url_panel; ?>/clics.html?action=update&id=<?= $dones_offers['id']; ?>" class="button secondary-dark">Modifier</a>
                            </div>
                        </div>
                        <!-- /TRANSACTION LIST ITEM -->
                    <?php endforeach;//Fin boucle all_offers ?>
                </form>

                <!-- PAGINATION-->
                <?php if ($pageActuelle != 1):
                    $page_p = ($pageActuelle - 1); ?>
                    <a href="<?= url_panel; ?>/clics.html?page=<?php echo $page_p; ?>">
                        <div class="bg-grey bg-grey-hover b-r-5 display-inline-block p-5-10">Page précédente</div>
                    </a>
                <?php else: ?>
                    <div class="bg-white b-r-5 display-inline-block p-5-10 color-grey cursor-not-allowed">Page précédente</div>
                <?php endif; ?>
                <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle):
                    $page_s = ($pageActuelle + 1);
                    ?>
                    <a href="<?= url_panel; ?>/clics.html?page=<?php echo $page_s; ?>">
                        <div class="bg-grey bg-grey-hover b-r-5 p-5-10" style="float : right;">Page suivante</div>
                    </a><?php else: ?>
                    <div class="bg-white b-r-5 p-5-10 color-grey cursor-not-allowed" style="float : right;">Page suivante</div>
                <?php endif; ?>
                <!-- /PAGINATION-->


                <div class="clear"></div>
            </div>
            <!-- /TRANSACTION LIST -->
        </div>
        <!-- DASHBOARD CONTENT -->
        <div class="clear-fix"></div>
<?php elseif ($_GET['action'] == 'add'): ?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Ajouter une offre</h4>
            <a href="<?= url_panel; ?>/clics.html" class="button mid-short primary">Retour</a>
        </div>
        <!-- /HEADLINE -->

        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item">
                <h4>Ajouter une offre</h4>
                <hr class="line-separator">

                <form id="profile-info-form" method="post">
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="nom" class="rl-label required">Nom de l'offre</label>
                        <input type="text" id="nom" name="nom" placeholder="Entrez le nom de l'offre..." value="<?= $post_nom ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="url" class="rl-label required">Url de l'offre</label>
                        <input type="text" id="url" name="url" placeholder="Entrez l'URL (Tracking : #IDM)" value="<?= $post_url ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="remuneration" class="rl-label required">Rémunération aux membres</label>
                        <input type="number" step="0.01" min="0.01" id="remuneration" name="remuneration" placeholder="0,01" value="<?= $post_remuneration ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="pays" class="rl-label required">Pays acceptés</label>
                        <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE" value="<?= $post_pays ?>" >
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <input type="submit" name="submit_add" class="button big dark" value="Ajouter une offre">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
    <div class="clear-fix"></div>
<?php elseif ($_GET['action'] == 'update'): ?>
    <?php //Bloc req SQL pour la prochaine boucle
    $sqlMissions = $pdo->query("SELECT * FROM offers_clics WHERE id = '".intval($_GET['id'])."'");
    $resultatMissions = $sqlMissions->fetch();
    $nomOffre = $resultatMissions['nom'];
    $urlOffre = $resultatMissions['url'];
    $paysOffre = $resultatMissions['pays'];
    $remunerationOffre = $resultatMissions['remuneration'];
    ?>
    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <!-- HEADLINE -->
        <div class="headline buttons primary">
            <h4>Modifier une offre</h4>
            <a href="<?= url_panel; ?>/clics.html" class="button mid-short primary">Retour</a>
        </div>
        <!-- /HEADLINE -->

        <!-- FORM BOX ITEMS -->
        <div class="form-box-items">
            <!-- FORM BOX ITEM -->
            <div class="form-box-item">
                <h4>Modifier une offre</h4>
                <hr class="line-separator">

                <form id="profile-info-form" method="post">
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="nom" class="rl-label required">Nom de l'offre</label>
                        <input type="text" id="nom" name="nom" placeholder="Entrez le nom de l'offre..." value="<?= $nomOffre ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="url" class="rl-label required">Url de l'offre</label>
                        <input type="text" id="url" name="url" placeholder="Entrez l'URL (Tracking : #IDM)" value="<?= $urlOffre ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="remuneration" class="rl-label required">Rémunération aux membres</label>
                        <input type="number" step="0.01" min="0.01" id="remuneration" name="remuneration" placeholder="0,01" value="<?= $remunerationOffre ?>">
                    </div>
                    <!-- /INPUT CONTAINER -->

                    <!-- INPUT CONTAINER -->
                    <div class="input-container">
                        <label for="pays" class="rl-label required">Pays acceptés</label>
                        <input type="text" id="pays" name="pays" value="<?= $paysOffre ?>" placeholder="Exemple : FR BE">
                    </div>
                    <!-- /INPUT CONTAINER -->
                    <input type="submit" name="submit_add" class="button big dark" value="Modifier l'offre">
                </form>
            </div>
            <!-- /FORM BOX ITEM -->
        </div>
        <!-- /FORM BOX -->
    </div>
    <!-- DASHBOARD CONTENT -->
    <div class="clear-fix"></div>
<?php endif; ?>
    </div>
    <!-- /DASHBOARD BODY -->


<?php
	include('./requiert/inc-footer.php');
?>