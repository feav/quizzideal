<?php 
	include('./requiert/php-form/login-register.php');
	
    $post_reg_mdp = addslashes(htmlentities("123"));
?>
<style type="text/css">
	.coupon-list{
	    width: 100%;
	    display: grid;
	    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
	    /* grid-template-columns: repeat(3, 1fr); */
	    grid-gap: 15px;
	}
	.coupon-list {
	    display: grid;
	    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
	    grid-gap: 15px;
	}
	.coupon-item{
	    height: 230px;
	    border: 1px solid gray;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	}
	.coupon-item::before {
	    content: "";
	    position: absolute;
	    top: 0;
	    width: 100%;
	    background: #000;
	    opacity: .6;
	    height: 100%;
	}
	.coupon-item img{
		max-width: 80%;
	    display: block;
	    top: 50%;
	    margin: auto;
	}
	.coupon-item .desc-box{
		z-index: 1;
	    position: absolute;
	    width: 100%;
	    color: #fff;
	    height: 100%;
	    top: 0;
	}
	.reduction{
		background: #f91942;
	    padding: 2px 10px;
	    border-radius: 42%;
	    position: absolute;
	    top: 3px;
	    left: 6px;
	}
	.voir-coupon{
		position: absolute;
	    top: 73%;
	    margin: auto;
	}
	.coupon-item::before {
	    content: "";
	    position: absolute;
	    top: 0;
	    width: 100%;
	    background: #000;
	    opacity: .6;
	    height: 100%;
	}
</style>

<!-- Banner
================================================== -->
    <div class="main-search-container" style="background-image:url(assets/images/bg2.jpg)">
        <div class="main-search-inner">

            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h1>GAGNER DE L'ARGENT ET DES CADEAUX</h1>
                        <h3>SIMPLEMENT, RAPIDEMENT ET SURTOUT GRATUITEMENT</h3>
                        <h3>SANS BOUGER DE CHEZ SOI ?</h3>
                        <h5><i>Juste en cliquant, en repondant a des sondages ou en testant des apps</i></h5>
                        <div>
                            
                            
                            <br>
                            <button class="button" onclick="window.location.href='listings-half-screen-map-list.html'">DEMARRER</button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


<!-- Fullwidth Section -->
<section class="fullwidth margin-top-0 padding-top-50 padding-bottom-70" data-background-color="#f8f8f8">

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h3 class="headline centered margin-bottom-45">
					NOS PARTENAIRES
					<span>A retrouver dans nos boutiques</span>
				</h3>
			</div>

			<div class="col-md-12">
				<div class="simple-slick-carousel dots-nav">
			<?php 
                 $boutique = $pdo->query("SELECT * FROM boutique WHERE actif = 1 ORDER BY rand()");
                $all_boutique = $boutique->fetchAll(PDO::FETCH_ASSOC);
               foreach ($all_boutique as $dones_boutique): //Boucle données boutique?>
                    <?php
                    $boutique_id = htmlspecialchars($dones_boutique['id']);
                    $boutique_nom = htmlspecialchars($dones_boutique['nom']);
                    $boutique_image = htmlspecialchars($dones_boutique['image']);
                    $boutique_cat = htmlspecialchars($dones_boutique['categorieId']);
                    $cat_name = $pdo->query("SELECT nom FROM boutiqueCategorie WHERE id = $boutique_cat ");
                    $cat = $cat_name->fetchAll(PDO::FETCH_ASSOC)[0]['nom'];
                    $desactiv = '';
                     if ($mbreIdentVerif == 0) 
                        $desactiv = "disabled"; ;
                   ?>
				<!-- Listing Item -->
				<div class="carousel-item">
					<a href="listings-single-page.html" class="listing-item-container">
						<div class="listing-item">
							<img src="<?php echo $boutique_image ?>" alt="">

							<!-- <div class="listing-badge now-open">Now Open</div> -->
							
							<div class="listing-item-content">
								<span class="tag"><?php echo $cat?> </span>
								<h3><?php echo $boutique_nom ;?></h3>
								<!-- <span>964 School Street, New York</span> -->
							</div>
							<!-- <span class="like-icon"></span> -->
						</div>
						<!-- <div class="star-rating" data-rating="3.5">
							<div class="rating-counter">(12 reviews)</div>
						</div> -->
					</a>
				</div>
			<?php endforeach; ?>
				<!-- Listing Item / End -->
				</div>
				
			</div>

		</div>
	</div>

