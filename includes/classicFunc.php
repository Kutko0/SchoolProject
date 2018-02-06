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
    $query = "SELECT `email`, `user_id`, `real_meno` FROM `users`
                WHERE `email` = '" . $mysqli->real_escape_string($name) . "';";
    if($res = $mysqli->query($query)->fetch_row()){
        if($res[0] == $name){
            $mysqli->close();
            return FALSE;
        }else{
             $mysqli->close();
            return TRUE;
        }
        }
    $mysqli->close();
    return TRUE;
}

function isHashIdInUse($hash){
    $mysqli = connect_to_db();
    $query = "SELECT `email`, `user_id`, `real_meno` FROM `users`
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
?>
