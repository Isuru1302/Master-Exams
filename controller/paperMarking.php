
<style>

	.markingsc{
		padding-bottom:3em; 
	}

	.mulanswers{
		margin-bottom:1.5em;
	}

	.mcq-nums{
		padding: 0.3em 0.6em;
		border:1px solid black;
		border-radius: 50%;
		margin-left: 0.5em;
	}

	.mcqindex{
		float: left;
		width: 1.5em;
		text-align: right;
	}

	.correctans{
		background-size: 1.72em;
		background-repeat: no-repeat;
		background-image: url(images/correct.svg);

	}

	.wrongans{
		background-size: 1.72em;
		background-repeat: no-repeat;
		background-image: url(images/wrong.svg);
	}


	.notanswerd{
		background-size: 1.72em;
		background-repeat: no-repeat;
		background-image: url(images/notanswerd.svg);
	}

	.markingsc input[type=text] {
		text-align: center;
		padding: 0.5em;
		font-size: 1.5em;
		border-radius: 10px;
		background: #eee;
		border:1px solid #ddd;
		margin-bottom: 1em;
		width: 100%;
	}

	.okbtn{
		float: right;
		padding: 0.8em 5em;
		border-radius: 5px;
		background: #891130;
		border:1px solid #891130;
		color: #fff;
		cursor: pointer;
	}

	.search-input button{
		border:1px solid #fff!important;
		padding:0.15em 0.5em!important;
		margin-left: -0.33em!important;
		background: #fff!important;
		cursor: pointer!important;
	}

	.search-input button .fa{
		transition: 0.3s!important;
	}

	.search-input button .fa:hover{
		transform: scale(1.2)!important;
	}

</style>


<?php
	
	require_once('../model/dao.php');
	$con = dbConnection();



	$totalQ = $_POST["q_count"];
	$answerString = $_POST["answerlist"];
	$paperID = $_POST["paper_ID"];
	$stuID = $_POST["stu_ID"];


	$getAnsSql = "SELECT correctAnswer FROM questions WHERE paperID = '$paperID' AND questionStatus = 1 ORDER BY questionID ASC";
	$getAnsrs = $con->query($getAnsSql);

	$dbAnsArray = array();

	while($getARow = $getAnsrs->fetch_assoc()){
		array_push($dbAnsArray,$getARow["correctAnswer"]);

	}
	

	$ansArray = explode(',', $answerString);
	$correctArray= $dbAnsArray;
	
	$totalmarks = 0;

	for($j=0;$j<sizeof($ansArray);$j++){
		if($ansArray[$j]==$correctArray[$j]){
			$totalmarks++;
		}
	}

	$checkSQL = "SELECT * FROM answers WHERE stuID = '$stuID' AND paperID = '$paperID'";
	$checkSQLResults = mysqli_query($con,$checkSQL);

	date_default_timezone_set("Asia/Colombo");
	$date = date("Y-m-d");

	if(mysqli_num_rows($checkSQLResults)>0){
		$updsql = "UPDATE answers SET Marks = '$totalmarks',ansdate = '$date' WHERE stuID = '$stuID' AND paperID = '$paperID' ";
		$con->query($updsql);
		$con->close();
		
	}else{
		$insSQL = "INSERT INTO answers (stuID,paperID,Marks,ansdate) VALUES ('$stuID','$paperID','$totalmarks','$date')";
		$con->query($updateSQL);
		$con->close();
	}

	
	echo '<div class= "markingsc">';
		echo '<div class="container"> ';
			echo '<div class="row "> ';

			for($i=0;$i<$totalQ;$i++){

				$stuAns = $ansArray[$i];
				$corAns = $correctArray[$i];

				if($stuAns==$corAns){
					$styleAns = "correctans";
				}else{
					$styleAns = "wrongans";
				}

				echo '<div class="col-12 col-sm-6 col-md-4 mulanswers"> ';

					echo '<div class="mcqindex">'.($i+1).')</div>';
						
							if($stuAns==1){
								echo '<span class="mcq-nums '.$styleAns.'">1</span>';
								
							}else{

								if($corAns==1 && $stuAns==""){
									echo '<span class="mcq-nums notanswerd">1</span>';
								}
								else if($corAns==1 && $stuAns!=""){
									echo '<span class="mcq-nums correctans">1</span>';
								}
								else{
									echo '<span class="mcq-nums">1</span>';
								}
								
								
							}

							if($stuAns==2){
								echo '<span class="mcq-nums '.$styleAns.'">2</span>';
							}else{

								if($corAns==2 && $stuAns==""){
									echo '<span class="mcq-nums notanswerd">2</span>';
								}
								else if($corAns==2 && $stuAns!=""){
									echo '<span class="mcq-nums correctans">2</span>';
								}
								else{
									echo '<span class="mcq-nums">2</span>';
								}
								
								
							}

							if($stuAns==3){
								echo '<span class="mcq-nums '.$styleAns.'">3</span>';
							}else{

								if($corAns==3 && $stuAns==""){
									echo '<span class="mcq-nums notanswerd">3</span>';
								}
								else if($corAns==3 && $stuAns!=""){
									echo '<span class="mcq-nums correctans">3</span>';
								}
								else{
									echo '<span class="mcq-nums">3</span>';
								}
								
								
							}

							if($stuAns==4){
								echo '<span class="mcq-nums '.$styleAns.'">4</span>';
							}else{

								if($corAns==4 && $stuAns==""){
									echo '<span class="mcq-nums notanswerd">4</span>';
								}
								else if($corAns==4 && $stuAns!=""){
									echo '<span class="mcq-nums correctans">4</span>';
								}
								else{
									echo '<span class="mcq-nums">4</span>';
								}
								
								
							}

							if($stuAns==5){
								echo '<span class="mcq-nums '.$styleAns.'">5</span>';
							}else{

								if($corAns==5 && $stuAns==""){
									echo '<span class="mcq-nums notanswerd">5</span>';
								}
								else if($corAns==5 && $stuAns!=""){
									echo '<span class="mcq-nums correctans">5</span>';
								}
								else{
									echo '<span class="mcq-nums">5</span>';
								}
								
								
							}
						
				echo '</div>';
			}

			echo '</div>';
		
	$averageMarks = ($totalmarks/sizeof($ansArray))*100;

	if($averageMarks>74){
		include_once('baloon.php');
	}

	echo '<center>';
		echo "<b>Total questions</b><br>";
		echo '<input type="text" readonly value="'.sizeof($ansArray).'"><br>';
		echo "<b>Total Marks</b><br>";
		echo '<input type="text" readonly value="'.$totalmarks.'"><br>';
		echo "<b>Average</b><br>";
		echo '<input type="text" readonly value="'.$averageMarks.'%"><br>';
	echo '</center>';

	echo '<button class="okbtn" onclick="gobacktoPaper()">';
	echo "OK";
	echo '</button>';

		echo '</div>';
	echo '</div>';
	


?>
