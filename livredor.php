<?php
include('./requiert/new-form/header.php');

$meta_title = 'Quizzdeal.fr : Contactez-nous';
$meta_description = '';

include('./requiert/php-form/livredor.php');

?>
<style type="text/css">
    .notification{display: none;}
</style>
<div class="container" style="margin-top: 40px">
    <div class="col-md-8 col-md-offset-2">
        <div class="f-s-13 f-w-light m-b-20">
            <div class="bg-light-grey color-black p-10-20 f-s-14 b-r-10 b-special-grey m-b-20" align="justify">
            Vous aimez notre site ou vous souhaitez contribuer à son amélioration ?<br />
            N'hésitez pas à nous le faire savoir en remplissant le Livre d'or.
            </div>

            <div class="row" align="center">
                <div class="col-md-12 col-xs-12 xs-m-b-20">
                    <div class="bg-light-grey p-20 b-r-10 b-5-blue" style="margin-bottom: 11px;">
                        <form method='POST' class="bg-white p-5 contact-form" id="upload_form" method="post">
                            <input type="email" name='email' class="input-md m-b-10 b-r-5 f-s-12" placeholder="Votre email" value="<?= $post_email; ?>" required>
                            <textarea name="message" id="" cols="30" rows="7" class="input-md m-b-10 b-r-5 f-s-12" placeholder="Message" required><?= $post_message; ?></textarea>
                            <input type="submit" name="submit_send" value="Envoyer le message" class="button-blue-degrade color-white b-r-5 f-s-13 submit-md">
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>


<?php
include('./requiert/new-form/footer.php');
?>		
