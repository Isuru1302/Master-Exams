<?php
	
	require_once('../model/dao.php');
	$conn = dbConnection();

	$target_dir = "../../images/";
	$target_dir2 = "images/";
	$uploadOk = 1;

	$target_file = $target_dir . basename($_FILES["subImage"]["name"]);
	$filename = $target_dir2 . basename($_FILES["subImage"]["name"]);
	$newSubName = $_POST["subName"];

	$checkSQL = "SELECT * FROM subjects WHERE subjectName = '$newSubName'";
	$checkSQLResults = mysqli_query($conn,$checkSQL);

	if(mysqli_num_rows($checkSQLResults)==0){


		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		if (file_exists($target_file)) {
		    echo '<script>alert("Image already exists")</script>';
		    $uploadOk = 0;
		}else{
			$uploadOk = 1;
		}

		if ($uploadOk == 0) {
		    echo '<script>alert("Sorry, your file was not uploaded.")</script>';
		    echo '<script type="text/javascript">location.href = "../main_subjects.php";</script>';
		} 

		else{
			if (move_uploaded_file($_FILES["subImage"]["tmp_name"], $target_file)) {
		        
				$addnewSubSQL = "INSERT INTO subjects (subjectName,subjectImage,subjectStatus) VALUES ('$newSubName','$filename','1')";
				$conn->query($addnewSubSQL);
				echo '<script type="text/javascript">location.href = "../main_subjects.php";</script>';

		    } else {
		        echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
		        echo '<script type="text/javascript">location.href = "../main_subjects.php";</script>';
		    }
		}
		
	}else{
		echo '<script>alert("Subject already exists")</script>';
		echo '<script type="text/javascript">location.href = "../main_subjects.php";</script>';
		
	}

	$conn->close();
?>