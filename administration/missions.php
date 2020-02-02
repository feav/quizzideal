<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Missions | Quizzdeal.fr';
	$nomPage = 'missions';

	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/missions.php');
?>
    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
    <?php if (!isset($_GET['action'])):?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline statement primary">
                <h4>Administration des missions</h4>
                <a href="<?= url_panel; ?>/missions.html?action=add" class="button primary">Ajouter un offre</a>
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
                        <p class="text-header small">Utilisateur|Pays</p>
                    </div>
                    <div class="transaction-list-header-item admin-s1">
                        <p class="text-header small">Rémunération</p>
                    </div>
                    <div class="transaction-list-header-detail admin-s1">
                        <p class="text-header small">Etat</p>
                    </div>
                    <div class="transaction-list-header-code">
                        <p class="text-header small">Action</p>
                    </div>
                </div>
                    <!-- /TRANSACTION LIST HEADER -->
                    <?php
                $messagesParPage = 50;
                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM offers");
                $donnees_total = $retour_total->fetch();
                $total = $donnees_total['total'];
                $nombreDePages = ceil($total / $messagesParPage);

                if (isset($_GET['page'])) {
                    $pageActuelle = intval($_GET['page']);
                    if ($pageActuelle > $nombreDePages) {
                        $pageActuelle = $nombreDePages;
                    } } else {
                    $pageActuelle = 1;
                }

                $premiereEntree = ($pageActuelle - 1) * $messagesParPage;

                $offer = $pdo->query("SELECT * FROM offers ORDER BY nom LIMIT ".$premiereEntree.", ".$messagesParPage."");
                $all_offers = $offer->fetchAll(PDO::FETCH_ASSOC);?>
                    <?php foreach ($all_offers as $dones_offers):?>
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
                <div class="transaction-list-item" style="overflow: hidden;">
                    <div class="transaction-list-item-date admin-s1">
                        <p ><?= $dones_offers['idoffre']; ?></p>
                    </div>
                    <div class="transaction-list-item-author admin-s1">
                        <p class="category primary">
                            <?= $dones_offers['nom']; ?>
                            <?php if ($dones_offers['premium'] == 1): ?>
                                <span class="tertiary">PREMIUM</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="transaction-list-item-item admin-s1">
                        <p class="text-header"><?= $dones_offers['annonceur']; ?> - <strong><?= $dones_offers['regie']; ?></strong> | <?= $dones_offers['pays']; ?></p>
                    </div>
                    <div class="transaction-list-item-detail admin-s1">
                        <p><?= displayMontant($dones_offers['remuneration'], 2, ' €'); ?></p>
                    </div>
                    <div class="transaction-list-item-code">
                        <p><?= $dones_offers['actif']; ?></p>
                    </div>
                    <div class="transaction-list-item-price flexy">
                        <?= $boutonActif; ?>
                        <a href="<?= url_panel; ?>/missions.html?action=update&id=<?= $dones_offers['id']; ?>" class="button secondary-dark">Modifier</a>
                    </div>
                </div>
                <!-- /TRANSACTION LIST ITEM -->
                <?php endforeach; ?>
                </form>
                <?php if ($pageActuelle != 1) { $page_p = ($pageActuelle - 1); ?><a href="<?= url_panel; ?>/missions.html?page=<?php echo $page_p; ?>"><div class="button secondary cursor-pointer display-inline-block">Page précédente</div></a><?php } else { ?><div class="button secondary-dark cursor-not-allowed display-inline-block">Page précédente</div><?php } ?>
                <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) { $page_s = ($pageActuelle + 1); ?><a href="<?= url_panel; ?>/missions.html?page=<?php echo $page_s; ?>"><div class="button secondary cursor-pointer display-inline-block" style="float : right;">Page suivante</div></a><?php } else { ?><div class="button secondary-dark cursor-not-allowed display-inline-block" style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>
            </div>
            <!-- /TRANSACTION LIST -->
        </div>
        <!-- DASHBOARD CONTENT -->
    <?php elseif ($_GET['action'] == 'add'):?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline buttons primary">
                <h4>Ajouter une mission</h4>
                <a href="<?= url_panel; ?>/missions.html" class="button mid-short primary">Retour</a>
            </div>
            <!-- /HEADLINE -->

            <!-- FORM BOX ITEMS -->
            <div class="form-box-items">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item">
                    <h4>Ajouter une mission</h4>
                    <hr class="line-separator">

                    <form id="profile-info-form" method="post" enctype="multipart/form-data">
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="nom" class="rl-label required">Nom de l'offre</label>
                            <input type="text" id="nom" name="nom" value="<?= $post_nom; ?>" placeholder="Entrez le nom de l'offre..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="url" class="rl-label required">Url de l'offre</label>
                            <input type="text" id="url" name="url" value="<?= $post_url; ?>" placeholder="Entrez l'url de l'offre..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description" class="rl-label">Description de l'offre</label>
                            <input type="text" id="description" name="description" placeholder="Entrez une courte description (optionel)" value="<?= $post_description; ?>">
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description2" class="rl-label">Description de l'offre (Longue)</label>
                            <textarea id="description2" name="description2" placeholder="Entrez une longue description (optionel)"><?= $post_description2; ?></textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="remuneration" class="rl-label required">Rémunération aux membres</label>
                            <input type="number" step="0.01" min="0.01" id="remuneration" name="remuneration" placeholder="0,01" value="<?= $post_remuneration; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="pays" class="rl-label required">Pays acceptés</label>
                            <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE" value="<?= $post_pays; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="premium" class="rl-label required">Premium</label>
                            <label for="premium" class="select-block">
                                <select name="premium" id="premium">
                                    <option value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                    <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="valid" class="rl-label required">Validation directe (0 = non | 1 = oui)</label>
                            <input type="number" min="0" max="1" id="valid" name="valid" placeholder="0" value="<?= $post_valid; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="quota" class="rl-label">Quota quotidien (0 = illimité)</label>
                            <input type="number" min="0" id="quota" name="quota" placeholder="0" value="<?= $post_quota; ?>">
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="montant" class="rl-label required">Rémunération sur régie</label>
                            <input type="number" step="0.01" min="0.01" id="montant" name="montant" placeholder="0,01" value="<?= $post_montant ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="regie" class="rl-label required">Régie publicitaire</label>
                            <input type="text" id="regie" name="regie" placeholder="Régie publicitaire" value="<?= $post_regie; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="about" class="rl-label required">Annonceur</label>
                            <input type="text" id="annonceur" name="annonceur" placeholder="Annonceur" value="<?= $post_annonceur; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="imageMission" class="rl-label">Image de la mission</label>
                            <input id="image" name="imageMission" type="file" placeholder="Uploader une image" required style="width: 100%;padding: 10px;border: 1px solid #ebebeb;">
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <input type="hidden" name="idoffre" value="new"/>
                        <input type="submit" name="submit_add" class="button big dark" value="Ajouter la mission">
                    </form>
                </div>
                <!-- /FORM BOX ITEM -->
            </div>
            <!-- /FORM BOX -->
        </div>
        <!-- DASHBOARD CONTENT -->
    <?php elseif ($_GET['action'] == 'update'):?>
        <?php //Bloc req SQL pour le formulaire de modification
        $sqlMissions = $pdo->query("SELECT * FROM offers WHERE id = '".intval($_GET['id'])."'");
        $resultatMissions = $sqlMissions->fetch();
        $nomOffre = $resultatMissions['nom'];
        $urlOffre = $resultatMissions['url'];
        $descriptionOffre = $resultatMissions['description'];
        $descriptionOffre2 = $resultatMissions['description2'];
        $paysOffre = $resultatMissions['pays'];
        $remunerationOffre = $resultatMissions['remuneration'];
        $montantOffre = $resultatMissions['montant'];
        $validOffre = $resultatMissions['valid'];
        $regieOffre = $resultatMissions['regie'];
        $annonceurOffre = $resultatMissions['annonceur'];
        $quotaOffre = $resultatMissions['quota'];
        $premiumOffre = $resultatMissions['premium'];
        $imageMission = $resultatMissions['image'];
        ?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline buttons primary">
                <h4>Modifier une mission</h4>
                <a href="<?= url_panel; ?>/missions.html" class="button mid-short primary">Retour</a>
            </div>
            <!-- /HEADLINE -->

            <!-- FORM BOX ITEMS -->
            <div class="form-box-items">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item">
                    <h4>Modifier une mission</h4>
                    <hr class="line-separator">

                    <form id="profile-info-form" method="post" enctype="multipart/form-data">
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="nom" class="rl-label required">Nom de l'offre</label>
                            <input type="text" id="nom" name="nom" value="<?= $nomOffre; ?>" placeholder="Entrez le nom de l'offre..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="url" class="rl-label required">Url de l'offre</label>
                            <input type="text" id="url" name="url" value="<?= $urlOffre; ?>" placeholder="Entrez l'url de l'offre..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description" class="rl-label">Description de l'offre</label>
                            <input type="text" id="description" name="description" placeholder="Entrez une courte description (optionel)" value="<?= $descriptionOffre; ?>">
                        </div>

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description2" class="rl-label">Description de l'offre (Longue)</label>
                            <textarea id="description2" name="description2" placeholder="Entrez une longue description (optionel)"><?= $descriptionOffre2; ?></textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="remuneration" class="rl-label required">Rémunération aux membres</label>
                            <input type="number" step="0.01" min="0.01" id="remuneration" name="remuneration" placeholder="0,01" value="<?= $remunerationOffre; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="pays" class="rl-label required">Pays acceptés</label>
                            <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE" value="<?= $paysOffre; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="premium" class="rl-label required">Premium</label>
                            <label for="premium" class="select-block">
                                <select name="premium" id="premium">
                                    <option value="0"<?php if ($premiumOffre == 0) echo ' selected'; ?>>Non</option>
                                    <option value="1"<?php if ($premiumOffre == 1) echo ' selected'; ?>>Oui</option>
                                </select>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                    <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="valid" class="rl-label required">Validation directe (0 = non | 1 = oui)</label>
                            <input type="number" min="0" max="1" id="valid" name="valid" placeholder="0" value="<?= $validOffre; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="quota" class="rl-label">Quota quotidien (0 = illimité)</label>
                            <input type="number" min="0" id="quota" name="quota" placeholder="0" value="<?= $quotaOffre; ?>">
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="montant" class="rl-label required">Rémunération sur régie</label>
                            <input type="number" step="0.01" min="0.01" id="montant" name="montant" placeholder="0,01" value="<?= $montantOffre ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="regie" class="rl-label required">Régie publicitaire</label>
                            <input type="text" id="regie" name="regie" placeholder="Régie publicitaire" value="<?= $regieOffre; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="about" class="rl-label required">Annonceur</label>
                            <input type="text" id="annonceur" name="annonceur" placeholder="Annonceur" value="<?= $annonceurOffre; ?>" required>
                        </div>

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="imageMission" class="rl-label">Image de la mission</label>
                            <input id="image" name="imageMission" type="file" placeholder="Uploader une image" style="width: 100%;padding: 10px;border: 1px solid #ebebeb;">
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <div class="input-container">
                            <img class="img_cashback" src="<?= $imageMission; ?>">
                        </div>

                        <!-- /INPUT CONTAINER -->
                        <input type="submit" name="submit_upd" class="button big dark" value="Modifier la mission">
                    </form>
                </div>
                <!-- /FORM BOX ITEM -->
            </div>
            <!-- /FORM BOX -->
        </div>
        <!-- DASHBOARD CONTENT -->
    <?php endif; ?>
    </div>
    <!-- /DASHBOARD BODY -->

<?php
	include('./requiert/inc-footer.php');
?>