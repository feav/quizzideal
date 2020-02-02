<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Quizzdeal.fr : Les derniers gagnants';
	$meta_description = '';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
?>
		
		<section class="bg-light-grey absolute-section-1 margin-base">
			<div class="m-auto content p-40-20 container"><div class="row">
				<div class="col-md-12 f-s-14 f-w-light">
					<div class="f-s-21 uppercase f-w-400 m-b-15 color-orange">Annonce</div>

<?php
					$debits = $pdo->query("SELECT COUNT(id) as 'countId', idUser, SUM(remuneration) as 'amountTotal' FROM histo_offers WHERE dateUsTime >= '2018-04-16 10:57:09' GROUP BY idUser ORDER BY amountTotal DESC");
					$all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);
					foreach ($all_debits as $dones_debits)
					{
						$amountTotal = $dones_debits['amountTotal'];
						$count = $dones_debits['countId'];
						$odUs = $dones_debits['idUser'];
						
						echo $count.' '.$odUs.' '.$amountTotal.'<br/>';
						
					}
?>

				</div>
			</div></div>
		</section>
		
<?php
	include('./requiert/inc-footer.php');
?>