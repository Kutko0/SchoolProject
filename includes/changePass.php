<?php
    // here form to change the pass and then redirect ro user
  include('../includes/classicFunc.php');
  include('../includes/dbFunc.php');

    if(isset($_SESSION['user_id']) && isset($_SESSION['mail'])){
        if(isset($_POST['changePassBtn'])){
            if((requiredInput($_POST['newPass']) === TRUE) || 
               (requiredInput($_POST['newPassa']) === TRUE) &&
               ($_POST['newPass'] == $_POST['newPassa']) &&
               (minLength($_POST['newPass'], 6) == TRUE)){
                    $mysqli = connect_to_db();
                
                    $passw = hash('sha256', $_POST['newPassa']);
                    $query = "UPDATE `ziaci_4` set heslo='" . $mysqli->real_escape_string($passw) . 
                            "' WHERE user_id='" . $mysqli->real_escape_string($_SESSION["user_id"]) . "';";
                    $mysqli->query($query);
                
                    $query = "UPDATE `ziaci_4` set first_log='" . $mysqli->real_escape_string(0) . 
                            "' WHERE user_id='" . $mysqli->real_escape_string($_SESSION["user_id"]) . "';";
                    $mysqli->query($query);
                
                    $mysqli->close();
                    echo "<p style='color:#23ff32;font-weight:800;width:350px;margin:auto;
                            margin-top:25px;margin-bottom:-90px;font-size:20px;'>
                            Uspesne zmenene heslo!
                            </p>";
            }else{
                echo  "<p style='color:red;font-weight:800;width:350px;margin:auto;
                            margin-top:25px;margin-bottom:-90px;font-size:20px;'>
                            Nevyplnili ste vsetky polia alebo<br> 
                            vase heslo nie je dostatocne dlhe (min. 6 charakterov)
                            </p>";
            }
        }
    }
    

?>
<div class="defCo"> 
            
    <form action="./" class="loginForm" method="post">
    <h3 style="color: #007bff;font-family: Poppins;font-weight: 600;margin:auto;padding:0;margin-top:-20px;">
       <?php
        echo "Zmena hesla pre " . $_SESSION['rname'];
        ?>
        </h3>
        <fieldset>
    
          <div class="formLine">
            <label for="newPass">Nove heslo :</label>
            <input type="password" name="newPass" value="" placeholder="Nove heslo" id="newpassw" required>
          </div>

          <div class="formLine">
            <label for="newPassa">Heslo znova :</label>
            <input type="password" name="newPassa" value="" placeholder="Heslo znova" id="newpasswa" required>
          </div>
            <p style="color:red;" id="someText"></p>
          <button type="submit" name="changePassBtn">Zmenit heslo</button>

        </fieldset>
        
    </form>
    
    <script type="text/javascript">
//Checks if input has at least 6 charactes and after that assigning invalid||valid class to it
// Plus checks if both password are the same and if they are not add text "Hesla nie su rovnake!"        
  $('#newpassw').blur(function(){
      var tmpval = $(this).val().length;
      if(tmpval >= 6) {
          $(this).addClass('valid');
          $(this).removeClass('invalid');
      } else {
          $(this).addClass('invalid');
          $(this).removeClass('valid');
      }
  });
  $('#newpasswa').blur(function(){
      var tmpval = $(this).val().length;
      if($(this).val() == $('#newpassw').val()){
          $(".loginForm").css("height", 250);
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
          $(".loginForm").css("height", 275);
          $('#someText').text("Hesla nie su rovnake!");
      }
  });
</script>
</div>


