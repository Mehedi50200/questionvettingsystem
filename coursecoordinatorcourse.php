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
        
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">  <img src ="resource/logo.png"> </a>
        <a class="navbar-brand panelname" href="coursecoordinatorhome.php"> Course Coordinator Panel </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link " href="coursecoordinatorhome.php">Home</a>
                <a class="nav-item nav-link active" href="#"> / <?php echo $_GET['id'] ; ?><span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link cusername" href="cuserprofile.php"><?php echo $_SESSION['username']; ?></a>
                <a class="nav-item nav-link clogout" href="coursecoordinatorcourse.php?logout='1'">Logout</a>               
            </div>
           
        </div>
    </nav> 

    <body> 

        <div class= "bodycontainer">
            <div class="row justify-content-center">
                <div class="addwidget"
                    data-toggle="collapse" data-target="#collapsableAddForm"
                    aria-expanded="false" aria-controls="collapsableAddForm">
                        <div class="title"><a>Add Questions</a></div>     
                </div>
            </div>

            <div class="row justify-content-center collapse collapsableAddForm"  id="collapsableAddForm">
                <form enctype="multipart/form-data" action="server.php" method="post">
                    <div class="input-group mb-3">
                        <select class="custom-select" id="question" name="question" required>
                            <option value="1">Question 1</option>
                            <option value="2">Question 2</option>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect02">Options</label>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <select class="custom-select"  name="vettera" required>
                            
                        <?php
                            $coursecode = $_GET['id'];
                            $conn = new mysqli('localhost', 'root', 'sony50200' ,'saifur');
                            $sql = "SELECT * FROM `course` WHERE coursecode='$coursecode' ";
                            $query = mysqli_query($conn, $sql) or die(mysqli_error());                             
                           

                            while ($row = mysqli_fetch_assoc($query)) :?>
                            <?php $lecturer1 =  $row['lecturer1'];?>   
                            <?php $lecturer2 =  $row['lecturer2'];?>   
                            <?php $lecturer3 =  $row['lecturer3'];?>   
                            <?php $lecturer4 =  $row['lecturer4'];?>                              
                           
                                     
                            <div class="pdfviewer">  
                            <div class="row justify-content-center clu">                                                        
                                <option value="<?php echo $lecturer1 ?>"><?php echo $lecturer1?></option>
                                <option value="<?php echo $lecturer2 ?>"><?php echo $lecturer2?></option>
                                <?php if($row['lecturer3']=="")  :?>
                                <option value="<?php  echo $lecturer3 ?>">'No More Lecturer Assigned'</option>
                                <?php else :?>
                                        <option value="<?php echo $lecturer3 ?> "><?php echo $lecturer3?></option>
                                <?php  endif;?>

                                <?php if($row['lecturer4']=="") :?>
                                <option value="<?php echo $lecturer4?>">'No More Lecturer Assigned'</option>
                                <?php else :?>
                                        <option value="<?php  echo $lecturer4 ?>"><?php echo $lecturer4?></option>
                                <?php  endif;?>
                            <?php endwhile;?>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect02">Vetter 1</label>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <select class="custom-select"  name="vetterb" required>                            
                            <?php
                                $coursecode = $_GET['id'];
                                $conn = new mysqli('localhost', 'root', 'sony50200' ,'saifur');
                                $sql = "SELECT * FROM `course` WHERE coursecode='$coursecode' ";
                                $query = mysqli_query($conn, $sql) or die(mysqli_error());                             
                            

                                while ($row = mysqli_fetch_assoc($query)) :?>
                                <?php $lecturer1 =  $row['lecturer1'];?>   
                                <?php $lecturer2 =  $row['lecturer2'];?>   
                                <?php $lecturer3 =  $row['lecturer3'];?>   
                                <?php $lecturer4 =  $row['lecturer4'];?>                   
                                        
                                
                                <div class="row justify-content-center">                                                        
                                    <option value="<?php echo $lecturer1?>"><?php echo $lecturer1?></option>
                                    <option value="<?php echo $lecturer2?>"><?php echo $lecturer2?></option>
                                    <?php if($row['lecturer3']=="")  :?>
                                    <option value="<?php  echo $lecturer3?>">'No More Lecturer Assigned'</option>
                                    <?php else :?>
                                        <option value="<?php  echo $lecturer3?>"><?php echo $lecturer3?></option>
                                    <?php  endif;?>

                                    <?php if($row['lecturer4']=="") :?>
                                    <option value="<?php  echo $lecturer4 ?>">'No More Lecturer Assigned'</option>
                                    <?php else :?>
                                            <option value="<?php  echo $lecturer4?> "><?php echo $lecturer4?></option>
                                    <?php  endif;?>
                                <?php endwhile;?>
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect02">Vetter 2</label>
                        </div>
                    </div>
                   

                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="text" class="form-control" id="clu" name="clu" placeholder="Lecture Units...." required>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" name="coursecode" value="<?php echo $_GET['id']?>">

                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="pdf" name="pdf" required>
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn" type="submit" name="uploadfiles">Upload</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row addquestion"></div>

            <?php
            $coursecode = $_GET['id'];
            $pdfid1="";              
            $conn = new mysqli('localhost', 'root', 'sony50200' ,'saifur');
            $sqlpdf1 = "SELECT * FROM `pdffiles` WHERE coursecode='$coursecode' AND question='1' ";
            $querypdf1 = mysqli_query($conn, $sqlpdf1) or die(mysqli_error());              

            if ($row = mysqli_fetch_assoc($querypdf1)) :?>                    
            <?php $pdfid1= $row['id']; ?>
            
            <div class="row justify-content-center  ">
                <div class="col-7">                 
                    <div class="pdfviewer">  
                        <div class="row justify-content-center">
                            <div class= clu>
                            <button class="btn" onclick="deletepdf('<?php echo $pdfid1; ?>','<?php echo $coursecode; ?>')">Delete</button>
                            <h5>  Course Learning Unit: <?php echo $row['clu'] ?></h5>                    
                            </div>                                                              
                            <script language="javascript">
                                function deletepdf(pdfid, coursecode){
                                    var r = confirm("Are you sure to delete?");
                                    if(r==true){ window.location.href='delete.php?pdfid=' + pdfid + '&coursecode='+ coursecode ;}
                                }
                            </script>                                 
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
                            <h3>Question 1</h3>                        
                        </div> 
                        <div class="row justify-content-center sendapprove">
                            <form method="post" action="server.php">
                                <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="pdfid" value="<?php echo $pdfid1?>">
                                <input type="hidden" class="form-control" name="coursecode" value="<?php echo $_GET['id']?>">
                                    <div class="input-group-append">
                                        <input type="text" class="form-control" id="sendforapproval" name="approvalcomment" required>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" name="sfacomment">Send for Approval</button>
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

                       
                        <?php
                        $sqlsfa1 = "SELECT * FROM pdffiles WHERE id='$pdfid1'";
                        $querysfa1 = mysqli_query($conn, $sqlsfa1) or die(mysqli_error()); 
                        
                        while ($row = mysqli_fetch_assoc($querysfa1)) :?>
                        <div class="row justify-content-center ">
                      
                            <h4><?php echo $row['approvalstatus'] ?></h4><br>
                            <div class="acommentrow justify-content-center">
                                <h5><?php echo $row['procomment'] ?></h5> 
                            </div>                         
                        </div> 
                        <?php endwhile; ?>                                         
   
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

            <div class="row justify-content-center  ">
                <div class="col-7">                 
                    <div class="pdfviewer">  
                        <div class="row justify-content-center">
                            <div class= clu>
                            <button class="btn" onclick="deletepdf('<?php echo $pdfid2; ?>','<?php echo $coursecode; ?>')">Delete</button>
                            <h5>  Course Learning Unit: <?php echo $row['clu'] ?></h5>                    
                            </div>                                                              
                            <script language="javascript">
                                function deletepdf(pdfid, coursecode){
                                    var r = confirm("Are you sure to delete?");
                                    if(r==true){ window.location.href='delete.php?pdfid=' + pdfid + '&coursecode='+ coursecode ;}
                                }
                            </script>                                 
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
                            <h3>Question 2</h3>                        
                        </div> 
                        <div class="row justify-content-center sendapprove">
                            <form method="post" action="server.php">
                                <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="pdfid" value="<?php echo $pdfid2?>">
                                <input type="hidden" class="form-control" name="coursecode" value="<?php echo $_GET['id']?>">
                                    <div class="input-group-append">
                                        <input type="text" class="form-control" id="sendforapproval" name="approvalcomment" required>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" name="sfacomment">Send for Approval</button>
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

                    
                        <?php
                        $sqlsfa2 = "SELECT * FROM pdffiles WHERE id='$pdfid2'";
                        $querysfa2 = mysqli_query($conn, $sqlsfa2) or die(mysqli_error()); 
                        
                        while ($row = mysqli_fetch_assoc($querysfa2)) :?>
                        <div class="row justify-content-center ">
                    
                            <h4><?php echo $row['approvalstatus'] ?></h4><br>
                            <div class="acommentrow justify-content-center">
                                <h5><?php echo $row['procomment'] ?></h5> 
                            </div>                         
                        </div> 
                        <?php endwhile; ?>                                         

                    </div> 
                </div>
            </div>
            <?php endif; ?>

        <div class="row addquestion"></div>

        </div>

    </body>


</html>