<?php 
    include('./requiert/new-form/header.php');
    include('./requiert/php-form/boutique.php');

?>


<div class="">
    <div class="row">

        <div class="col-md-12">

            <!-- Sorting - Filtering Section -->
            <div class="row margin-bottom-25 margin-top-40">

                <div class="col-md-12">
                    <form method="POST" >
                        <div class="main-search-input gray-style margin-top-0 margin-bottom-10">

                            <div class="main-search-input-item">
                                <input type="text" name="search" required="required"   placeholder="Entrez le nom de la boutique" />
                            </div>

                            <button  type="submit"  name="submit_recherche" value="submit_recherche" class="button">Chercher</button>
                        </div>
                    </form>
                </div>
            </div>
    
            <!-- Sorting - Filtering Section / End -->
            <?php if(isset($_POST['search'])){?>
                
                <form  method="POST" style="display: flex;justify-content: space-between;margin-bottom: 10px;" >
                    <h4>Filtre Boutique : <?php echo $_POST['search']?></h4>
                    <button  type="submit"  name="submit_rei" value="submit_rei"  class="button border">Annuler le filtre</button>
                </form>
            <?php } ?>
            <div class="row">

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
                    $boutique_cat = htmlspecialchars($dones_boutique['categorieId']);
                    $cat_name = $pdo->query("SELECT nom FROM boutiqueCategorie WHERE id = $boutique_cat ");
                    $cat = $cat_name->fetchAll(PDO::FETCH_ASSOC)[0]['nom'];
                    $desactiv = '';
                     if ($mbreIdentVerif == 0) 
                        $desactiv = "disabled"; ;
                   ?>
                <!-- Listing Item -->
                <div class="col-lg-4 col-md-6">
                    <a class="listing-item-container compact">
                        <div class="listing-item">
                            <img src="<?php echo $boutique_image ?>" alt="">
                            <?php
                            if ($desactiv == 'disabled') {?>
                                <div class="listing-badge not-open">Indispoble</div>
                            <?php } ?>
                            <div class="listing-item-content">
                                <form method="POST">
                                    <h3>
                                        <?php echo $boutique_nom ;
                                        if ($desactiv == '') { ?>
                                        <i class="verified-icon"></i>
                                        <?php } ?>
                                    </h3>
                                    <span><?php echo $cat?> </span>
                                     <select name="idBoutiqueMontant" <?= $desactiv; ?> data-placeholder="Select Item" class="chosen-select">
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
                                    <input type="hidden" name="idBoutique" value="<?= $boutique_id; ?>">
                                    <button class="button" type="submit" name="commander" style="margin-top: 15px;"  <?= $desactiv; ?>>COMMANDER</button>
                                    </span> 
                                </form>
                            </div>
                            <!-- <span class="like-icon"></span> -->
                        </div>
                    </a>
                </div>
                <!-- Listing Item / End -->
                <?php endforeach; ?>
                <!-- Listing Item -->

        </div>

    </div>
</div>

<?php 
    include('./requiert/new-form/footer.php');
?>
