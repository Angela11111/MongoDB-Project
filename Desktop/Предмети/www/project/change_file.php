<?php
    
   //$_SESSION['var_session'] = 'hello';
    $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=That70'sshow");
?>
<?php

  session_start();
 //  //$_SESSION['var_session'] = 'hello';
 //  //echo $_SESSION['var_session'];

	// $success = 0;
	// $ind = $_POST["project_del_id"];
  $file_id = $_POST['id'];
  $file_name = $_POST['name'];
  $file_description = $_POST['description'];

  $file_update = pg_query($db_connection, "UPDATE files SET f_name = '$file_name', description = '$file_description' WHERE id = $file_id");
  echo $file_update;
?>