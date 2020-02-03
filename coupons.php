<?php 
    include('./requiert/new-form/header.php');
    include('./requiert/php-form/boutique.php');

?>


<div class=" ">
    <div class="row">

        <div class="col-md-12">

            <!-- Sorting - Filtering Section -->
            <div class="row margin-bottom-25 margin-top-40">

                <div class="col-md-12">
                    <form method="POST" >
                        <div class="main-search-input gray-style margin-top-0 margin-bottom-10">

                            <div class="main-search-input-item">
                                <input type="text" name="search" required="required"   placeholder="Entrez le nom du coupon" />
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
               
                    $messagesParPage = 50;
                    if (isset($_POST['submit_recherche'])){
                        $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM cashbackengine_coupons WHERE status = 'active' AND title LIKE ('%".$_POST['search']."%')");
                    }else{
                      $retour_total = $pdo->query("SELECT COUNT(*) AS total FROM cashbackengine_coupons WHERE status = 'active'");
                    }
                    $donnees_total = $retour_total->fetch();
                    $total = $donnees_total['total'];
                    $nombreDePages = ceil($total / $messagesParPage);

                    if (isset($_GET['page'])) {
                        $pageActuelle = intval($_GET['page']);
                        if ($pageActuelle > $nombreDePages) {
                            $pageActuelle = $nombreDePages;
                        }
                    } else {
                        $pageActuelle = 1;
                    }

                    $premiereEntree = ($pageActuelle - 1) * $messagesParPage;
                    if (isset($_POST['submit_recherche'])){
                        $debits = $pdo->query("SELECT cashbackengine_coupons.*, cashbackengine_retailers.retailer_id, cashbackengine_retailers.image , cashbackengine_retailers.cashback , cashbackengine_retailers.end_date  FROM cashbackengine_coupons INNER  JOIN  cashbackengine_retailers ON cashbackengine_coupons.retailer_id = cashbackengine_retailers.retailer_id WHERE cashbackengine_coupons.status = 'active' AND cashbackengine_coupons.title LIKE ('%".$_POST['search']."%') ORDER BY STR_TO_DATE(cashbackengine_coupons.start_date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
                    }else{
                        $debits = $pdo->query("SELECT cashbackengine_coupons.*, cashbackengine_retailers.retailer_id, cashbackengine_retailers.image  , cashbackengine_retailers.cashback  , cashbackengine_retailers.end_date FROM cashbackengine_coupons INNER  JOIN  cashbackengine_retailers ON cashbackengine_coupons.retailer_id = cashbackengine_retailers.retailer_id WHERE cashbackengine_coupons.status = 'active' ORDER BY STR_TO_DATE(cashbackengine_coupons.start_date,'%d/%m/%Y à %H:%i') DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
                    }
                    $all_debits = $debits->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($all_debits as $dones_debits):
                        $boutique_image=  strpos($dones_debits['image'], 'http') !== false ? $dones_debits['image'] : '/img/' . $dones_debits['image'];
                    ?>
                    <!-- Listing Item -->
                    <div class="col-lg-4 col-md-5">
                        <a class="">
                            <div class="listing-item">
                                <span class="blog-item-tag"><?php echo $dones_debits['cashback'];?></span>
                                <img src="<?php echo $boutique_image; ?>" alt="">
                                <div class="listing-item-content">
                                    <h3><?php echo $dones_debits['description'];?></h3>
                                    <br/>
                                    <span>Expiration : <?php echo $dones_debits['end_date'];?></span>
                                    <form method="POST">
                                        <!-- <span><?php echo $cat?> </span> -->
                                        <input type="hidden" name="idBoutique" value="<?= $boutique_id; ?>">
                                        <a  href="goto2store.php?id=<?php echo $dones_debits['retailer_id']; ?>&c=<?php echo $dones_debits['coupon_id']; ?>"  class="button ">Utiliser le coupon</a>
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
<div class="row"><br></div>
<?php 
    include('./requiert/new-form/footer.php');
?>
