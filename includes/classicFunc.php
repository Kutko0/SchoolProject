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
    $query = "SELECT `user_id`, `real_meno` FROM `ziaci_4` WHERE `u_meno` LIKE '" . $mysqli->real_escape_string($name) . "';";
    if($res = $mysqli->query($query)){
        $mysqli->close();
        return FALSE;
    }
    $mysqli->close();
    return TRUE;
}
?>
