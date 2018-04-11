<?php
    
   //$_SESSION['var_session'] = 'hello';
    $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=That70'sshow");
?>
<?php

  session_start();
  //$_SESSION['var_session'] = 'hello';
  //echo $_SESSION['var_session'];

	$success = 0;
	$ind = $_POST["file_del_id"];

  $result = pg_query($db_connection, "SELECT delete_file($ind)");
  echo $result;
?>
