<?php

include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Les cashback';
$meta_description = '';

if(!isset($_SESSION['id'])){
    header("Location: connexion.php");
    exit();
}

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
    $('.swal-text').css('border','none');
	$('.swal-text').css('font-size','20px');
	$('.swal-text').css('background','#fff');
	$('.swal-text').find('a').css('display','block');
	$('.swal-icon').hide();
    }

    function sendAjax(url, datas){
        $.post(
            url,
            datas,
            function(data){},
            'json'
        );
    }
</script>

<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">	
    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <?php
                $sql = "SELECT * FROM cashbackengine_categories";
                $req = $pdo->query($sql);
                $categories = $req->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="bg-light-grey b-r-10 p-20 b-special-grey m-t-20" style="border: 2px orange solid">
                <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 10px -15px;width:calc(100% - 10px);">
                    Categories
                </div>
                    <ul class="widget-submenu">
                        <?php foreach ($categories as $category) : ?>
                            <li class=" m-b-5 m-t-5">
                                <a href="cashback.php?category=<?= $category['category_id'];?>"><?= $category['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="m-b-5 f-s-18 f-w-bold txt-align-left color-gold">cashback</div>
        <div class="m-b-20 b-b-3-gold"></div>

        <div class="bg-light-grey b-r-10 p-20 b-special-grey container">
            <div class="row">      

    <?php
    $messagesParPage = 50;
    if(isset($_GET['category'])){
        $idCashback = (int)$_GET['category'];
        $retour_total = $pdo->query("
        SELECT COUNT(*) AS total FROM cashbackengine_retailers INNER JOIN cashbackengine_retailer_to_category ON cashbackengine_retailers.retailer_id = cashbackengine_retailer_to_category.retailer_id AND cashbackengine_retailer_to_category.category_id = {$idCashback} WHERE status = 'active'");
    }else{
        $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM cashbackengine_retailers WHERE status = 'active'");
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
    if(isset($_GET['category'])){
        $idCashback = (int)$_GET['category'];

        $debits = $pdo->query("SELECT * FROM cashbackengine_retailers INNER JOIN cashbackengine_retailer_to_category ON cashbackengine_retailers.retailer_id = cashbackengine_retailer_to_category.retailer_id AND cashbackengine_retailer_to_category.category_id = {$idCashback} WHERE status = 'active' ORDER BY STR_TO_DATE(added,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
     }else{
        $debits = $pdo->query("SELECT * FROM cashbackengine_retailers WHERE status = 'active' ORDER BY STR_TO_DATE(added,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
     }
    $all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);
    foreach ($all_debits as $dones_debits)
    {
        $boutique_image=  strpos($dones_debits['image'], 'http') !== false ? $dones_debits['image'] : '/img/' . $dones_debits['image'];
    ?>
                <div class="col-md-4 col-sm-6 col-xs-12 m-b-20">
                    <div class="coupon bg-white b-special-grey b-r-5 p-20 row">
                        <div class="col-md-12 col-sm-12 col-xs-12 " style="height:70%;margin-bottom: 0;width: 100%;padding-left: 0;padding-right: 0; ">
                            <!-- <div class="coupon-img"> -->
                                <img src="<?= $boutique_image; ?>" alt="" class="" style="width: 100%;"/>
                            <!-- </div> -->
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="height:25%;margin-bottom: 0;">

                        <?php
                            if($dones_debits['cashback'] !== '') {
                        ?>
                            <a href="goto2store.php?id=<?= $dones_debits['retailer_id'] ?>" class="btn_code b-r-5 uppercase p-10">Utiliser</a>
                        
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>

<?php } ?>
          
            <div class="clear"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 m-b-20">
<?php if ($pageActuelle != 1) {
    $page_p = ($pageActuelle - 1); ?><a href="<?= url_site; ?>/cashback.php?page=<?php echo $page_p; ?>"><div>Page précédente</div></a><?php } else { ?><div>Page précédente</div><?php } ?>
<?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) {
    $page_s = ($pageActuelle + 1); ?><a href="<?= url_site; ?>/cashback.php?page=<?php echo $page_s; ?>"><div style="float : right;">Page suivante</div></a><?php } else { ?><div style="float : right;">Page suivante</div><?php } ?>
            </div>
            <div class="clear"></div>
            </div>
        </div>
    </div>
        </div>
    </div>			
</section>

<?php
include('./requiert/inc-footer.php');
?>