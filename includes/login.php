
<!--<a href="../" id="backBtn">◀</a>-->
<div class="defCo">
   
    <?php
    
        $failMsg = "<p style='color:red;font-weight:800;width:300px;margin:auto;margin-top:25px;margin-bottom:-68px;font-size:20px;text-align:center;'>
        Zle meno alebo heslo,<br> skuste to znova! </p>";
        if(isset($_GET['f'])){
            echo $failMsg;
        }
    
    ?>
    
  <form class="loginForm" action="../includes/formVal.php" method="post">
   
    <h3 style="color: #007bff;font-family: Poppins;font-weight: 600;margin:auto;padding:0;margin-top:-20px;">Prihlásenie</h3>
    
    <fieldset>
      <div class="formLine">
        <label for="loginName" style="text-align:center">E-mail :</label>
        <input type="email" name="loginName" value="" placeholder="Jozko@mail.sk" id="Lname" >
      </div>

      <div class="formLine">
        <label for="loginPassword" style="text-align:center">Heslo :</label>
        <input type="password" name="loginPassword" value="" placeholder="Heslo123" id="Lpass" >
      </div>
        <p style="color:red;"></p>
      <button type="submit" name="loginBtn">Prihlasit sa</button>
      <button type="submit" name="forgotBtn"
                  style="border-width:0px;font-size:12px;">
                  Zabudol si heslo?</button>

    </fieldset>
    
  </form>


</div>
<script type="text/javascript">
//Checks if input has at least 3 charactes and after that assigning invalid||valid class to it
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    
    
  $('#Lname').blur(function(){
      var tmpval = $(this).val().length;
      if(tmpval >= 3 && validateEmail($(this).val()) {
          $(this).addClass('valid');
          $(this).removeClass('invalid');
      } else {
          $(this).addClass('invalid');
          $(this).removeClass('valid');
      }
  });
  $('#Lpass').blur(function(){
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
