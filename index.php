<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta lang="sk">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="photos/logo.png">
    <title>Registracia rocnikoveho projektu</title>
  </head>

  <body>

    <div class="main-wrapper">
      <div class="titleCo">
        <h1 class="mainTitle">Prihlasenie rocnikovej prace</h1>
        <p>Stredna priemyselna skola Jozefa Murgasa</p>
      </div>
      <div class="defCo">

        <a href="./login/index.php?type=ziak" class="loginOp" id="BtnZiak">Ziak login</a>
        <div id="BtnUcitelDiv">
        <a href="./login/index.php?type=ucitel" class="loginOp" id="BtnUcitel">Ucitel login</a>
        </div>
        <br>
        <a href="./reg/" id="blogOp" >Registracia</a>

      </div>

<?php
  include('includes/footer.php');
?>
