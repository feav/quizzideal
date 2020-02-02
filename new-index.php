<?php 
if (!isset($_SESSION['id'])) {
    include('./index-connected.php');
}else{
    include('./index-not-connected.php');
}

?>