<?php 
    $teachers = getTeachers();
    if(isLogged() === FALSE){
        session_destroy();
        redirect(' ');
    }

function echoFailMsg($msg){
	echo "<p style='color:red;font-weight:800;width:350px;margin:auto;margin-top:25px;
                margin-bottom:-50px;font-size:20px;text-align:center;'>
                " . $msg ." </p>";
}

$successMsg = "<p style='color:green;font-weight:800;width:350px;margin:auto;margin-top:25px;
                margin-bottom:-50px;font-size:20px;text-align:center;'>
                Uspesne odoslane<br> konzultantovi!</p>";
    if(isset($_GET['f'])){
        if($_GET['f'] == 1){
            echoFailMsg("Vsetky polia musia <br> byt vyplnene!");
        }else{
            echoFailMsg("Nastala chyba pri odosielani<br>skuste to znova !");
        }
    }else if(isset($_GET['ff'])){
        echoFailMsg("Musis pockat na<br>rozhodnutie ucitela!");
    }else if(isset($_GET['fff'])){
        echoFailMsg("Nastala chyba pri<br>odosielani emailu!");
    }else if(isset($_GET['ffff'])){
        echoFailMsg("Tento konzultant ta<br>uz raz odmietol!");
    }else if(isset($_GET['ni'])){
        echoFailMsg("Tvoje info este<br>nie je vyplnene!");
    }else if(isset($_GET['s'])){
        echo $successMsg;
    }

?>
<div class="defCo">
    <div>
        <form class="loginForm" id="prihForm"
        action="../includes/formVal.php" method="post" style="margin-top:100px;">
        <h3 style="color: #007bff;font-family: Poppins;font-weight: 600;
            margin:auto;padding:0;margin-top:-20px;">Moja Prihlaska</h3>
        <fieldset style="padding-bottom:15px">
          <div class="formLine">
            <label for="prihTema" style="text-align:center">Téma :</label>
            <input type="text" name="prihTema" value="" placeholder="Zdroj G400" id='prihTema' required>
          </div>
          <div class="formLine">
            <label for="prihTyp" style="text-align:center">Typ Prace :</label>
            <input type="text" name="prihTyp" value="" placeholder="Realizacia elek. zariadenia" id='prihTyp' required>
          </div>
          <div class="formLine">
            <label for="infoOdbor" style="text-align:center">Poznamka<br>(nepovinne) :</label>
            <textarea name='prihPoznamka' value="" id="prihPoznamka"></textarea>
          </div><br>
          <div class="formLine">
            <label for="ucitelVyber" style="text-align:center">Konzultanti :</label>
            <select name="ucitelVyber" required>
               <?php
                    while ($row = mysqli_fetch_assoc($teachers)) {
	                    echo "<option value=" . $row["hash_id"] . ">" . $row["real_meno"] . "</option>";
                    }
                    ?>
              </select>
          </div>
            <p style="color:red;" id='someText'></p>
          <button type="submit" name="userPrihBtn">Odoslat</button>
        </fieldset>
      </form>
    </div>
</div>
<script type="text/javascript">
$('#prihTema, #prihTyp').blur(function(){
      var tmpval = $(this).val().length;
      if(tmpval >= 3) {
          $(this).addClass('valid');
          $(this).removeClass('invalid');
      } else {
          $(this).addClass('invalid');
          $(this).removeClass('valid');
      }
  });
    $('#prihPoznamka').blur(function(){
      var tmpval = $(this).val().length;
      if(tmpval >= 151) {
          $(this).addClass('invalid');
          $(this).removeClass('valid');
          $('#someText').text("Max 150 znakov!");
      } else {
          $(this).addClass('valid');
          $(this).removeClass('invalid');
          $('#someText').text("");
      }
  });
</script>
