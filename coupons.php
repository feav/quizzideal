<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Les coupons';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
?>

    <style>

.coupon.bg-white.b-special-grey.b-r-5.p-20.row {
    background: #fff;
    padding: 5px;
    margin: 0;

}
.coupon-img > img {
    max-width: 100%;
}
.boutique-right {
    position: relative;
    /* float: right; */
    /* width: calc(100% - 102px); */
    font-weight: bold;
    font-size: 12px;
}
button.submit.button-gold.color-white.b-r-5.uppercase.p-10 {
    margin-top: 20px;
    float: right;
    /* text-align: center; */
}
form.coupon_form {
    margin-top: 10px;
    overflow: hidden;
    height: 130px;
    position: relative;
    width: 100%;
}
a.btn_code {
    background: #6bc67c;
    transition: all 0.2s;
    border-radius: 30px;
    color: #fff;
    font-weight: 600;
    font-size: 15px;
    display: block;
    border: none;
    letter-spacing: 0.04em;
    /* margin: 20px 0 20px; */
    padding: 5px 10px 5px;
    cursor: pointer;
    font-family: 'Open Sans', sans-serif;
    width: auto;
    text-align: center;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
	text-align: center;
}
a.btn_code:hover {
	background: #7dcd8c;
    color: #fff;
}
form.coupon_form > span {
    /* text-overflow: ellipsis; */
    word-break: break-word;
    padding: 0;
    white-space: normal;
}
.msg_img {
	max-width: 100%;
    max-height: 100px;
    margin-bottom: 30px;
	display: block;
	margin-left: auto;
    margin-right: auto;
}
@media screen and (max-width: 500px) {
.col-md-3.col-sm-3.col-xs-12 {
    display: contents;
}
.col-md-9.col-sm-9.col-xs-12 {
	text-align:center;
}
.coupon-img {
	text-align:center;
}
.coupon-img > img {
	max-width:80%;
	max-height: 100px;
    margin-bottom: 20px;
    margin-top: 20px;
}
}
@media screen and (min-width: 501px) {
	.col-md-9.col-sm-9.col-xs-12 {
		height:100%;
	}
	.col-md-3.col-sm-3.col-xs-12 {
		height:100%;
		width: 25%;
	}
	.coupon.bg-white.b-special-grey.b-r-5.p-20.row {
		height: 170px;
	}
}
</style>

    <script>
	function DispMsg(ele,msg) {
	var img=$(ele).parent().parent().find('div.coupon-img > img').attr('src');
	var txt='<img class="msg_img" src="' + img + '" >' + $(ele).parent().parent().find('span.link_coupon').html() + '<br>' + msg
	swal({
		text: msg,
		button: "Fermer",
		icon: "success",
		closeOnClickOutside: false,
		closeOnEsc: false,
	});
	$('.swal-text').html(txt);
	$('.swal-text').css('background','#fff');
    $('.swal-text').css('border','none');
	$('.swal-text').css('font-size','20px');
	$('.swal-text').find('a').css('display','block');
	$('.swal-icon').hide();
}


</script>

    <section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">
        <div class="m-b-5 f-s-18 f-w-bold txt-align-left color-gold">Coupons</div>
        <div class="m-b-20 b-b-3-gold"></div>

	<div class="bg-light-grey b-r-10 p-20 b-special-grey container"><div class="row">
                <div class="p-l-20 p-r-20 m-b-20">
                    <form method="POST" class="display-inline"><input type="text" name="search" value="" placeholder="Recherche ..." class="b-special-grey input-md p-10-20 b-r-5 input-search" required=""/>
                        <button type="submit" name="submit_recherche" value="submit_recherche" class="submit uppercase button-blue color-white b-r-5 b-special-grey m-l-10">Rechercher</button></form>
                    <form method="POST" class="display-inline-block xs-display-block"><button name="submit_rei" value="submit_rei" class="submit uppercase button-red color-white b-r-5 b-special-grey button-search-special">Réinitialiser</button></form>
                </div>

    <?php
    $messagesParPage = 50;
    if (isset($_POST['submit_recherche'])){
        $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM cashbackengine_coupons WHERE status = 'active' AND title LIKE ('%".$_POST['search']."%')");
    }else{
      $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM cashbackengine_coupons WHERE status = 'active'");
    }
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
    if (isset($_POST['submit_recherche'])){
        $debits = $pdo->query("SELECT cashbackengine_coupons.*, cashbackengine_retailers.retailer_id, cashbackengine_retailers.image  FROM cashbackengine_coupons INNER  JOIN  cashbackengine_retailers ON cashbackengine_coupons.retailer_id = cashbackengine_retailers.retailer_id WHERE cashbackengine_coupons.status = 'active' AND cashbackengine_coupons.title LIKE ('%".$_POST['search']."%') ORDER BY STR_TO_DATE(cashbackengine_coupons.start_date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
    }else{
        $debits = $pdo->query("SELECT cashbackengine_coupons.*, cashbackengine_retailers.retailer_id, cashbackengine_retailers.image  FROM cashbackengine_coupons INNER  JOIN  cashbackengine_retailers ON cashbackengine_coupons.retailer_id = cashbackengine_retailers.retailer_id WHERE cashbackengine_coupons.status = 'active' ORDER BY STR_TO_DATE(cashbackengine_coupons.start_date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
    }
    $all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);
    foreach ($all_debits as $dones_debits)
    {
        $boutique_image=  strpos($dones_debits['image'], 'http') !== false ? $dones_debits['image'] : '/img/' . $dones_debits['image'];
    ?>
                <div class="col-md-4 col-sm-6 col-xs-12 m-b-20">
                    <div class="coupon bg-white b-special-grey b-r-5 p-20 row">
						<div class="col-md-12 col-sm-12 col-xs-12 " style=" height: 70%;width: 100%; margin: 0;padding: 0;">
							<!-- <div class="coupon-img"> -->
								<img src="<?= $boutique_image; ?>" alt="" class="" style="width: 100%; height: 100%;"/>
							<!-- </div> -->
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin: 0;padding: 0 0 0 5px;width: 100%;height: 30%">
							<!-- <div >
								<div class="f-s-16 color-gold"><?= $dones_debits['title'] ?></div>
							</div> -->
							<div class="f-s-12">
								<span class="m-r-5 f-w-bold">
									   <?= $dones_debits['description']; ?>
                                </span>
                                <a href="goto2store.php?id=<?php echo $dones_debits['retailer_id']; ?>&c=<?php echo $dones_debits['coupon_id']; ?>" class="btn_code b-r-5 uppercase p-10">Utiliser</a>
							</div>
						</div>
                    </div>
                </div>

<?php } ?>

			<div class="clear"></div>
            </div>
			<div class="col-md-12 col-sm-12 col-xs-12 m-b-20">
<?php if ($pageActuelle != 1) {
    $page_p = ($pageActuelle - 1); ?><a href="<?= url_site; ?>/coupons.php?page=<?php echo $page_p; ?>"><div>Page précédente</div></a><?php } else { ?><div>Page précédente</div><?php } ?>
<?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) {
    $page_s = ($pageActuelle + 1); ?><a href="<?= url_site; ?>/coupons.php?page=<?php echo $page_s; ?>"><div style="float : right;">Page suivante</div></a><?php } else { ?><div style="float : right;">Page suivante</div><?php } ?>
			</div>
            <div class="clear"></div>
            </div>
        </div>
    </div>
</section>

<?php
include('./requiert/inc-footer.php');
?>