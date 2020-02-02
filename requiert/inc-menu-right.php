<div class="col-md-4 col-xs-12">
    <div class="bg-light-grey b-r-10 p-20 b-special-grey">
        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-user m-r-10"></i> <?php echo $mbrePrenom . " " . $mbreNom; ?></div>

        <div class="col-md-12 txt-align-center">
            <!-- <div class="f-s-21 bg-blue color-white b-r-5 b-special-grey p-10-20 m-b-20"><i class="fa fa-money m-r-10"></i> <strong><?php echo displayMontant($mbreEuros, 6, ' €'); ?></strong><br>(<?= displayMontant($totalAmoundAttente, 2, ' €'); ?>)</span><div class="f-s-14 uppercase f-w-light m-t-2">solde actuel</div></div> -->

            <a href="#" id="info-prcnt"><div class="float m-b-10 f-s-13 f-w-light bg-grey transition-1s color-white p-10-20 b-r-5 b-special-grey">
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
            

            <a href="./profil.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fa fa-1x fa-user"></i>
                    <span class="menu-text"> Mon profil</span>
                </div>
            </a>

            <a href="./parrainage.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fa fa-1x fa-users"></i>
                    <span class="menu-text">Parrainage</span>
                </div></a>

            <a href="./livredor.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fa fa-1x fa-book"></i>
                    <span class="menu-text">Livre d'Or</span>
                </div>
            </a>

            <!-- <a href="./messagerie.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fa fa-1x fa-inbox"></i>
                    <span class="menu-text">Messagerie</span> <span class="message_circle"><?= $nb_MsgNonLu['nbr_entrees']; ?></span>
                </div>
            </a> -->	

            <a href="./mes-commandes.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fa fa-1x fa-list"></i>
                    <span class="menu-text">Mes commandes</span>
                </div>
            </a>

            <a href="./mes-participations.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fa fa-1x fa-list"></i>
                    <span class="menu-text">Mes participations</span>
                </div>
            </a>

            <a href="./coupons.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fa fa-1x fa-money"></i>
                    <span class="menu-text">Coupon Reduc</span>
                </div>
            </a>

            <a href="./cashback.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fas fa-1x fa-coins"></i>
                    <span class="menu-text">Cashback</span>
                </div>
            </a>
            <a id="offerwalls-menu" href="./offerwalls.php">
                <div class="float m-b-10 f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fas fa-1x fa-money"></i>
                    <span class="menu-text">Offerwalls</span>
                </div>
            </a>
            <ul id="submenu" class="submenu bg-grey" style="display: none;">
               <li>
                   <a href="./offerwalls.php?ow=adgem">ADGEM</a>
               </li>
               <li>
                   <a href="./offerwalls.php?ow=adworkmedia">ADWORKMEDIA</a>
               </li>
               <li>
                   <a href="./offerwalls.php?ow=ayetstudios">AYETSTUDIOS</a>
               </li> 
               <li>
                   <a href="./offerwalls.php?ow=kiwiwall">KIWIWALL</a>
               </li> 
               <li>
                   <a href="./offerwalls.php?ow=offertoro">OFFERTORO</a>
               </li> 
               <li>
                   <a href="./offerwalls.php?ow=offerwolf">OFFERWOLF</a>
               </li> 
               <li>
                   <a href="./offerwalls.php?ow=personaly">PERSONALY</a>
               </li> 
               <li>
                   <a href="./offerwalls.php?ow=superrewards">SUPERREWARDS</a>
               </li> 
               <li>
                   <a href="./offerwalls.php?ow=wannads">WANNADS</a>
               </li> 
            </ul>
            <a <?= isset($_SESSION['email_offre']) && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'] ? 'href="./missions.php"' : 'href="./infos.php"'?> >
                <div class="float f-s-13 f-w-light transition-1s bg-grey bg-light-grey-hover color-white p-10-20 b-r-5 b-special-grey txt-align-left text-dark">
                    <i class="fas fa-1x fa-coins"></i>
                    <span class="menu-text">Gagner de l'argent</span>
                </div>
            </a>

        </div><div class="clear"></div>
    </div>
</div>