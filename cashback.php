<?php

include('./requiert/new-form/header.php');

$meta_title = 'Quizzdeal.fr : Les cashback';
$meta_description = '';

if(!isset($_SESSION['id'])){
    header("Location: connexion.php");
    exit();
}
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
        background: #f74265;
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

<section class="container-content">
    <h1 class="title-page">Cashback</h1>
    <div class=" wrapper-content">
    <div class="m-auto content p-40-20">	
    <div class="row">
        <div class="col-sm-3 col-xs-12" style="padding:0">
            <div class="" style="box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.12);">
                <div class="cat-head">Catégorie</div>
                <?php
                    $sql = "SELECT * FROM cashbackengine_categories";
                    $req = $pdo->query($sql);
                    $categories = $req->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="cat-box-content">
                    <ul class="widget-submenu" style="padding: 0">
                        <?php foreach ($categories as $category) : ?>
                            <li class=" m-b-5 m-t-5">
                                <a href="cashback.php?category=<?= $category['category_id'];?>"><?= $category['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>                
            </div>
        </div>
        <div class="col-sm-9 col-md-8 col-md-offset-1">
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
                    <div class="coupon item-coupon bg-white b-special-grey b-r-5 p-20 row">
                        <div class="col-md-12 col-sm-12 col-xs-12 coupon-box-img">
                            <img src="<?= $boutique_image; ?>" alt="" class="" style="max-width: 80%;"/>
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
                <div class="col-md-12 col-sm-12 col-xs-12 m-b-20 group-nav">
    <?php if ($pageActuelle != 1) {
        $page_p = ($pageActuelle - 1); ?><a class="navigation-table" href="<?= url_site; ?>/cashback.php?page=<?php echo $page_p; ?>"><i class="fa fa-angle-left"></i></a><?php } else { ?><i class="fa fa-angle-left"></i><?php } ?>
    <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) {
    $page_s = ($pageActuelle + 1); ?><a class="navigation-table" href="<?= url_site; ?>/cashback.php?page=<?php echo $page_s; ?>"><i class="fa fa-angle-right"></i></a><?php } else { ?><i class="fa fa-angle-right"></i><?php } ?>
            </div>
            <div class="clear"></div>
            </div>
        </div>
    </div>
        </div>
    </div>		
    </div>	
</section>

<?php
include('./requiert/new-form/footer.php');
?>