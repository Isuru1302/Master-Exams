<?php 
	require_once('../model/dao.php');
	$qID = $_POST["q_ID"];
	$conn = dbConnection();
	$updateSQL = "DELETE FROM questions WHERE questionID='$qID'";
	$conn->query($updateSQL);
	$conn->close();
?>