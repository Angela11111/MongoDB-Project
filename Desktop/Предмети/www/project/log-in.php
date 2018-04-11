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

    <div class="jumbotron text-center header-pm">
      <h2 class="header-text">
        PROJECT MANAGER
      </h2>
    </div>
      
    <div class="container bg">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-6">
        <form class="form-container" action="javascript:void(0);">
          <div class="form-group">
            <label for="index">
              Index:
            </label>
            <input type="text" class="form-control" id="index">
          </div>
          <div class="form-group">
            <label for="pwd">
              Password:
            </label>
            <input type="password" class="form-control" id="pwd">
          </div>
          </br>
          <button id="submit_log"type="submit" class="btn btn-success btn-block">Submit</button>
        </form>
      </div>
      <div class="col-sm-3">
      </div>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){

    results = []; //PHP ECHO RETURNS STRINGS MY RETURN STRING IS SPLIT BY &
    user_json = {}; 

      $("#submit_log").click(function(){
          index = $("#index").val();
          console.log(index);
          pass = $("#pwd").val();
          $.post("check-log.php",
          {
            index: index,
            password: pass
          },
          function(data,status){
             console.log("Successful log in ? : " + data);
             console.log("Successful communication ? : " + status);

             if(parseInt(data) != 0){
               window.location  = 'profile.php';
             }

             
          });
      });
  });
  </script>
</html>