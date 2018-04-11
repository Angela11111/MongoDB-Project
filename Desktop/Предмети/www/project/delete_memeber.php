<?php
    
   //$_SESSION['var_session'] = 'hello';
    $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=That70'sshow");
?>
<?php

  session_start();

  $project_id = $_POST['id'];
  $member_id = $_POST['project'];

  $rpoject_update = pg_query($db_connection, "DELETE FROM members where members.s_id = $member_id and p_id = $project_id");
  echo $file_update;
?>