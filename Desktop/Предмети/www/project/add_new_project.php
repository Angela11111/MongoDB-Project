<?php
session_start();

 $name = $_POST['project_name'];
 $members = $_POST['members'];
 $id =  $_SESSION['my_id']; 
 $date = date("Y-m-d h:i:sa");
 $result_members = true;

$db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=That70'sshow");

$students = pg_query($db_connection, "insert into projects(p_name, date_created, created_by) values('$name', '$date', $id)");

$id_proj = pg_fetch_row(pg_query($db_connection, "select id from projects where p_name = '$name' and date_created = '$date' and created_by = $id limit 1"))[0]; //one row one column 0th element

for($m=0; $m<count($members); $m++){
	$pom = $members[$m];
	$result_members = $result_members and pg_query($db_connection, "insert into members(s_id, p_id, date_created) values($pom, $id_proj, '$date')"); //pg_query returns false if an error occured
	}
	if($result_members and $students){
		echo "Success!";
	}
	else{
		echo "An error occured, try again!";
	}
 ?> 
