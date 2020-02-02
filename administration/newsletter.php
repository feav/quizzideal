<?php
	include('./requiert/php-global.php');
	
	$meta_title = 'Panel d\'administration : Newsletter | Quizzdeal.fr';
	$nomPage = 'newsletter';
	
	include('./requiert/inc-head.php');
	include('./requiert/inc-header-navigation.php');
	include('./requiert/php-form/newsletter.php');
?>

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline buttons primary">
                <h4>Administration newsletter</h4>
            </div>
            <!-- /HEADLINE -->
            <!-- FORM BOX ITEMS -->
            <div class="form-box-items wrap-3-1 left">
                <!-- FORM BOX ITEM -->
                <div class="form-box-item full">
                    <h4>Ajouter un cadeau tombola</h4>
                    <hr class="line-separator">
                    <form id="upload_form" method="post">


                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="type" class="rl-label required">Type</label>
                            <label for="type" class="select-block">
                                <select name="type" id="type">
                                    <option value="Texte">Texte</option>
                                    <option value="HTML">HTML</option>
                                </select>
                                <!-- SVG ARROW -->
                                <svg class="svg-arrow">
                                    <use xlink:href="#svg-arrow"></use>
                                </svg>
                                <!-- /SVG ARROW -->
                            </label>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="sujet" class="rl-label required">URL de l'image</label>
                            <input type="text" id="sujet" name="sujet" placeholder="Entrez le sujet" required>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="message" class="rl-label required">Description</label>
                            <textarea id="message" name="message" placeholder="Entrez votre message..." required></textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->


                        <hr class="line-separator">
                        <input type="submit" name="submit_newsletter" value="Envoyer la newletter" class="submit button big dark"/>
                    </form>
                </div>
                <!-- /FORM BOX ITEM -->
            </div>
            <!-- /FORM BOX ITEMS -->
        </div>
        <!-- /DASHBOARD CONTENT -->
        <div class="clearfix"></div>
    </div>
    <!-- /DASHBOARD BODY -->



<?php
	include('./requiert/inc-footer.php');
?>