<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Mon profil';
$meta_description = '';

if (!isset($_SESSION['id'])) {
    header('Location: /connexion.html');
    exit();
}

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
include('./requiert/php-form/profil.php');
?>
<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">
        <div class="container" style="padding-left: 0; margin-left: 0; width: 100%;"><div class="row">
            <?php include('./requiert/inc-menu-right.php'); ?>
                <div class="col-md-8 col-xs-12 xs-m-b-20">
                    <div class="bg-light-grey b-r-10 p-20 b-special-grey">
                        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-user m-r-10"></i> Mon profil</div>

                        <form method="POST" enctype="multipart/form-data">

                            <div class="m-b-5 f-s-16 f-w-bold txt-align-left color-gold">Mes données personnelles</div>
                            <div class="m-b-10 b-b-3-gold"></div>

                            <input type="text" id="nom" name="nom" placeholder="Entrez le nom de famille" value="<?= $mbreNom; ?> "class="input-xs b-r-5 f-s-12 m-b-10 m-r-10"<?php if ($mbreNom != '') echo ' cursor-not-allowed'; ?>" required="required"<?php if ($mbreNom != '') echo ' readonly="readonly"'; ?> />
                            <input type="text" id="prenom" name="prenom" placeholder="Entrez le prénom" value="<?= $mbrePrenom; ?> "class="input-xs b-r-5 f-s-12 m-b-10" <?php if ($mbrePrenom != '') echo ' cursor-not-allowed'; ?>" required="required"<?php if ($mbrePrenom != '') echo ' readonly="readonly"'; ?> />
                            <input type="email" id="email" name="email" placeholder="Entrez l'adresse e-mail" value="<?= $mbreEmail; ?>" class="input-xs b-r-12 f-s-12 m-b-10" required="required"/>
                            <input type="text" id="adresse" name="adresse" placeholder="Entrez l'adresse complète (Rue + nr.)" value="<?= $mbreAdresse; ?>" class="input-xs b-r-12 f-s-12 m-b-10" />
                            <input type="text" id="codePostal" name="codePostal" placeholder="Entrez le code postal" value="<?= $mbreCodePostal; ?>"  class="input-xs b-r-5 f-s-12 m-b-10" />
                            <input type="text" id="ville" name="ville" placeholder="Entrez la ville" value="<?= $mbreVille; ?>"  class="input-xs b-r-5 f-s-12 m-b-10" />
                            <input type="text" id="parrain" name="parrain" placeholder="ID du Parrain" value="<?= $mbreParrain; ?>" class="input-md f-s-12 f-w-light m-b-10" disabled="disabled" />
                            <input type="text" id="pays" value="<?= $mbrePays; ?>" class="input-md-readonly b-r-5 f-s-12 m-b-20" disabled="disabled"/>
                            <select name="news" class="input-md m-b-10 b-r-5">
                                <option value="0" <?php if ($mbreNewsletter == 0) echo "selected"; ?>>Je ne m'inscris pas à la newsletter</option>
                                <option value="1" <?php if ($mbreNewsletter == 1) echo "selected"; ?>>Je m'inscris à la newsletter</option>
                            </select>

                            <div class="m-b-5 f-s-16 f-w-bold txt-align-left color-gold">Mes informations de paiement</div>
                            <div class="m-b-10 b-b-3-gold"></div>

                            <input type="text" id="paypal" name="paypal" placeholder="Entrez votre adresse Paypal" value="<?= $mbrePaypal; ?>" class="input-md b-r-5 f-s-12 m-b-10"/>
                            <input type="text" id="skrill" name="skrill" placeholder="Entrez votre adresse Skrill" value="<?= $mbreSkrill; ?>" class="input-md b-r-5 f-s-12 m-b-10"/>
                            <input type="text" id="iban" name="iban" placeholder="Entrez votre IBAN" value="<?= $mbreIban; ?>"class="input-xs b-r-5 f-s-12 m-b-10 m-r-10"/>
                            <input type="text" id="swift" name="swift" placeholder="Entrez votre code Swift/BIC" value="<?= $mbreSwift; ?>" class="input-xs b-r-5 f-s-12 m-b-20"/>


                            <div class="txt-align-right"><button  type="submit" name="submit_update" value="Appliquer les modifications" id="submit"/class="submit button-blue-degrade color-white b-r-5 uppercase f-s-12 f-w-bold">Enregistrer</button></div>
                        </form>
                    </div>
                    
                    
                </div>
                
                
                
            </div>
        </div><div class="clear"></div></form>


        <?php
        if ($mbreNom != '' && $mbrePrenom != '' && $mbreAdresse != '' && $mbreVille != '' && $mbreCodePostal != '') {
            if ($mbreCodeVerif != 0 && $mbreCodeVerif != 1) {
                ?>
                <div class="m-t-20 f-s-21 uppercase f-w-400 m-b-15 color-orange m-l-20">Vérification du profil <div class="display-inline-block m-l-10">|<i class="fa fa-clock-o m-l-10 m-r-5"></i> En attente</div></div>

                <form method="POST" class="m-l-20 m-r-20 p-t-20 p-b-20 bg-white b-r-5"><div class="col-md-12 col-sm-12 txt-align-center">
                        <div class="m-b-10"><label for="code_verif" class="m-l-5 p-5 f-s-11 bg-grey color-dark-grey b-r-5">Entrez votre code ci-dessous :</label></div>
                        <input type="text" id="code_verif" name="code_verif" placeholder="Entrez votre code reçu ici" value="" class="input-xs b-r-5 f-s-12 f-w-light txt-align-center m-b-10" required="required"/><br/>
                        <input type="submit" name="valid_profil" value="Valider mon profil" class="submit button bg-green bg-green-hover color-white f-w-400 f-s-14 b-r-50"/>
                    </div><div class="clear"></div></form>
                <?php
            } else if ($mbreCodeVerif == 1) {
                ?>
                <div class="m-t-20 f-s-21 uppercase f-w-400 color-green m-l-20">Vérification du profil <div class="display-inline-block m-l-10">|<i class="fa fa-check m-l-10 m-r-5"></i> Validé</div></div>

                <?php
            }
        }
        ?>

        <?php
        if ($mbreIdentRecto == '' && $mbreIdentVerso == '' && $mbreIdentVerif == 0) {
            ?>
            <div class="m-b-5 f-s-16 f-w-bold txt-align-left color-gold">Vérification d'identité A faire</div>
            <div class="m-b-10 b-b-3-gold"></div>

            <form method="POST" enctype="multipart/form-data">
                <div class="m-b-5 f-s-14 f-w-light">Copie Recto de votre Carte d'identité :</div>
                <input type="file" id="fileToUpload" name="fileToUpload" class="input-md b-r-5 f-s-12 m-b-10" /><br/><br/>

                <div class="m-b-5 f-s-14 f-w-light">Copie Verso de votre Carte d'identité :</div>
                <input type="file" id="fileToUpload2" name="fileToUpload2" class="input-md b-r-5 f-s-12 m-b-10" /><br/>

                <div class="txt-align-right"><button type="submit" name="valid_ident" value="Envoyer mes documents" class="submit button-blue-degrade color-white b-r-5 uppercase f-s-12 f-w-bold">Envoyer documents </button></div>
            </form>
            <?php
        } else if ($mbreIdentRecto != '' && $mbreIdentVerso != '' && $mbreIdentVerif == 0) {
            ?>
            <div class="m-b-5 f-s-16 f-w-bold txt-align-left color-gold">Vérification d'identité En attente</div>
            <div class="m-b-10 b-b-3-gold"></div>

            <?php
        } else {
            ?>
            <div class="m-b-5 f-s-16 f-w-bold txt-align-left color-blue">Vérification d'identité  Validé</div>
            <div class="m-b-10 b-b-3-blue"></div>
            <?php
        }
        ?>
    </div></div>
</section>

<?php
include('./requiert/inc-footer.php');
?>