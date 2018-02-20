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

function updatePrihlasku($hash_id, $val='9', $status='5'){
    $mysqli = connect_to_db();
    $query = "UPDATE `prihlasky`
                SET `status`= '" . $mysqli->real_escape_string($val) . "'
                WHERE `student_hash` = '" . $mysqli->real_escape_string($hash_id) . "'
                AND `status` = '" . $mysqli->real_escape_string($status) . "';";
    if($res = $mysqli->query($query)){
            $mysqli->close();
            return TRUE;
        }
    return FALSE;
}

function getClass($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `class` FROM `users_info`
                WHERE `hash_id` = '" . $mysqli->real_escape_string($hash_id) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
            $mysqli->close();
        }
    return $res[0];
}

function sendRecoveryMail($email){
    $hash_id = getHashID($email);
    $emailBody = file_get_contents('../includes/emailProto.html');
    $to      = 'andrej.kutliak@gmail.com';
    $subject = 'SPSJM | Recovery Password';
    $message =  strval($emailBody) . $hash_id . '">
                <b>Klikni sem</b></a></button></div></div>';
     $headers =  'From: noreply@mail.com' . "\r\n" .
                'Reply-To: noreply@mail.com' . "\r\n" .
                'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" .
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
    $message = '<h1>Prihlaska</h1>
                <b>Ziak</b> : ' . getRealName($studentHash) . ',<br>
                <b>Odbor</b> : ' . $res[2] . ',<br>
                <b>Trieda</b> : ' . $res[3] . ',<br>
                <b>Tema</b> : ' . $tema . ',<br>
                <b>Poznamka</b> : ' . $poznamka . '<br>
                ';
    $headers =  'From: noreply@mail.com' . "\r\n" .
                'Reply-To: noreply@mail.com' . "\r\n" .
                'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" .
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

function canSend($hash_id, $teacherHash){
     $mysqli = connect_to_db();
     $query = "SELECT * FROM `prihlasky`
                WHERE `student_hash` = '" . $mysqli->real_escape_string($hash_id) . "'
                AND `teacher_hash` = '" . $mysqli->real_escape_string($teacherHash) . "';";
    if($res = $mysqli->query($query) ){
            $mysqli->close();
            if($res->num_rows > 0){
                return FALSE;
            }

        }
    return TRUE;
}

function getKonzultantoveMeno($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `teacher_hash` FROM `prihlasky`
                WHERE `student_hash` = '" . $mysqli->real_escape_string($hash_id) . "'
                AND `status` = '1';";
    if($res = $mysqli->query($query)->fetch_row()){
            $mysqli->close();
        }
    $meno = getRealName($res[0]);
    return $meno;
}

function maPotvrdenuPrihlasku($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `status` FROM `prihlasky`
                WHERE `student_hash` = '" . $mysqli->real_escape_string($hash_id) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
            $mysqli->close();
            if($res[0] === '1'){
                return TRUE;
            }
        }
    return FALSE;
}

function getPracaInfo($hash_id){
    $mysqli = connect_to_db();
    $query = "SELECT `tema`, `typ`, `poznamka` FROM `prihlasky`
                WHERE `student_hash` = '" . $mysqli->real_escape_string($hash_id) . "'
                AND `status` = '1';";
    if($res = $mysqli->query($query)->fetch_row()){
            $mysqli->close();
        }
    return $res;
}

function getPracePreUcitela($hash_id, $val='5'){
    $mysqli = connect_to_db();
    $query = "SELECT `student_hash`, `tema`, `typ`, `poznamka` FROM `prihlasky`
                WHERE `teacher_hash` = '" . $mysqli->real_escape_string($hash_id) . "'
                AND `status` = '" . $mysqli->real_escape_string($val) . "';";
    if($res = $mysqli->query($query)){
            $mysqli->close();
        }
    return $res;
}

function maPrihlasku($hash_id, $val=FALSE){
    $mysqli = connect_to_db();
    $query = "SELECT `status` FROM `prihlasky`
                WHERE `student_hash` = '" . $mysqli->real_escape_string($hash_id) . "';";
    if($res = $mysqli->query($query)){
            $mysqli->close();
        while ($row = mysqli_fetch_assoc($res)) {
            if($val === TRUE && ($row["status"] === '5')){
                return TRUE;
            }
            if($val === '9' && ($row["status"] === '9')){
                return TRUE;
            }
            if($val === FALSE && ($row["status"] === '5') || ($row["status"] === '1')){
                return TRUE;
            }
        }
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
