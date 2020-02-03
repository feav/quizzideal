<?php
	include('./requiert/new-form/header.php');
	
	$meta_title = 'Quizzdeal.fr : Le Chatroom';
	$meta_description = '';
	if ($mbreBanniChat == 1) {
?>
		<script LANGUAGE="JavaScript">
		document.location.href="./"
		</script>
<?php
	exit();
	}
		
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
			}, 1000);
		});
		</script>

<?php
		if (isset($_GET['del'])) { $del = $_GET['del']; }

		if (!empty($del) && $mbre_admin != '0')
		{
			$pdo->exec("DELETE FROM tchat WHERE id = '".$_GET['id']."' AND time = '".$_GET['time']."' AND idUser = '".$_GET['idUser']."'");
		}
?>

<h1 class="	title-page">Chatroom</h1>
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
	} else {
?>
		<section class="bg-light-grey absolute-section-1 margin-base">
			<div class="m-auto content p-40-20 container"><div class="row">
		<script type="text/javascript">
			swal({
				text: "Oups, vous n'avez rien a faire ici !",
				button: false,
				icon: "error",
				closeOnClickOutside: false,
				closeOnEsc: false,
			})
			setTimeout("window.location='<?= url_site; ?>'",3000);
		</script>
</div></div>
		
<?php
	}
	
	include('./requiert/new-form/footer.php');
?>