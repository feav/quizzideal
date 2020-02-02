<?php
include('./requiert/php-global.php');

$meta_title = 'Panel d\'administration : Accueil | Quizzdeal.fr';
$nomPage = 'accueil';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
include('./requiert/php-form/home.php');
?>
<?php //Requete pour compter le nombre de membre
$sql = $pdo->query('SELECT COUNT(id) AS membreTotal FROM users');
$donnees = $sql->fetchAll();
$membreTotal = $donnees[0]['membreTotal'];
?>
<?php //Requete pour compter le nombre de profil a vérifier
$user = $pdo->query("SELECT * FROM users WHERE nom != '' && prenom != '' && adresse != '' && ville != '' && codePostal != '' && code_verif != 1 && code_verif_date = '' ORDER BY id DESC");
$all_users_profil = $user->fetchAll(PDO::FETCH_ASSOC);
?>
<?php //Requete pour compter le nombre d'identité a vérifier
$user = $pdo->query("SELECT * FROM users WHERE ident_verso != '' && ident_recto != '' && ident_verif = 0 ORDER BY id DESC");
$all_users_idt = $user->fetchAll(PDO::FETCH_ASSOC);
?>


    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">


        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline filter primary">
                <h4>Bienvenu sur votre espace d'administration</h4>
            </div>
            <!-- /HEADLINE -->

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
                                <span class="icon-note"></span>
                            </div>
                            <h3>Je m'inscris gratuitement</h3>

                        </div>
                        <!-- /SERVICE ITEM -->

                        <!-- SERVICE ITEM -->
                        <div class="service-item column">
                            <div class="circle medium gradient"></div>
                            <div class="circle white-cover"></div>
                            <div class="circle dark">
                                <span class="icon-layers"></span>
                            </div>
                            <h3>Je complète des offres</h3>

                        </div>
                        <!-- /SERVICE ITEM -->

                        <!-- SERVICE ITEM -->
                        <div class="service-item column">
                            <div class="circle medium gradient"></div>
                            <div class="circle white-cover"></div>
                            <div class="circle dark">
                                <span class="icon-credit-card"></span>
                            </div>
                            <h3>Je perçois mes gains</h3>

                        </div>
                        <!-- /SERVICE ITEM -->
                    </div>
                    <!-- /SERVICE LIST -->
                    <div class="clearfix"></div>
                </section>
            </div>
            <!-- /SERVICES -->

            <div class="clearfix"></div>
            <!-- HEADLINE -->
            <div class="headline filter secondary">
                <h4>Vérification des profils</h4>
            </div>
            <!-- /HEADLINE -->

            <!-- TRANSACTION LIST -->
            <div class="transaction-list">
                <form method="post">
                <!-- TRANSACTION LIST HEADER -->
                <div class="transaction-list-header">
                    <div class="transaction-list-header-date admin-s1">
                        <p class="text-header small">Utilisateur</p>
                    </div>
                    <div class="transaction-list-header-author">
                        <p class="text-header small">Adresse e-mail</p>
                    </div>
                    <div class="transaction-list-header-code">
                        <p class="text-header small">Code</p>
                    </div>
                    <div class="transaction-list-header-date">
                        <p class="text-header small"></p>
                    </div>
                </div>
                <!-- /TRANSACTION LIST HEADER -->
                <?php foreach ($all_users_profil as $dones_user):?>
                <!-- TRANSACTION LIST ITEM -->
                <div class="transaction-list-item">
                    <div class="transaction-list-item-date admin-s1">
                        <p><?= $dones_user['prenom']; ?> <?= $dones_user['nom']; ?></p>
                    </div>
                    <div class="transaction-list-item-author">
                        <p class="text-header"><?= $dones_user['email']; ?></p>
                    </div>
                    <div class="transaction-list-item-item">
                        <p class="category primary">
                            <?php if ($dones_user['code_verif'] == 0) echo '-'; else echo $dones_user['code_verif']; ?>
                        </p>
                    </div>
                    <div class="transaction-list-item-code">
                        <?php if ($dones_user['code_verif'] == 0): ?>
                            <button name="generer" value="<?= $dones_user['id']; ?>" class="button primary admin-s2">Générer un code</button>
                        <?php  else: ?>
                            <button name="send" value="<?= $dones_user['id']; ?>" class="button tertiary admin-s2">Document envoyé</button>
                        <?php endif; ?>
                    </div>
                    <div class="transaction-list-item-code">
                        <a href="<?= url_panel; ?>/membres.html?action=<?= $dones_user['id']; ?>">
                            <div class="button secondary admin-s2">Voir le profil</div>
                        </a>
                    </div>
                </div>
                <!-- /TRANSACTION LIST ITEM -->
                <?php endforeach; ?>
                </form>
            </div>
            <!-- /TRANSACTION LIST -->

            <div class="clearfix"></div>
            <!-- HEADLINE -->
            <div class="headline filter secondary">
                <h4>Vérification des pièces d'identités</h4>
            </div>
            <!-- /HEADLINE -->

            <!-- TRANSACTION LIST -->
            <div class="transaction-list">
                <form method="post">
                <!-- TRANSACTION LIST HEADER -->
                <div class="transaction-list-header">
                    <div class="transaction-list-header-date admin-s1">
                        <p class="text-header small">Utilisateur</p>
                    </div>
                    <div class="transaction-list-header-author">
                        <p class="text-header small">Adresse e-mail</p>
                    </div>
                    <div class="transaction-list-header-item">
                        <p class="text-header small">Documents</p>
                    </div>

                    <div class="transaction-list-header-icon"></div>
                    <div class="transaction-list-header-icon"></div>
                </div>
                <!-- /TRANSACTION LIST HEADER -->
                <?php foreach ($all_users_idt as $dones_user):?>
                <!-- TRANSACTION LIST ITEM -->
                <div class="transaction-list-item">
                    <div class="transaction-list-item-date admin-s1">
                        <p><?= $dones_user['prenom']; ?> <?= $dones_user['nom']; ?></p>
                    </div>
                    <div class="transaction-list-item-author">
                        <p class="text-header"><?= $dones_user['email']; ?></p>
                    </div>
                    <div class="transaction-list-item-item">
                        <p class="category primary">
                            <?php if ($dones_user['ident_recto'] == '') echo '-'; else echo '[ <a href="../'.$dones_user['ident_recto'].'" target="_blank">Recto</a> ]'; ?>
                            <span class="m-l-10 m-r-10">-</span>
                            <?php if ($dones_user['ident_verso'] == '') echo '-'; else echo '[ <a href="../'.$dones_user['ident_verso'].'" target="_blank">Verso</a> ]'; ?>
                        </p>
                    </div>
                    <?php if ($dones_user['ident_verif'] == 0): ?>
                    <div class="transaction-list-item-code">
                        <button name="ident_valider" value="<?= $dones_user['id']; ?>" class="button primary admin-s2">Valider</button>


                    </div>
                    <div class="transaction-list-item-code">
                        <button name="ident_refuser" value="<?= $dones_user['id']; ?>" class="button tertiary admin-s2">Refuser</button>
                    </div>
                    <?php endif; ?>
                    <div class="transaction-list-item-code">
                        <a href="<?= url_panel; ?>/membres.html?action=<?= $dones_user['id']; ?>">
                            <div class="button secondary admin-s2">Voir le profil</div>
                        </a>
                    </div>
                </div>
                <!-- /TRANSACTION LIST ITEM -->
                <?php endforeach; ?>
                </form>
            </div>
            <!-- /TRANSACTION LIST -->
        </div>
        <!-- DASHBOARD CONTENT -->

    </div>
    <!-- /DASHBOARD BODY -->
    
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        unset($_SESSION['adminid']);
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

	include('./requiert/inc-footer.php');
?>