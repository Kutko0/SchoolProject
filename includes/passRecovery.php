<div class="defCo">

    <?php

        $failMsg = "<p style='color:red;font-weight:800;width:300px;margin:auto;margin-top:25px;margin-bottom:-50px;font-size:20px;'>
        Email nie je <br>zaregistrovany! </p>";

        $successMsg = "<p style='color:green;font-weight:800;width:300px;margin:auto;margin-top:25px;margin-bottom:-50px;font-size:20px;'>
        Sprava bola odoslana, <br>na vas e-mail! </p>";

        if(isset($_GET['f'])){
            echo $failMsg;
        }else if(isset($_GET['s'])){
            echo $successMsg;
        }

    ?>

  <form class="loginForm" action="../includes/formVal.php" method="post">

    <h3 style="color: #007bff;font-family: Poppins;font-weight: 600;margin:auto;padding:0;margin-top:-20px;">Obnovit heslo</h3>

    <fieldset>
      <div class="formLine">
        <label for="loginName" style="text-align:center">E-mail :</label>
        <input type="email" name="loginName" value="" placeholder="Jozko@mail.sk" id="Lname" required>
      </div>

      <button type="submit" name="recoveryBtn" style='margin-top:35px;'>Poslat email</button>


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

</script>
