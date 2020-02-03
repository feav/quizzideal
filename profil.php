<?php 
    include('./requiert/new-form/header.php');
    include('./requiert/php-form/login-register.php');
    
    
        $sql = "SELECT * FROM parrainage WHERE id = 1";
        $req = $pdo->query($sql);
        $par = $req->fetch(PDO::FETCH_ASSOC);
        include('./requiert/php-form/profil.php');

    ?>

<div class="container margin-top-40">

        <div class="row">

            <!-- Profile -->
            <div class="col-lg-6 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray"> Mon profil</h4>
                    <div class="dashboard-list-box-static">
                        <!-- Details -->
                        <div class="my-profile">
                        <form method="POST" enctype="multipart/form-data">
                            <label>Nom</label>
                            <input type="text" id="nom" name="nom" placeholder="Entrez le nom de famille" value="<?= $mbreNom; ?> " required="required"<?php if ($mbreNom != '') echo ' readonly="readonly"'; ?> >

                            <label>Prenom</label>
                            <input type="text" id="prenom" name="prenom" placeholder="Entrez le prénom" value="<?= $mbrePrenom; ?> "  <?php if ($mbrePrenom != '') echo ' cursor-not-allowed'; ?>" required="required"<?php if ($mbrePrenom != '') echo ' readonly="readonly"'; ?> >

                            <label>Email</label>
                            <input type="email" id="email" name="email" placeholder="Entrez l'adresse e-mail" value="<?= $mbreEmail; ?>" required="required">

                            <label>Adresse</label>
                            <input type="text" id="adresse" name="adresse" placeholder="Entrez l'adresse complète (Rue + nr.)" value="<?= $mbreAdresse; ?>" >

                            <label>Code Postal</label>
                            <input type="text" id="codePostal" name="codePostal" placeholder="Entrez le code postal" value="<?= $mbreCodePostal; ?>"   >

                            <label>Ville</label>
                            <input  type="text" id="ville" name="ville" placeholder="Entrez la ville" value="<?= $mbreVille; ?>"  >

                            <label>Parrain</label>
                            <input type="text" id="parrain" name="parrain" placeholder="ID du Parrain" value="<?= $mbreParrain; ?>"  disabled="disabled" />

                            <label>Pays</label>
                            <input type="text" id="pays" value="<?= $mbrePays; ?>" class="input-md-readonly b-r-5 f-s-12 m-b-20" disabled="disabled"/>

                            <select name="news" >
                                <option value="0" <?php if ($mbreNewsletter == 0) echo "selected"; ?>>Je ne m'inscris pas à la newsletter</option>
                                <option value="1" <?php if ($mbreNewsletter == 1) echo "selected"; ?>>Je m'inscris à la newsletter</option>
                            </select>
                        </div>
                
                        <button   type="submit" name="submit_update" value="Appliquer les modifications" id="submit"  class="button margin-top-15">Enregistrer</button>
                    </form>

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
        
                    </div>
                </div>
            </div>

            <!-- Change Password -->
            <div class="col-lg-6 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray">Mes informations de paiement</h4>
                    <div class="dashboard-list-box-static">

                        <!-- Change Password -->
                        <div class="my-profile">
                            <label class="margin-top-0">Paypal</label>
                            <input type="text" id="paypal" name="paypal" placeholder="Entrez votre adresse Paypal" value="<?= $mbrePaypal; ?>" />

                            <label class="margin-top-0">Skrill</label>
                            <input type="text" id="skrill" name="skrill" placeholder="Entrez votre adresse Skrill" value="<?= $mbreSkrill; ?>" />

                            <label class="margin-top-0">IBAN</label>
                            <input type="text" id="iban" name="iban" placeholder="Entrez votre IBAN" value="<?= $mbreIban; ?>"/>

                            <label class="margin-top-0">SWIFT</label>
                            <input type="text" id="swift" name="swift" placeholder="Entrez votre code Swift/BIC" value="<?= $mbreSwift; ?>" />

                            <button class="button margin-top-15">Modifier</button>
                        </div>

                    </div>
                </div>

                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray">Vérification d'identité A faire</h4>
                    <div class="dashboard-list-box-static">

                        <!-- Change Password -->
                        <div class="my-profile">
                        <?php
                            if ($mbreIdentRecto == '' && $mbreIdentVerso == '' && $mbreIdentVerif == 0) {
                                ?>
                                <form method="POST" enctype="multipart/form-data">
                                    <label class="margin-top-0">Copie Recto de votre Carte d'identité :</label>
                                    <input type="file" id="fileToUpload" name="fileToUpload" />

                                    <label class="margin-top-0">Copie Verso de votre Carte d'identité :</label>
                                    <input type="file" id="fileToUpload2" name="fileToUpload2" /><br/>

                                    <button type="submit" name="valid_ident" value="Envoyer mes documents"  class="button margin-top-15">Modifier</button>
                                </form>
                                <?php
                            } else if ($mbreIdentRecto != '' && $mbreIdentVerso != '' && $mbreIdentVerif == 0) {
                                ?>

                                <label class="margin-top-0">Vérification d'identité En attente</label>
                                <?php
                            } else {
                                ?>
                                <label class="margin-top-0">Vérification d'identité  Validé</label>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
<br>
<?php 
    include('./requiert/new-form/footer.php');
?>
