<?php
	session_start();
	require_once('../model/dao.php');
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["uemail"];
	$prevURL = $_POST["prevURL"];

	$con = dbConnection();

	$checkEmailSQL = "SELECT * FROM students WHERE stuEmail = '$email'";
	$checkEmailResults = mysqli_query($con,$checkEmailSQL);

	if(mysqli_num_rows($checkEmailResults)>0){
		if($row = mysqli_fetch_assoc($checkEmailResults)){
			$_SESSION["googleLogin"] = "true";
			$_SESSION["userLogin"] = "true";
			$_SESSION["uFirstName"] = $row["stuName"];
			$_SESSION["userStatus"] = $row["stuStatus"];
			$_SESSION["userID"] = $row["stuID"];

			if (strpos($prevURL, 'controller') !== false) {
				echo "<script type='text/javascript'>location.href = '../';</script>";
			}else{
				if($row["stuStatus"]==1){
					echo "<script type='text/javascript'>location.href = '$prevURL';</script>";
				}else{
					echo "<script type='text/javascript'>location.href = '../Admin/';</script>";
				}


			}
		}

	}else{
		
		$insertGoogleUserSQL = "INSERT INTO students (stuName,stuLast,stuEmail,stuUserName,stuContactNo,stuCity,stuStatus,tempPW) VALUES('$fname','$lname','$email','','','','1','')";

		if ($con->query($insertGoogleUserSQL) === true) {

			$getDetailsSQL = "SELECT * FROM students WHERE stuEmail = '$email' ";
			$getDetailsResults = mysqli_query($con,$getDetailsSQL);

			if($row = mysqli_fetch_assoc($getDetailsResults)){

				$_SESSION["googleLogin"] = "true";
				$_SESSION["userLogin"] = "true";
				$_SESSION["uFirstName"] = $row["stuName"];
				$_SESSION["userStatus"] = $row["stuStatus"];
				$_SESSION["userID"] = $row["stuID"];

				if (strpos($prevURL, 'controller') !== false) {
					   echo "<script type='text/javascript'>location.href = '../';</script>";
				}else{
					echo "<script type='text/javascript'>location.href = '$prevURL';</script>";
				}
			}

		} else {
		    echo '<script type="text/javascript">location.href = "../login.php?error=try";</script>';
		}

	}
	exit();

?>