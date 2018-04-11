
<?php
session_start();
 $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=That70'sshow");
 $id  = $_SESSION['my_id'];
 $envolvement = pg_query($db_connection, "select student_envolvement($id)");

?>      
  <div class="table-responsive">          
    <table class="table">
        <?php while($row = pg_fetch_row($envolvement)){
                     $r = explode(',', substr($row[0],1,-1)); ?>
          <tr>
            <th><?php echo $r[0]?></th>
          </tr>
          <tr>
            <td>Number of files contributed to project:</td>
            <td><?php echo $r[1]?></td>
          </tr>
        <?php }?>   
    </table>
  </div>
