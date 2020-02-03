<?php 
    include('./requiert/new-form/header.php');
    include('./requiert/php-form/login-register.php');
    
    
        $sql = "SELECT * FROM parrainage WHERE id = 1";
        $req = $pdo->query($sql);
        $par = $req->fetch(PDO::FETCH_ASSOC);
    ?>


    <div class="container">
        <div class="row">
            <div>
                <h2>Parainage</h2>
            </div>
            <div class="row">

                    <!-- Item -->
                    <div class="col-lg-4 col-md-6">
                        <div class="dashboard-stat color-1">
                            <div class="dashboard-stat-content">
                            	<h4><?= $par['inscription']  ?></h4>
                            	<span>Bonus Inscription</span>
                            </div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Checked-User"></i></div>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="col-lg-4 col-md-6">
                        <div class="dashboard-stat color-2">
                            <div class="dashboard-stat-content">
                            	<h4><?= $par['ami']?></h4> 
                            	<span>Bonus Parrainage Ami</span>
                            </div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
                        </div>
                    </div>

                    
                    <!-- Item -->
                    <div class="col-lg-4 col-md-6">
                        <div class="dashboard-stat color-3">
                            <div class="dashboard-stat-content"><h4><?= $par['commission'] ?></h4> <span>Commission de renvoi</span></div>
                            <div class="dashboard-stat-icon"><i class="im im-icon-Back"></i></div>
                        </div>
                    </div>
                </div>

			<div class="row">
				<h4 class="headline centered ">
						Vous souhaitez inviter vos ami(e)s sur Multi-cadeaux et gagner plus d'argent ? Récupérez votre lien de parrainage ci-dessous et partagez-le un maximum. Chaque personne qui s'inscrit via votre lien devient automatiquement votre filleul et vous devenez son parrain. A chaque commande effectuée, vous toucherez 15% du montant de leur commande.
					</h4>

					<h4 class="headline centered margin-top-75">Votre lien de parrainage : <a href="<?= url_site; ?>?parrain=<?= $mbreId; ?>"><?= url_site; ?>?parrain=<?= $mbreId; ?></a> </h4>
			</div>
        </div>
    </div>

<style type="text/css">
    a.navigation-table{
        width: 36px;
        font-size: 24px;
        background: #f91942;
        color: #fff;
        height: 36px;
        display: inline-block;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .table.group-nav{
        margin: 6px;
        text-align: right;
        padding-right: 6px;
    }
    .title-page{
        text-align: center;
        font-size: 28px;
        font-weight: 600;
    }
</style>
<div class="container" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title-page">Liste de vos filleuls</h1>
            <table class="basic-table" rules="none" class="f-s-13 f-w-light">

                            <tr>
                                    <th align="left" valign="middle">Utilisateurs</th>
                                    <th align="left" valign="middle">Email</th>
                                    <th align="left" valign="middle">Adresse</th>
                                    <th align="right" valign="middle">Montant perçu</th>
                            </tr>

                
                           <?php
								$messagesParPage = 50;
								$retour_total = $pdo->query("SELECT COUNT(*) AS total FROM users WHERE idParrain = '" . $mbreId . "'");
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

								$commandes = $pdo->query("SELECT * FROM users WHERE idParrain = '" . $mbreId . "' ORDER BY eurosParrain DESC LIMIT " . $premiereEntree . ", " . $messagesParPage . "");
								$all_commandes = $commandes->fetchAll(PDO::FETCH_ASSOC);
								foreach ($all_commandes as $dones_commandes) {
								    ?>

                                <tr>
                                    <td align="right" valign="top"><?= $dones_commandes['prenom'] . ' ' . substr($dones_commandes['nom'], 0, 1) . '.'; ?></td>
                                    <td><?= $dones_commandes['email']; ?> </td>
                                    <td><?= $dones_commandes['adresse']; ?> </td>
                                    <td><?= displayMontant($dones_commandes['eurosParrain'], 2, ''); ?> €</td>
                                </tr>

                <?php } ?>

                            </table>
            <div class="table group-nav">
                <?php if ($pageActuelle != 1) {
                    $page_p = ($pageActuelle - 1); ?><a class="navigation-table" href="<?= url_site; ?>/gagnants.html?page=<?php echo $page_p; ?>"><i class="fa fa-angle-left"></i></a><?php } else { ?><i class="fa fa-angle-left"></i><?php } ?>
                <?php if (($pageActuelle == 1 AND $nombreDePages > $pageActuelle) OR $nombreDePages > $pageActuelle) {
                    $page_s = ($pageActuelle + 1); ?><a class="navigation-table" href="<?= url_site; ?>/gagnants.html?page=<?php echo $page_s; ?>"><i class="fa fa-angle-right"></i></a><?php } else { ?><i class="fa fa-angle-right"></i><?php } ?> 
            </div>
                            <div class="clear"></div> 
        </div>
    </div>
</div>

<?php 
    include('./requiert/new-form/footer.php');
?>
