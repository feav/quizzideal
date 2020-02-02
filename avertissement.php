<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr';
$meta_description = 'Avertisement';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');
include('./requiert/php-form/login-register.php');

$_SESSION['pmessage'] = "Mon message";
if (!isset($_SESSION['pmessage'])) {
    header('Location: index.php');
    exit;
}
?>

    <style>
        .button_link {
            background-color: blue;
            color: white;
            border: 2px solid black;
            width: 170px;
            border-radius: 5px;
            text-align: center;
        }

        .bigsize {
            font-size: 18px;
        }
    </style>

    <div class="col-md-8 col-xs-12 xs-m-b-20">
                    <div class="bg-light-grey b-r-10 p-20 b-special-grey">
                        <div class="bg-white b-r-10 p-10-20 f-s-14 b-special-grey f-w-bold" style="margin:-15px 0 20px -15px;width:calc(100% - 10px);"><i class="fa fa-fw fa-user m-r-10"></i>Avertissement</div>
    <!-- /SECTION HEADLINE -->
    <div class="container">
        <!-- SAMAKUNCHAN -->
        <div style="margin: 60px">
            <h1 style="color: grey;" >
                Message de l'administration
            </h1>

            <div class="search-widget" style="text-align: center; position: relative;margin-top: 20px">
                <h1 style="font-size: 1.3em;"><?= ucfirst($_SESSION['pmessage']);?></h1>
                <a class="button_link button tertiary" href="./index.php?seenpmessage=1" style="position: absolute;left: 43%; bottom: -30px">J'ai bien lu ce message</a>
            </div>
        </div>
        <!-- /SAMAKUNCHAN -->
    </div>
    <div class="clearfix"></div>

<?php

include('./requiert/inc-footer.php');
?>