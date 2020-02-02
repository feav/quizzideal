<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Ma page Membre';
$meta_description = '';

if (!isset($_SESSION['id'])) {
	header('Location: /connexion.html');
	exit();
}

include('./requiert/new-inc-head.php');
include('./requiert/inc-header-navigation.php');
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
    			var message = $('#msg').val();

    			if(message != ""){ // on vérifie que les variables ne sont pas vides
       				$.ajax({
            			url : "chat-envois.php", // on donne l'URL du fichier de traitement
            			type : "POST", // la requête est de type POST
            			data : {message : message, submit : 'Envoyer mon message'}, // et on envoie nos données
            			success:function(data){
            				$('input#msg').val('');
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
		<?php 
			if ($mbreNom != '' && $mbrePrenom != '') { ?>
				$(function(){
					$('#refreshco').load('chat-ajax.php?a=refreshco');
					setInterval(function(){
					$('#refreshco').load('chat-ajax.php?a=refreshco');
					}, 10000);
				});
		<?php 
			} 
		?>
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
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<section class="bg-white absolute-section-1">
			<div class="m-auto content p-40-20">
				<div class="container" style="padding-left: 0; margin-left: 0; width: 100%;">
					<div class="row">
					<?php include('./requiert/inc-menu-right.php'); ?>
					<!-- historique -->

					<!--  -->
					<div class="col-md-8 col-xs-12 xs-m-b-20">
						<div class="chat">
							<div class="chat-header">
								<i class="fa fa-fw fa-comments"></i> Chatroom
							</div>	
							<div class="chat-content">
								<div class="chat-message">
									<div id="refreshchat" style="display:inline"></div>
								</div>
								<div class="chat-list">
									<div class="list-co">
										<ul id="refreshco" class="list-group chat-co">
											
										</ul>
									</div>
								</div>
							</div>
							<div class="chat-footer">
								<div class="send-message">
									<?php if ($mbreNom != '' && $mbrePrenom != '') { ?>
									<form id="form" class="message-input">
										<input type="hidden" id="idUser" value="<?php echo $mbreHashId; ?>" />
										<input type="text" id="msg" name="message" autocomplete="off" placeholder="Entrez votre message ici" class="input-md b-r-5 f-w-light m-b-5 f-s-12" />
										<input type="submit" name="submit" value="Envoyer" class="submit button bg-blue bg-blue-hover color-white f-w-400 f-s-12 b-r-5" />
										<div class="clear"></div>
									</form>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-xs-12 xs-m-b-20">
						<div class="bg-light-grey b-r-10 p-20 b-special-grey m-t-20" style="border: 2px orange solid">
                        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 10px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-list m-r-10"></i> Historique</div>
                        <table rules="none" class="f-s-13 f-w-light">
                            <tr>
                                <th align="left" valign="middle">Date</th>
                                <th align="left" valign="middle">Libéllé</th>
                                <th align="right" valign="middle">Rémunération</th>
                            </tr>
                            <?php
                            $histoParticipations = $pdo->query("SELECT offerwall, idt, remuneration, date, etat FROM histo_offers WHERE idUser > 0 AND etat != 'En cours' ORDER BY STR_TO_DATE(date,'%d/%m/%Y à %H:%i') DESC LIMIT 0,5");
                            $all_histoParticipations = $histoParticipations->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($all_histoParticipations as $dones_histoParticipations) {
                                $etat = $dones_histoParticipations['etat'];
                                if ($etat == 'Valid&eacute;') {
                                    $btn_etat = '<i class="fa fa-check color-green"></i>';
                                } else if ($etat == 'En cours') {
                                    $btn_etat = '<i class="fa fa-clock-o color-orange"></i>';
                                } else if ($etat == 'Refus&eacute;') {
                                    $btn_etat = '<i class="fa fa-times- color-red"></i>';
                                }
                                ?>

                                <tr>
                                    <td align="left" valign="top">Le <?= $dones_histoParticipations['date']; ?></td>
                                    <td align="left" valign="top"><?= $dones_histoParticipations['idt']; ?></td>
                                    <td align="right" valign="top"><?= displayMontant($dones_histoParticipations['remuneration'], 6, ''); ?> €</td>
                                </tr>

                                <?php
                            }
                            ?>
                        </table>
                    </div>
					</div>
					
				</div>

			</div>
		</div>
	</section>

	<?php
	include('./requiert/inc-footer.php');
	?>		
