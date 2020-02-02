<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : La boutique';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
include('./requiert/php-form/boutique.php');
?>
<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">				
        <div class="m-b-5 f-s-18 f-w-bold txt-align-left color-gold">Boutique</div>
        <div class="m-b-20 b-b-3-gold"></div>

        <div class="bg-light-grey b-r-10 p-20 b-special-grey container"><div class="row">
                <div class="p-l-20 p-r-20 m-b-20">
                    <form method="POST" class="display-inline"><input type="text" name="search" value="" placeholder="Recherche ..." class="b-special-grey input-md p-10-20 b-r-5 input-search" required=""/>
                        <button type="submit" name="submit_recherche" value="submit_recherche" class="submit uppercase button-blue color-white b-r-5 b-special-grey m-l-10">Rechercher</button></form>
                    <form method="POST" class="display-inline-block xs-display-block"><button name="submit_rei" value="submit_rei" class="submit uppercase button-red color-white b-r-5 b-special-grey button-search-special">Réinitialiser</button></form>
                </div>
                
                <?php
                if (isset($_POST['submit_recherche']))
                {
                    $boutique = $pdo->query("SELECT * FROM boutique WHERE actif = 1 AND nom LIKE ('%".$_POST['search']."%') ORDER BY rand()");
                }
                else
                {
                    $boutique = $pdo->query("SELECT * FROM boutique WHERE actif = 1 ORDER BY rand()");
                }
                $all_boutique = $boutique->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php foreach ($all_boutique as $dones_boutique): //Boucle données boutique?>
                    <?php
                    $boutique_id = htmlspecialchars($dones_boutique['id']);
                    $boutique_nom = htmlspecialchars($dones_boutique['nom']);
                    $boutique_image = htmlspecialchars($dones_boutique['image']);
                    ?>
                
                <div class="col-md-4 col-sm-6 col-xs-12 m-b-20">
                    <div class="boutique bg-white b-special-grey b-r-5 p-20">
                        <div class="boutique-img">
                            <img src="<?= $boutique_image; ?>" alt="" class="b-special-grey b-r-50 p-5"/>
                        </div>
                        <div class="boutique-right">
                            <div class="f-s-16 color-gold"><?= $boutique_nom; ?></div>
                        </div>
                        <div class="f-s-12" style="position: absolute; z-index: 1; bottom: 20px; right: 40px;">
                            <form method="POST">
                                <span class="m-r-5 f-w-bold">
                                    <select name="idBoutiqueMontant" id="price_filter">
                                    <?php
                                    //Bloc req SQL pour la boucle montant boutique
                                    $boutiqueMontant = $pdo->query("SELECT * FROM boutiqueMontant WHERE boutiqueId = $boutique_id ORDER BY montant");
                                    $all_boutiqueMontant = $boutiqueMontant->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <?php foreach ($all_boutiqueMontant as $dones_boutiqueMontant): // Boucle données montant?>
                                        <?php
                                        $boutiqueMontant_id = htmlspecialchars($dones_boutiqueMontant['id']);
                                        $boutiqueMontant_montant = htmlspecialchars($dones_boutiqueMontant['montant']);
                                        ?>
                                        <option value="<?= $boutiqueMontant_montant; ?>"><?= $boutiqueMontant_montant; ?>€</option>
                                    <?php endforeach; // FIN Boucle données montant  ?>
                                    </select>
                                </span> 
                                <?php if ($mbreIdentVerif == 0) $desactiv = "disabled"; else $desactiv = ""; ?>
                                <button type="submit" name="commander" name="commander" value="20" class="submit button-gold color-white b-r-5 uppercase p-10" <?= $desactiv; ?>>Commander</button>
                                <input type="hidden" name="idBoutique" value="<?= $boutique_id; ?>">
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>
</section>

<script>
    function redirectReload(elmt) {
        elmt.parentElement.submit();
        setTimeout(function () {
            window.location.reload();
        }, 1000);
    }
</script>

<?php
include('./requiert/inc-footer.php');
?>