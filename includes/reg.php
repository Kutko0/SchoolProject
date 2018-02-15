<?php

    // doplnit y1 error = niesu vypnene vsetky polia
    // doplnit y2 error = input nie je email
    // doplnit y3 error = hesla sa nerovnaju
    // doplnit y4 error = email sa uz pouziva
    if(isset($_GET['f'])){
        $err = strtoupper($_GET['f']);
        if($err == 'Y1'){
            $msg = 'Vyplnte vsetky polia !';
        }else if($err == 'Y2'){
            $msg = 'Vas vstup nie je vo formate <br> e-mail !';
        }else if($err == 'Y3'){
            $msg = 'Vase hesla sa nezhoduju !';
        }else if($err == 'Y4'){
            $msg = 'E-mail, ktory ste zadali sa <br> uz pouziva !';
        }else if($err == 'Y5'){
            $msg = 'Nastala chyba pri registracii <br> skuste to znova neskvor !';
        }
    }
?>
   

   
   <div class='defCo'>
   <?php
       if(isset($msg)){
            echo "<p style='color:red;font-weight:800;width:350px;
                margin:auto;margin-top:25px;margin-bottom:-85px;
                font-size:20px;'>" . $msg . "</p>";
       }
    ?>
    <form class="loginForm" action="../includes/formVal.php" method="post" id="regForm">
   
    <h3 style="color: #007bff;font-family: Poppins;font-weight: 600;margin:auto;padding:0;margin-top:-20px;">Registracia</h3>
    
    <fieldset>
      <div class="formLine">
        <label for="regName" style="text-align:center">E-mail :</label>
        <input type="email" name="regName" value="" placeholder="Jozko@mail.sk" id="Rname" required>
      </div>

      <div class="formLine">
        <label for="regRealName" style="text-align:center">Meno a priezvisko :</label>
        <input type="text" name="regRealName" value="" placeholder="Michal Petrzlen" id="Rrealname" required>
      </div>

      <div class="formLine">
        <label for="regPassword" style="text-align:center">Heslo :</label>
        <input type="password" name="regPassword" value="" placeholder="Pa$$w0rd" id="Rpass" required>
      </div>
      
      <div class="formLine">
        <label for="regZPassword" style="text-align:center">Heslo znovu :</label>
        <input type="password" name="regZPassword" value="" placeholder="Pa$$w0rd" id="RZpass" required>
      </div>
      
      <p style="color:red;" id="someText"></p>
      <button id="subBtnN" type="submit" name="regBtn">Registrovat</button>

    </fieldset>
    
  </form>
    
    
</div>


<script type="text/javascript">
//Checks if input has at least 3 charactes and after that assigning invalid||valid class to it
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    $('#subBtnN').prop('disabled', true);
    $('#Rname').blur(function(){
      var tmpval = $(this).val().length;
      if(tmpval >= 3 && validateEmail($(this).val())) {
          $(this).addClass('valid');
          $(this).removeClass('invalid');
      } else {
          $(this).addClass('invalid');
          $(this).removeClass('valid');
      }
    });
    $('#Rrealname').blur(function(){
      var tmpval = $(this).val().length;
      if(tmpval >= 4 ) {
          $(this).addClass('valid');
          $(this).removeClass('invalid');
      } else {
          $(this).addClass('invalid');
          $(this).removeClass('valid');
      }
    });
    $('#Rpass').blur(function(){
      var tmpval = $(this).val().length;
      if(tmpval >= 6) {
          $(".loginForm").css("height", 370);
          $('#someText').text("");
          $(this).addClass('valid');
          $(this).removeClass('invalid');
          $('#subBtnN').prop('disabled', false);
      } else {
          $('#someText').text("Hesla musi obsahovat minimalne 6 znakov!");
          $(".loginForm").css("height", 390);
          $(this).addClass('invalid');
          $(this).removeClass('valid');
      }
    });
    $('#RZpass').blur(function(){
      var tmpval = $(this).val().length;
      if($(this).val() == $('#Rpass').val()){
          $(".loginForm").css("height", 370);
          $('#someText').text("");
          if(tmpval >= 6) {
              $(this).addClass('valid');
              $(this).removeClass('invalid');
          } else {
              $(this).addClass('invalid');
              $(this).removeClass('valid');
          }
      }else{
          $(this).addClass('invalid');
          $(".loginForm").css("height", 390);
          $('#someText').text("Hesla nie su rovnake!");
      }
  });
</script>
