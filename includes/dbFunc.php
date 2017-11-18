<?php
function connect_to_db(){

  DEFINE('DB_USERNAME', 'root');
  DEFINE('DB_PASSWORD', 'root');
  DEFINE('DB_HOST', 'localhost');
  DEFINE('DB_DATABASE', 'skolausers');

  $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, 3308);

  if ($mysqli->connect_errno) {
    die("<h1>SOMETHING WENT WRONG</h1>");
  }
 return $mysqli;
}


function login($type, $name, $pass) { 
  
  // potom pouzi aj type chuju
  $mysqli = connect_to_db();
  // encrypt password to match db
  $password = hash('sha256', $pass);
  // query to db  
  // comparing name and encrypted password
  $queryCommand = "SELECT `u_meno`, `heslo`, `first_log`, `real_meno`,`user_id` FROM `ziaci_4` 
                    WHERE `u_meno` LIKE '" . $mysqli->real_escape_string($name) . "' 
                    AND `heslo` LIKE '" . $password . "' LIMIT 1";    
  
  if($result = $mysqli->query($queryCommand)){
      
    $row = $result->fetch_row();
      // skutocne meno, mail a id ulozenie do globalnej 
      // premennej Session, kvoli dalsiemu pouzitiu i inych castiach programu
    $_SESSION['mail'] =  $row[0];
    $_SESSION['rname'] = $row[3];  
    $_SESSION['user_id'] = $row[4];  
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
    die("<h1>SOMETHING WENT WRONG</h1>");
  }

}




?>
