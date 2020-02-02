<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Quizzdeal.fr : Les clics rémunérés';
	$meta_description = '';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
?>
    <!-- SECTION HEADLINE -->
    <div class="section-headline-wrap v3">
        <div class="section-headline">
            <h2>Les clics rémunérés</h2>
            <p>Accueil<span class="separator">/</span><span class="current-section">Clics</span></p>
        </div>
    </div>
    <!-- /SECTION HEADLINE -->
    <!-- SAMAKUNCHAN -->
    <div class="info-clic">
        <h4 >Effectuez des clics sur les offres présentes ci-dessous et gagnez des €uros.</h4>
    </div>
    <!-- /SAMAKUNCHAN -->
		<section class="bg-light-grey absolute-section-1 margin-base">
			<div class="m-auto content p-40-20 container">
                <div class="row clics">
				<div class="col-md-12 f-s-14 f-w-light " style="font-size: 17px">
                    <!-- TRANSACTION LIST HEADER -->
                    <div class="transaction-list-header">
                        <div class="transaction-list-header-date">
                            <p class="text-header small">Nom de l'offre</p>
                        </div>
                        <div class="transaction-list-header-author">
                            <p class="text-header small">Rémunération</p>
                        </div>
                        <div class="transaction-list-header-item">
                            <p class="text-header small"> </p>
                        </div>
                        <div class="transaction-list-header-icon"></div>
                    </div>
                    <!-- /TRANSACTION LIST HEADER -->
                <?php
					$sql_Clics = $pdo->query("SELECT * FROM offers_clics WHERE actif = 1 AND pays LIKE '".$country_code."' ORDER BY nom");
					$all_Clics = $sql_Clics->fetchAll(PDO::FETCH_ASSOC);?>
					<?php foreach ($all_Clics as $dones_Clics): ?>
                        <?php
						$sql_countClics = $pdo->query("SELECT COUNT(id) as 'count' FROM histo_clics WHERE idUser = '".$mbreHashId."' AND idOffers = '".$dones_Clics['idoffre']."' AND date LIKE '".date('d/m/Y')."%%'");
						$resultat_countClics = $sql_countClics->fetch(PDO::FETCH_ASSOC);
						$countClics = $resultat_countClics['count'];
						?>
                        <?php if ($countClics == 0): ?>
                            <!-- TRANSACTION LIST ITEM -->
                            <div class="transaction-list-item">
                                <div class="transaction-list-item-date">
                                    <p><?= $dones_Clics['nom']; ?></p>
                                </div>
                                <div class="transaction-list-item-author">
                                    <p class="text-header">
                                        <a href=""><?= displayMontant($dones_Clics['remuneration'], 3, ' €'); ?></a>
                                    </p>
                                </div>
                                <div class="transaction-list-item-item">
                                    <form
                                            method="POST"
                                            target="_blank"
                                            style="cursor:pointer;display:inline-block;"
                                            action="<?= URL_SITE; ?>/cpc.html">
                                        <input type="hidden" name="off_id" value="<?= $dones_Clics['idoffre']; ?>" />
                                        <a title="Accéder à l'offre" onclick="redirectReload(this);">
                                            <div class="button color-white button primary">Cliquez-ici</div></a>
                                    </form>
                                </div>
                            </div>
                            <!-- /TRANSACTION LIST ITEM -->

                            <?php endif; ?>

                    <?php endforeach; ?>

					<script>
						function redirectReload(elmt) {
							elmt.parentElement.submit(); 
							setTimeout(function () {
								window.location.reload();
							}, 1000);
						}
					</script>
				</div>
			</div></div>
		</section>
		
<?php
	include('./requiert/inc-footer.php');
?>