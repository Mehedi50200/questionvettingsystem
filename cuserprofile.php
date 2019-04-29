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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </head>


     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">  <img src ="resource/logo.png"> </a>
        <a class="navbar-brand panelname"> Course Coordinator Panel </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
              <a class="nav-item nav-link " href="coursecoordinatorhome.php"> Home <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link active" href="#"><?php echo $_SESSION['username']; ?></a>
              <a class="nav-item nav-link " href="coursecoordinatorhome.php?logout='1'">Logout</a>
          </div>
        </div>
    </nav> 

    <body>

    <div class="bodycontainer">
        <div class="row justify-content-center scene_element scene_element--fadeinright">
            <div class="col-md-5 col-sm-10">

                <?php 
                $username =$_SESSION['username'];           
                $conn = new mysqli('localhost', 'root', '' ,'saifur');
                $sql = "SELECT * FROM users WHERE username='$username'";
                $query = mysqli_query($conn, $sql) or die($mysqli->error()); 

                if ($row = mysqli_fetch_assoc($query)) :?>                    
                <?php $pdfid1= $row['id']; ?>

                <div class="profilecard">
                    <div class="row justify-content-center scene_element scene_element--fadeinright">
                        <div class="profileimage">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'"/>' ;?> 
                        </div>
                    </div>

                    <div class="row justify-content-center scene_element scene_element--fadeinright">
                        <div class="col-md-5 col-sm-8">
                            <h3> <?php echo $row['usernamefull']?> </h3>
                        </div>
                    </div>

                    <div class="row justify-content-center scene_element scene_element--fadeinright">
                        <div class="col-md-5 col-sm-8">
                            <h5> <?php echo $row['position']?> </h5>
                        </div>
                    </div>

                    <div class="row contact justify-content-center scene_element scene_element--fadeinright">
                        <div class="col-md-6">
                            <img src="resource/email.png"/><h6> <?php echo $row['email']?> </h5>
                        </div>
                        <div class="col-md-6">
                        <img src="resource/phone.png"/><h6> <?php echo $row['phone']?> </h5>
                        </div>
                    </div>
                </div>



                <?php endif; ?>


            </div>
        
        </div>
    </div>




    </body>
</html>
