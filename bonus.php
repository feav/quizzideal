<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Bonus Quotidien';
$meta_description = '';

if (!isset($_SESSION['id'])) {
    header('Location: /connexion.html');
    exit();
}

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');

if (!empty($_POST['submitBonus'])) {
    
    $redir = "http://quizzdeal.fr/accueil.php";

    if ($mbreDateLastCo != date('Y-m-d')) {

        $rand = rand(1, 30);
        $rand_Base = htmlentities(intval($_POST['submitBonus']));

        if ($rand == $rand_Base) {

            $sql_BonusGift = $pdo->query("SELECT COUNT(id) as 'total' FROM bonusLogin WHERE actif = 0");
            $dns_BonusGift = $sql_BonusGift->fetch(PDO::FETCH_ASSOC);
            $nbr_BonusGift = addslashes(htmlentities($dns_BonusGift['total']));

            if ($nbr_BonusGift == 0) {

                $montant = (rand(11, 50) / 100);
                $pdo->exec("UPDATE users SET euros = euros + '" . $montant . "', euros_histo = euros_histo + '" . $montant . "' WHERE id = '" . $mbreId . "'");

                $reponsConfirm = 'Bravo, vous venez de gagner ' . displayMontant($montant, 2, '') . '€ ! Redirection en cours...';
                $redirectionLogin = $redir;
                $button = 'false';
            } else {

                $sql_BonusGift = $pdo->query("SELECT name FROM bonusLogin WHERE actif = 0");
                $dns_BonusGift = $sql_BonusGift->fetch(PDO::FETCH_ASSOC);
                $nbr_BonusGiftId = addslashes(htmlentities($dns_BonusGift['id']));
                $nbr_BonusGiftName = addslashes(htmlentities($dns_BonusGift['name']));

                $pdo->exec("UPDATE bonusLogin SET actif = 1, winner = '" . $mbreId . "' WHERE id = '" . $nbr_BonusGiftId . "' AND actif = 0");
                $pdo->exec("INSERT INTO `gagnants` (`id`, `idUser`, `montant`, `type`, `categorie`, `date`, `ip`) VALUES ('', '" . $mbreId . "', 0, '" . $nbr_BonusGiftName . "', 'Bonus Connexion', '" . date('d/m/Y à H:i:s') . "', '" . ip . "')");

                $reponsConfirm = 'Bravo, vous venez de gagner 1x ' . $nbr_BonusGiftName . ' ! Redirection en cours...';
                $redirectionLogin = $redir;
                $button = 'false';
            }
        } else {

            $montant = (rand(1, 10) / 100);
            $pdo->exec("UPDATE users SET euros = euros + '" . $montant . "', euros_histo = euros_histo + '" . $montant . "' WHERE id = '" . $mbreId . "'");

            $reponsConfirm = 'Bravo, vous venez de gagner ' . displayMontant($montant, 2, '') . '€ ! Redirection en cours...';
            $redirectionLogin = $redir;
            $button = 'false';
        }

        $pdo->exec("UPDATE users SET datelastco = '" . date('Y-m-d') . "' WHERE id = '" . $mbreId . "'");
    } else {

        $reponsError = 'Oups, une erreur c\'est produite !';
    }
}

if (isset($reponsConfirm)) {
    ?>
    <script type="text/javascript">
        swal({
            text: "<?= $reponsConfirm; ?>",
            button: <?= $button; ?>,
            icon: "success",
            closeOnClickOutside: false,
            closeOnEsc: false,
        })<?php if (isset($redirectionLogin)) { ?>,
                    setTimeout("window.location='<?= $redirectionLogin; ?>'", 3000);<?php } ?>
    </script>
    <?php
}

if (isset($reponsError)) {
    ?>
    <script type="text/javascript">
        swal({
            text: "<?= $reponsError; ?>",
            button: "Fermer",
            icon: "error",
            closeOnClickOutside: false,
            closeOnEsc: false,
        });
    </script>
    <?php
}
?>

<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20 container"><div class="row">
            <div class="col-md-12 txt-align-center">

                <?php
                if ($mbreDateLastCo != date('Y-m-d')) {
                    ?>
                    <div class="f-s-21 uppercase f-w-400 m-b-15 color-orange m-b-40">Bonjour <?= $mbrePrenom; ?>,<br/>choisissez l'un des 3 cadeaux ci-dessous et repartez avec des €uros ou des Cadeaux <i class="fa fa-smile"></i></div>

                    <form method="POST">
                        <button name="submitBonus" value="1" class="m-r-20" style="border:0;background-color:transparent;outline:0;"><img src="./images/gift.png" alt=""/></button>
                        <button name="submitBonus" value="2" class="m-r-20" style="border:0;background-color:transparent;outline:0;"><img src="./images/gift.png" alt=""/></button>
                        <button name="submitBonus" value="3" style="border:0;background-color:transparent;outline:0;"><img src="./images/gift.png" alt=""/></button>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div></div>
</section>

<?php
include('./requiert/inc-footer.php');
?>