<?php 
	require_once('../model/dao.php');
	$qID = $_POST["qID"];
	$faq = $_POST["ques"];
	$ans = $_POST["ans"];
	$conn = dbConnection();

	$updateSQL = "UPDATE faq SET FAQ = '$faq', answer = '$ans' WHERE ID = '$qID'";
	$conn->query($updateSQL);
	$conn->close();
?>