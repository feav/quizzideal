<?php
include('./requiert/new-form/header.php');

$meta_title = 'Quizzdeal.fr';
$meta_description = 'Avertisement';

include('./requiert/php-form/login-register.php');

$_SESSION['pmessage'] = "Mon message";
if (!isset($_SESSION['pmessage'])) {
    header('Location: index.php');
    exit;
}
?>
<style type="text/css">
    .avertissement{
        text-align: center;
        font-size: 26px;
        font-weight: 600;
    }
    .message-wrapper{
        margin-top: 50px;
    }
</style>
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <div class="avertissement">Avertissement</div>
            <div class="message-wrapper">
                <p style="font-size: 1.3em;"><?= ucfirst($_SESSION['pmessage']);?></p>
                <a class="button_link button tertiary" href="./index.php?seenpmessage=1">J'ai bien lu ce message</a>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<?php 
    include('./requiert/new-form/footer.php');
?>