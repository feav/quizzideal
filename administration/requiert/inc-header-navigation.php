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

<!-- SIDE MENU -->
<div id="dashboard-options-menu" class="side-menu dashboard left closed">
    <!-- SVG PLUS -->
    <svg class="svg-plus">
        <use xlink:href="#svg-plus"></use>
    </svg>
    <!-- /SVG PLUS -->

    <!-- SIDE MENU HEADER -->
    <div class="side-menu-header">
        <!-- USER QUICKVIEW -->
        <div class="user-quickview">
            <!-- USER AVATAR -->
            <!--<a href="author-profile.html">-->
                <div class="outer-ring">
                    <div class="inner-ring"></div>
                    <figure class="user-avatar">
                        <img src="../images/images-dragon/avatars/avatar_01.jpg" alt="avatar">
                    </figure>
                </div>
            <!--</a>-->
            <!-- /USER AVATAR -->

            <!-- USER INFORMATION -->
            <p class="user-name"><?= ucfirst($mbrePrenom).' '.substr($mbreNom, 0, 1).'.'; ?></p>
            <!-- /USER INFORMATION -->
        </div>
        <!-- /USER QUICKVIEW -->
    </div>
    <!-- /SIDE MENU HEADER -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">Votre administration</p>
    <!-- /SIDE MENU TITLE -->


    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect interactive">
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item active">
            <a href="<?= url_panel; ?>/index.html">
                <span class="sl-icon icon-home"></span>
                Accueil
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/admin_cashback.php">
                <span class="sl-icon icon-layers"></span>
                Administration Cashback
            </a>
        </li>

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/membres.html">
                <span class="sl-icon icon-user"></span>
                Membres
            </a>
            <!-- PIN -->
            <span class="pin soft-edged big primary">49</span>
            <!-- /PIN -->
        </li>
        <!-- /DROPDOWN ITEM -->
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/boutique.php">
                <span class="sl-icon icon-credit-card dbcc"></span>
                Boutique
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/messagerie.php">
                <span class="sl-icon icon-envelope dbcc"></span>
                Messagerie
         <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/users.php">
                <span class="sl-icon icon-envelope dbcc"></span>
                Users
            </a>
        </li>
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/parrainage.php">
                <span class="sl-icon icon-people dbcc"></span>
                Parrainage
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->


    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">Les campagnes</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect">

        <!-- DROPDOWN ITEM -->
        <!--li class="dropdown-item">
            <a href="<?= url_panel; ?>/coupons.html">
                <span class="sl-icon icon-layers"></span>
                Coupons
            </a>
        </li-->
        <!-- /DROPDOWN ITEM -->
		
	<!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect">
        <!-- DROPDOWN ITEM -->
        <!--li class="dropdown-item">
            <a href="<?= url_panel; ?>/cashback.php">
                <span class="sl-icon icon-layers"></span>
                Cashback
            </a>
        </li-->
        <!-- /DROPDOWN ITEM -->
        
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/missions.html">
                <span class="sl-icon icon-layers"></span>
                Missions
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/clics.html">
                <span class="sl-icon icon-cursor"></span>
                Clics
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/validations.html">
                <span class="sl-icon icon-check"></span>
                    Validations
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">Les jeux</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect">
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/gagnants.html">
                <span class="sl-icon icon-star"></span>
                Gagnants
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/concours.html">
                <span class="sl-icon icon-event"></span>
                Concours
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/tombola.html">
                <span class="sl-icon icon-bag"></span>
                Tombola
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">Divers</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect">
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/faq.html">
                <span class="sl-icon icon-star"></span>
                F.A.Q
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/pages.html">
                <span class="sl-icon icon-question"></span>
                Pages
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/bonus.php">
                <span class="sl-icon icon-notebook"></span>
                Bonus
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="<?= url_panel; ?>/newsletter.html">
                <span class="sl-icon icon-envelope"></span>
                Newsletter
            </a>
        </li>
        <!-- /DROPDOWN ITEM -->
    </ul>
    <!-- /DROPDOWN -->

    <a href="<?= url_panel; ?>/index.html?action=logout" class="button medium secondary">Logout</a>
</div>
<!-- /SIDE MENU -->
<!-- DASHBOARD HEADER -->
<div class="dashboard-header retracted">
    <!-- DB CLOSE BUTTON -->
    <a href="<?= url_panel; ?>/index.html?action=logout" class="db-close-button">
        <img src="../images/images-dragon/dashboard/back-icon.png" alt="back-icon">
    </a>
    <!-- DB CLOSE BUTTON -->

    <!-- DASHBOARD HEADER ITEM -->
    <div class="dashboard-header-item title">
        <!-- DB SIDE MENU HANDLER -->
        <div class="db-side-menu-handler">
            <img src="../images/images-dragon/dashboard/db-list-left.png" alt="db-list-left">
        </div>
        <!-- /DB SIDE MENU HANDLER -->
        <h6>Administration</h6>
    </div>
    <!-- /DASHBOARD HEADER ITEM -->


    <!-- DASHBOARD HEADER ITEM -->
    <div class="dashboard-header-item stats">
        <!-- STATS META -->
        <div class="stats-meta">
            <h6>
                <span class="sl-icon icon-user"></span>
                <span><?= $membreTotal ?></span>
            </h6>
            <p>Membres total du site</p>
        </div>
        <!-- /STATS META -->
    </div>
    <!-- /DASHBOARD HEADER ITEM -->

    <!-- DASHBOARD HEADER ITEM -->
    <div class="dashboard-header-item stats">
        <!-- STATS META -->
        <div class="stats-meta">
            <div class="pie-chart pie-chart2">
                <!-- SVG PLUS -->
                <svg class="svg-minus tertiary">
                    <use xlink:href="#svg-minus"></use>
                </svg>
                <!-- /SVG PLUS -->
            </div>
            <h6><?=  count($all_users_profil); ?></h6>
            <p>Vérification de profil</p>
        </div>
        <!-- /STATS META -->
    </div>
    <!-- /DASHBOARD HEADER ITEM -->

    <!-- DASHBOARD HEADER ITEM -->
    <div class="dashboard-header-item stats">
        <!-- STATS META -->
        <div class="stats-meta">
            <div class="pie-chart pie-chart3">
                <!-- SVG PLUS -->
                <svg class="svg-plus primary">
                    <use xlink:href="#svg-plus"></use>
                </svg>
                <!-- /SVG PLUS -->
            </div>
            <h6><?=  count($all_users_idt); ?></h6>
            <p>Vérification d'identité</p>
        </div>
        <!-- /STATS META -->
    </div>
    <!-- /DASHBOARD HEADER ITEM -->

    <!-- DASHBOARD HEADER ITEM -->
    <div class="dashboard-header-item back-button">
        <a href="index.html" class="button mid dark-light">Back to Homepage</a>
    </div>
    <!-- /DASHBOARD HEADER ITEM -->
</div>
<!-- DASHBOARD HEADER -->
