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
                <option value="2561M/2694M">2561 M / 2694 M IST</option>
                <option value="2567M/3957M">2567 M / 3957 M multimédiá</option>
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
                <option value="11_Informatika">11 – Informatika</option>
                <option value="12_Elektrotechnika_hardware_mechatronika">12 – Elektrotechnika, hardware, mechatronika</option>
              </select>
            </div>

            <p style="color:red;"></p>
          <button type="button" name="loginBtn" id="actualInfo">Aktualne Info</button>
          <button type="submit" name="loginBtn">Ulozit Info</button>

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
            <p>Priezvisko : <span>MojeHotInfo</span></p>
            <p>Meno : <span>MojeHotInfo</span></p>
            <p>Odbor : <span>MojeHotInfo</span></p>
            <p>Trieda : <span>MojeHotInfo</span></p>
            <p>SOČ Kategoria : <span>MojeHotInfo</span></p>
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
