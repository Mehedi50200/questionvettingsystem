<?php 

$connect = new mysqli('localhost', 'root', '' ,'saifur');
$pdfid= $_GET['pdfid'];
$coursecode = $_GET['coursecode'];
$sql ="DELETE FROM pdffiles WHERE id='$pdfid'";


//$sql ="DELETE pdffiles, comment FROM pdffiles INNER JOIN comment ON comment.pdfid=pdf.id WHERE pdf.id='$pdfid'";
//$results = $connect->query($sql2);

if($success=mysqli_query($connect,$sql)){

    $sql2 ="DELETE FROM comment  WHERE pdfid='$pdfid'";
    if($success=mysqli_query($connect,$sql2)){
        header("Location:coursecoordinatorcourse.php?id=$coursecode");
    }

    	
}else{
   echo $result->fetch_assoc();
}


?>

