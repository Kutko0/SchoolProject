<?php
    $triedy = array(
        "4A" => "4.A",
        "4B" => "4.B",
        "4C" => "4.C",
        "4D" => "4.D",
        "4E" => "4.E",
        "4F" => "4.F",
        "3A" => "3.A",
        "3B" => "3.B",
        "3C" => "3.C",
        "3D" => "3.D",
        "3E" => "3.E",
        "3F" => "3.F"
    );

    if(isLogged() === FALSE){
        session_destroy();
        redirect(' ');
    }

    $failMsg1 = "<p style='color:red;font-weight:800;width:350px;margin:auto;margin-top:25px;
                margin-bottom:-50px;font-size:20px;text-align:center;'>
                Vsetky polia musia <br> byt vyplnene! </p>";
    $failMsg2 = "<p style='color:red;font-weight:800;width:350px;margin:auto;margin-top:25px;
                margin-bottom:-50px;font-size:20px;text-align:center;'>
                Nastala chyba pri odosielani<br>skuste to znova ! </p>";
    $successMsg = "<p style='color:green;font-weight:800;width:350px;margin:auto;margin-top:25px;
                margin-bottom:-50px;font-size:20px;text-align:center;'>
                Uspesne ulozene!</p>";
        if(isset($_GET['f'])){
            if($_GET['f'] == 1){
                echo $failMsg1;
            }else{
                echo $failMsg2;
            }
        }else if(isset($_GET['s'])){
            echo $successMsg;
        }
    if($actualInfo = getUserInfo($_SESSION['hash_id'])){
        $last_name = $actualInfo[1];
        $first_name = $actualInfo[0];
        $odbor = $actualInfo[2];
        $class = $actualInfo[3];
        $soc = $actualInfo[4];
    }else{
        $last_name = 'nezadane';
        $first_name = 'nezadane';
        $odbor = 'nezadane';
        $class ='nezadane';
        $soc = 'nezadane';
    }
?>

<div class="defCo">

    <div>
        <form class="loginForm" action="../includes/formVal.php" method="post" style="margin-top:100px;">

        <h3 style="color: #007bff;font-family: Poppins;font-weight: 600;
            margin:auto;padding:0;margin-top:-20px;">Moje Info</h3>

        <fieldset style="padding-bottom:15px">

          <div class="formLine">
            <label for="infoSurName" style="text-align:center">Priezvisko :</label>
            <input type="text" name="infoSurName" value="" placeholder="Mrkvicka" id='infoSurname' required>
          </div>

          <div class="formLine">
            <label for="infoName" style="text-align:center">Meno :</label>
            <input type="text" name="infoName" value="" placeholder="Stevo" id='infoName' required>
          </div>

          <div class="formLine">
            <label for="infoOdbor" style="text-align:center">Odbor :</label>
            <select name="infoOdbor" required>
                <option value="2675M">2675 M Elektrotechnika</option>
                <option value="2694M">2694 M IST</option>
                <option value="2567M/3957M">3957 M Multimédiá</option>
              </select>
          </div>

          <div class="formLine">
            <label for="infoTrieda" style="text-align:center">Trieda :</label>
            <select name="infoTrieda" required>
               <?php
                    foreach ($triedy as $key => $value){
                        echo "<option value=" . $key . ">" . $value . "</option>";
                    }
                ?>
              </select>
          </div>

          <div class="formLine">
            <label for="infoSoc" style="text-align:center">SOČ Kategoria :</label>
            <select name="infoSoc" required>
                <option value="11">11 – Informatika</option>
                <option value="12">12 – Elektrotechnika, hardware, mechatronika</option>
              </select>
            </div>

            <p style="color:red;"></p>
          <button type="button" name="actualInfoBtn" id="actualInfo">Aktualne Info</button>
          <button type="submit" name="newUserInfoBtn">Ulozit Info</button>

        </fieldset>

      </form>
    </div>
</div>

<div id='overlay'>
    <div class='overlayMainBox'>
        <div class='overlayTitle'>
           	<h2>Aktualne info</h2>
        </div>
        <div class='overlaySteps' id='actualInfo'>
            <p>Priezvisko : <span><?php echo $last_name;?></span></p>
            <p>Meno : <span><?php echo $first_name;?></span></p>
            <p>Odbor : <span><?php echo $odbor;?></span></p>
            <p>Trieda : <span><?php echo $class;?></span></p>
            <p>SOČ Kategoria : <span><?php echo $soc;?></span></p>
        </div>
        <button id='closeOverlay'>Zavriet</button>
    </div>
</div>

<script type="text/javascript">
    $('#actualInfo').click(function(){
        $('#overlay').show();
    });
    $('#closeOverlay, #overlay').click(function(){
        $('#overlay').hide();
    });

    $('#infoName, #infoSurname').blur(function(){
      var tmpval = $(this).val().length;
      if(tmpval >= 3) {
          $(this).addClass('valid');
          $(this).removeClass('invalid');
      } else {
          $(this).addClass('invalid');
          $(this).removeClass('valid');
      }
  });

</script>
