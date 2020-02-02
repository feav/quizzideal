<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Mes participations';
$meta_description = '';

if (!isset($_SESSION['id'])) {
	header('Location: /connexion.html');
	exit();
}

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
?>
<section class="bg-white absolute-section-1">
	<div class="m-auto content p-40-20">
		<div class="container" style="padding-left: 0; margin-left: 0; width: 100%;"><div class="row">
			<?php include('./requiert/inc-menu-right.php'); ?>
			<div class="col-md-8 col-xs-12 xs-m-b-20">
				<div class="bg-light-grey b-r-10 p-20 b-special-grey">
					<div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-list m-r-10"></i> Historique de mes participations</div>

					<table rules="none" class="f-s-13 f-w-light">
						<tr>
							<th align="left" valign="middle">Date</th>
							<th align="left" valign="middle">Libéllé</th>
							<th align="right" valign="middle">Rémunération</th>
							<th align="right" valign="middle">Etat</th>
						</tr>

						<?php
						$messagesParPage = 15;
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
								$btn_etat = '<i class="fa fa-check color-green"></i>';
							} else if ($etat == 'En attente') {
								$btn_etat = '<i class="fa fa-clock-o color-orange"></i>';
							} else if ($etat == 'Refus&eacute;') {
								$btn_etat = '<i class="fa fa-times- color-red"></i>';
							}
							?>
							<tr>
								<td align="left" valign="top">Le <?= $dones_histoParticipations['date']; ?></td>
								<td align="left" valign="top"><?= $dones_histoParticipations['idt']; ?></td>
								<td align="right" valign="top"><?= displayMontant($dones_histoParticipations['remuneration'], 6, ''); ?> €</td>
								<td align="center" valign="top"><?= $btn_etat; ?></td>
							</tr>
							<?php
						}
						?>                            
					</table>
					<?php if ($pageActuelle != 1) {
						$page_p = ($pageActuelle - 1); ?><a href="<?= url_site; ?>/mes-participations.html?page=<?php echo $page_p; ?>"><div class="bg-grey bg-grey-hover b-r-5 display-inline-block p-5-10">Page précédente</div></a><?php } else { ?><div class="bg-white b-r-5 display-inline-block p-5-10 color-grey cursor-not-allowed">Page précédente</div><?php } ?>
						<?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) {
							$page_s = ($pageActuelle + 1); ?><a href="<?= url_site; ?>/mes-participations.html?page=<?php echo $page_s; ?>"><div class="bg-grey bg-grey-hover b-r-5 p-5-10" style="float : right;">Page suivante</div></a><?php } else { ?><div class="bg-white b-r-5 p-5-10 color-grey cursor-not-allowed" style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>

						</div>

						<!--  Historique Cashback --> 
				<div class="bg-light-grey b-r-10 p-20 b-special-grey">
					<div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-list m-r-10"></i> Historique de mes participations Cashback</div>

					<table rules="none" class="f-s-13 f-w-light">
						<tr>
							<th align="left" valign="middle">Date</th>
							<th align="left" valign="middle">Libéllé</th>
							<th align="right" valign="middle">Rémunération</th>
							<th align="right" valign="middle">Etat</th>
						</tr>
						
						<?php
						$cashbackParPage = 15;
						$cashback_total = $pdo->query("SELECT COUNT(*) AS total FROM histo_cashback WHERE idUser = '" . $_SESSION['id'] . "' AND etat != 'Refus&eacute;' AND etat != 'En cours'");
						$donnees_totalCashback = $cashback_total->fetch();
						$totalCashback = $donnees_totalCashback['total'];
						$nombreDePagesCashback = ceil($totalCashback / $cashbackParPage);
						if (isset($_GET['pageCashback'])) {
							$pageActuelleCashback = intval($_GET['pageCashback']);
							if ($pageActuelleCashback > $nombreDePagesCashback) {
								$pageActuelleCashback = $nombreDePagesCashback;
							}
						} else {
							$pageActuelleCashback = 1;
						}
						$premiereEntreeCashback = ($pageActuelleCashback - 1) * $cashbackParPage;
						$histoParticipationsCashback = $pdo->query("SELECT hc.date, hc.etat, c.nom, c.renumeration, c.pourcentage FROM histo_cashback hc, cashback c WHERE hc.idCashback=c.id AND hc.idUser = '" . $_SESSION['id'] . "' ORDER BY hc.date DESC LIMIT " . $premiereEntreeCashback . ", " . $cashbackParPage . "");
						$all_histoParticipationsCashback = $histoParticipationsCashback->fetchAll(PDO::FETCH_ASSOC);
						foreach ($all_histoParticipationsCashback as $dones_histoParticipationsCashback) {
							$etatC = $dones_histoParticipationsCashback['etat'];
							if ($etatC == 'Valid&eacute;') {
								$btn_etatC = '<span class="b-r-5 p-5 bg-green color-white">'.$dones_histoParticipationsCashback['etat'].'</span>';
							} else if ($etatC == 'En attente') {
								$btn_etatC = '<span class="b-r-5 p-5 bg-orange color-white">'.$dones_histoParticipationsCashback['etat'].'</span>';
							} else if ($etatC == 'Refus&eacute;') {
								$btn_etatC = '<span class="b-r-5 p-5 bg-red color-white">'.$dones_histoParticipationsCashback['etat'].'</span>';
							}
							?>
							<tr>
								<td align="left" valign="top">Le <?= date('d/m/Y H:i:s', strtotime($dones_histoParticipationsCashback['date'])); ?></td>
								<td align="left" valign="top"><?= $dones_histoParticipationsCashback['nom']; ?></td>
								<td align="right" valign="top"><?= displayMontant($dones_histoParticipationsCashback['renumeration'], 6, $dones_histoParticipationsCashback['pourcentage']); ?></td>
								<td align="right" valign="middle"><?= $btn_etatC; ?></td>
							</tr>
							<?php
						}
						?>                            
					</table>
					<?php if ($pageActuelleCashback != 1) {
						$page_p_c = ($pageActuelleCashback - 1); ?><a href="<?= url_site; ?>/mes-participations.html?pageCashback=<?php echo $page_p_c; ?>"><div class="bg-grey bg-grey-hover b-r-5 display-inline-block p-5-10">Page précédente</div></a><?php } else { ?><div class="bg-white b-r-5 display-inline-block p-5-10 color-grey cursor-not-allowed">Page précédente</div><?php } ?>
						<?php if (($pageActuelleCashback == 1 AND $nombreDePagesCashback > $pageActuelleCashback) OR $nombreDePagesCashback > $pageActuelleCashback) {
							$page_s_c = ($pageActuelleCashback + 1); ?><a href="<?= url_site; ?>/mes-participations.html?pageCashback=<?php echo $page_s_c; ?>"><div class="bg-grey bg-grey-hover b-r-5 p-5-10" style="float : right;">Page suivante</div></a><?php } else { ?><div class="bg-white b-r-5 p-5-10 color-grey cursor-not-allowed" style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>
							
						</div>
					</div>

					

				</div>
			</div>
		</div>
					

		</section>

		<?php
		include('./requiert/inc-footer.php');
		?>