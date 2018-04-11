

<div id="message" class="container-fluid"></div>      
<div class="table-responsive">          
  <table id="new_prject_table" class="table">
    <tr>
      <th> Project Name</th>
      <td><input type="text" id="new_project_name"></td>
    </tr>
    <tr class="members">
      <th>Project Members:</th>
      <td><input type="text" id="search_field" placeholder="Search by index.."></td>
    </tr>
  </table>
  <button id="add_project" class="btn btn-success btn-block">
    Add project
  </button>
  </br>
  <button id="clear_students" class="btn btn-danger btn-block">
    Clear students
  </button>
  </br>
</div>
           
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script type="text/javascript">
  var global_members = {};
  var global_i = 0;
   $("#search_field").keypress(function(e){
    console.log("ffff");
    if(e.which == 13){
      query = $(this).val().toString();
      $.post(
        "find_student.php",
        {
          student: query
        },
        function(data){

          data = jQuery.parseJSON(data);
          student_id = data["id"];
          student_name = data["name"];
          student_faculty = data["faculty"];
          student_index = data["index"];
          already_added_student = false;
        
          $("#new_prject_table").append('<tr class="new_student"><td>'+student_name+'</td> <td>'+student_index+'</td><td>'+student_faculty+'</td></tr>');
            for(var i=0; i<global_i; i++){
              if(global_members[i] == student_id)
                already_added_student = true;
            }
            if(!already_added_student){
              global_members[global_i] = student_id;
              global_i++;
            }
        }
      );
    }
   });

   $("#add_project").click(function(){
    console.log(global_members);
    project_name_temp = $("#new_project_name").val();
    members_temp = {};
    if(global_members != {})
      members_temp = global_members;
    console.log(members_temp);

    if(project_name_temp == ""){
      $("#message").html("Empty project name!");
    }
    else{
      $.post(
        "add_new_project.php",
        {
          project_name: project_name_temp,
          members: members_temp
        },
        function(data){
          $("#message").html(data);
          $("#new_project_name").val("");
          $("#search_field").val("");
          $(".new_student").remove();
        }
      );
    }
     
   });
   $("#clear_students").click(function(){
      $("#search_field").val("");
      $(".new_student").remove();
   });
 </script>