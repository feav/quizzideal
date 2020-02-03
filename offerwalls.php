<?php
include('./requiert/new-form/header.php');

$meta_title = 'Quizzdeal.fr : Les offerwalls';
$meta_description = '';

if (!isset($_SESSION['id'])) { header('Location: /connexion.php'); exit(); }

?>
<style type="text/css">
    ul{
        list-style-type: none;
    }
    .wrapper-content{margin-top: 70px;}
    .cat-box-content{
        padding:20px;
    }
    .cat-head{
        background: #f74265;
        color: #fff;
        padding: 7px 15px;
        font-size: 16px;
        border-radius: 6px 6px 0 0;
    }
    .item-coupon{
        border: 1px solid #80808036;
        border-radius: 25px;
    }
    .coupon-box-img{
        height: 70%;
        margin-bottom: 0;
        width: 100%;
        padding-left: 0;
        padding-right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-offerwalls{
    	width: 100%;
    	background: #e9e9e9!important;
    	color: #000!important;
    }
    .btn-offerwalls{margin-bottom: 4px;}
    .btn-offerwalls:hover, .btn-offerwalls.active{background: #f74265!important;color: #fff!important}
</style>
	<!-- SECTION HEADLINE -->
	<section class="container-content">
	    <h1 class="title-page">Cashback</h1>
	    <div class=" wrapper-content">
		    <div class="m-auto content p-40-20">
		    	<p>Gagnez de l'argent en participant à nos différentes missions ! L'argent sera crédité sur votre compte immédiatement après votre participation.</p>	
			    <div class="row">
			        <div class="col-sm-3 col-xs-12" style="padding:0">
			            <div class="" style="box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.12);">
			                <div class="cat-head">Offerwalls</div>
			                <div class="cat-box-content">
			                    <ul class="offerwall" style="padding: 0;">
									<li><form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'adgem') echo 'active';?>" style="width: 100%;">Adgem</button><input type="hidden" name="ow" value="adgem"></form></li>
									<li><form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'adworkmedia') echo 'active';?>" style="width: 100%;">AdWorkMedia</button><input type="hidden" name="ow" value="adworkmedia"></form>
									</li>
									<li>
										<form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'ayetstudios') echo 'active';?>" style="width: 100%;">Ayetstudios</button><input type="hidden" name="ow" value="ayetstudios"></form></li>
									<li><form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'kiwiwall') echo 'active';?>" style="width: 100%;">Kiwiwall</button><input type="hidden" name="ow" value="kiwiwall"></form></li>
									<li><form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'offertoro') echo 'active';?>" style="width: 100%;">Offertoro</button><input type="hidden" name="ow" value="offertoro"></form></li>
									<li><form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'offerwolf') echo 'active';?>" style="width: 100%;">Offerwolf</button><input type="hidden" name="ow" value="offerwolf"></form></li>
									<li><form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'personaly') echo 'active';?>" style="width: 100%;">Personaly</button><input type="hidden" name="ow" value="personaly"></form></li>
									<li><form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'superrewards') echo 'active';?>" style="width: 100%;">Superrewards</button><input type="hidden" name="ow" value="superrewards"></form></li>
									<li><form method="get"><button type="submit" class="button btn-offerwalls <?php if($_GET['ow'] == 'wannads') echo 'active';?>" style="width: 100%;">Wannads</button><input type="hidden" name="ow" value="wannads"></form></li>
								</ul>
			                </div>                
			            </div>
			        </div>
					<div class="col-md-8 col-xs-12">
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
	</section>

<?php include('./requiert/new-form/footer.php'); ?>