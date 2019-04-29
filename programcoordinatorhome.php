<?php 
  session_start(); 
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Vetting System | UNIMAS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles.css">
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>

 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">  <img src ="resource/logo.png"> </a>
        <a class="navbar-brand panelname"> Program Coordinator Panel </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
              <a class="nav-item nav-link active" href="#"> Home <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link " href="puserprofile.php"><?php echo $_SESSION['username']; ?></a>
              <a class="nav-item nav-link " href="programcoordinatorhome.php?logout='1'">Logout</a>
          </div>
        </div>
    </nav> 

  <body> 

     <div class="row justify-content-center">
      <div class = "main">    
       
          <?php
          $conn = new mysqli('localhost', 'root', '' ,'saifur');
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM `course` WHERE lecturer1='$username' OR programcoordinator='$username' ";    
          $query = mysqli_query($conn, $sql) or die($mysqli->error());

          while($row = mysqli_fetch_assoc($query)) :?>    
          
       
          <?php echo"<a href =programcoordinatorcourse.php?id=".$row['coursecode']." ".">" ?>	          
            <div class="coursewidget">
              <div class="row justify-content-center">

                <div class="col-3">
                  <div class="coursecode">
                    <p><?php echo $row['coursecode'];?> </p>
                  </div>
                </div>

                <div class="col-6">
                  <div class="coursename">
                    <div class="title"> <p><?php echo $row['coursename'];?> </p></div>  
                  </div>    
                </div>

                <div class="col-3">
                  <div class="coursecredit">
                    <div class="title"> <p>Credit:  <?php echo $row['coursecredit'];?> </p></div>
                  </div>
                </div>

              </div>
              <div class="overlay"></div> 
            </div>

          </a>
        
          <?php endwhile;?>
      </div>
    </div>

  </body>


</html>