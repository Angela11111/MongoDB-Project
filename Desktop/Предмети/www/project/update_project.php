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
  $project_update_id = $_POST['project_update_id'];

  $files = pg_query($db_connection, "SELECT f.* FROM files f, files_of_project fop WHERE fop.f_id = f.id AND fop.p_id = $project_update_id");
  $members = pg_query($db_connection, "SELECT s.s_name, s.s_index FROM students s, members m WHERE m.s_id = s.id and m.p_id = $project_update_id");
  $proect_details = pg_fetch_array(pg_query($db_connection, "SELECT * FROM projects WHERE id = $project_update_id"));
 //  echo $result;
?>
<h3> Project details </h3>
<div>
	<div class="form-group">
		<label for="projet_name">Name:</label>
		<input type="text" class="form-control" id="project_name" value='<?php echo $proect_details[1]?>'>
	</div>
	<button  class="btn btn-primary btn-block btn-save-project" id = <?php echo $proect_details[0]?>>
	            Save changes to project
	</button>

	<h3> Files </h3>
	<?php 
		while($f = pg_fetch_row($files)){?>
			<div class="form-group">
			  	<label for="file_name">Name:</label>
			  	<input type="text" class="form-control"  value=<?php echo $f[1]?> id= <?php echo $f[0]?>>
			</div>
			<div class="form-group">
			  	<label for="file_description">Description:</label>
			  	<textarea type="text" class="form-control" id_descr=<?php echo $f[0]?>><?php echo $f[3]?></textarea>
			</div>
			<button  class="btn btn-primary btn-block btn-save" id_remove = <?php echo $f[0]?>>
	            Save changes to file
	        </button>
			<button  class="btn btn-danger btn-block btn-remove" id_remove = <?php echo $f[0]?>>
	            Remove file from project
	        </button>
	        </br>
	<?php } ?>
</div>
<script type="text/javascript">
	
	$(".btn-save").click(function(){
		id_file = $(this).attr('id_remove');
		console.log(id_file);
		name = $("#"+id_file).val();
		console.log(name);
		descr = $("textarea[id_descr="+id_file+"]").html();
		console.log(descr);
		$.post("change_file.php",
			{
				id: id_file,
				name: name,
				description: descr
			},function(data){
				//$(document).reload();
				console.log(data);
			});
	});
	$(".btn-remove").click(function(){
		id_file = $(this).attr('id_remove');
		console.log(id_file);
		$.post("file_remove.php",
			{
				id: id_file
			},function(data){
				//$(document).reload();
				console.log(data);
				alert(data);
			});
	});
	$(".btn-save-project").click(function(){
		id_proj = $(this).attr('id');
		name_proj = $("#project_name").val();
		console.log(name_proj);
		$.post("project_change.php",
			{
				id: id_proj,
				name: name_proj
			},function(data){
				//$(document).reload();
				console.log(data);
				alert('Changes_saved.');
				// alert(data);
			});
	});

</script>
