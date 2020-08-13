<?php

	function dbConnection(){
		$con = mysqli_connect("localhost","root" ,"Isuru2176@","quiz");

	    if (mysqli_connect_errno())
	    {
	        echo "Failed to connect to MySQL: " . mysqli_connect_error();
	    }

	    return $con;
	}

	function closeDBConnection(){
		$connection = dbConnection();
		$connection->close();
	}

    
?>