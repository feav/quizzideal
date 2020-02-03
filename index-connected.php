
<?php 
    include('./requiert/php-form/login-register.php');
    
    $post_reg_mdp = addslashes(htmlentities("123"));


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


    <div class="">
        <div class="row">
            <div>
                <h2>Bonjour <?= $mbrePrenom; ?></h2>
            </div>
            <div class="row">

                    <!-- Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-stat color-1">
                            <div class="dashboard-stat-content"><h4><?= displayMontant($totalMissions, 0, ''); ?></h4> <span>Missions Disponibles</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Management"></i></div>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-stat color-2">
                            <div class="dashboard-stat-content"><h4><?= displayMontant($totalMissionsAttente, 0, ''); ?></h4> <span>Mission En Attente</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Over-Time2"></i></div>
                        </div>
                    </div>

                    
                    <!-- Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-stat color-3">
                            <div class="dashboard-stat-content"><h4><?= displayMontant($totalFilleuls, 0, ''); ?></h4> <span>Filleuls</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-stat color-4">
                            <div class="dashboard-stat-content"><h4><?= displayMontant($totalCommandes, 0, ''); ?></h4> <span>Commandes</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Credit-Card2"></i></div>
                        </div>
                    </div>
                </div>


                            

                <div class="row">
                    
                    <!-- Recent Activity -->
                    <div class="col-lg-6 col-md-12">
                        <div class="dashboard-list-box invoices with-icons margin-top-20">
                            <h4>Mes Participations</h4>
                            <ul>
                                    <?php
                                $messagesParPage = 7;
                                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat != 'Refus&eacute;' AND etat != 'En cours'");
                                $donnees_total = $retour_total->fetch();
                                $total = $donnees_total['total'];
                                $nombreDePages = ceil($total / $messagesParPage);

                                if (isset($_GET['page'])) {
                                    $pageActuelle = intval($_GET['page']);
                                    if ($pageActuelle > $nombreDePages) {
                                        $pageActuelle = $nombreDePages;
                                    }
                                } else {
                                    $pageActuelle = 1;
                                }
                                $premiereEntree = ($pageActuelle - 1) * $messagesParPage;
                                $histoParticipations = $pdo->query("SELECT offerwall, idt, remuneration, date, etat FROM histo_offers WHERE idUser = '" . $mbreHashId . "' AND etat != 'En cours' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
                                $all_histoParticipations = $histoParticipations->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($all_histoParticipations as $dones_histoParticipations) {
                                    $etat = $dones_histoParticipations['etat'];
                                    if ($etat == 'Valid&eacute;') {
                                        $btn_etat = '<li class="paid">Valide</li>';
                                    } else if ($etat == 'En attente') {
                                        $btn_etat = '<li class="unpaid">En Attente</li>';
                                    } else if ($etat == 'Refus&eacute;') {
                                        $btn_etta = '<li class="unpaid">Refuse</li>';
                                    }
                                    ?>
                                <li><i class="list-box-icon sl sl-icon-doc"></i>
                                    <strong><?= $dones_histoParticipations['idt']; ?></strong>
                                    <ul>
                                         <?= $btn_etta ?>
                                        <li>Order: <?= displayMontant($dones_histoParticipations['remuneration'], 6, ''); ?> €</li>
                                        <li>Date: <?= $dones_histoParticipations['date']; ?></li>
                                    </ul>
                                    <!-- <div class="buttons-to-right">
                                        <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                                    </div> -->
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <div style="display: flex;justify-content: center;    padding-bottom: 16px;">
                                <a class="button border">Voir plus</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Invoices -->
                    <div class="col-lg-6 col-md-12">
                        <div class="dashboard-list-box invoices with-icons margin-top-20">
                            <h4>Livre d'OR</h4>
                            <ul>
                                
                            <?php
                                $retour_total = $pdo->query("SELECT id,email,message,date FROM livredor WHERE 1 ORDER BY id DESC LIMIT 3");
                                $donnees = $retour_total->fetchAll(PDO::FETCH_ASSOC); 
                                // var_dump(count($donnees) );                  
                                foreach ($donnees as $livre  ) { 
                                    // var_dump(); ?>
                                
                                <li><i class="list-box-icon sl sl-icon-layers"></i>
                                    <span> <strong><?php echo $livre['email']; ?></strong> </span><br>
                                    <span><?php echo $livre['message']; ?></span><hr>
                                    <span> <i><?php echo $livre['date']; ?></i> </span>
                                </li>

                                <?php
                                }
                                ?>
                            </ul>
                            <div style="display: flex;justify-content: center;    padding-bottom: 16px;">
                                <a class="button border">Voir plus</a>
                            </div>
                        </div>
                    </div>

                </div>


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

    ?>
        </div>
    </div>


<?php 
    include('./requiert/new-form/footer.php');
?>
