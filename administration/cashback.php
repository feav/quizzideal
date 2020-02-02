<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Cashback | Quizzdeal.fr';
	$nomPage = 'cashback';

	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/cashback.php');
?>
    <!-- DASHBOARD BODY -->
	<style>
	.button {
		padding-left: 5px;
		margin-right: 10px;
		padding-right: 5px;
		margin-top: 10px;
	}
	select {
		-webkit-appearance: menulist;
	}
	select, input, textarea {
		color:#000;
		background-color: whitesmoke;
	}
	</style>
    <div class="dashboard-body">
    <?php if (!isset($_GET['action'])):?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline statement primary">
                <h4>Administration des cashback</h4>
                <a href="<?= url_panel; ?>/cashback.html?action=add" class="button primary">Ajouter un Cashback</a>
            </div>
            <!-- /HEADLINE -->

            <!-- TRANSACTION LIST -->
            <div class="transaction-list">
                <form method="post">
                    <!-- TRANSACTION LIST HEADER -->
                    <div class="transaction-list-header">
                    <div class="transaction-list-header-date admin-s1">
                        <p class="text-header small">Type</p>
                    </div>
                    <div class="transaction-list-header-author admin-s1">
                        <p class="text-header small">Nom</p>
                    </div>
                    <div class="transaction-list-header-item admin-s1">
                        <p class="text-header small">Rénumération</p>
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
                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM cashback");
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

                $offer = $pdo->query("SELECT * FROM cashback ORDER BY nom LIMIT ".$premiereEntree.", ".$messagesParPage."");
                $all_cashback = $offer->fetchAll(PDO::FETCH_ASSOC);?>
                    <?php foreach ($all_cashback as $dones_cashback):?>
                    <?php
                    //if ($dones_cashback['status'] == 1) { $dones_cashback['status'] = 'status'; $boutonstatus = '<a href="" class="m-r-5"><div class="display-inline-block button bg-red bg-red-hover color-white p-5-10 b-r-50 uppercase">Mettre en pause</div></a>'; } else if ($dones_cashback['status'] == 0) { $dones_cashback['status'] = 'Instatus'; $boutonstatus = '<a href="" class="m-r-5"><div class="display-inline-block button bg-green bg-green-hover color-white p-5-10 b-r-50 uppercase">Activer</div></a>'; }
                    if ($dones_cashback['actif'] == 1) {
                        $dones_cashback['actif'] = 'actif';
                        $boutonstatus = '<button name="desactive" value="'.$dones_cashback['id'].'" class="button secondary ">Pause</button>';
                    } else if ($dones_cashback['actif'] == 0) {
                        $dones_cashback['actif'] = 'Inactif';
                        $boutonstatus = '<button name="active" value="'.$dones_cashback['id'].'" class="button primary">Activer</button>';
                    }
                    ?>
                <!-- TRANSACTION LIST ITEM -->
                <div class="transaction-list-item" style="overflow: hidden;">
                    <div class="transaction-list-item-date admin-s1">
                        <p ><?= $dones_cashback['typecashback']; ?></p>
                    </div>
                    <div class="transaction-list-item-author admin-s1">
                        <p class="category primary">
                            <?= $dones_cashback['nom']; ?>                          
                        </p>
                    </div>
                   <div class="transaction-list-item-author admin-s1">
                        <p class="category primary">
                            <?= $dones_cashback['renumeration'] . ' ' . $dones_cashback['pourcentage']; ?> 
                        </p>
                    </div>
                    <div class="transaction-list-item-code">
                        <p><?= $dones_cashback['actif']; ?></p>
                    </div>
                    <div class="transaction-list-item-price flexy">
                        <?= $boutonstatus; ?>
                        <a href="<?= url_panel; ?>/cashback.html?action=update&id=<?= $dones_cashback['id']; ?>" class="button secondary-dark">Modifier</a>
                    </div>
                </div>
                <!-- /TRANSACTION LIST ITEM -->
                <?php endforeach; ?>
                </form>
                <?php if ($pageActuelle != 1) { $page_p = ($pageActuelle - 1); ?><a href="<?= url_panel; ?>/cashback.html?page=<?php echo $page_p; ?>"><div class="button secondary cursor-pointer display-inline-block">Page précédente</div></a><?php } else { ?><div class="button secondary-dark cursor-not-allowed display-inline-block">Page précédente</div><?php } ?>
                <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) { $page_s = ($pageActuelle + 1); ?><a href="<?= url_panel; ?>/cashback.html?page=<?php echo $page_s; ?>"><div class="button secondary cursor-pointer display-inline-block" style="float : right;">Page suivante</div></a><?php } else { ?><div class="button secondary-dark cursor-not-allowed display-inline-block" style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>
            </div>
            <!-- /TRANSACTION LIST -->
        </div>
        <!-- DASHBOARD CONTENT -->
    <?php elseif ($_GET['action'] == 'add'):?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline buttons primary">
                <h4>Ajouter un cashback</h4>
                <a href="<?= url_panel; ?>/cashback.html" class="button mid-short primary">Retour</a>
            </div>
            <!-- /HEADLINE -->

            <!-- FORM BOX ITEMS -->
            <div class="form-box-items">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item" style="width: 100%;">
                    <h4>Ajouter un cashback</h4>
                    <hr class="line-separator">
                    <form id="profile-info-form" method="post" enctype="multipart/form-data">
					
						<!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="typecashback" class="rl-label required">Type de cashback</label>
							<select name="typecashback" id="typecashback" placeholder="Entrez le type du cashback..." required>
								<option value="cashback" selected="selected">Cashback</option>
								<option value="pourcentage">Pourcentage</option>
							</select>                           
                        </div>
                        <!-- /INPUT CONTAINER -->
						
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="nom" class="rl-label required">Nom du cashback</label>
                            <input type="text" id="nom" name="nom" value="<?= $post_nom; ?>" placeholder="Entrez le nom du cashaback..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->
                        <?php
                            $sql = "SELECT * FROM category_cashback";
                            $req = $pdo->query($sql);
                            $categories = $req->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <div class="input-container half">
                            <label for="category" class="rl-label required">Categorie</label>
                            <select name="category" id="category" required>
                                <option value="" selected></option>
                                <?php foreach ($categories as $category) : ?> 
                                    <option value="<?= $category['id']?>"><?= $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>                           
                        </div>

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="url" class="rl-label required">Url du cashback</label>
                            <input type="text" id="url" name="url" value="<?= $post_url; ?>" placeholder="Entrez l'url du cashback..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="rénumération" class="rl-label required">cashaback</label>
                            <input type="text" id="rénumération" name="rénumération" placeholder="rénumération" value="<?= $post_rénumération; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="typerenumeration" class="rl-label required">Type de rénumération</label>
                            <select name="typerenumeration" id="typerenumeration" required>
                                <option value="€" selected="selected">€</option>
                                <option value="%">%</option>
                            </select>                           
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="pays" class="rl-label required">Pays acceptés</label>
                            <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE" value="<?= $post_pays; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description" class="rl-label">Description du cashaback (Longue)</label>
                            <textarea id="description" name="description" placeholder="Entrez une longue description (optionel)"><?= $post_description; ?></textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description" class="rl-label">Image du cashback</label>
                            <input id="image" name="image" type="file" placeholder="Uploader une image" required style="width: 100%;padding: 10px;border: 1px solid #ebebeb;">
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- /INPUT CONTAINER -->
                        <input type="hidden" name="id" value="new"/>
                        <input type="submit" name="submit_add" class="button big dark" value="Ajouter le cashback">
                    </form>
                </div>
                <!-- /FORM BOX ITEM -->
            </div>
            <!-- /FORM BOX -->
        </div>
        <!-- DASHBOARD CONTENT -->
    <?php elseif ($_GET['action'] == 'update'):?>
        <?php //Bloc req SQL pour le formulaire de modification
        $sqlMissions = $pdo->query("SELECT * FROM cashback WHERE id = '".intval($_GET['id'])."'");
        $resultatMissions = $sqlMissions->fetch();
        $nomOffre = $resultatMissions['nom'];
		$idcashbackOffre = $resultatMissions['idcashback'];
		$pourcentageOffre = $resultatMissions['idcashback'];
        $urlOffre = $resultatMissions['url'];
        $descriptionOffre = $resultatMissions['description'];
        $paysOffre = $resultatMissions['pays'];
        $rénumérationoffres = $resultatMissions['renumeration'];
        $typerenumeration = $resultatMissions['pourcentage'];
		$typecashback = $resultatMissions['typecashback'];
		$imagecashback = $resultatMissions['image'];
        $categoryCashback = $resultatMissions['idCategory'];
       
        ?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline buttons primary">
                <h4>Modifier un cashback</h4>
                <a href="<?= url_panel; ?>/cashback.html" class="button mid-short primary">Retour</a>
            </div>
            <!-- /HEADLINE -->

            <!-- FORM BOX ITEMS -->
            <div class="form-box-items">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item" style="width:100%;">
                    <h4>Modifier un cashback</h4>
                    <hr class="line-separator">

                    <form id="profile-info-form" method="post" enctype="multipart/form-data">
					
						<!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="typecashback" class="rl-label required">Type de cashback</label>
							<select name="typecashback" id="typecashback" placeholder="Entrez le type du cashback..." required>
								<option value="cashback" <?= ($typecashback=='cashback'?'selected="selected"':'') ?>>Cashback</option>
							</select>                           
                        </div>
                        <!-- /INPUT CONTAINER -->
						
						<!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="nom" class="rl-label required">Nom du cashback</label>
                            <input type="text" id="nom" name="nom" value="<?= $nomOffre; ?>" placeholder="Entrez le nom du cashback..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <?php
                            $sql = "SELECT * FROM category_cashback";
                            $req = $pdo->query($sql);
                            $categories = $req->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <div class="input-container half">
                            <label for="category" class="rl-label required">Categorie</label>
                            <select name="category" id="category" required>
                                <option value="" selected></option>
                                <?php foreach ($categories as $category) : ?> 
                                    <option value="<?= $category['id']?>" <?= $category['id']==$categoryCashback ? 'selected':''; ?> ><?= $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>                           
                        </div>
						
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="cashback" class="rl-label required">Cashback</label>
                            <input type="text" id="cashback" name="cashback" value="<?= $typecashback; ?>" placeholder="Entrez le cashback..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="url" class="rl-label required">Url du cashback</label>
                            <input type="text" id="url" name="url" value="<?= $urlOffre; ?>" placeholder="Entrez l'url du cashback..." required>
                        </div>
                        <!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="rénumération" class="rl-label required">rénumération</label>
                            <input type="text" id="rénumération" name="rénumération" value="<?= $rénumérationoffres; ?>"required>
                        </div>
                        <!-- /INPUT CONTAINER -->
						
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="typerenumeration" class="rl-label required">Type de rénumération</label>
                            <select name="typerenumeration" id="typerenumeration" required>
                                <option value="€" <?= $typerenumeration === '€' ? 'selected' : ''; ?> >€</option>
                                <option value="%" <?= $typerenumeration === '%' ? 'selected' : ''; ?> >%</option>
                            </select>                           
                        </div>
                        <!-- /INPUT CONTAINER -->
						
                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description" class="rl-label">Description du cashback (Longue)</label>
                            <textarea id="description" name="description" placeholder="Entrez une longue description (optionel)"><?= $descriptionOffre; ?></textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->
						
                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="pays" class="rl-label required">Pays acceptés</label>
                            <input type="text" id="pays" name="pays" placeholder="Exemple : FR BE" value="<?= $paysOffre; ?>" required>
                        </div>
                        <!-- /INPUT CONTAINER -->
						
						<!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="description" class="rl-label">Image du cashback</label>
                            <input name="image" type="file" placeholder="Uploader une image" style="width: 100%;padding: 10px;border: 1px solid #ebebeb;">
                        </div>
                        <!-- /INPUT CONTAINER -->
						<div class="input-container">
							<img class="img_cashback" src="<?= $imagecashback; ?>">
						</div>
                       
                        <input type="submit" name="submit_upd" class="button big dark" value="Modifier le cashback">
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