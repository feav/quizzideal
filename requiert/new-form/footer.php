</div></div>
<!-- Footer
================================================== -->
<div id="footer" class="sticky-footer">
	<!-- Main -->
	<div class="container">
		<?php
		if (isset($_SESSION['id'])) {
			?>




			<?php
		}else{
			?>



		<div class="row">
			<div class="col-md-4 col-sm-6">
				<img class="footer-logo" src="assets/images/logo.png" alt="">
				<br><br>
				<p><strong>A chaque jour ses gains et ses cadeaux !!!</strong>. Quizzdeal vous permet à l'aide de simples clics de gagner de l'argent et des cadeaux facilement et rapidement...et surtout gratuitement !!!</p>
			</div>

			<div class="col-md-5 col-sm-6">
				<h4>Accès rapide</h4>
				<ul class="footer-links">
				<?php if (isset($_SESSION['id'])) { ?> 
                    <li> <a href="accueil.php" title="">Accueil</a></li>
                <?php } else { ?>
                    <li><a href="index.html" title="">Accueil</a></li>
                <?php } ?>
					<li><a href="contact.html" title="">Contact</a></li>
					<li><a href="gagnants.php" title="">Ils ont gagné</a></li>
					<li><a href="mentions-legales.html" title="">Mentions légales</a></li>
                    <li><a href="faq.php" title="">Question fréquentes</a></li>
				</ul>

				<ul class="footer-links">
					<li> <a href="https://www.afflight.biz/" title="Plateforme d'affiliation" target="_blank">Plateforme d'affiliation</a></li>
					<li> <a href="http://www.optimiads.com/" title="Régie Publicitaire" target="_blank">Régie Publicitaire</a></li>
					<li><a href="https://www.dj-events.be/" title="Deejay en Belgique" target="_blank">Deejay en Belgique</a></li>
				</ul>
				<div class="clearfix"></div>
			</div>		

			<div class="col-md-3  col-sm-12">
				<h4>Contact Us</h4>
				<div class="text-widget">
					<span>France, 81000 albi</span> <br>
					Phone: <span>(+33) 766001506 </span><br>
					E-Mail:<span> <a href="#">jeromerodrigueze@outlook.com</a> </span><br>
				</div>

				<ul class="social-icons margin-top-20">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
				</ul>

			</div>

		</div>
		<!-- Footer / End -->

			<?php
		}
		?>
		<!-- Copyright -->
		<div class="row">
			<div class="col-md-12">
				<div class="copyrights">© 2020 Quizzdeal.fr. All Rights Reserved.</div>
			</div>
		</div>

	</div>

</div>


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script type="text/javascript" src="assets/scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="assets/scripts/mmenu.min.js"></script>
<script type="text/javascript" src="assets/scripts/chosen.min.js"></script>
<script type="text/javascript" src="assets/scripts/slick.min.js"></script>
<script type="text/javascript" src="assets/scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="assets/scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="assets/scripts/waypoints.min.js"></script>
<script type="text/javascript" src="assets/scripts/counterup.min.js"></script>
<script type="text/javascript" src="assets/scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/scripts/tooltips.min.js"></script>
<script type="text/javascript" src="assets/scripts/custom.js"></script>


<!-- Google Autocomplete -->
<script>
  function initAutocomplete() {
    var input = document.getElementById('autocomplete-input');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
    });

	if ($('.main-search-input-item')[0]) {
	    setTimeout(function(){ 
	        $(".pac-container").prependTo("#autocomplete-container");
	    }, 300);
	}
}
</script>
<script src="assets/https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"></script>




</body>
</html>