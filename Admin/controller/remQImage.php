<?php 
	require_once('../model/dao.php');
	$qID = $_POST["qID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE questions SET questionImage = '' WHERE questionID = '$qID'";
	$conn->query($updateSQL);
	$conn->close();
?>