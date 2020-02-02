<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Membres | Quizzdeal.fr';
	$nomPage = 'membres';

	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/membres.php');
?>

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">

        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline statement primary">
                <h4>Les membres</h4>
                <a href="<?= url_panel; ?>/membres.html" class="button primary">Retour</a>
            </div>
            <!-- /HEADLINE -->

            <?php if (!isset($_GET['action'])):?>
            <!-- TRANSACTION LIST -->
            <div class="transaction-list">
                <!-- TRANSACTION LIST HEADER -->
                <div class="transaction-list-header">
                    <div class="transaction-list-header-date">
                        <p class="text-header small">Utilisateur</p>
                    </div>
                    <div class="transaction-list-header-author">
                        <p class="text-header small">Adresse e-mail</p>
                    </div>
                    <div class="transaction-list-header-item">
                        <p class="text-header small">Solde</p>
                    </div>
                    <div class="transaction-list-header-detail">
                        <p class="text-header small">Actions</p>
                    </div>
                </div>
                <!-- /TRANSACTION LIST HEADER -->
                <?php
                $messagesParPage = 50;
                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM users");
                $donnees_total = $retour_total->fetch();
                $total = $donnees_total['total'];
                $nombreDePages = ceil($total / $messagesParPage);

                if (isset($_GET['page'])) { $pageActuelle = intval($_GET['page']); if ($pageActuelle > $nombreDePages) { $pageActuelle = $nombreDePages; } } else { $pageActuelle = 1; }

                $premiereEntree = ($pageActuelle - 1) * $messagesParPage;

                $user = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT ".$premiereEntree.", ".$messagesParPage."");
                $all_users = $user->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($all_users as $dones_user):?>
                <!-- TRANSACTION LIST ITEM -->
                <div class="transaction-list-item">
                    <div class="transaction-list-item-date">
                        <p>
                            <?= $dones_user['prenom']; ?> <?= $dones_user['nom']; ?>
                            <?php if ($dones_user['premium'] == 1): ?>
                                <span class="tertiary">PREMIUM</span>
                            <?php endif; ?>
                        </p>

                    </div>
                    <div class="transaction-list-item-author">
                        <p class="text-header"><?= $dones_user['email']; ?></p>
                    </div>
                    <div class="transaction-list-item-item">
                        <p class="category primary"><?= displayMontant($dones_user['euros'], 2, ' €'); ?></p>
                    </div>
                    <div class="transaction-list-item-detail">
                        <a href="<?= url_panel; ?>/membres.html?action=<?= $dones_user['id']; ?>">
                            <div class="button secondary">Voir le profil</div>
                        </a>
                    </div>

                </div>
                <!-- /TRANSACTION LIST ITEM -->
                <?php endforeach;?>
            </div>
            <!-- /TRANSACTION LIST -->
                <!-- PAGINATION-->
                <?php if ($pageActuelle != 1):?>
                <?php $page_p = ($pageActuelle - 1); ?>
                <a href="<?= url_panel; ?>/membres.php?page=<?php echo $page_p; ?>">
                    <div class="button primary bg-grey-hover b-r-5 display-inline-block p-5-10">Page précédente</div>
                </a>
            <?php else: ?>
                <div class="button secondary-new b-r-5 display-inline-block p-5-10 color-grey cursor-not-allowed">Page précédente</div>
            <?php endif; ?>

                <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle):?>
                <?php  $page_s = ($pageActuelle + 1); ?>
                <a href="<?= url_panel; ?>/membres.php?page=<?php echo $page_s; ?>">
                    <div class="button primary bg-grey-hover b-r-5 p-5-10" style="float : right;">Page suivante</div>
                </a>
                <?php else:?>
                <div class="button secondary-new b-r-5 p-5-10 color-grey cursor-not-allowed" style="float : right;">Page suivante</div>
                <?php endif; ?>
                <!-- /PAGINATION-->
            <?php else: ?>
                <?php
                $sql_infoUser = $pdo->query("SELECT * FROM users WHERE id = '".$_GET['action']."'");
                $donnees_infoUser = $sql_infoUser->fetch();
                $infoUser_nom = $donnees_infoUser['nom'];
                $infoUser_prenom = $donnees_infoUser['prenom'];
                $infoUser_euros = $donnees_infoUser['euros'];
                $infoUser_email = $donnees_infoUser['email'];
                $infoUser_ip = $donnees_infoUser['ip'];
                $infoUser_idParrain = $donnees_infoUser['idParrain'];
                $infoUser_adresse = $donnees_infoUser['adresse'];
                $infoUser_ville = $donnees_infoUser['ville'];
                $infoUser_codePostal = $donnees_infoUser['codePostal'];
                $infoUser_pays = $donnees_infoUser['pays'];
                $infoUser_actif = $donnees_infoUser['actif'];
                $infoUser_banni = $donnees_infoUser['banni'];
                $infoUser_banni_chat = $donnees_infoUser['banni_chat'];
                $infoUser_level = $donnees_infoUser['level'];
                $infoUser_premium = $donnees_infoUser['premium'];
                ?>
                <!-- FORM BOX ITEMS -->
                <div class="form-box-items">
                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>Information sur le profil</h4>
                        <hr class="line-separator">

                        <form id="profile-info-form" method="post">
                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="nom" class="rl-label required">Nom de famille</label>
                                <input type="text" id="nom" name="nom" value="<?= $infoUser_nom; ?>" placeholder="Entrez votre nom de famille..." required>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="prenom" class="rl-label required">Prénom</label>
                                <input type="text" id="prenom" name="prenom" placeholder="Enter your password here..." value="<?= $infoUser_prenom; ?>" required>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <label for="email" class="rl-label required">Email</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email address here..." value="<?= $infoUser_email; ?>" required>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <label for="adresse" class="rl-label">Adresse complète</label>
                                <input type="text" id="adresse" name="adresse" value="<?= $infoUser_adresse ?>" placeholder="Entrez l'adresse complète (Rue + nr.)">
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="ip" class="rl-label">Adresse IP d'inscription</label>
                                <input type="text" id="ip" name="ip" value="<?= $infoUser_ip ?>" disabled>
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="parrain" class="rl-label">ID Parrain</label>
                                <input type="text" id="parrain" name="parrain" placeholder="ID du Parrain..." value="<?= $infoUser_idParrain; ?>">
                            </div>
                            <!-- /INPUT CONTAINER -->


                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="ville" class="rl-label">Ville</label>
                                <input type="text" id="ville" name="ville" placeholder="Entrez la ville..." value="<?= $infoUser_ville; ?>">
                            </div>
                            <!-- /INPUT CONTAINER -->

                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="codePostal" class="rl-label">Code postal</label>
                                <input type="text" id="codePostal" name="codePostal" placeholder="Entrez le code postal..." value="<?= $infoUser_codePostal; ?>">
                            </div>
                            <!-- /INPUT CONTAINER -->


                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="pays" class="rl-label">Pays</label>
                                <input type="text" id="pays" name="pays" placeholder="Entrez le pays" value="<?= $infoUser_pays ?>">
                            </div>
                            <!-- /INPUT CONTAINER -->
                            
                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="country2" class="rl-label">Actif</label>
                                <label for="actif" class="select-block">
                                    <select name="actif" id="actif">
                                       <option value="1"<?php if ($infoUser_actif == 1) echo ' selected'; ?>>Oui</option>
				       <option value="0"<?php if ($infoUser_actif == 0) echo ' selected'; ?>>Non</option>
                                   </select>
                              </div> 

                              <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="premium" class="rl-label">Premium</label>
                                <label for="prenuim" class="select-block">
				    <select name="premium" id="premium">
						<option value="0"<?php if ($infoUser_premium == 0) echo ' selected'; ?>>Non</option>
						<option value="1"<?php if ($infoUser_premium == 1) echo ' selected'; ?>>Oui</option>
                                    </select>
                               
                            <!-- /INPUT CONTAINER -->
         
                                   <!-- SVG ARROW -->
                                    <svg class="svg-arrow">
                                        <use xlink:href="#svg-arrow"></use>
                                    </svg>
                                    <!-- /SVG ARROW -->

                                </label>

                            </div>
                            <!-- /INPUT CONTAINER -->
                            <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <input type="submit" name="submit_update" value="Appliquer les modifications" class="button primary">
                            </div>
                            <!-- /INPUT CONTAINER -->
                            <?php if ($infoUser_banni == 0){?>
                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <input type="submit" name="submit_bannir" value="Bannir" class="button tertiary">
                            </div>
                            <!-- /INPUT CONTAINER -->
                            <?php }else{ ?>
                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <input type="submit" name="submit_debannir" value="Débannir" class="button secondary">
                            </div>
                            <!-- /INPUT CONTAINER -->

                                <input type="submit" name="submit_update" value="Appliquer les modifications" class="button primary">
                            <?php } ?>

                            <?php if ($infoUser_banni_chat == 0){?>
                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <input type="submit" name="submit_bannir_chat" value="Bannir du chat" class="button tertiary">
                            </div>
                            <!-- /INPUT CONTAINER -->
                            <?php }else{ ?>
                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <input type="submit" name="submit_debannir_chat" value="Débannir du chat" class="button secondary">
                            </div>
                            <!-- /INPUT CONTAINER -->

                                <input type="submit" name="submit_update" value="Appliquer les modifications" class="button primary">
                            <?php } ?>

                            <?php if ($infoUser_level == 1){?>
                            <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <input type="submit" name="submit_moderateur" value="Nommer modérateur" class="button primary">
                            </div>
                            <!-- /INPUT CONTAINER -->
                            <?php }else{ ?>
                                <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <input type="submit" name="submit_stop_moderateur" value="Retirer modérateur" class="button secondary">
                            </div>
                            <!-- /INPUT CONTAINER -->
                            <?php } ?><div class="clear"></div>
                        </form>
                    </div>
                    <!-- /FORM BOX ITEM -->

                    <!-- FORM BOX ITEM -->
                    <div class="form-box-item">
                        <h4>Ajustement solde</h4>
                        <hr class="line-separator">

                        <form id="profile-info-form" method="post">
                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <label for="solde" class="rl-label required">Solde actuel: <strong><?= displayMontant($infoUser_euros, 4, ''); ?> €</strong></label>
                                <input type="number" id="solde" name="solde" step="0.01" min="0" placeholder="Entrez le montant" required>
                            </div>
                            <!-- /INPUT CONTAINER -->
                  
                            <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <input type="submit" name="submit_addMontant" value="Ajouter" class="button primary">
                            </div>
                            <!-- /INPUT CONTAINER -->
                                <!-- INPUT CONTAINER -->
                            <div class="input-container half">
                                <input type="submit" name="submit_delMontant" value="Déduire" class="button tertiary">
                            </div>
                            <!-- /INPUT CONTAINER -->

                        </form>
                    </div>
                    <!-- /FORM BOX ITEM -->

                </div>
                <!-- /FORM BOX -->

            <?php endif; ?>
        </div>
        <!-- DASHBOARD CONTENT -->
    </div>
    <!-- /DASHBOARD BODY -->


<?php
	include('./requiert/inc-footer.php');
?>