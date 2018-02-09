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
                        while(TRUE){
                            $hashID = hash('sha256', $email . time() . 'spsjm');
                            if(isHashIdInUse($hashID, 'users')){
                                break;
                                }
                            }
                        if(registration($email, $realName, $pass, $hashID)){
                            // presmerovat na jeho ucet
                            $_SESSION['mail'] = $email;
                            $_SESSION['rmeno'] = $realName;
                            $_SESSION['status'] = 1;
                            $_SESSION['hash_id'] = $hashID;
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
    }else if(isset($_POST['forgotBtn'])){
        header('Location: ../passRecovery');

    }else if(isset($_POST['recoveryBtn'])){
        $email = $_POST['loginName'];
        if(isEmail($email)){
            if(!isEmailInUse($email)){
                if(sendRecoveryMail($email)){
                    header('Location: ../passRecovery/index.php?s=1');
                }else{
                    header('Location: ../passRecovery/index.php?ff=1');
                }

            }
        }else{
            header('Location: ../passRecovery/index.php?f=1');
        }
    }else if(isset($_POST['newUserInfoBtn'])){
        $last_name = $_POST['infoSurName'];
        $first_name = $_POST['infoName'];
        $odbor = $_POST['infoOdbor'];
        $class = $_POST['infoTrieda'];
        $soc = $_POST['infoSoc'];
        $hash_id = $_SESSION['hash_id'];

        if((requiredInput($last_name) !== TRUE)
         || (requiredInput($first_name) !== TRUE)
         || (requiredInput($odbor) !== TRUE)
         || (requiredInput($class) !== TRUE)
         || (requiredInput($soc) !== TRUE)) {
              header('Location: ../user/index.php?ci=inf&f=1');
        }else{
            if(isHashIdInUse($hash_id, 'users_info')){
               if(sendUserInfo($last_name, $first_name, $odbor, $class, $soc, $hash_id, TRUE)){
                   header('Location: ../user/index.php?ci=inf&s=1');
               }else{
                   header('Location: ../user/index.php?ci=inf&f=2');
               }
            }else{
               if(sendUserInfo($last_name, $first_name, $odbor, $class, $soc, $hash_id, FALSE)){
                   header('Location: ../user/index.php?ci=inf&s=1');
               }else{
                   header('Location: ../user/index.php?ci=inf&f=2');
               }
            }
        }
    }


  ?>


