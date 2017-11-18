<?php
  session_start();
  
  if( isset($_GET['type']) && ($_GET['type'] == 'ziak' || $_GET['type'] == 'ucitel') ) {
    $_SESSION['type'] = $_GET['type'];
  }else{
    header("Location: ../");
    die();
  }
    include('../includes/header.php');
    include('../includes/login.php');
    include('../includes/footer.php');

?>
