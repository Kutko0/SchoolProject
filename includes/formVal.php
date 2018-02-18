    <?php
    session_start();
    
    include('dbFunc.php');
    include('classicFunc.php');
    
    

    if(isset($_POST['loginBtn']) ){
    //FORM VALIDATION
      if((requiredInput($_POST['loginName']) !== TRUE)
         || (requiredInput($_POST['loginPassword']) !== TRUE) ) {
              redirect('login/index.php?type=' . $_SESSION['type'] . '&f=yy');
        }else{
          //ak vsetko prebehlo v poriadku pozre sa do DB ci existuje tento vstup
          $name = $_POST['loginName'];
          $password = $_POST['loginPassword'];
            //login je metoda z dbFunc ktora vrati TRUE ak vstup existuje
            if(login($name, $password) === TRUE){
                if($_SESSION['flog'] === TRUE){
                    //ak je prvy krat prihlaseny tak ho presmeruje na zmenu hesla
                   redirect('changePass/');
                }else{
                    //inak pojde na jeho home page
                    redirect('user/');
                }
                 // ak vstup neexistuje vypise fail message
            }else{
                redirect('login/index.php?f=yy');
                } 
        }
    }else if(isset($_POST['regBtn'])){

        if((requiredInput($_POST['regName']) !== TRUE)
         || (requiredInput($_POST['regPassword']) !== TRUE)
         || (requiredInput($_POST['regZPassword']) !== TRUE)
         || (requiredInput($_POST['regRealName']) !== TRUE)) {
              redirect('reg/index.php?f=y1');
        }else{
            $email = $_POST['regName'];
            $pass = $_POST['regPassword'];
            $passAgain = $_POST['regZPassword'];
            $realName = $_POST['regRealName'];
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
                            $_SESSION['rname'] = $realName;
                            $_SESSION['status'] = 1;
                            $_SESSION['hash_id'] = $hashID;
                            redirect('user/');
                        }else{
                            redirect('reg/index.php?f=y5');
                        }
                    }else{
                        redirect('reg/index.php?f=y4');
                        }
                }else{
                    redirect('reg/index.php?f=y3');
                    }
            }else{
                redirect('reg/index.php?f=y2');
                }
            }
    }else if(isset($_POST['forgotBtn'])){
        redirect('passRecovery/');

    }else if(isset($_POST['recoveryBtn'])){
        $email = $_POST['loginName'];
        if(isEmail($email)){
            if(!isEmailInUse($email)){
                if(sendRecoveryMail($email)){
                    redirect('passRecovery/index.php?s=1');
                }else{
                    redirect('passRecovery/index.php?ff=1');
                }
            }else{
                redirect('passRecovery/index.php?fff=1');
            }
        }else{
            redirect('passRecovery/index.php?f=1');
        }
    }else if(isset($_POST['newUserInfoBtn'])){

        if((requiredInput($_POST['infoSurName']) !== TRUE)
         || (requiredInput($_POST['infoName']) !== TRUE)
         || (requiredInput($_POST['infoOdbor']) !== TRUE)
         || (requiredInput($_POST['infoTrieda']) !== TRUE)
         || (requiredInput($_POST['infoSoc']) !== TRUE)) {
              redirect('user/index.php?ui=inf&f=1');
        }else{
            $last_name = $_POST['infoSurName'];
            $first_name = $_POST['infoName'];
            $odbor = $_POST['infoOdbor'];
            $class = $_POST['infoTrieda'];
            $soc = $_POST['infoSoc'];
            $hash_id = $_SESSION['hash_id'];

            if(isHashIdInUse($hash_id, 'users_info')){
               if(sendUserInfo($last_name, $first_name, $odbor, $class, $soc, $hash_id, TRUE)){
                   redirect('user/index.php?ui=inf&s=1');
               }else{
                   redirect('user/index.php?ui=inf&f=2');
               }
            }else{
               if(sendUserInfo($last_name, $first_name, $odbor, $class, $soc, $hash_id, FALSE)){
                   redirect('user/index.php?ui=inf&s=1');
               }else{
                   redirect('user/index.php?ui=inf&f=2');
               }
            }
        }
    }else if(isset($_POST['userPrihBtn'])){

        if((requiredInput($_POST['prihTyp']) !== TRUE)
         || (requiredInput($_POST['prihTema']) !== TRUE)
         || (requiredInput($_POST['ucitelVyber']) !== TRUE)){
              redirect('user/index.php?ui=prih&f=1');
        }else{
            $typPrace = $_POST['prihTyp'];
            $temaPrace = $_POST['prihTema'];
            $ucitelHash = $_POST['ucitelVyber'];
            if(isset($_POST['prihPoznamka'])){
                $poznamka = $_POST['prihPoznamka'];
            }else{
                $poznamka = ' ';
            }
            $hash_id = $_SESSION['hash_id'];

            if(canSend($hash_id, $ucitelHash)){
                if(isTeacher($ucitelHash)){
                    if(isPending($hash_id)){
                        if(!(sendPrihlaskaToTeacher($ucitelHash, $hash_id, $temaPrace, $poznamka))
                           && !(sendPrihlaskaToStudent($hash_id))){
                            if(savePrihlaska($ucitelHash, $hash_id, $temaPrace, $typPrace, $poznamka)){
                                redirect('user/index.php?ui=prih&s=1');
                            }else{
                                redirect('user/index.php?ui=prih&f=2');
                            }
                        }else{
                            redirect('user/index.php?ui=prih&fff=1');
                        }
                    }else{
                        redirect('user/index.php?ui=prih&ff=1');
                    }
                }else{
                    redirect('user/index.php?ui=prih&f=2');
                }
            }else{
                redirect('user/index.php?ui=prih&ffff=1');
            }
        }
    }else if(isset($_POST['hashN'])){
        $hash_id = $_POST['hashN'];
        if(maPrihlasku($hash_id, TRUE)){
            if(updatePrihlasku($hash_id)){
                redirect('user/index.php?ti=pp&s=1');
            }else{
                redirect('user/index.php?ti=pp&f=2');
            }
        }else{
            redirect('user/index.php?ti=pp&f=1');
        }
    }else if(isset($_POST['hashY'])){
        $hash_id = $_POST['hashY'];
        if(maPrihlasku($hash_id, TRUE)){
            if(updatePrihlasku($hash_id,'1')){
                redirect('user/index.php?ti=pp&s=1');
            }else{
                redirect('user/index.php?ti=pp&f=2');
            }
        }else{
            redirect('user/index.php?ti=pp&f=1');
        }
    }else{
        redirect(' ');
    }


  ?>


