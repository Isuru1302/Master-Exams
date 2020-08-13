<?php 
	if(!isset($_SESSION['userLogin']) && empty($_SESSION['userLogin'])) {
        echo "<script type='text/javascript'>location.href = 'index.php';</script>";
    }

    if(isset($_SESSION["userID"])){
    	$userID = $_SESSION['userID'];
    }else{
    	echo "<script type='text/javascript'>location.href = 'index.php';</script>";
    }
?>