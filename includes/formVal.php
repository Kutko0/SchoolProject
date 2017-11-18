    <?php
    session_start();
    
    include('dbFunc.php');
    include('classicFunc.php');
    
    

    if(isset($_POST['loginBtn']) ){
    //FORM VALIDATION
      if((requiredInput($_POST['loginName']) !== TRUE) || (requiredInput($_POST['loginPassword']) !== TRUE) ) {
              header('Location: ../login/index.php?type=' . $_SESSION['type'] . '&f=yy');
        }else{
          //ak vsetko prebehlo v poriadku pozre sa do DB ci existuje tento vstup
          $name = $_POST['loginName'];
          $password = $_POST['loginPassword'];
          $type = $_SESSION['type'];
            //login je metoda z dbFunc ktora vrati TRUE ak vstup existuje
            if(login($type, $name, $password) === TRUE){
                if($_SESSION['flog'] === TRUE){
                    //ak je prvy krat prihlaseny tak ho presmeruje na zmenu hesla
                    header('Location: ../changePass/');
                }else{
                    //inak pojde na jeho home page
                    header('Location: ../user/');
                }
                 // ak vstup neexistuje vypise fail message
            }else{
                header('Location: ../login/index.php?type=' . $_SESSION['type'] . '&f=yy');
                } 
        }
    }else if(isset($_POST['regBtn'])){
        if((requiredInput($_POST['regName']) !== TRUE) 
         || (requiredInput($_POST['regPassword']) !== TRUE) 
         || (requiredInput($_POST['regZPassword']) !== TRUE)) {
              header('Location: ../reg/index.php?f=y1');
        }else{
            if(isEmail($_POST['regName'])){
                if($_POST['regPassword'] === $_POST['regZPassword']){
                    if(isEmailInUse($_POST['regName'])){
                        echo "I got here";
                    }else{
                        header('Location: ../reg/index.php?f=y4');    
                    }
                }else{
                    header('Location: ../reg/index.php?f=y3');
                }
            }else{
                header('Location: ../reg/index.php?f=y2');
            }
        }
    }
  

  ?>


