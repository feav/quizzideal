
<?php 
    include('./requiert/new-form/header.php');

    $meta_title = 'Quizzdeal.fr : Contactez-nous';
    $meta_description = '';

    include('./requiert/php-form/contact.php');
?>

<!-- Content
================================================== -->

<!-- Container / Start -->
<div class="" style="margin-top: 50px">
    <div class="container">
        <div class="row">

            <!-- Contact Details -->
            <div class="col-md-4">

                <h4 class="headline margin-bottom-30">Rejoignez nous</h4>

                <!-- Contact Details -->
                <div class="sidebar-textbox">
                    <p>A chaque jour ses gains et ses cadeaux !!!</strong>. Quizzdeal vous permet à l'aide de simples clics de gagner de l'argent et des cadeaux facilement et rapidement...et surtout gratuitement</p>

                    <ul class="contact-details">
                        <li><i class="im im-icon-Phone-2"></i> <strong>Phone:</strong> <span>(+33) 766001506 </span></li>
                        <li><i class="im im-icon-Globe"></i> <strong>Web:</strong> <span><a href="#">www.quizzdeal.fr</a></span></li>
                        <li><i class="im im-icon-Envelope"></i> <strong>E-Mail:</strong> <span><a href="#">jeromerodrigueze@outlook.com</a></span></li>
                    </ul>
                </div>

            </div>

            <!-- Contact Form -->
            <div class="col-md-8">

                <section id="contact">
                    <h4 class="headline margin-bottom-35">Contactez-nous</h4>
                    <h5><?php echo $reponse; ?></h5>
                    <div id="contact-message"></div> 

                        <form method='POST' class="bg-white p-5 contact-form" id="contact_form" method="post" action="" autocomplete="on">

                        <div>
                            <input type="email" name='email' id="contact_email" placeholder="Votre email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" value="<?= $post_email; ?>" required="required" />
                        </div>

                        <div>
                            <input type="text" name='sujet' id="contact_sujet" placeholder="Votre sujet" value="<?= $post_sujet; ?>" required="required" />
                        </div>

                        <div>
                            <textarea name="message" id="contact_description" cols="40" rows="3" placeholder="Message" spellcheck="true" required="required"><?= $post_email; ?></textarea>
                        </div>

                        <input type="submit" class="submit button" name="submit_send" id="submitContact" value="Envoyer le message" />

                        </form>
                </section>
            </div>
            <!-- Contact Form / End -->

        </div>
    </div>
</div>
<!-- Container / End -->

<?php 
    include('./requiert/new-form/footer.php');
?>
<script type="text/javascript">
    $('#navigation .contact').addClass('current');
</script>