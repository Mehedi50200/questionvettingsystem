<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
  }

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
        <link rel="stylesheet" type="text/css" href="style/styles.css">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">  <img src ="resource/logo.png"> </a>
        <a class="navbar-brand panelname" href="lecturerhome.php"> Lecturer Panel </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link " href="lecturerhome.php">Home</a>
                <a class="nav-item nav-link active" href="#"> / <?php echo $_GET['id'] ; ?><span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link cusername" href="luserprofile.php"><?php echo $_SESSION['username']; ?></a>
                <a class="nav-item nav-link clogout" href="lecturerhome.php?logout='1'">Logout</a>               
            </div>
           
        </div>
    </nav> 

    <body> 

        <div class= "bodycontainer">

            <div class="row addquestion"></div>

            <?php
            $coursecode = $_GET['id'];
            $pdfid1="";              
            $conn = new mysqli('localhost', 'root', 'sony50200' ,'saifur');
            $sqlpdf1 = "SELECT * FROM `pdffiles` WHERE coursecode='$coursecode' AND question='1' ";
            $querypdf1 = mysqli_query($conn, $sqlpdf1) or die(mysqli_error());              

            if ($row = mysqli_fetch_assoc($querypdf1)) :?>                    
            <?php $pdfid1= $row['id']; ?>
            
            <div class="row justify-content-center">
                <div class="col-7">        
                    <div class="pdfviewer"> 
                        <div class="row justify-content-center clu">
                            <h5>Course Learning Unit: <?php echo $row['clu'] ?> </h5>
                        </div>  
                        <div class="row justify-content-center"> 
                            <?php echo '<embed src="data:application/pdf;base64,'.base64_encode($row['pdf']).'" width="100%" height="500px"/>' ;?>  
                        </div>
                    </div>
                </div>  


                <div class="col-5 scene_element scene_element--fadeinright">                     
                    <?php
                    $conn = new mysqli('localhost', 'root', 'sony50200' ,'saifur');                      
                    $sqlcomment1 = "SELECT * FROM comment WHERE pdfid='$pdfid1'";
                    $querycomment1 = $conn->query($sqlcomment1);?>

                    <div class="commentbox">
                        <div class="row justify-content-center ">
                            <h2>Question 1 Comment</h2>                        
                        </div>

                        <div class="row justify-content-center sendapprove">
                            <form method="post" action="server.php">                 
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Comment here....." name="comment">
                                    <input type="hidden" class="form-control" name="pdfid" value="<?php echo $pdfid1?>">
                                    <input type="hidden" class="form-control" name="username" value="<?php echo $_SESSION['username']?>">
                                    <input type="hidden" class="form-control" name="coursecode" value="<?php echo $_GET['id']?>">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" name="postcomment">Post</button>
                                    </div>
                                </div>
                            </form>
                        </div>    
                           
                        <?php                       
                        if ($querycomment1-> num_rows > 0) :?>                                       
                            <?php while ($row = mysqli_fetch_assoc($querycomment1)) :?>
                            <div class="row commentrow">  
                                <div class="col-md-3 col-sm-5 username">
                                    <?php echo  $row['username'] ?> 
                                </div>  
                                <div class="col-md-9 col-sm-7">
                                    <?php echo  $row['comment'] ?>
                                </div>                                                            
                            </div>                            
                            <?php endwhile; ?>
                            <?php else :?>
                            <div class="row justify-content-center"> <h4> No Comment Yet </h4> </div>                        
                        <?php endif; ?>                         
                    </div>

                </div>
            </div>
            <?php endif; ?>


            <div class="row addquestion"></div>

            <?php
            $coursecode = $_GET['id'];
            $pdfid2="";              
            $conn = new mysqli('localhost', 'root', 'sony50200' ,'saifur');
            $sqlpdf2 = "SELECT * FROM `pdffiles` WHERE coursecode='$coursecode' AND question='2' ";
            $querypdf2 = mysqli_query($conn, $sqlpdf2) or die(mysqli_error());              

            if ($row = mysqli_fetch_assoc($querypdf2)) :?>                    
            <?php $pdfid2= $row['id']; ?>

            <div class="row justify-content-center">
                <div class="col-7">        
                    <div class="pdfviewer"> 
                        <div class="row justify-content-center clu">
                            <h5>Course Learning Unit: <?php echo $row['clu'] ?> </h5>
                        </div>  
                        <div class="row justify-content-center"> 
                            <?php echo '<embed src="data:application/pdf;base64,'.base64_encode($row['pdf']).'" width="100%" height="500px"/>' ;?>  
                        </div>
                    </div>
                </div>  


                <div class="col-5 scene_element scene_element--fadeinright">                     
                    <?php
                    $conn = new mysqli('localhost', 'root', 'sony50200' ,'saifur');                      
                    $sqlcomment2 = "SELECT * FROM comment WHERE pdfid='$pdfid2'";
                    $querycomment2 = $conn->query($sqlcomment2);?>

                    <div class="commentbox">
                        <div class="row justify-content-center ">
                            <h2>Question 2 Comment</h2>                        
                        </div>

                        <div class="row justify-content-center sendapprove">
                            <form method="post" action="server.php">                 
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Comment here....." name="comment">
                                    <input type="hidden" class="form-control" name="pdfid" value="<?php echo $pdfid2?>">
                                    <input type="hidden" class="form-control" name="username" value="<?php echo $_SESSION['username']?>">
                                    <input type="hidden" class="form-control" name="coursecode" value="<?php echo $_GET['id']?>">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" name="postcomment">Post</button>
                                    </div>
                                </div>
                            </form>
                        </div>    
                        
                        <?php                       
                        if ($querycomment2-> num_rows > 0) :?>                                       
                            <?php while ($row = mysqli_fetch_assoc($querycomment2)) :?>
                            <div class="row commentrow">  
                                <div class="col-md-3 col-sm-5 username">
                                    <?php echo  $row['username'] ?> 
                                </div>  
                                <div class="col-md-9 col-sm-7">
                                    <?php echo  $row['comment'] ?>
                                </div>                                                            
                            </div>                            
                            <?php endwhile; ?>
                            <?php else :?>
                            <div class="row justify-content-center"> <h4> No Comment Yet </h4> </div>                        
                        <?php endif; ?>                         
                    </div>

                </div>
            </div>
            <?php endif; ?>

            <div class="row addquestion"></div>

          
        
        
        </div>
        

    </body>


</html>