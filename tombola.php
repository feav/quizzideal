<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Quizzdeal.fr : Tombola';
	$meta_description = '';
	
	if (!isset($_SESSION['id'])) { header('Location: /connexion.html'); exit(); }
	
	include('./requiert/inc-head.php');
	include('./requiert/php-form/tombola.php');
	include('./requiert/inc-header-navigation.php');
	
		$tombola = $pdo->query("SELECT COUNT(id) as 'countIdTombola', id, name, image, description, dateFin FROM tombolas WHERE idUser = 0 ORDER BY dateFin LIMIT 0,1");
		$dones_tombola = $tombola->fetch();
		$tombolaCountIdTombola = $dones_tombola['countIdTombola'];
		$tombolaId = $dones_tombola['id'];
		$tombolaName = $dones_tombola['name'];
		$tombolaImage = $dones_tombola['image'];
		$tombolaDescription = $dones_tombola['description'];
		$tombolaDateFin = $dones_tombola['dateFin'];
		$tombolaDateFin = date("d/m/Y", strtotime($tombolaDateFin));
		
		if ($tombolaCountIdTombola > 1)
		{
			$retour_totalPart = $pdo->query("SELECT COUNT(*) AS total FROM tombolasParticipation WHERE idUser = '".$mbreId."' && idTombola = '".$tombolaId."'");
			$donnees_totalPart = $retour_totalPart->fetch();
			$totalPart = $donnees_totalPart['total'];
		}
?>
		
		<section class="bg-light-grey absolute-section-1 margin-base">
			<div class="m-auto content p-40-20 container"><div class="row">
				<div class="col-md-12 f-s-14 f-w-light">
					<?php if ($tombolaCountIdTombola > 1) { ?><div class="f-s-21 uppercase f-w-400 m-b-5 color-orange">Tombola - Tirage au sort le <?= $tombolaDateFin; ?> à 20h <div class="uppercase bg-black display-inline-block p-5-10 m-l-20 b-r-5 f-w-light f-s-16" style="color:white;"><?= $mbreTicketTombola; ?> <img src="/images/if-ticket-white.png" alt="" align="absmiddle" class="height-24" /> restants</div></div>

					<div class="container row m-t-20 m-b-40 float">
						<div class="float-left"><img src="<?= $tombolaImage; ?>" alt="<?= $tombolaName; ?>" class="m-r-20"/></div>
						<div class="float-left">
							<div class="f-s-21 f-w-bold m-b-10"><?= $tombolaName; ?></div>
							<div class="txt-align-justify"><?= $tombolaDescription; ?></div>
							<div class="m-t-20">
								<form method="POST" class="bg-blue p-10 b-r-10" style="color:white;">
									Nombre de ticket à jouer : <input type="number" name="nombreTickets" min="0" max="1000" step="0" value="0" style="border:0;outline:none;width:50px;" class="f-s-14 f-w-light txt-align-right p-10 b-r-10 m-l-10" /> <button name="submit_tombola" value="<?= $tombolaId; ?>" class="button bg-black bg-orange-hover m-l-5 f-s-14 f-w-bold p-10-20 b-r-10 cursor-pointer" style="color:white;border:0;">Valider</button>
									<div class="f-s-11 txt-align-center m-t-10 p-5 bg-orange b-r-10">Vous avez joué <strong><?= $totalPart; ?></strong> ticket(s) à cette Tombola</div>
								</form>
							</div>
						</div>
					</div><?php } else { ?><div class="f-s-21 uppercase f-w-400 m-b-5 color-orange">Tombola - Aucune Tombola actuellement <div class="uppercase bg-black display-inline-block p-5-10 m-l-20 b-r-5 f-w-light f-s-16" style="color:white;"><?= $mbreTicketTombola; ?> <img src="/images/if-ticket-white.png" alt="" align="absmiddle" class="height-24" /> restants</div></div><div class="m-t-20 m-b-40"></div><?php } ?>

					<div class="bg-white p-20 b-r-5">
						<div class="f-s-21 uppercase f-w-400 m-b-15 color-orange">Les derniers gagnants tombola</div>

						<table class="tableau-1 m-b-20" rules="none" cellpadding="0" cellspacing="0" style="min-width: 350px;">
							<tr>
								<th align="left" valign="middle">Date</th>
								<th align="left" valign="middle">Nom du cadeau</th>
								<th align="left" valign="middle">Utilisateur</th>
							</tr>
<?php
		$messagesParPage = 50;
		$retour_total = $pdo->query("SELECT COUNT(*) AS total FROM tombolas WHERE idUser != 0");
		$donnees_total = $retour_total->fetch();
		$total = $donnees_total['total'];
		$nombreDePages = ceil($total / $messagesParPage);

		if (isset($_GET['page'])) { $pageActuelle = intval($_GET['page']); if ($pageActuelle > $nombreDePages) { $pageActuelle = $nombreDePages; } } else { $pageActuelle = 1; }

		$premiereEntree = ($pageActuelle - 1) * $messagesParPage;

					$debits = $pdo->query("SELECT * FROM tombolas WHERE idUser != 0 ORDER BY dateFin DESC LIMIT ".$premiereEntree.", ".$messagesParPage."");
					$all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);
					foreach ($all_debits as $dones_debits)
					{
						$dateFin = date("d/m/Y", strtotime($dones_debits['dateFin']));

						$sql_userWin = $pdo->query("SELECT nom, prenom FROM users WHERE id = '".$dones_debits['idUser']."' ");
						$resultat_userWin = $sql_userWin->fetch(PDO::FETCH_ASSOC);
						$winNom = $resultat_userWin['nom'];
						$winPrenom = $resultat_userWin['prenom'];
?>
							<tr>
								<td align="left" valign="top"><?= $dateFin; ?></td>
								<td align="left" valign="top"><?= $dones_debits['name']; ?></td>
								<td align="left" valign="top"><?= $winPrenom; ?> <?= substr($winNom , 0, 2); ?>.</td>
							</tr>

<?php
					}
?>
						</table>
						
						<?php if ($pageActuelle != 1) { $page_p = ($pageActuelle - 1); ?><a href="<?= url_site; ?>/tombola.html?page=<?php echo $page_p; ?>"><div class="bg-grey bg-grey-hover b-r-5 display-inline-block p-5-10">Page précédente</div></a><?php } else { ?><div class="bg-light-grey b-r-5 display-inline-block p-5-10 color-grey cursor-not-allowed">Page précédente</div><?php } ?>
						<?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) { $page_s = ($pageActuelle + 1); ?><a href="<?= url_site; ?>/tombola.html?page=<?php echo $page_s; ?>"><div class="bg-grey bg-grey-hover b-r-5 p-5-10" style="float : right;">Page suivante</div></a><?php } else { ?><div class="bg-light-grey b-r-5 p-5-10 color-grey cursor-not-allowed" style="float : right;">Page suivante</div><?php } ?><div class="clear"></div>
					</div>

				</div>
			</div></div>
		</section>
		
<?php
	include('./requiert/inc-footer.php');
?>