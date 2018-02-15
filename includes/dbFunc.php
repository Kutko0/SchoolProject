<?php

  DEFINE('DB_USERNAME', 'root');
  DEFINE('DB_PASSWORD', 'root');
  DEFINE('DB_HOST', 'localhost');
  DEFINE('DB_DATABASE', 'skolausers');

function connect_to_db(){
  $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, 3308);

  if ($mysqli->connect_errno) {
    die("<h1>SOMETHING WENT WRONG</h1>");
  }
 return $mysqli;
}


function login($name, $pass) {

  $mysqli = connect_to_db();
  // encrypt password to match db
  $password = hash('sha256', $pass);
  // query to db  
  // comparing name and encrypted password
  $queryCommand = "SELECT `email`, `heslo`, `first_log`, `real_meno`, `hash_id`, `status`
                    FROM `users`
                    WHERE `email` LIKE '" . $mysqli->real_escape_string($name) . "'
                    AND `heslo` LIKE '" . $mysqli->real_escape_string($password) . "' LIMIT 1";
  
  if($result = $mysqli->query($queryCommand)){
      
    $row = $result->fetch_row();
      // skutocne meno, mail a id ulozenie do globalnej 
      // premennej Session, kvoli dalsiemu pouzitiu i inych castiach programu
    $_SESSION['mail'] =  $row[0];
    $_SESSION['rname'] = $row[3];  
    $_SESSION['hash_id'] = $row[4];
    $_SESSION['status'] = $row[5];
      // ak sa prvy krat prihlasil 'flog' = first_log
        if(intval($row[2]) === 1){
            $_SESSION['flog'] = TRUE;
        }else{
            $_SESSION['flog'] = FALSE;
        }
        if($row[0] == $name && $row[1] == $password){
          return TRUE;
        }
      $mysqli->close();
      
  }else{
    $mysqli->close();
    die("<h1>SOMETHING WENT WRONG</h1>");
  }

}


function registration($email, $name, $pass, $hashID){
    $mysqli = connect_to_db();
    $hashPass = hash('sha256', $pass);
    $query = "INSERT INTO `users` (email, real_meno, heslo, hash_id, status)
                VALUES ('" . $mysqli->real_escape_string($email) . "',
                        '" . $mysqli->real_escape_string($name). "',
                        '" . $mysqli->real_escape_string($hashPass) . "',
                        '" . $mysqli->real_escape_string($hashID). "',
                        '" . $mysqli->real_escape_string(1). "');";
    if($mysqli->query($query) == TRUE){
        $mysqli->close();
        return TRUE;
    }

    $mysqli->close();
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

function savePrihlaska($ucitelHash, $ziakHash, $temaPrace, $typPrace, $poznamka){
    $mysqli = connect_to_db();
    $query = "INSERT INTO `prihlasky` (teacher_hash, student_hash, tema, typ, poznamka)
                    VALUES ('" . $mysqli->real_escape_string($ucitelHash) . "',
                        '" . $mysqli->real_escape_string($ziakHash) . "',
                        '" . $mysqli->real_escape_string($temaPrace). "',
                        '" . $mysqli->real_escape_string($typPrace) . "',
                        '" . $mysqli->real_escape_string($poznamka). "');";

    if($mysqli->query($query) == TRUE){
        $mysqli->close();
        return TRUE;
    }

    $mysqli->close();
    return FALSE;
}



?>
