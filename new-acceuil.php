<?php 
	include('./requiert/new-form/header.php');
?>


<!-- Banner
================================================== -->
<div class="main-search-container" data-background-image="assets/images/bg.jpg">
	<div class="main-search-inner">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Simplifiez votre gestion</h2>
					<h4>Gerez vos coupons et faites des cashout facilement.</h4>
					<div>
						<table>
							<tr><td><h4>Gains disponibles </h4></td><td><h2 style="display: inherit;padding-left: 10px;"><?php echo displayMontant($mbreEuros, 3, ' €'); ?></h2></td></tr>
							<tr><td><h4>Gains en attente</h4></td><td><h2 style="display: inherit;padding-left: 10px;"><?php echo  displayMontant($totalAmoundAttente, 2, ' €'); ?></h2></td></tr>
						</table>
						
						
						<br>
						<button class="button" onclick="window.location.href='listings-half-screen-map-list.html'">FAIRE UN CASHOUT</button>

					</div>
				</div>
			</div>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<h3 class="headline centered margin-top-75">
				DERNIERES TRANSACTIONS 
				<span>Les  <i>10</i> dernieres transactions sur votre compte</span>
			</h3>
		</div>

	</div>
</div>


<!-- Categories Carousel -->
<div class="fullwidth-carousel-container margin-top-25">
	<div class="fullwidth-slick-carousel category-carousel">
	<?php
        $histoParticipations = $pdo->query("SELECT offerwall, idt, remuneration, date, etat FROM histo_offers WHERE idUser > 0 AND etat != 'En cours' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i') DESC LIMIT 0,5");
        $all_histoParticipations = $histoParticipations->fetchAll(PDO::FETCH_ASSOC);
        foreach ($all_histoParticipations as $dones_histoParticipations) {
        	// var_dump($dones_histoParticipations);die();
	        $etat = $dones_histoParticipations['etat'];
	        if ($etat == 'Valid&eacute;') {
	        	$btn_etat = '<i class="im im-icon-Like color-green"></i>';
	        } else if ($etat == 'En cours') {
	            $btn_etat = '<i class="im im-icon-Over-Time2 color-orange"></i>';
	        } else if ($etat == 'Refus&eacute;') {
	            $btn_etat = '<i class="im im-icon-Unlike color-red"></i>';
	        }
    ?>

		<!-- Item -->
		<div class="fw-carousel-item">
			<div class="category-box-container">
				<a href="listings-half-screen-map-grid-1.html" class="category-box" data-background-image="assets/images/category-box-01.jpg">
					<div class="category-box-content">
						<h3><?php echo $btn_etat ?> <?php echo $dones_histoParticipations['idt']; ?></h3>
						<h3><?= displayMontant($dones_histoParticipations['remuneration'], 6, '') ?>€</h3>
						<i style="color: #f1edee;"><?= $dones_histoParticipations['date']; ?></i>
					</div>
					<span class="category-box-btn">Details</span>
				</a>
			</div>
		</div>

    <?php
        }
    ?>

	</div>
</div>
<!-- Categories Carousel / End -->



<!-- Fullwidth Section -->
<section class="fullwidth margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f8f8f8">

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h3 class="headline centered margin-bottom-45">
					Mes Coupons Crees
					<span>Les coupons les plus recements crees</span>
				</h3>
			</div>

			<div class="col-md-12">
				<div class="simple-slick-carousel dots-nav">

				<!-- Listing Item -->
				<div class="carousel-item">
					<a href="listings-single-page.html" class="listing-item-container">
						<div class="listing-item">
							<img src="assets/images/listing-item-01.jpg" alt="">

							<div class="listing-badge now-open">Now Open</div>
							
							<div class="listing-item-content">
								<span class="tag">Eat & Drink</span>
								<h3>Tom's Restaurant <i class="verified-icon"></i></h3>
								<span>964 School Street, New York</span>
							</div>
							<span class="like-icon"></span>
						</div>
						<div class="star-rating" data-rating="3.5">
							<div class="rating-counter">(12 reviews)</div>
						</div>
					</a>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<a href="listings-single-page.html" class="listing-item-container">
						<div class="listing-item">
							<img src="assets/images/listing-item-02.jpg" alt="">
							<div class="listing-item-details">
								<ul>
									<li>Friday, August 10</li>
								</ul>
							</div>
							<div class="listing-item-content">
								<span class="tag">Events</span>
								<h3>Sticky Band</h3>
								<span>Bishop Avenue, New York</span>
							</div>
							<span class="like-icon"></span>
						</div>
						<div class="star-rating" data-rating="5.0">
							<div class="rating-counter">(23 reviews)</div>
						</div>
					</a>
				</div>
				<!-- Listing Item / End -->		

				<!-- Listing Item -->
				<div class="carousel-item">
					<a href="listings-single-page.html" class="listing-item-container">
						<div class="listing-item">
							<img src="assets/images/listing-item-03.jpg" alt="">
							<div class="listing-item-details">
								<ul>
									<li>Starting from $59 per night</li>
								</ul>
							</div>
							<div class="listing-item-content">
								<span class="tag">Hotels</span>
								<h3>Hotel Govendor</h3>
								<span>778 Country Street, New York</span>
							</div>
							<span class="like-icon"></span>
						</div>
						<div class="star-rating" data-rating="2.0">
							<div class="rating-counter">(17 reviews)</div>
						</div>
					</a>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<a href="listings-single-page.html" class="listing-item-container">
						<div class="listing-item">
							<img src="assets/images/listing-item-04.jpg" alt="">

							<div class="listing-badge now-open">Now Open</div>

							<div class="listing-item-content">
								<span class="tag">Eat & Drink</span>
								<h3>Burger House <i class="verified-icon"></i></h3>
								<span>2726 Shinn Street, New York</span>
							</div>
							<span class="like-icon"></span>
						</div>
						<div class="star-rating" data-rating="5.0">
							<div class="rating-counter">(31 reviews)</div>
						</div>
					</a>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<a href="listings-single-page.html" class="listing-item-container">
						<div class="listing-item">
							<img src="assets/images/listing-item-05.jpg" alt="">
							<div class="listing-item-content">
								<span class="tag">Other</span>
								<h3>Airport</h3>
								<span>1512 Duncan Avenue, New York</span>
							</div>
							<span class="like-icon"></span>
						</div>
						<div class="star-rating" data-rating="3.5">
							<div class="rating-counter">(46 reviews)</div>
						</div>
					</a>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<a href="listings-single-page.html" class="listing-item-container">
						<div class="listing-item">
							<img src="assets/images/listing-item-06.jpg" alt="">

							<div class="listing-badge now-closed">Now Closed</div>

							<div class="listing-item-content">
								<span class="tag">Eat & Drink</span>
								<h3>Think Coffee</h3>
								<span>215 Terry Lane, New York</span>
							</div>
							<span class="like-icon"></span>
						</div>
						<div class="star-rating" data-rating="4.5">
							<div class="rating-counter">(15 reviews)</div>
						</div>
					</a>
				</div>
				<!-- Listing Item / End -->
				</div>
				
			</div>

		</div>
	</div>

</section>



<?php 
	include('./requiert/new-form/footer.php');
?>
