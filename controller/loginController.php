<?php
	session_start();
	require_once('../model/dao.php');
	
	$username = $_POST["username"];
	$userpass = $_POST["uPassword"];
	$prevURL = $_POST["prevURL"];
	$con = dbConnection();

	$loginSql = "SELECT * FROM students WHERE (stuEmail = '$username' OR  stuUserName = '$username')";
	$loginResults =  mysqli_query($con,$loginSql);

	if($row = mysqli_fetch_assoc($loginResults)){
		$pass = $row["stuPassword"];
		require_once('Bcrypt.php');
		if(Bcrypt::checkPassword($userpass, $pass)){
			if($row["stuStatus"]==2){
				$_SESSION["userID"] = $row["stuID"];
				$_SESSION["userLogin"] = "true";
				$_SESSION["uFirstName"] = $row["stuName"];
				$_SESSION["userStatus"] = $row["stuStatus"];
				echo "<script type='text/javascript'>location.href = '../Admin/';</script>";
			}

			elseif($row["stuStatus"]==1){
				$_SESSION["userID"] = $row["stuID"];
				$_SESSION["userLogin"] = "true";
				$_SESSION["uFirstName"] = $row["stuName"];
				$_SESSION["userStatus"] = $row["stuStatus"];
				if (strpos($prevURL, 'controller') !== false) {
				    echo "<script type='text/javascript'>location.href = '../';</script>";
				}else{
					echo "<script type='text/javascript'>location.href = '$prevURL';</script>";
				}

				
			}

			else{
				$_SESSION["prevurl"] = $prevURL;
				echo "<script type='text/javascript'>location.href = '../?error=confirm';</script>";
			}
		}

		else{
			$_SESSION["prevurl"] = $prevURL;
		 	echo '<script type="text/javascript">location.href = "../login.php?error=wrongpw";</script>';
		}

		

	}
	else{
		$_SESSION["prevurl"] = $prevURL;
		echo '<script type="text/javascript">location.href = "../login.php?error=noaccount";</script>';
	}
?>