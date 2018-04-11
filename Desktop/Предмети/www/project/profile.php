<!DOCTYPE html>
<html lang="en">
<head>
  <title>Project manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="main_css.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
 session_start();
 $db_connection = pg_connect("host=localhost dbname=postgres user=postgres password=That70'sshow");

 $id  = $_SESSION['my_id'];

 if($id){
   $projects_res = pg_query($db_connection, "SELECT * from projects where deleted = false and id in (SELECT p_id FROM members where s_id = $id)");
   $files_res = pg_query($db_connection, "SELECT * from files where created_by = $id and deleted = false");
 }
?>

  <div class="container header-pm">
    <p>
      <h2 class="header-text">
         PROJECT MANAGER HOME 
      </h2>
    </p>
  </div>
  
  <div class="container body_contents">       
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
          <td><?php echo $_SESSION['my_index']; ?></td>
          <td><?php echo $_SESSION["my_name"]; ?></td>
          <td><?php echo $_SESSION["my_faculty"]; ?></td>
        </tr>
      </tbody>
    </table>
    </div>


    <div class="row">
      <div class="col-sm-4 projects">
        <h3>My projects</h3>
        </br>
        <?php while($row = pg_fetch_row($projects_res)){ ?>
          <p class=<?php echo $row[0]?>>
            <button id=<?php echo $row[0]?> class="btn btn-default btn-block btn-project">
              <h4> 
                <b>
                  <?php echo $row[1];?>
                </b>
              </h4>
            </button>
          </p class=<?php echo $row[0]?>>
          
          <p class=<?php echo $row[0]?> >
            <b>
              Project name: 
            </b> 
            <?php echo $row[1];?>  
          </p>

          <p class=<?php echo $row[0]?> >
            <b>
              Date created: 
            </b> 
            <?php echo $row[2];?>  
          </p>
            
          <p class=<?php echo $row[0]?> >
            <b>
              Creator: 
            </b> 
            <?php 
              $std_creator = (int)$row[3];
              $creator = pg_query($db_connection, "select students.s_name, students.s_index from students where students.id = $std_creator");
              while($creators = pg_fetch_row($creator)){
                echo "$creators[0], $creators[1]";
              }
            ?>  
          </p>

          <!-- p  = spaces between rows which should be removed when the row is removed or added accordingly-->
          <p class=<?php echo $row[0]?>></p> 
          <button class="btn btn-danger btn-block project-del" id_btn_proj=<?php echo $row[0]?>>
            Delete project 
          </button> 

          <!-- p  = spaces between rows which should be removed when the row is removed or added accordingly-->
          <p class=<?php echo $row[0]?>></p>
          <button class="btn btn-primary btn-block project-update" id_upd_proj=<?php echo $row[0]?>>
            Update project 
          </button> 

          <!-- p  = spaces between rows which should be removed when the row is removed or added accordingly -->
          <p class="update"+<?php echo $row[0]?>></p>
         <?php } ?>
      </div>   

      <div class="col-sm-4 files">
        <h3>
          My files
        </h3>
        </br>
        <?php while($row = pg_fetch_row($files_res)){?>
          <p class=<?php echo $row[0]?>>
          <button id=<?php echo $row[0]?> class="btn btn-default btn-block btn-file">
            <h4> <b><?php echo $row[1];?> </b></h4>
          </button>
          </p>
            <p class=<?php echo $row[0]?>>
               <b>File name: </b> <?php echo "$row[1]$row[3]";?> <!-- row[3] is a file extension example: .txt-->
            </p>
            <p class=<?php echo $row[0]?>>
               <b>Date created: </b> <?php echo $row[2];?>  
            </p>
            <p class=<?php echo $row[0]?>>
               <b>
                Last accessed: 
              </b> 
              <?php 
                $std_accessed = (int)$row[4];
                $last = pg_query($db_connection, "select students.s_name, students.s_index from students where students.id = $std_accessed");
                while($std = pg_fetch_row($last)){
                  echo "$std[0], $std[1]";
                }
              ?>  
            </p><!-- 
            <p class=<?php echo $row[0]?> attr-description=<?php echo $row[6]?>><?php echo $row[6]?></p> -->
            <p class=<?php echo $row[0]?>></p>
            <button class="btn btn-danger btn-block file-del" id_btn=<?php echo $row[0]?>>
                 Delete file 
            </button> 
            <p class=<?php echo $row[0]?>></p>
          <?php } ?>
        </div>

        <div class="col-sm-4">
          <h3>
            Display
          </h3> 
          </br>
            <div class="container-fluid display_window">
            <div class="display"></div>
              <button id="btn-score" class="btn btn-success btn-block">
                <h4> 
                  Show my score 
                </h4>
              </button>
              <button id="btn-best" class="btn btn-peach btn-block">
                <h4> 
                  Show the best student at my faculty 
                </h4>
              </button>
              <button id="btn-new" class="btn btn-primary btn-block">
                <h4> 
                  Add new project 
                </h4>
              </button>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  
     $(".btn-file").click(function(){
        id = $(this).attr('id');
        file_descr = $(this).parent().siblings('#descr').html();
        console.log(file_descr);
      
        $(".display_file_descr").remove();
        $(".display_window").prepend('<div class="container-fluid display_file_descr"><h4>'+file_descr+'</h4></div></br>');

     });

     $("#btn-score").click(function(){
      $(".display").load('student_envolvement.php');
     });
     $("#btn-best").click(function(){
      $(".display").load('best_student.php');
     });
     $("#btn-new").click(function(){
      $(".display").load('new_project.php');
     });

     $(".file-del").click(function(){
        file_id = $(this).attr('id_btn');
        file = $(this);
        console.log(file_id);
        $.post(
          "delete_file.php",
          {
            file_del_id: file_id
          },
          function(data){
            console.log(data);
            file.remove();
            $(".files").children("."+file_id).remove();
          }
          );

     });

     $(".project-del").click(function(){
        project_id = $(this).attr('id_btn_proj');
        project = $(this);
        console.log(project_id);
        $.post(
          "delete_project.php",
          {
            project_del_id: project_id
          },
          function(data){
            console.log(data);
            project.remove();
            $(".projects").children("."+project_id).remove();
          }
          );

     });

     $(".project-update").click(function(){

        project_id = $(this).attr('id_upd_proj');

       $(".display").load('update_project.php', {project_update_id: project_id});

     });

</script>
</body>
</html>