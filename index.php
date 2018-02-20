<?php function redirect($direction){header('Location: http://localhost:8888/skolaProject/' . $direction);}
    session_start();
    if(isset($_POST['logOffButton'])){
        session_destroy();
    }else if(isset($_SESSION['mail'])
             && isset($_SESSION['flog'])
             && $_SESSION['flog'] === FALSE){
        redirect('user/');
    }else{
        session_destroy();
    }

?>

<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta lang="sk">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="photos/logo.png">
    <title>Registrácia ročníkového projektu</title>
  </head>

  <body>

    <div class="main-wrapper">
      <div class="titleCo">
        <h1 class="mainTitle">Prihlásenie ročníkovej prace</h1>
        <p>Stredná priemyselná škola Jozefa Murgaša</p>
      </div>
      <div class="defCo">

        <a href="./login/" class="loginOp mainBubbles" id="BtnZiak">Žiak login</a>
        <div id="BtnUcitelDiv">
        <a href="./login/" class="loginOp mainBubbles" id="BtnUcitel">Učiteľ login</a>
        </div>
        <br>
        <a href="./reg/" class='mainBubbles' id="regOp" >Registrácia</a>

      </div>

<?php
  include('includes/footer.php');
?>
