<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Concours | Quizzdeal.fr';
	$nomPage = 'concours';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/concours.php');
?>

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <?php if (!isset($_GET['action'])): //Controle action?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
                <!-- HEADLINE -->
                <div class="headline buttons primary">
                <h4>Administration concours</h4>
            </div>
                <!-- /HEADLINE -->
            <!-- PURCHASES LIST -->
            <div class="purchases-list">
                <form method="post">
                    <!-- PURCHASES LIST HEADER -->
                    <div class="purchases-list-header">
                        <div class="purchases-list-header-date">
                            <p class="text-header small">Concours</p>
                        </div>
                        <div class="purchases-list-header-info">
                            <p class="text-header small">Date début</p>
                        </div>
                        <div class="purchases-list-header-info">
                            <p class="text-header small">Date fin</p>
                        </div>
                        <div class="purchases-list-header-price">
                            <p class="text-header small">Etat</p>
                        </div>
                        <div class="purchases-list-header-download">
                            <p class="text-header small">Actions</p>
                    </div>
                    </div>
                    <!-- /PURCHASES LIST HEADER -->
                    <?php //Bloc req SQL pour la prochaine boucle
                $offer = $pdo->query("SELECT * FROM concours ORDER BY nom");
                $all_offers = $offer->fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <?php foreach ($all_offers as $dones_offers)://Boucle all_offers?>
                        <?php if ($dones_offers['actif'] == 1) {
                        $dones_offers['actif'] = 'Actif';
                        $boutonActif = '<button name="desactive" value="'.$dones_offers['id'].'" class="display-inline-block button tertiary">Mettre en pause</button>'; } else if ($dones_offers['actif'] == 0) { $dones_offers['actif'] = 'Inactif'; $boutonActif = '<button name="active" value="'.$dones_offers['id'].'" class="display-inline-block button primary">Activer</button>';
                        }
                        ?>
                    <!-- PURCHASE ITEM -->
                    <div class="purchase-item">
                        <div class="purchase-item-date">
                            <p><?= $dones_offers['nom']; ?></p>
                        </div>
                        <div class="purchase-item-info">
                            <p class="text-header" style="margin-top: 30px"><?= $dones_offers['dateDebut']; ?></p>
                        </div>
                        <div class="purchase-item-info">
                            <p class="category primary" style="margin-top: 30px"><?= $dones_offers['dateFin']; ?></p>
                        </div>
                        <div class="purchase-item-price">
                            <p class="price"><?= $dones_offers['actif']; ?></p>
                        </div>
                        <div class="purchase-item-details">
                            <?= $boutonActif ?>
                                <a href="<?= url_panel; ?>/concours.html?action=update&id=<?= $dones_offers['id']; ?>">
                                    <div class="display-inline-block button secondary">Modifier</div>
                                </a>
                        </div>
                    </div>
                    <!-- /PURCHASE ITEM -->
                    <?php endforeach;//Boucle all_offers ?>
                </form>
            </div>
            <!-- /PURCHASES LIST -->
        </div>
        <!-- /DASHBOARD CONTENT -->
            <div class="clearfix"></div>
        <?php elseif ($_GET['action'] == 'update')	:?>
            <?php //Bloc req SQL pour le formulaire de modification
            $sqlConcours = $pdo->query("SELECT * FROM concours WHERE id = '".intval($_GET['id'])."'");
            $resultatConcours = $sqlConcours->fetch();
            $nomConcours = $resultatConcours['nom'];
            $descriptionConcours = $resultatConcours['description'];
            $dateDebutConcours = $resultatConcours['dateDebut'];
            $dateFinConcours = $resultatConcours['dateFin'];

            $gagnant1Concours = $resultatConcours['gagnant1'];
            $gagnant2Concours = $resultatConcours['gagnant2'];
            $gagnant3Concours = $resultatConcours['gagnant3'];
            $gagnant4Concours = $resultatConcours['gagnant4'];
            $gagnant5Concours = $resultatConcours['gagnant5'];
            ?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline buttons primary">
                <h4>Administration concours</h4>
                <a href="<?= url_panel; ?>/concours.html" class="button mid-short primary">Retour</a>
            </div>
            <!-- /HEADLINE -->
            <!-- FORM BOX ITEMS -->
            <div class="form-box-items wrap-3-1 left">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item full">
                    <h4>Nom du concours: <?= $nomConcours; ?></h4>
                    <hr class="line-separator">
                    <form id="upload_form" method="post">
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description" class="rl-label required">Description</label>
                            <textarea id="description" name="description" placeholder="Entrez la description du concours..." required><?= $descriptionConcours ?></textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="dateDebut" class="rl-label required">Date de début (Exemple: 2018-04-01 18:00:00)</label>
                            <input type="text" id="dateDebut" name="dateDebut" value="<?= $dateDebutConcours ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="dateFin" class="rl-label required">Date de fin (Exemple: 2018-04-01 18:00:00)</label>
                            <input type="text" id="dateFin" name="dateFin" value="<?= $dateFinConcours ?>" required >
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="gagnant1" class="rl-label required">1er</label>
                            <input type="text" id="gagnant1" name="gagnant1" value="<?= $gagnant1Concours ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="gagnant2" class="rl-label required">2ème</label>
                            <input type="text" id="gagnant2" name="gagnant2" value="<?= $gagnant2Concours ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="gagnant3" class="rl-label required">3ème</label>
                            <input type="text" id="gagnant3" name="gagnant3" value="<?= $gagnant3Concours ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="gagnant4" class="rl-label required">4ème</label>
                            <input type="text" id="gagnant4" name="gagnant4" value="<?= $gagnant4Concours ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="gagnant5" class="rl-label required">5ème</label>
                            <input type="text" id="gagnant5" name="gagnant5" value="<?= $gagnant5Concours ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <hr class="line-separator">
                        <input type="submit" name="submit_upd" value="Modifier les informations" class="submit button big dark"/>
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