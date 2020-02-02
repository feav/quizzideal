<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Bonus | Quizzdeal.fr';
	$nomPage = 'bonus';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/bonus.php');
?>
    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <?php if (!isset($_GET['action'])): ?>
        <!-- DASHBOARD CONTENT -->
            <div class="dashboard-content">
                <!-- HEADLINE -->
                <div class="headline buttons primary">
                    <h4>Administration bonus</h4>
                    <a href="<?= url_panel; ?>/bonus.html?action=add" class="button mid-short primary">Ajouter un cadeau</a>
                </div>
                <!-- /HEADLINE -->
                <?php
                $messagesParPage = 50;
                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM bonusLogin");
                $donnees_total = $retour_total->fetch();
                $total = $donnees_total['total'];
                $nombreDePages = ceil($total / $messagesParPage);

                if (isset($_GET['page'])) { $pageActuelle = intval($_GET['page']); if ($pageActuelle > $nombreDePages) { $pageActuelle = $nombreDePages; } } else { $pageActuelle = 1; }

                $premiereEntree = ($pageActuelle - 1) * $messagesParPage;

                $offer = $pdo->query("SELECT * FROM bonusLogin ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i:%s') DESC LIMIT ".$premiereEntree.", ".$messagesParPage."");
                $all_offers = $offer->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($all_offers as $dones_offers): ?>

                    <form method="post">
                        <!-- PURCHASES LIST -->
                        <div class="purchases-list">
                            <!-- PURCHASES LIST HEADER -->
                            <div class="purchases-list-header">
                                <div class="purchases-list-header-date">
                                    <p class="text-header small">Date</p>
                                </div>
                                <div class="purchases-list-header-details">
                                    <p class="text-header small">Cadeau</p>
                                </div>
                                <div class="purchases-list-header-info">
                                    <p class="text-header small">Gagnant</p>
                                </div>

                                <div class="purchases-list-header-download">
                                    <p class="text-header small">Actions</p>
                                </div>
                            </div>
                            <!-- /PURCHASES LIST HEADER -->

                            <!-- PURCHASE ITEM -->
                            <div class="purchase-item">
                                <div class="purchase-item-date">
                                    <p><?php if ($dones_offers['date'] != '') echo $dones_offers['date']; else echo '-'; ?></p>
                                </div>
                                <div class="purchase-item-details">
                                    <!-- ITEM PREVIEW -->
                                    <p class="text-header"><?= $dones_offers['name']; ?></p>
                                    <!-- /ITEM PREVIEW -->
                                </div>
                                <div class="purchase-item-info">
                                    <p class="category primary"><?php if ($dones_offers['winner'] != '') echo $dones_offers['winner']; else echo '-'; ?></p>
                                </div>

                                <div class="purchase-item-download">
                                    <?php if ($dones_offers['winner'] == ''): ?>
                                        <button name="submit_del" value="<?= $dones_offers['id']; ?>" class="button tertiary">Supprimer</button>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <!-- /PURCHASE ITEM -->

                        </div>
                        <!-- /PURCHASES LIST -->
                    </form>

                <?php endforeach; ?>

                <?php if ($pageActuelle != 1) { $page_p = ($pageActuelle - 1); ?><a href="<?= url_panel; ?>/bonus.html?page=<?php echo $page_p; ?>"><div class="bg-grey bg-grey-hover b-r-5 display-inline-block p-5-10">Page précédente</div></a><?php } else { ?><div class="bg-white b-r-5 display-inline-block p-5-10 color-grey cursor-not-allowed">Page précédente</div><?php } ?>
                <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) { $page_s = ($pageActuelle + 1); ?><a href="<?= url_panel; ?>/bonus.html?page=<?php echo $page_s; ?>"><div class="bg-grey bg-grey-hover b-r-5 p-5-10" style="float : right;">Page suivante</div></a><?php } else { ?><div class="bg-white b-r-5 p-5-10 color-grey cursor-not-allowed" style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>

            </div>
        <!-- /DASHBOARD CONTENT -->
        <?php elseif($_GET['action'] == 'add'): ?>
            <!-- DASHBOARD CONTENT -->
            <div class="dashboard-content">
                <!-- HEADLINE -->
                <div class="headline buttons primary">
                    <h4>Administration bonus</h4>
                    <a href="<?= url_panel; ?>/bonus.html?action=add" class="button mid-short primary">Ajouter un cadeau</a>
                </div>
                <!-- /HEADLINE -->
                <!-- FORM BOX ITEM -->
                <div class="form-box-item full">
                    <h4>Ajouter un cadeau</h4>
                    <hr class="line-separator">
                    <form id="upload_form" method="post">

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="name" class="rl-label required">Nom du cadeau</label>
                            <input type="text" id="name" name="name" placeholder="Entrez le nom du cadeau (ex.: Paysafecard 10€)..."/>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <hr class="line-separator">
                        <input type="submit" name="submit_add" value="Ajouter le cadeau" class="button big dark">
                    </form>
                </div>
                <!-- /FORM BOX ITEM -->

            </div>
            <!-- /DASHBOARD CONTENT -->
        <?php endif; ?>

        <div class="clearfix"></div>
    </div>
    <!-- /DASHBOARD BODY -->

<?php include('./requiert/inc-footer.php');?>