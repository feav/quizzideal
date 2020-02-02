<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Contactez-nous';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
include('./requiert/php-form/contact.php');
?>

<div id="content" class="site-content">
<div id="primary" class="content-area width-full">
        <main id="main" class="site-main">
            <div class="cont">			
        <h1 class="maincont-ttl">Besoin d'information</span> rapidement ?</h1>
        <h3 class="f-s-24 xs-f-s-18 Oswald f-w-light uppercase color-dark-grey txt-align-center">Vous n'avez pas trouvé de réponse(s) à votre(vos) question(s) ? Utilisez le formulaire de contact dès à présent pour nous contacter.</h3>

        <div class="container m-t-40">
            <div class="row" align="center">
                <div class="col-md-6 col-xs-12 txt-align-center" style="float: inherit;">
                    <div class="bg-light-grey p-20 b-r-10 b-5-blue">
                        <form method='POST' class="bg-white p-5 contact-form" id="contact_form" method="post" action="">
                            <div class="m-b-10 f-s-18 f-w-bold txt-align-left">Contactez-nous</div>
                            <div id="reponse" align="center"><h3><?php echo $reponse; ?></h3></div>
                            <input type="email" name='email' id="contact_email" class="input-md m-b-10" placeholder="Votre email" value="<?= $post_email; ?>" required>
                            <input type="text" name='sujet' id="contact_sujet" class="input-md m-b-10" placeholder="Votre sujet" value="<?= $post_sujet; ?>" required>
                            <textarea name="message" id="contact_description" cols="30" rows="7" class="input-md m-b-10" placeholder="Message" required><?= $post_email; ?></textarea>
                            <button type="submit" name="submit_send" id="submitContact" value="submit_send" class="button-blue-degrade color-white b-r-5 f-s-13 submit-md">Envoyer le message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</div>
<?php
include('./requiert/inc-footer.php');
?>