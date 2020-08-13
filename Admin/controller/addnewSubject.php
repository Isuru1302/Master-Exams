<?php
	
	require_once('../model/dao.php');
	$conn = dbConnection();
	$category = $_POST["category"];
	$newSub = $_POST["new_Sub"];

	$checkSQL = "SELECT * FROM subcategory WHERE subSubName = '$newSub' AND subID = '$category'";
	$checkSQLResults = mysqli_query($conn,$checkSQL);

	if(mysqli_num_rows($checkSQLResults)>0){
		echo "exists";
	}else{
		$addnewSubSQL = "INSERT INTO subcategory (subID,subSubName,subSubStatus) VALUES ('$category','$newSub','1')";
		$conn->query($addnewSubSQL);
		echo "added";
	}
	
	$conn->close();

?>