<?php
    session_start();

    include('../includes/header.php');
    if(isset($_GET['ci'])){
        $ci = $_GET['ci'];
        if($ci == 'prh'){
            include('../includes/prihlaska.php');
        }else if($ci == 'inf'){
            include('../includes/userInfo.php');
        }else{
            include('../includes/user.php');
        }
    }else{
        include('../includes/user.php');
    }
    include('../includes/footer.php');
?>
