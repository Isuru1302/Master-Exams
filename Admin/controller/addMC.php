<?php 
	require_once('../model/dao.php');
	$subID = $_POST["sub_ID"];
	$conn = dbConnection();
	$updateSQL = "UPDATE subjects SET subjectStatus = '1' WHERE subjectID = '$subID'";
	$conn->query($updateSQL);
	$conn->close();
?>