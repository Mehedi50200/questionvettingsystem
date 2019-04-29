<?php 
	session_start(); 
	$username = "";
	$email    = "";
	$usertype = "";
	$upassword = "";
	$errors = array(); 

	// connect to database
	$connect = new mysqli('localhost', 'root', '' ,'saifur');


	if ( $connect->connect_error){
		die('connection failed');
	} 

	// LOGIN USER
	if (isset($_POST['loginuser']))
	{
		$email = $_POST ['email'];
		$upassword = $_POST ['upassword'];
		$usertype = $_POST ['usertype'];

		$sql ="SELECT id,email, username, usertype FROM users WHERE email = '$email' AND upassword = '$upassword' AND usertype= '$usertype'";
		$results = $connect->query($sql);

		if ($results-> num_rows > 0)
		{
			while ($row=mysqli_fetch_assoc($results))
			{
				if( $row['usertype'] =='Program Coordinator')
				{
					$_SESSION['username'] = $row['username'];
					$_SESSION['usertype'] = $row['usertype'];
					header('location: programcoordinatorhome.php');
				}

				else if($row['usertype'] =='Course Coordinator')
				{
					$_SESSION['username'] = $row['username'];
					$_SESSION['usertype'] = $row['usertype'];
					$_SESSION['success'] = "You are now logged in";
					header('location: coursecoordinatorhome.php');
				}

				else if($row['usertype'] =='Lecturer')
				{
					$_SESSION['username'] = $row['username'];
					$_SESSION['usertype'] = $row['usertype'];
					$_SESSION['success'] = "You are now logged in";
					header('location: lecturerhome.php');
				}
				else{
					array_push($errors, "User Type has is not defined for this user" );
				}

			}				

		}else{
				array_push($errors, "Wrong Email, Password or User Type  combination");
			}
	}

	if (isset($_POST['postcomment']))
	{
		$coursecode = $_POST ['coursecode'];
		$username = $_POST ['username'];
		$comment = $_POST ['comment'];
		$pdfid = $_POST ['pdfid'];

		$sql = "INSERT INTO comment(coursecode, username, comment,pdfid)
					  VALUES('$coursecode', '$username', '$comment',  '$pdfid')";

		if ($connect->query($sql) === TRUE)
			{	
				header("Location:lecturercourse.php?id=$coursecode");	
			}	

	}

	if (isset($_POST['uploadfiles']))
    {          		
		$coursecode = $_POST['coursecode'];
		$question =$_POST['question'];	
		$clu = $_POST['clu'];	
		$vettera =$_POST['vettera'];
		$vetterb =$_POST['vetterb'];

		$pdf = addslashes(file_get_contents($_FILES['pdf']['tmp_name']));		
  
        $sql = "INSERT INTO pdffiles (pdf,coursecode,question,clu)
            VALUES('$pdf','$coursecode','$question','$clu')";
        
        if($success=mysqli_query($connect,$sql))
		{	
			$sql2 = "UPDATE course SET vettera ='$vettera', vetterb = '$vetterb' WHERE coursecode='$coursecode'";
			if($success=mysqli_query($connect,$sql2)){
				header("Location:coursecoordinatorcourse.php?id=$coursecode");	

			}
			
		}else
		{
			echo "$vettera $vetterb";
			echo "<h2>Question Files Uploading FAILED!!!!!!!!!</h2> ";
		//	header("Location:coursecoordinatorcourse.php?id=$coursecode");	
		}
		
    

	}

	if(isset($_POST['sfacomment'])){
		$approvalcomment = $_POST['approvalcomment'];
		$pdfid = $_POST['pdfid'];
		$coursecode = $_POST['coursecode'];
		$sql = "UPDATE pdffiles SET sentforapproval= 'true', approvalcomment='$approvalcomment', approvalstatus='PENDING' WHERE id='$pdfid'";

		if($success=mysqli_query($connect,$sql))
		{	echo "($approvalcomment $pdfid $coursecode)";  
			header("Location:coursecoordinatorcourse.php?id=$coursecode");	
		}else
		{
			echo "($approvalcomment $pdfid $coursecode)";  
			header("Location:coursecoordinatorcourse.php?id=$coursecode");	
		}
	}


	if(isset($_POST['approve'])){
		$procomment = $_POST['procomment'];
		$pdfid = $_POST['pdfid'];
		$coursecode = $_POST['coursecode'];
		$sql = "UPDATE pdffiles SET procomment= '$procomment', approvalstatus='APPROVED' WHERE id='$pdfid'";

		if($success=mysqli_query($connect,$sql))
		{	
			echo "$procomment $pdfid $coursecode";
			header("Location:programcoordinatorcourse.php?id=$coursecode");	
		}else
		{
			echo "$procomment $pdfid $coursecode";
			header("Location:programcoordinatorcourse.php?id=$coursecode");	
		}
	}

	if(isset($_POST['disapprove'])){
		$procomment = $_POST['procomment'];
		$pdfid = $_POST['pdfid'];
		$coursecode = $_POST['coursecode'];
		$sql = "UPDATE pdffiles SET procomment= '$procomment', approvalstatus='DISSAPROVED' WHERE id='$pdfid'";

		if($success=mysqli_query($connect,$sql))
		{
			echo "$procomment $pdfid $coursecode";
			header("Location:programcoordinatorcourse.php?id=$coursecode");	
		}else
		{
			echo "$procomment $pdfid $coursecode";
			header("Location:programcoordinatorcourse.php?id=$coursecode");	
		}
	}


?>