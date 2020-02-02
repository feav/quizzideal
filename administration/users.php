<?php
include('./requiert/php-global.php');
$meta_title = 'Panel d\'administration : Utilisateurs | Quizzdeal.fr';
$nomPage = 'Utilisateurs';
include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');

$users = array();
$sql = "SELECT id,nom,prenom FROM users WHERE id != '".$mbreId."'";
foreach  ($pdo->query($sql) as $row) {
    $users[$row['id']] = $row['prenom']." ".$row['nom'];
}
if(isset($_POST['submit'])){
	try {
		$message = $pdo->Quote($_POST["message"]);
		$id_to_message = $pdo->Quote($_POST["id"]);
		$pdo->Query("UPDATE `users` SET `pmessage`=".$message." WHERE `id` = ".$id_to_message."");
		$successful_message = true;
	} catch (Exception $ex) {
		$successful_message = false;
	}
}

?>
        
    <section class="bg-light-grey absolute-section-1 margin-base">
        <div class="m-auto content p-40-20 container"><div class="row">
		<div class="bg-blue color-white b-r-5 uppercase p-10 m-b-15 m-r-20" style="color:white;">Laisser un message à un utilisateur</div>
			<form action="#" method="post">
				<div class="m-b-10"><select name="id">
					<?php 
					foreach ($users as $id => $infos) {
						echo "<option value='".$id."'>".$infos."</option>";
					}
					?>
				</select></div>
				<div class="m-b-10"><textarea name="message" cols="50" rows="5" placeholder="Tapez votre message ici"></textarea></div>
				<div class="m-b-10"><button type="submit" name="submit">Envoyer le message</button></div>
			</form>		
		</div>
		</div></div>
    </section>
		
		<?php if (isset($_POST['submit'])) { ?>
		<script>
			 var success = "<?php echo $successful_message; ?>";
			 if (success) {
				alert('Message bien envoyé !');
			 } else {
				alert('Erreur d\'envoi du message !');
			 }
		</script>
		<?php } ?>
<?php
	include('./requiert/inc-footer.php');
?>