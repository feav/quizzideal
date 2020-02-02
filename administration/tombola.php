<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Tombola | Quizzdeal.fr';
	$nomPage = 'tombola';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/tombola.php');
?>

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <?php if (!isset($_GET['action'])):?>
            <!-- DASHBOARD CONTENT -->
            <div class="dashboard-content">
                <!-- HEADLINE -->
                <div class="headline buttons primary">
                    <h4>Administration tombola</h4>
                    <a href="<?= url_panel; ?>/<?= $nomPage; ?>.html?action=add" class="button mid-short primary">Ajouter un cadeau Tombola</a>
                </div>
                <!-- /HEADLINE -->
                <!-- PURCHASES LIST -->
                <div class="purchases-list">
                    <form method="post">
                        <!-- PURCHASES LIST HEADER -->
                        <div class="purchases-list-header">
                            <div class="purchases-list-header-date">
                                <p class="text-header small">Nom du cadeau</p>
                            </div>
                            <div class="purchases-list-header-details">
                                <p class="text-header small">Date de fin</p>
                            </div>
                            <div class="purchases-list-header-info">
                                <p class="text-header small">Participations</p>
                            </div>
                            <div class="purchases-list-header-price">
                                <p class="text-header small">Gagnant</p>
                            </div>
                            <div class="purchases-list-header-download">
                                <p class="text-header small">Actions</p>
                            </div>
                        </div>
                        <!-- /PURCHASES LIST HEADER -->
                        <?php //Bloc requete SQL pour la prochaine boucle
                        $messagesParPage = 50;
                        $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM tombolas");
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

                        $offer = $pdo->query("SELECT * FROM tombolas ORDER BY dateFin DESC LIMIT ".$premiereEntree.", ".$messagesParPage."");
                        $all_offers = $offer->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach ($all_offers as $dones_offers):?>
                            <?php //Bloc req SQL pour fetch
                            $dateFin = date("d/m/Y", strtotime($dones_offers['dateFin']));

                            $retour_totalPart = $pdo->query("SELECT COUNT(*) AS total FROM tombolasParticipation WHERE idTombola = '".intval($dones_offers['id'])."'");
                            $donnees_totalPart = $retour_totalPart->fetch();
                            $totalPart = $donnees_totalPart['total'];

                            $sql_userWin = $pdo->query("SELECT nom, prenom FROM users WHERE id = '".$dones_offers['idUser']."' ");
                            $resultat_userWin = $sql_userWin->fetch(PDO::FETCH_ASSOC);
                            $winNom = $resultat_userWin['nom'];
                            $winPrenom = $resultat_userWin['prenom'];
                            ?>
                            <!-- PURCHASE ITEM -->
                            <div class="purchase-item">
                                <div class="purchase-item-date">
                                    <p><?= $dones_offers['name']; ?></p>
                                </div>
                                <div class="purchase-item-details">
                                    <p class="text-header" style="margin-top: 28px"><?= $dateFin ?></p>
                                </div>
                                <div class="purchase-item-info">
                                    <p class="category primary" style="margin-top: 28px"><?= displayMontant($totalPart, 0, ''); ?></p>
                                </div>
                                <div class="purchase-item-price">
                                    <?php if ($dones_offers['idUser'] != 0) echo $winPrenom.' '.substr($winNom , 0, 2).'.'; else echo '-'; ?>
                                </div>
                                <div class="purchase-item-download">
                                    <a href="<?= url_panel; ?>/<?= $nomPage; ?>.html?action=update&id=<?= $dones_offers['id']; ?>" class="display-inline-block button secondary">Modifier</a>
                                </div>

                            </div>
                            <!-- /PURCHASE ITEM -->
                        <?php endforeach; ?>
                    </form>
                </div>
                <!-- /PURCHASES LIST -->

            </div>
            <!-- /DASHBOARD CONTENT -->
            <div class="clearfix"></div>
        <?php elseif ($_GET['action'] == 'add')	:?>
            <!-- DASHBOARD CONTENT -->
            <div class="dashboard-content">
                <!-- HEADLINE -->
                <div class="headline buttons primary">
                    <h4>Administration concours</h4>
                    <a href="<?= url_panel; ?>/<?= $nomPage; ?>.html" class="button mid-short primary">Retour</a>
                </div>
                <!-- /HEADLINE -->
                <!-- FORM BOX ITEMS -->
                <div class="form-box-items wrap-3-1 left">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item full">
                        <h4>Ajouter un cadeau tombola</h4>
                        <hr class="line-separator">
                        <form id="upload_form" method="post">


                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="nameCadeau" class="rl-label required">Nom du cadeau</label>
                                <input type="text" id="nameCadeau" name="name" placeholder="Nom du cadeau" value="<?= $post_name; ?>" required>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="image" class="rl-label required">URL de l'image</label>
                                <input type="text" id="image" name="image" placeholder="Lien URL de l'image (http://...)" value="<?= $post_image; ?>" required >
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <label for="description" class="rl-label required">Description</label>
                                <textarea id="description" name="description" placeholder="Description du cadeau tombola..." required>
                                <?= $post_description; ?>
                            </textarea>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="date" class="rl-label required">Date de fin (Format: YYYY-mm-dd)</label>
                                <input type="date" id="date" name="date" value="<?= $post_date; ?>" required>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <hr class="line-separator">
                            <input type="submit" name="submit_add" value="Ajouter un cadeau tombola" class="submit button big dark"/>
                        </form>
                    </div>
                    <!-- /FORM BOX ITEM -->
                </div>
                <!-- /FORM BOX ITEMS -->
            </div>
            <!-- /DASHBOARD CONTENT -->
            <div class="clearfix"></div>
        <?php elseif ($_GET['action'] == 'update')	:?>
            <?php //Bloc req SQL pour le formulaire de modification
            $sqlTombola = $pdo->query("SELECT * FROM tombolas WHERE id = '".intval($_GET['id'])."'");
            $resultatTombola = $sqlTombola->fetch();
            $tombolaName = $resultatTombola['name'];
            $tombolaImage = $resultatTombola['image'];
            $tombolaDescription = $resultatTombola['description'];
            $tombolaDate = $resultatTombola['dateFin'];
            ?>
            <!-- DASHBOARD CONTENT -->
            <div class="dashboard-content">
                <!-- HEADLINE -->
                <div class="headline buttons primary">
                    <h4>Administration concours</h4>
                    <a href="<?= url_panel; ?>/<?= $nomPage; ?>.html" class="button mid-short primary">Retour</a>
                </div>
                <!-- /HEADLINE -->
                <!-- FORM BOX ITEMS -->
                <div class="form-box-items wrap-3-1 left">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item full">
                        <h4>Ajouter un cadeau tombola</h4>
                        <hr class="line-separator">
                        <form id="upload_form" method="post">


                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="nameCadeau" class="rl-label required">Nom du cadeau</label>
                                <input type="text" id="nameCadeau" name="name" placeholder="Nom du cadeau" value="<?= $tombolaName; ?>" required>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="image" class="rl-label required">URL de l'image</label>
                                <input type="text" id="image" name="image" placeholder="Lien URL de l'image (http://...)" value="<?= $tombolaImage; ?>" required >
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <label for="description" class="rl-label required">Description</label>
                                <textarea id="description" name="description" placeholder="Description du cadeau tombola..." required>
                                <?= $tombolaDescription; ?>
                            </textarea>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="date" class="rl-label required">Date de fin (Format: YYYY-mm-dd)</label>
                                <input type="date" id="date" name="date" value="<?= $tombolaDate; ?>" required>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <hr class="line-separator">
                            <input type="submit" name="submit_upd" value="Modifier un cadeau tombola" class="submit button big dark"/>
                        </form>
                    </div>
                    <!-- /FORM BOX ITEM -->
                </div>
                <!-- /FORM BOX ITEMS -->
            </div>
            <!-- /DASHBOARD CONTENT -->
            <div class="clearfix"></div>
        <?php endif; ?>
    </div>
    <!-- /DASHBOARD BODY -->

<?php include('./requiert/inc-footer.php');?>