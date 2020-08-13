<?php

	require_once('../model/dao.php');
	$conn = dbConnection();
	$mc = $_POST["main_C"];
	$ca = $_POST["cat_e"];
	$paper_name = $_POST["paper_Name"];

	date_default_timezone_set("Asia/Colombo");
	$date = date("Y-m-d");

	$addnewSubSQL = "INSERT INTO paper (paperName,subjectID,subSubjectiD,paperDate,paperStatus) VALUES ('$paper_name','$mc','$ca','$date','0')";
	$conn->query($addnewSubSQL);

	$conn->close();
?>