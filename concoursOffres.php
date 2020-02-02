<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Quizzdeal.fr : Concours Offres';
	$meta_description = '';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	
		$sqlConcours = $pdo->query("SELECT * FROM concours WHERE id = 4");
		$resultatConcours = $sqlConcours->fetch(PDO::FETCH_ASSOC);
		$descriptionConcours = addslashes(htmlentities($resultatConcours['description']));
		$dateDebutConcours = addslashes(htmlentities($resultatConcours['dateDebut']));
		$dateFinConcours = addslashes(htmlentities($resultatConcours['dateFin']));
		$gagnant1 = addslashes(htmlentities($resultatConcours['gagnant1']));
		$gagnant2 = addslashes(htmlentities($resultatConcours['gagnant2']));
		$gagnant3 = addslashes(htmlentities($resultatConcours['gagnant3']));
		$gagnant4 = addslashes(htmlentities($resultatConcours['gagnant4']));
		$gagnant5 = addslashes(htmlentities($resultatConcours['gagnant5']));
?>
    <!-- SECTION HEADLINE -->
    <div class="section-headline-wrap">
        <div class="section-headline">
            <h2>Concours Offres</h2>
            <p>Accueil<span class="separator">/</span>Concours Offres<span class="separator"></span></p>
        </div>
    </div>
    <!-- /SECTION HEADLINE -->
    <div class="container">
        <div >
            <p style="padding: 50px; text-align: center"><?= $descriptionConcours; ?></p>
        </div>
        <!-- TRANSACTION LIST -->
        <div class="transaction-list">


            <!-- TRANSACTION LIST HEADER -->
            <div class="transaction-list-header">
                <div class="transaction-list-header-date">
                    <p class="text-header small">Utilisateur</p>
                </div>
                <div class="transaction-list-header-item">
                    <p class="text-header small">Montant</p>
                </div>
                <div class="transaction-list-header-item">
                    <p class="text-header small">Gain</p>
                </div>
            </div>
            <!-- /TRANSACTION LIST HEADER -->
            <?php //Bloc req SQL pour la prochaine boucle
            $messagesParPage = 50;
            $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM histo_offers WHERE dateUsTime >= '".$dateDebutConcours."' AND dateUsTime <= '".$dateFinConcours."' AND etat LIKE 'Valid%%' GROUP BY idUser");
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

            $debits = $pdo->query("SELECT COUNT(id) as 'countId', idUser, SUM(remuneration) as 'amountTotal' FROM histo_offers WHERE dateUsTime >= '".$dateDebutConcours."' AND dateUsTime <= '".$dateFinConcours."' AND etat != 'En cours' AND etat != 'Refus&eacute;' GROUP BY idUser ORDER BY amountTotal DESC LIMIT ".$premiereEntree.", ".$messagesParPage."");
            $all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);
            $i = 1;
            ?>
            <?php foreach ($all_debits as $dones_debits)://Boucle débit?>
                <?php
                $amountTotal = $dones_debits['amountTotal'];
                $concoursIdUser = $dones_debits['idUser'];

                $sql_userWin = $pdo->query("SELECT nom, prenom FROM users WHERE hashId = '".$concoursIdUser."' ");
                $resultat_userWin = $sql_userWin->fetch(PDO::FETCH_ASSOC);
                $winNom = $resultat_userWin['nom'];
                $winPrenom = $resultat_userWin['prenom'];

                if ($i == 1) { $gainPosition = displayMontant($gagnant1, 2, ' €'); }
                elseif ($i == 2) { $gainPosition = displayMontant($gagnant2, 2, ' €'); }
                elseif ($i == 3) { $gainPosition = displayMontant($gagnant3, 2, ' €'); }
                elseif ($i == 4) { $gainPosition = displayMontant($gagnant4, 2, ' €'); }
                elseif ($i == 5) { $gainPosition = displayMontant($gagnant5, 2, ' €'); }
                else 	{ $gainPosition = '-'; }
                ?>
            <!-- TRANSACTION LIST ITEM -->
            <div class="transaction-list-item">
                <div class="transaction-list-item-date">
                    <p><?= $winPrenom; ?> <?= substr($winNom , 0, 2); ?>.</p>
                </div>
                <div class="transaction-list-item-author">
                    <p class="text-header"><?= displayMontant($amountTotal, 2, ''); ?> €</p>
                </div>
                <div class="transaction-list-item-item">
                    <p class="category primary"><?= $gainPosition; ?></p>
                </div>
            </div>
            <!-- /TRANSACTION LIST ITEM -->
            <?php  $i++;   endforeach; //Fin boucle débit?>

            <!-- PAGINATION-->
            <?php if ($pageActuelle != 1) { $page_p = ($pageActuelle - 1); ?><a href="<?= url_site; ?>/concoursMissions.html?page=<?php echo $page_p; ?>"><div class="bg-grey bg-grey-hover b-r-5 display-inline-block p-5-10">Page précédente</div></a><?php } else { ?><div class="bg-white b-r-5 display-inline-block p-5-10 color-grey cursor-not-allowed">Page précédente</div><?php } ?>
            <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) { $page_s = ($pageActuelle + 1); ?><a href="<?= url_site; ?>/concoursMissions.html?page=<?php echo $page_s; ?>"><div class="bg-grey bg-grey-hover b-r-5 p-5-10" style="float : right;">Page suivante</div></a><?php } else { ?><div class="bg-white b-r-5 p-5-10 color-grey cursor-not-allowed" style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>
            <!-- /PAGINATION-->
        </div>
        <!-- /TRANSACTION LIST -->
    </div>



<?php
	include('./requiert/inc-footer.php');
?>