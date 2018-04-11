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
  $proj_id = $_POST['id'];
  $proj_name = $_POST['name'];

  $proj_change= pg_query($db_connection, "UPDATE projects SET p_name = '$proj_name' WHERE id = $proj_id");
  echo $proj_change;
?>