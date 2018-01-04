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
            if(login($type, $name, $password, $type) === TRUE){
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
        $email = $_POST['regName'];
        $pass = $_POST['regPassword'];
        $passAgain = $_POST['regZPassword'];
        $realName = $_POST['regRealName'];
        //multiple require func
        if((requiredInput($email) !== TRUE)
         || (requiredInput($pass) !== TRUE)
         || (requiredInput($passAgain) !== TRUE)
         || (requiredInput($realName) !== TRUE)) {
              header('Location: ../reg/index.php?f=y1');
        }else{
            if(isEmail($email)){
                if($pass === $passAgain){
                    if(isEmailInUse($email)){
                        if(registration($email, $realName, $pass)){
                            // presmerovat na jeho ucet
                            $_SESSION['newUsrInfo'] = '';
                            header('Location: ../user/');
                        }else{
                            header('Location: ../reg/index.php?f=y5');
                        }
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


