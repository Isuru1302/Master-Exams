<?php 
	require_once('../model/dao.php');
	$stuID = $_POST["stu_ID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE students SET stuStatus = '0' WHERE stuID = '$stuID'";
	$conn->query($updateSQL);
	$conn->close();
?>