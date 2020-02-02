<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Quizzdeal.fr : Le Chatroom';
	$meta_description = '';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');

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
				$('#refreshchat').load('chat-ajax.php?a=refreshchat');
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
		<section class="bg-white absolute-section-1">
			<div class="m-auto content p-40-20">				
				<div class="container" style="padding-left: 0; margin-left: 0; width: 100%;"><div class="row">
					<div class="col-md-8 col-xs-12 xs-m-b-20">				
						<div class="bg-light-grey b-r-10 p-20 b-special-grey">
							<div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-comments m-r-10"></i> Chatroom</div>

					<div class="bg-dark-light-grey color-white b-r-5 p-20 b-special-grey m-b-10 f-s-14 f-w-light">
								<div class="m-b-10">Bienvenue sur le chatroom de GPTBonus, votre modérateur est <span class="f-w-bold color-green uppercase">Krisjul</span> !</div>
								<strong>Membre(s) actuellement sur le chat :</strong> <div id="refreshco" style="display:inline"><i>Chargement en cours...</i></div>
							</div>
					
					<div class="bg-white b-r-5 b-special-grey p-10 m-b-10 f-s-13 f-w-light" style="height:275px;overflow-x: hidden;overflow-y: scroll;box-shadow: none;">
								<div id="refreshchat" style="display:inline"></div>
							</div>

						<?php if ($mbreNom != '' && $mbrePrenom != '') { ?><form id="form" class="txt-align-right form-chat m-t-10">
							<input type="hidden" id="idUser" value="<?php echo $mbreHashId; ?>" />
							<input type="text" id="msg" name="message" autocomplete="off" placeholder="Entrez votre message ici" class="input-md b-r-50 f-w-light m-b-5 f-s-12" />
							<input id="send" type="submit" name="submit" value="Envoyer mon message" class="submit button bg-blue bg-blue-hover color-white f-w-400 f-s-12 b-r-50" /><div class="clear"></div>
						</form>
						<?php } ?>
					</div>
				</div>	
					<div class="col-md-4 col-xs-12">
						<div class="bg-light-grey b-r-10 p-20 b-special-grey">
							<div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-user m-r-10"></i> Orealclaude</div>

							
        <div class="col-md-12 txt-align-center">
            <div class="f-s-21 bg-blue color-white b-r-5 b-special-grey p-10-20 m-b-20"><i class="fa fa-money m-r-10"></i> <strong><?php echo displayMontant($mbreEuros, 6, ' €'); ?></strong><br>(<?= displayMontant($totalAmoundAttente, 2, ' €'); ?>)</span><div class="f-s-14 uppercase f-w-light m-t-2">solde actuel</div></div>

            <a href="#" id="info-prcnt"><div class="float m-b-10 f-s-13 f-w-light transition-1s color-white p-10-20 b-r-5 b-special-grey">
                <progress id="avancement" value="<?= $mbreBarrePrcnt; ?>" max="100" title="Bonus à <?= displayMontant($mbreBarrePrcnt, 2, ' %'); ?>" style="width:80%;"></progress>
                <span id="description-barre" class="m-l-10 color-white txt-align-center f-s-10 cursor-pointer" style="float: right;"><i class="fa fa-info p-5 bg-blue bg-blue-hover b-r-50 width-10"></i></span> <script type="text/javascript">
                    document.querySelector('span#description-barre').onclick = function () {
                        swal({
                            text: "Vous avez rempli <?= $mbreBarrePrcnt; ?>% de la barre de bonus.\n\nEncore un petit effort, car une fois à 100%, vous serez crédité automatiquement de 2 euros !!!",
                            button: "Fermer",
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                    };
                    </script>
                </div></a>
								
								<a href="./chatroom.html"><div class="float m-b-10 f-s-13 f-w-light transition-1s bg-green bg-green-hover color-white p-10-20 b-r-5 b-special-grey">
									<div class="float-left"><i class="fa fa-fw fa-comments"></i></div>
									<div class="float-right f-w-bold">Chatroom</div>
								</div></a>

								<a href="./profil.html"><div class="float m-b-10 f-s-13 f-w-light transition-1s bg-red bg-red-hover color-white p-10-20 b-r-5 b-special-grey">
									<div class="float-left"><i class="fa fa-fw fa-user"></i></div>
									<div class="float-right">Mon profil</div>
								</div></a>
								
								<a href="./parrainage.html"><div class="float m-b-10 f-s-13 f-w-light transition-1s bg-red bg-red-hover color-white p-10-20 b-r-5 b-special-grey">
									<div class="float-left"><i class="fa fa-fw fa-users"></i></div>
									<div class="float-right">Parrainage</div>
								</div></a>
								
								<a href="./livredor.php"><div class="float m-b-10 f-s-13 f-w-light transition-1s bg-red bg-red-hover color-white p-10-20 b-r-5 b-special-grey">
                                     <div class="float-left"><i class="fa fa-fw fa-book"></i></div>
                                     <div class="float-right">Livre d'Or</div>
                                </div></a>

                                <a href="./messagerie.php"><div class="float m-b-10 f-s-13 f-w-light transition-1s bg-red bg-red-hover color-white p-10-20 b-r-5 b-special-grey">
                                     <div class="float-left"><i class="fa fa-fw fa-book"></i></div>
                                     <div class="float-right">Messagerie <span class="message_circle"><?= $nb_MsgNonLu['nbr_entrees']; ?></span></div>
                                </div></a>	
								
								<a href="./mes-commandes.html"><div class="float m-b-10 f-s-13 f-w-light transition-1s bg-red bg-red-hover color-white p-10-20 b-r-5 b-special-grey">
									<div class="float-left"><i class="fa fa-fw fa-list"></i></div>
									<div class="float-right">Mes commandes</div>
								</div></a>
								
								<a href="./mes-participations.html"><div class="float f-s-13 f-w-light transition-1s bg-red bg-red-hover color-white p-10-20 b-r-5 b-special-grey">
									<div class="float-left"><i class="fa fa-fw fa-list"></i></div>
									<div class="float-right">Mes participations</div>
								</div></a>
							</div><div class="clear"></div>
						</div>
					</div>
				</div></div>
			</div>
		</section>
		  
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
	
	include('./requiert/inc-footer.php');
?>