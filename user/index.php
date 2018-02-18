<?php
    session_start();

    include('../includes/header.php');
    include('../includes/classicFunc.php');
    include('../includes/dbFunc.php');
    if(isset($_GET['ui'])){
        $ui = $_GET['ui'];
        if($ui == 'prih'){
            $hash_id = $_SESSION['hash_id'];
            if(maPrihlasku($hash_id)){
                if(maPotvrdenuPrihlasku($hash_id)){
                    $_SESSION['konzultant'] = getKonzultantoveMeno($_SESSION['hash_id']);
                    $info = getPracaInfo($hash_id);
                    include('../includes/maKonzultanta.php');
                }else{
                    include('../includes/wait.php');
                }
            }else{
                include('../includes/prihlaska.php');
            }
        }else if($ui == 'inf'){
            include('../includes/userInfo.php');
        }else{
            include('../includes/user.php');
        }
    }else if(isset($_GET['ti'])){
        $ti = $_GET['ti'];
        if($ti == 'mz'){
            include('../includes/mojiZiaci.php');
        }else if($ti == 'pp'){
            $prihlasky = getPracePreUcitela($_SESSION['hash_id']);
            include('../includes/podanePrihlasky.php');
        }else if($ti == 'oz'){
            include('../includes/odmietnutyZiaci.php');
        }else{
            include('../includes/teacher.php');
        }
    }else if($_SESSION['status'] == 1 ){
        include('../includes/user.php');
    }else{
        include('../includes/teacher.php');
    }
    include('../includes/footer.php');
?>
