<?php include('server.php') ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles.css">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </head>
  <body>  

    <div class="row justify-content-center  scene_element scene_element--fadeinleft">
				<?php include('errors.php'); ?>
		</div>

    <div class= "loginformcontainer">
      <div class="row justify-content-center logocontainer">
        <img src ="resource/logo.png"> 
      </div>

      <div class="row justify-content-center">
        <div  class="col-sm-6 col-md-5 col-lg-3">
          <form method="post" action="index.php">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="upassword" name="upassword" placeholder="Password" required>
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">User Role</label>
              <select class="form-control" id="usertype" name="usertype">
                <option value="Lecturer">Lecturer</option>
                <option value="Course Coordinator">Course Coordinator</option>
                <option value="Program Coordinator">Program Coordinator</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary" name="loginuser">Submit</button>
          </form>
        <div>
      </div>     
    </div>

  </body>
</html>