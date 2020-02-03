<?php 

include('./requiert/new-form/header.php');
if (!isset($_SESSION['id']) || $_SESSION['id']==NULL || $_SESSION['id'] == "NULL") {
    include('./index-not-connected.php');
}else{
    include('./index-connected.php');
}

?>