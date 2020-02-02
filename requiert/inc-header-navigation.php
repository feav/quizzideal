<header class="fixed-first">			
	<!-- Navigation -->
	<nav class="bg-black-opaque absolute-section-2 f-s-13">
		<?php if (!isset($_SESSION['id'])) { ?>
<!-- 		<div class="logo">
			<a href="index.php">
				<img src="./img/new_logo.png">
			</a>
		</div> -->
		<div class="m-auto p-20">
		<!-- Logo -->
			<div id="menuDeroulant" class="Oswald uppercase f-w-400">
				<li class="m-r-15"><a href="index.php" title="" class="menuUrl">Accueil</a></li>
				<!-- <li class="m-r-15"><a href="gagnants.php" title="" class="menuUrlBlue">Ils ont gagné</a></li> -->
				<li class="m-r-15"><a href="faq.php" title="" class="menuUrl">FAQ</a></li>
				<li class="m-r-15"><a href="contact.php" title="" class="menuUrl">Contact</a></li>
				<li class="m-r-15"><a href="connexion.php" title="" class="color-beige button-white p-5-10 b-r-50 f-w-bold"><i class="fa fa-fw fa-sign-in m-r-5"></i> Espace Membre</a></li>
			</div>
			<div class="mobile-btn b-r-5" style="float:none;">
				<form method="POST">
					<select name="choixPage" onchange="loadPage(this.value);" style="border:0;background:transparent">
						<option selected disabled>Sélectionnez une page</option>
						<option value="index.php">Accueil</option>
						<!-- <option value="gagnants.php">Ils ont gagné</option> -->
                         <option value="faq.php">FAQ</option>
						<option value="contact.php">Contact</option>
						<option value="connexion.php">Espace Membre</option>
					</select>
				</form>

				<script>
				<!--
				function loadPage(param) {
					self.location.href = "http://www.quizzdeal.fr/"+param;
				}
				-->
				</script>
			</div>
			<div class="clear"></div>
		</div>
		<?php } else { ?>
<!-- 		<div class="logo">
			<a href="index.php">
				<img src="./img/new_logo.png">
			</a>
		</div> -->
		<div class="m-auto p-20">
			<!-- Logo -->
			<div id="menuDeroulant" class="Oswald uppercase f-w-400">
				<?php //if ($mbreLevel == 99) { ?>
                                <!--<li class="m-r-15"><a href="administration/index.php" title="" class="menuUrl">Admin</a></li>-->
                                <?php //} ?>
          
                 <li class="m-r-15">
                 	<a href="accueil.php" title="" class="menuUrl">Accueil</a>
                 </li>
				<!-- <li class="m-r-15">
					<a href="coupons.php" title="" class="color-white button-blue p-5-10 b-r-50 f-w-bold"><i class="fa fa-fw fa-money m-r-5"></i>Coupon reduc</a>
				</li>
				<li class="m-r-15">
					<a href="cashback.php" title="" class="color-beige button-white p-5-10 b-r-50 f-w-bold with-submenu">
						<i class="fas fa-coins m-r-5"></i>Cashback
					</a>
				</li> -->
				<!-- <li class="m-r-15">
					<a href="missions.php" title="" class="color-white button-blue p-5-10 b-r-50 f-w-bold"><i class="fa fa-fw fa-euro m-r-5"></i> Gagner de l'argent</a>
				</li> -->
				<li class="m-r-15">
					<a href="boutique.php" title="" class="color-beige button-white p-5-10 b-r-50 f-w-bold"><i class="fa fa-fw fa-gift m-r-5"></i> Boutique</a>
				</li>
				<!-- <li class="m-r-15">
					<a href="gagnants.php" title="" class="menuUrlBlue">Ils ont gagné</a>
				</li> -->
				<li class="m-r-10">
					<i class="fa fa-money mes-money">
						<span class="money money-text"><?php echo displayMontant($mbreEuros, 3, ' €'); ?>&nbsp;(<?= displayMontant($totalAmoundAttente, 2, ' €'); ?>)</span>
					</i>
				</li>
				<li class="m-r-15">
					<a href="messagerie.php" title="" class="fa fa-envelope mes">
						<span class="message_circle mes-text"><?= $nb_MsgNonLu['nbr_entrees']; ?></span>
					</a>
				</li>
				<li class="m-r-15">
					<a href="index.php?action=logout" title="" class="color-white color-white-hover button-red p-5-10 b-r-50 f-w-bold"><i class="fa fa-fw fa-sign-out m-r-5"></i> Déconnexion</a>
				</li>
			</div>
			<div class="mobile-btn b-r-5" style="float:none;">
				<form method="POST">
					<select name="choixPage" onchange="loadPage(this.value);" style="border:0;background:transparent">
						<option selected disabled>Sélectionnez une page</option>
                        <option value="accueil.php">Accueil</option>
						<!-- <option value="missions.php">Gagner de l'argent</option> -->
						<option value="boutique.php">Boutique</option>	
						<!-- <option value="gagnants.php">Ils ont gagné</option> -->
						<option value="index.html?action=logout">Déconnexion</option>
					</select>
				</form>

				<script>
				<!--
				function loadPage(param) {
					self.location.href = "http://www.quizzdeal.fr/"+param;
				}
				-->
				</script>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
	</nav>
</header>