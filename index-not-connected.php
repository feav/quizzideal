<?php 
	include('./requiert/new-form/header.php');
	include('./requiert/php-form/login-register.php');
	
    $post_reg_mdp = addslashes(htmlentities("123"));
?>


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
<section class="fullwidth margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f8f8f8">

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


<?php 
	include('./requiert/new-form/footer.php');
?>
