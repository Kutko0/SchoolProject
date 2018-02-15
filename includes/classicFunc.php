<?php
function redirect($direction){
    header('Location: http://localhost:8888/skolaProject/' . $direction);
}

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

function getHashID($email){
    $mysqli = connect_to_db();
    $query = "SELECT `hash_id` FROM `users`
                WHERE `email` = '" . $mysqli->real_escape_string($email) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
            $hash_id = $res[0];
            $mysqli->close();
        }
    return $hash_id;
}

function getEmail($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `email` FROM `users`
                WHERE `hash_id` = '" . $mysqli->real_escape_string($hash_id) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
        $mysqli->close();
        return $res[0];
    }
    return FALSE;
}

function getRealName($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `real_meno` FROM `users`
                WHERE `hash_id` = '" . $mysqli->real_escape_string($hash_id) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
            $mysqli->close();
        }
    return $res[0];
}

function sendRecoveryMail($email){
    $hash_id = getHashID($email);
    $to      = 'andrej.kutliak@gmail.com';
    $subject = 'SPSJM | Recovery Password';
    $message = 'Klikni na tento link pre zmenu hesla.
                https://kutko145.000webhostapp.com/changePass/index.php?emre=' . $hash_id;
    $headers = 'From: kutko145@gmail.com' . "\r\n" .
        'Reply-To: kutko145@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if(mail($to, $subject, $message, $headers)){
        return TRUE;
    }
    return FALSE;
}

function sendPrihlaskaToTeacher($teacherHash, $studentHash, $tema, $poznamka){
    $res     = getUserInfo($studentHash);
    $to      = getEmail($teacherHash);
    $subject = 'SPSJM | Prihlaska';
    $message = 'Ziak : ' . getRealName($studentHash) . ',
                Odbor: ' . $res[2] . ',
                Trieda: ' . $res[3] . ',
                Tema: ' . $tema . ',
                Poznamka: ' . $poznamka . '
                ';
    $headers = 'From: noreply@mail.com' . "\r\n" .
        'Reply-To: noreply@mail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    if(mail($to, $subject, $message, $headers)){
        return TRUE;
    }
    return FALSE;
}

function sendPrihlaskaToStudent($hash_id){
    $to      = getEmail($hash_id);
    $subject = 'SPSJM | Prihlaska';
    $message = 'Vasa prihlaska bola odoslana ucitelovi na schvalenie.';
    $headers = 'From: noreply@mail.com' . "\r\n" .
        'Reply-To: noreply@mail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    if(mail($to, $subject, $message, $headers)){
        return TRUE;
    }
    return FALSE;
}

function getTeachers(){
    $mysqli = connect_to_db();
    $query = "SELECT `real_meno`, `hash_id` FROM `users`
                WHERE `status` = '" . $mysqli->real_escape_string(5) . "';";
    if($res = $mysqli->query($query)){
            $mysqli->close();
        }

    return $res;
}

function getUserInfo($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `first_name`, `last_name`, `odbor`, `class`, `soc`
                FROM `users_info`
                WHERE `hash_id` = '" . $mysqli->real_escape_string($hash_id) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
            $mysqli->close();
        }else{
            return FALSE;
        }
    return $res;
}

function isTeacher($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `status`
                FROM `users`
                WHERE `hash_id` = '" . $mysqli->real_escape_string($hash_id) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
            $mysqli->close();
            if($res[0] === '5'){
                return TRUE;
            }
        }
    return FALSE;
}

function isPending($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `status`
                FROM `prihlasky`
                WHERE `student_hash` = '" . $mysqli->real_escape_string($hash_id) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
            $mysqli->close();
            if($res[0] === '5'){
                return FALSE;
            }
        }
    return TRUE;
}

function isLogged(){
    if(isset($_SESSION['hash_id'])){
        return TRUE;
    }
    return FALSE;
}

?>
