<?php
	require_once('../model/dao.php');
	$conn = dbConnection();

	$target_dir = "../../adImages/";
	$target_dir2 = "adImages/";
	$uploadOk = 1;

	$target_file = $target_dir . basename($_FILES["adimage"]["name"]);
    $filename = $target_dir2 . basename($_FILES["adimage"]["name"]);

    $adlink = $_POST["adLink"];
    date_default_timezone_set("Asia/Colombo");
    $date = date("Y-m-d");

    if (file_exists($target_file)) {
        echo '<script>alert("Image already exists")</script>';
            $uploadOk = 0;
    }else{
        $uploadOk = 1;
    }

    if ($uploadOk == 0) {
       echo '<script>alert("Sorry, your file was not uploaded.")</script>';
       echo '<script type="text/javascript">location.href = "../adver.php";</script>';
    }

    else{
        if (move_uploaded_file($_FILES["adimage"]["tmp_name"], $target_file)) {
            $addnewImgSQL = "INSERT INTO adver(AdImage,Link,adStatus,adDate) VALUES('$filename','$adlink','1','$date')";
            $conn->query($addnewImgSQL);
            echo '<script type="text/javascript">location.href = "../adver.php";</script>';
        }
    }
?>