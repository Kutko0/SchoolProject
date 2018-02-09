<?php

function requiredInput($str) {
  if(isset($str) === TRUE && empty($str) !== TRUE) {
    return  TRUE;
  }
  return FALSE;

}

function minLength($str, $length = 3){
    if(strlen(trim($str)) >= $length){
        return TRUE;
    }
    return FALSE;
}

function isEmail($name){
    return filter_var($name, FILTER_VALIDATE_EMAIL);
}

function isEmailInUse($name){
    $mysqli = connect_to_db();
    $query = "SELECT `email` FROM `users`
                WHERE `email` = '" . $mysqli->real_escape_string($name) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
        if($res[0] == $name){
            $mysqli->close();
            return FALSE;
        }
        }
    $mysqli->close();
    return TRUE;
}

function isHashIdInUse($hash, $db){
    $mysqli = connect_to_db();
    $query = "SELECT `hash_id` FROM `" . $mysqli->real_escape_string($db) ."`
                WHERE `hash_id` = '" . $mysqli->real_escape_string($hash) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
        if($res[0] == $hash){
            $mysqli->close();
            return FALSE;
        }
        }
    $mysqli->close();
    return TRUE;
}

function sendRecoveryMail($email){
    $to      = 'andrej.kutliak@gmail.com';
    $subject = 'SPSJM | Recovery Password';
    $message = '<p>Klikni na link, ktore ta presmeruje na stranku kde si zmenis heslo.</p>
                <br>
                <br>
                <br>
                <a href="http://localhost:8888/skolaProject/passRecovery">Klikni na mna!</a>
                ';
    $headers = 'From: kutko145@gmail.com' . "\r\n" .
        'Reply-To: kutko145@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if(mail($to, $subject, $message, $headers)){
        return TRUE;
    }
    return FALSE;
}


function sendUserInfo($last_name, $first_name, $odbor, $class, $soc, $hash_id, $decide){
    $mysqli = connect_to_db();
    if($decide){
        $query = "INSERT INTO `users_info` (hash_id, first_name, last_name, odbor, class, soc)
                    VALUES ('" . $mysqli->real_escape_string($hash_id) . "',
                        '" . $mysqli->real_escape_string($first_name) . "',
                        '" . $mysqli->real_escape_string($last_name). "',
                        '" . $mysqli->real_escape_string($odbor) . "',
                        '" . $mysqli->real_escape_string($class). "',
                        '" . $mysqli->real_escape_string($soc). "');";

    }else{
        $query = "UPDATE `users_info` SET
                        first_name='" . $mysqli->real_escape_string($first_name) . "',
                        last_name='" . $mysqli->real_escape_string($last_name) . "',
                        odbor='" . $mysqli->real_escape_string($odbor) . "',
                        class='" . $mysqli->real_escape_string($class) . "',
                        soc='" . $mysqli->real_escape_string($soc) . "'
                        WHERE hash_id='" . $mysqli->real_escape_string($hash_id) . "';";
    }

    if($mysqli->query($query) == TRUE){
        $mysqli->close();
        return TRUE;
    }

    $mysqli->close();
    return FALSE;

}

?>
