<?php
	require_once('../model/dao.php');
	$conn = dbConnection();


	$stuID = $_POST["stuID"];
	$stuName = $_POST["stuName"];
	$stuLName = $_POST["stuLName"];
	$stuEmail = $_POST["stuEmail"];
	$stuCon = $_POST["stuCon"];
	$stuCity = $_POST["stuCity"];

	$upSQL = "UPDATE students SET stuName = '$stuName',stuLast = '$stuLName', stuEmail = '$stuEmail', stuCity = '$stuCity', stuContactNo = '$stuCon' WHERE stuID = '$stuID' ";

	$conn->query($upSQL);
	$conn->close();

?>