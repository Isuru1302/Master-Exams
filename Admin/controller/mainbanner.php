<?php
	require_once('../model/dao.php');
	$conn = dbConnection();

	$target_dir = "../../images/mainbanner/";
	$target_dir2 = "images/mainbanner/";
	$uploadOk = 1;

	$target_file = $target_dir . basename($_FILES["mbimage"]["name"]);
    $filename = $target_dir2 . basename($_FILES["mbimage"]["name"]);

    if (file_exists($target_file)) {
        echo '<script>alert("Image already exists")</script>';
            $uploadOk = 0;
    }else{
        $uploadOk = 1;
    }

    if ($uploadOk == 0) {
       echo '<script>alert("Sorry, your file was not uploaded.")</script>';
       echo '<script type="text/javascript">location.href = "../mainbanner.php";</script>';
    }

    else{
        if (move_uploaded_file($_FILES["mbimage"]["tmp_name"], $target_file)) {
            $addnewImgSQL = "INSERT INTO mainbanner(bannerImage,imageStatus) VALUES('$filename','1')";
            $conn->query($addnewImgSQL);
            echo '<script type="text/javascript">location.href = "../mainbanner.php";</script>';
        }
    }
?>