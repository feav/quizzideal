<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Contactez-nous';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
include('./requiert/php-form/livredor.php');

?>

<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">
        <div class="container" style="padding-left: 0; margin-left: 0; width: 100%;">
            <div class="row">
                         <?php include('./requiert/inc-menu-right.php'); ?>
                <div class="col-md-8 col-xs-12 xs-m-b-20">
                    <div class="bg-light-grey b-r-10 p-20 b-special-grey">
                        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-book m-r-10"></i> Livre d'Or</div>

                        <div class="f-s-13 f-w-light m-b-20">
                            <div class="bg-light-grey color-black p-10-20 f-s-14 b-r-10 b-special-grey m-b-20" align="justify">
                            Vous aimez notre site ou vous souhaitez contribuer à son amélioration ?<br />
                            N'hésitez pas à nous le faire savoir en remplissant le Livre d'or.
                            </div>

                            <div class="row" align="center">
                                <div class="col-md-12 col-xs-12 xs-m-b-20">
                                    <div class="bg-light-grey p-20 b-r-10 b-5-blue">
                                        <form method='POST' class="bg-white p-5 contact-form" id="upload_form" method="post">
                                            <div class="m-b-10 f-s-18 f-w-bold txt-align-left">Livre d'or</div>
                                            <input type="email" name='email' class="input-md m-b-10 b-r-5 f-s-12" placeholder="Votre email" value="<?= $post_email; ?>" required>
                                            <textarea name="message" id="" cols="30" rows="7" class="input-md m-b-10 b-r-5 f-s-12" placeholder="Message" required><?= $post_message; ?></textarea>
                                            <button type="submit" name="submit_send" value="submit_send" class="button-blue-degrade color-white b-r-5 f-s-13 submit-md">Envoyer le message</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

       
                
            </div>
        </div>
    </div>
</section>

<?php
include('./requiert/inc-footer.php');
?>		
