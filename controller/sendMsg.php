<?php

	require_once('../model/dao.php');
	$uName = $_POST["u_name"];
	$uEmail = $_POST["u_email"];
	$uMsg = $_POST["u_message"];

	date_default_timezone_set("Asia/Colombo");
	$date = date("Y-m-d");

	$conn = dbConnection();

	$insSQL = "INSERT INTO messages (messageBy,messageEmail,message,messageDate,messageStatus) VALUES ('$uName','$uEmail','$uMsg','$date',1)";

	if($conn->query($insSQL)){
		echo "success";
	}else{
		echo "failed";
	}
?>