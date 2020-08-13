<?php 
	require_once('../model/dao.php');
	$qID = $_POST["qID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE faq SET status = '0' WHERE ID = '$qID'";
	$conn->query($updateSQL);
	$conn->close();
?>