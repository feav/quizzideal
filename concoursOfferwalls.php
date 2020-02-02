<?php
	include('./requiert/new-form/header.php');
	
	$meta_title = 'Quizzdeal.fr : Concours Offerwalls';
	$meta_description = '';
	
	
		$sqlConcours = $pdo->query("SELECT * FROM concours WHERE id = 2");
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
<style type="text/css">
    .description-concours{padding: 50px 0;}
</style>
    <!-- SECTION HEADLINE -->
<div class="container" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title-page">Les concours offerwalls</h1>
            <p class="description-concours"><?= $descriptionConcours; ?></p>

            <table class="basic-table" rules="none" class="f-s-13 f-w-light">
                <tr>
                    <th valign="middle">Utilisateur</th>
                    <th valign="middle">Montant</th>
                    <th valign="middle">Gain</th>
                </tr>
                <!-- /TRANSACTION LIST HEADER -->
                <?php //Bloc req SQL pour la prochaine boucle
                $messagesParPage = 50;
                $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM histo_offers WHERE dateUsTime >= '".$dateDebutConcours."' AND dateUsTime <= '".$dateFinConcours."' AND offerwall != 'Mission' AND etat LIKE 'Valid%%' GROUP BY idUser");
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

                $debits = $pdo->query("SELECT COUNT(id) as 'countId', idUser, SUM(remuneration) as 'amountTotal' FROM histo_offers WHERE dateUsTime >= '".$dateDebutConcours."' AND dateUsTime <= '".$dateFinConcours."' AND offerwall != 'Mission' AND etat != 'En cours' AND etat != 'Refus&eacute;' GROUP BY idUser ORDER BY amountTotal DESC LIMIT ".$premiereEntree.", ".$messagesParPage."");
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
                    else    { $gainPosition = '-'; }
                    ?>
                <!-- TRANSACTION LIST ITEM -->
                <tr>
                    <td><?= $winPrenom; ?> <?= substr($winNom , 0, 2); ?>.</td>
                    <td><?= displayMontant($amountTotal, 2, ''); ?> €</td>
                    <td><?= $gainPosition; ?></td>
                </tr>
                <!-- /TRANSACTION LIST ITEM -->
                <?php  $i++;   endforeach; //Fin boucle débit?>
            </table>
            <div class="table group-nav">
                <?php if ($pageActuelle != 1) { $page_p = ($pageActuelle - 1); ?><a class="navigation-table" href="<?= url_site; ?>/concoursMissions.html?page=<?php echo $page_p; ?>"><i class="fa fa-angle-left"></i></a><?php } else { ?><i class="fa fa-angle-left"></i><?php } ?>
                <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) { $page_s = ($pageActuelle + 1); ?><a class="navigation-table" href="<?= url_site; ?>/concoursMissions.html?page=<?php echo $page_s; ?>"><i class="fa fa-angle-right"></i></a><?php } else { ?><i class="fa fa-angle-right"></i><?php } ?><div class="clear"></div>
            </div>
        </div>
    </div>
</div>

<?php 
    include('./requiert/new-form/footer.php');
?>