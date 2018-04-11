
<?php
// $user = $_GET['user'];
// $jsonArray = json_decode($user, TRUE);
session_start();
//$Lname = $_POST["Lname"];
 $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=That70'sshow");
 $fax  = $_SESSION['my_faculty'];
 $q = pg_fetch_row(pg_query($db_connection, "select best_student_faculty('$fax')"));

 $best = explode(',', substr($q[0],1,-1));

?>

  <!-- 
  <p>Resize this responsive page to see the effect!</p> -->       
          
  <div class="table-responsive">          
    <table class="table">
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Index</th>
          <th>Faculty</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $best[1]; ?></td>
          <td><?php echo $best[2]; ?></td>
          <td><?php echo $best[3]; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
           

 