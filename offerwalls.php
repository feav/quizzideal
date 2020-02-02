<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Les offerwalls';
$meta_description = '';

if (!isset($_SESSION['id'])) { header('Location: /connexion.html'); exit(); }
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	?>
	<!-- SECTION HEADLINE -->
	<section class="bg-white absolute-section-1">
		<div class="m-auto content p-40-20">
			<div class="container" style="padding-left: 0; margin-left: 0; width: 100%;">
				<div class="row">
					<div class="col-md-4 col-xs-12">
						<div class="bg-light-grey b-r-10 p-20 b-special-grey m-t-20" style="border: 2px orange solid">
							<div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 10px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-money m-r-10"></i> Offerwalls
							</div>

							<ul class="offerwall">
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Adgem</button><input type="hidden" name="ow" value="adgem"></form></li>
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">AdWorkMedia</button><input type="hidden" name="ow" value="adworkmedia"></form></li>
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Ayetstudios</button><input type="hidden" name="ow" value="ayetstudios"></form></li>
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Kiwiwall</button><input type="hidden" name="ow" value="kiwiwall"></form></li>
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Offertoro</button><input type="hidden" name="ow" value="offertoro"></form></li>
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Offerwolf</button><input type="hidden" name="ow" value="offerwolf"></form></li>
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Personaly</button><input type="hidden" name="ow" value="personaly"></form></li>
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Superrewards</button><input type="hidden" name="ow" value="superrewards"></form></li>
								<li><form method="get"><button type="submit" class="f-w-bold m-l-5 bg-grey bg-green-hover color-black color-white-hover p-5 f-s-10 b-r-10 uppercase" style="width: 100%;">Wannads</button><input type="hidden" name="ow" value="wannads"></form></li>
							</ul>

							<div class="clear"></div>
						</div>
					</div>
						<div class="col-md-8 col-xs-12">
							<div class="bg-green color-white p-10-20 f-s-14 b-r-10 b-special-grey m-b-20">Gagnez de l'argent en participant à nos différentes missions ! L'argent sera crédité sur votre compte immédiatement après votre participation.</div>
							<div class="bg-light-grey b-r-10 p-20 b-special-grey">

								<?php if (isset($_GET['ow'])) : ?> 

									<?php $nameOfferwall = htmlentities($_GET['ow']);
									$hashId = $mbreHashId . '-' . date('YmdH');
									?>

									<?php if ($_POST['ow'] == 'offertoro'): ?>

										<iframe src="https://www.offertoro.com/ifr/show/19324/<?= $hashId; ?>/7155" frameborder="0" width="100%" height="700px"></iframe>

									<?php elseif ($_GET['ow'] == 'adscendmedia'): ?>

										<iframe src="https://adscendmedia.com/adwall/publisher/110911/new/profile/13208?subid1=<?= $hashId; ?>" frameborder="0" width="100%" height="700px"></iframe>

									<?php elseif ($_GET['ow'] == 'kiwiwall'): ?>

										<iframe src="https://www.kiwiwall.com/wall/YKDHIm3WzFwpKtrWTxeVpiAacPlUjZoQ/<?= $hashId; ?>" frameborder="0" width="100%" height="700px"></iframe>

									<?php elseif ($_GET['ow'] == 'wannads'): ?>

										<iframe src="https://wall.wannads.com/wall?apiKey=5d446e6ca96de949432700&userId=[<?= $hashId; ?>" frameborder="0" width="100%" height="700px"></iframe>

									<?php elseif ($_GET['ow'] == 'adworkmedia') : ?>

										<iframe src="http://lockwall.xyz/wall/5lH/<?= $hashId; ?>" frameborder="0" width="100%" height="700px"></iframe>

									<?php elseif ($_GET['ow'] == 'ptcwall'): ?>

										<iframe src="http://www.ptcwall.com/index.php?view=ptcwall&pubid=gxqb86469i36vh966z&usrid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

									<?php elseif ($_GET['ow'] == 'personaly'): ?>

										<iframe src="https://persona.ly/widget/?appid=91600366dbf74a5808b266c87c32313f&userid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

									<?php elseif ($_GET['ow'] == 'superrewards'): ?>

										<iframe src="https://wall.superrewards.com/super/offers?h=uebrmznlgmm.682401188058&uid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

									<?php elseif ($_GET['ow'] == 'clixwall'): ?>

										<iframe src="http://www.clixwall.com/wall.php?p=BFXV1-PNF36-RRX05&u=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

									<?php elseif ($_GET['ow'] == 'offerwolf'): ?>

										<iframe src="https://ads.offerwolf.com/wall/?idUser=112&appId=72&subid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

									<?php elseif ($_GET['ow'] == 'ayetstudios'): ?>

										<iframe src="https://www.ayetstudios.com/offers/web_offerwall/1068/default_adslot?external_identifier=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

									<?php elseif ($_GET['ow'] == 'adgem'): ?>

										<iframe src="https://api.adgem.com/v1/wall?appid=956&playerid=<?= $hashId; ?>" width="100%" height="700px" frameborder="0" scrolling="auto"></iframe>

									<?php endif; ?>    



								</div>

							<?php endif; ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php	include('./requiert/inc-footer.php');?>