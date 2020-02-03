</div></div>

<?php if (isset($_SESSION['id'])){
	?>


<button id="open-chatroom"  onclick="$('#chatroom').toggle()"><i class="im im-icon-Speach-Bubble12"></i></button>
<div id="chatroom">
	<div class="chatroom-head">
		<div class="messages-headline">
					Moderateur: <h4>Krisjul</h4> 								

				</div>	
					<input type="button" style="width: max-content;position: absolute;right: 20px;top:5px;" onclick="$('#chatroom').toggle()" value="x" class="button" />
	</div>
	<div class="chatroom-body">
		
			<div class="messages-container margin-top-0">
				

				<div class="messages-container-inner">

					<!-- Message Content -->
					<div style="width: 100%">
						<div class="message-content">
							
						</div>

						<!-- Reply Area -->
						<div class="clearfix"></div>
						<?php if ($mbreNom != '' && $mbrePrenom != '') { ?>
							<form id="form">
								<div class="message-reply">
									<textarea id="msg" name="message" cols="40" rows="3" placeholder="Entrez votre message ici"></textarea>
									<input id="send" type="submit" name="submit" value="Envoyer mon message" class="submit button bg-blue bg-blue-hover color-white f-w-400 f-s-12 b-r-50" />
								</div>
								</form>
							<?php } ?>
						
					</div>
					<!-- Message Content -->

				</div>

			</div>
	</div>
</div>

<?php
		
	if ($mbreLevel > 1 OR $mbreEurosHisto >= '0.30') {
?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$("tr").each(function() {
    			var tab = $(this).attr("data-hl");
    			//3ème partie == 2 car cela commence à 0
    			//alert("Numéro compris dans l'ID : "+tab);
			});
    		// Lorsque je soumets le formulaire
    		$('#form').on('submit', function(e) {
        		e.preventDefault(); 
        		$('#send').attr('disabled', true);
    			var message = $('#msg').val();

    			if(message != ""){ // on vérifie que les variables ne sont pas vides
       				$.ajax({
            			url : "chat-envois.php", // on donne l'URL du fichier de traitement
            			type : "POST", // la requête est de type POST
            			data : {message : message, submit : 'Envoyer mon message'}, // et on envoie nos données
            			success:function(data){
            				$('input#msg').val('');
            				$('#send').removeAttr('disabled');
            				if (data != 'ok') 
			                {
			                	$('#message').addClass('alert-danger').show();
			                	$('#message').html('<button type="button" class="close" data-dismiss="alert">×</button>\
			                		<strong>Erreur !</strong> Le message n\'a pas été envoyé ... > ' + data);
			                	setTimeout(function() {
			                		$('#message').removeClass('alert-danger').hide();
			                	}, 6000);
			                }
			            } 
       	 			});
    			}
			});
		});
		</script>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script>
		<?php if ($mbreNom != '' && $mbrePrenom != '') { ?>$(function(){
			$('#refreshco').load('chat-ajax.php?a=refreshco');

			setInterval(function(){
				$('#refreshco').load('chat-ajax.php?a=refreshco');
			}, 10000);
		});<?php } ?>
		$(function(){
			setInterval(function(){
				$('.message-content').load('chat-ajax.php?a=refreshchat');
			}, 100000);
			$('.message-content').load('chat-ajax.php?a=refreshchat');
		});
		</script>

<?php
		if (isset($_GET['del'])) { $del = $_GET['del']; }

		if (!empty($del) && $mbre_admin != '0')
		{
			$pdo->exec("DELETE FROM tchat WHERE id = '".$_GET['id']."' AND time = '".$_GET['time']."' AND idUser = '".$_GET['idUser']."'");
		}
?>



<?php } ?>



<div class="container">
	<div class="row">
				
		<!-- Listings -->
		<div class="col-md-8 col-md-offset-2">
			<p>
				Bienvenue sur le chatroom de GPTBonus <b><?php echo $mbreNom." ".$mbrePrenom ?></b>
			</p>
			<div class="messages-container margin-top-0">
				<div class="messages-headline">
					Moderateur: <h4>Krisjul</h4>
				</div>

				<div class="messages-container-inner">

					<!-- Message Content -->
					<div style="width: 100%">
						<div class="message-content">
							
						</div>

						<!-- Reply Area -->
						<div class="clearfix"></div>
						<?php if ($mbreNom != '' && $mbrePrenom != '') { ?>
							<form id="form">
								<div class="message-reply">
									<textarea id="msg" name="message" cols="40" rows="3" placeholder="Entrez votre message ici"></textarea>
									<input id="send" type="submit" name="submit" value="Envoyer mon message" class="submit button bg-blue bg-blue-hover color-white f-w-400 f-s-12 b-r-50" />
								</div>
								</form>
							<?php } ?>
						
					</div>
					<!-- Message Content -->

				</div>

			</div>

		</div>
	</div>
</div>
<?php
	} 
?>

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
                    <li><a href="index.php" title="">Accueil</a></li>
                <?php } ?>
					<li><a href="contact.php" title="">Contact</a></li>
					<li><a href="gagnants.php" title="">Ils ont gagné</a></li>
					<li><a href="mentions-legales.php" title="">Mentions légales</a></li>
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

<style type="text/css">
	#chatroom {  
		position: fixed;
	    background: white;
	    max-width: 501px;
	    bottom: 0;
	    width: max-content;
	    display: none;
	    right: 20px;
	    z-index: 10000;
	    box-shadow: 0px -1px 17px 3px #b5b3b3;
	    border-radius: 25px;
	    overflow: hidden;
	}
	#open-chatroom{
	       position: fixed;
	    background: #f31f49;
	    bottom: 50px;
	    right: 50px;
	    color: white;
	    border-radius: 100%;
	    width: 100px;
	    height: 100px;
	    z-index: 1000;
	    font-size: 53px;
	    font-weight: 800;
	}
	.messages-container-inner .message-content {
	    padding: 10px !important;
	}
	.message-bubble .message-text {
	    margin-left: 60px;
	    background-color: #f6f6f6;
	    border-radius: 4px;
	    padding: 8px;
	    position: relative;
	}
	#chatroom  .messages-container-inner {
	    padding: 10px;
	}
	#chatroom .messages-container-inner .message-content {
	    padding: 10px !important;
	    height: 300px;
	    overflow: scroll;
	}
</style>
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