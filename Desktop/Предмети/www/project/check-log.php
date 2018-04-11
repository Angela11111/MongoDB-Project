<?php
    $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=That70'sshow");
?>
<?php

  session_start();

	$success = 0;
	$ind = $_POST["index"];
  $pwd = $_POST["password"];

  $result = pg_query($db_connection, "SELECT * FROM students where students.s_index = '$ind' and students.s_password = '$pwd'");

  $user = pg_fetch_array($result);

  if($user != null){
    $success = 1;
    
    $_SESSION['my_id'] = $user[0]; 
    $_SESSION['my_index'] = $user[1];
    $_SESSION['my_name'] = $user[2];
    $_SESSION['my_faculty'] = $user[3];
  
  }
  echo $success;
?>
