<footer class="absolute-footer-1">
			<div class="bg-dark-grey">
			<!-- Pied-de-page de la page -->
				<div class="m-auto content p-t-20 container"><div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12 line-height f-s-14 sm-m-b-20">
						<div class="f-s-16 f-w-400 m-b-5 color-white Nunito-Light">Accès rapide</div>
						<ul>
							<?php if (isset($_SESSION['id'])) { ?> 
                                                            <li><i class="fa fa-fw fa-angle-right"></i> <a href="accueil.php" title="">Accueil</a></li>
                                                        <?php } else { ?>
                                                            <li><i class="fa fa-fw fa-angle-right"></i> <a href="index.html" title="">Accueil</a></li>
                                                        <?php } ?>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="contact.html" title="">Contact</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="gagnants.php" title="">Ils ont gagné</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="mentions-legales.html" title="">Mentions légales</a></li>
                                                        <li><i class="fa fa-fw fa-angle-right"></i> <a href="faq.php" title="">Question fréquentes</a></li>
						</ul>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12 line-height f-s-14 sm-m-b-20">
						<div class="f-s-16 f-w-400 m-b-5 color-white Nunito-Light">Partenaires</div>

						<ul>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="https://www.afflight.biz/" title="Plateforme d'affiliation" target="_blank">Plateforme d'affiliation</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="http://www.optimiads.com/" title="Régie Publicitaire" target="_blank">Régie Publicitaire</a></li>
							<li><i class="fa fa-fw fa-angle-right"></i> <a href="https://www.dj-events.be/" title="Deejay en Belgique" target="_blank">Deejay en Belgique</a></li>
						</ul>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 line-height f-s-14">
						<div class="f-s-16 f-w-400 m-b-10 color-white Nunito-Light">A propos de Quizzdeal</div>
						
						<div class="txt-align-justify"><strong>A chaque jour ses gains et ses cadeaux !!!</strong>. Quizzdeal vous permet à l'aide de simples clics de gagner de l'argent et des cadeaux facilement et rapidement...et surtout gratuitement !!!</div>
					</div>
				</div></div>
			</div>
			
			<div class="bg-dark-light-grey color-light-grey f-s-13 txt-align-center">
			<!-- Pied-de-page de la page -->
				<div class="m-auto content p-t-5 p-b-10">
					<div class="">2019 - <strong>Quizzdeal.fr</strong></div>
				</div>
			</div>
		</footer>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="script/js/popup-sweetalert.min.js"></script>
		<script src="script/js/login-register.js"></script>
                <script src="ticker/includes/jquery.ticker.js" type="text/javascript"></script>
                
                <script type="text/javascript">
    $(function () {
    $('#js-news').ticker({
        titleText: 'Livre d\'or',
        displayType: 'fade',
        pauseOnItems: 5000,
        fadeInSpeed: 1000,
        fadeOutSpeed: 1000,
        controls: false, 
    });

    $('#offerwalls-menu').on('click', function(e){
		e.preventDefault();
		$('#submenu').toggle('blind',500);
	});
});
</script>
</div>
</div>
    </body>
</html>