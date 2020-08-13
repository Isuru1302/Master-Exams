<?php
	require_once('../model/dao.php');
	require_once('Bcrypt.php');

	$uid = $_POST["urluname"];
	$newpw = $_POST["newpw2"];

	$conn = dbConnection();

	$hasedPW = Bcrypt::hashPassword($newpw, PASSWORD_DEFAULT);


	$upPwSql = "UPDATE students SET stuPassword = '$hasedPW', stuStatus = 1, tempPW = '' WHERE stuID = '$uid' ";

	if ($conn->query($upPwSql) === TRUE) {
	    echo "<script type='text/javascript'>location.href = '../login.php?update=success';</script>";
	} else {
	    echo "<script type='text/javascript'>location.href = '../?update=error';</script>";
	}



?>