</section>
<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="headline centered margin-top-80">
				FAITES CONFIANCE À <strong>QUIZZDEAL</strong>
			</h2>
		</div>
	</div>
	<div class="row icons-container">
		<!-- Stage -->
		<div class="col-md-4">
			<div class="icon-box-2 with-line">
				<i class="im im-icon-Police"></i>
				<h3>Securite</h3>
				<p>Vos données sont sécurisées et ne seront jamais cédées à des sociétés tiers.</p>
			</div>
		</div>

		<!-- Stage -->
		<div class="col-md-4">
			<div class="icon-box-2 with-line">
				<i class="im im-icon-Magnifi-Glass"></i>
				<h3>Fiabilite</h3>
				<p>Nous proposons uniquement les meilleures offres afin de vous proposer que de la qualité.</p>
			</div>
		</div>

		<!-- Stage -->
		<div class="col-md-4">
			<div class="icon-box-2">
				<i class="im im-icon-Money"></i>
				<h3>Rapidite</h3>
				<p>Les reversements et envois de cadeaux sont envoyés sous 72H maximum.</p>
			</div>
		</div>
	</div>

</div>

<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="headline centered margin-top-80">
				Nos coupons</strong>
			</h2>
		</div>
	</div>

    <?php if(isset($_POST['search'])){?>
        
        <form  method="POST" style="display: flex;justify-content: space-between;margin-bottom: 10px;" >
            <h4>Filtre Boutique : <?php echo $_POST['search']?></h4>
            <button  type="submit"  name="submit_rei" value="submit_rei"  class="button border">Annuler le filtre</button>
        </form>
    <?php } ?>
    <div class="row">

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
                $debits = $pdo->query("SELECT cashbackengine_coupons.*, cashbackengine_retailers.retailer_id, cashbackengine_retailers.image , cashbackengine_retailers.cashback , cashbackengine_retailers.end_date  FROM cashbackengine_coupons INNER  JOIN  cashbackengine_retailers ON cashbackengine_coupons.retailer_id = cashbackengine_retailers.retailer_id WHERE cashbackengine_coupons.status = 'active' AND cashbackengine_coupons.title LIKE ('%".$_POST['search']."%') ORDER BY STR_TO_DATE(cashbackengine_coupons.start_date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
            }else{
                $debits = $pdo->query("SELECT cashbackengine_coupons.*, cashbackengine_retailers.retailer_id, cashbackengine_retailers.image  , cashbackengine_retailers.cashback  , cashbackengine_retailers.end_date FROM cashbackengine_coupons INNER  JOIN  cashbackengine_retailers ON cashbackengine_coupons.retailer_id = cashbackengine_retailers.retailer_id WHERE cashbackengine_coupons.status = 'active' ORDER BY STR_TO_DATE(cashbackengine_coupons.start_date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
            }
            $all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);
            foreach ($all_debits as $dones_debits):
                $boutique_image=  strpos($dones_debits['image'], 'http') !== false ? $dones_debits['image'] : '/img/' . $dones_debits['image'];
            ?>
            <!-- Listing Item -->
            <div class="col-lg-4 col-md-6">
                <a class="">
                    <div class="listing-item">
                        <span class="blog-item-tag"><?php echo $dones_debits['cashback'];?></span>
                        <img src="<?php echo $boutique_image; ?>" alt="">
                        <div class="listing-item-content">
                            <h3><?php echo $dones_debits['description'];?></h3>
                            <br/>
                            <span>Expiration : <?php echo $dones_debits['end_date'];?></span>
                            <form method="POST">
                                <!-- <span><?php echo $cat?> </span> -->
                                <input type="hidden" name="idBoutique" value="<?= $boutique_id; ?>">
                                <a  href="goto2store.php?id=<?php echo $dones_debits['retailer_id']; ?>&c=<?php echo $dones_debits['coupon_id']; ?>"  class="button ">Utiliser le coupon</a>
                            </form>
                        </div>
                        <!-- <span class="like-icon"></span> -->
                    </div>
                </a>
            </div>
            <!-- Listing Item / End -->
        <?php endforeach; ?>
	</div>
</div>


<?php 
	include('./requiert/new-form/footer.php');
?>
