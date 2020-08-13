<!DOCTYPE html>
<html>
<head>
	<?php include_once("templates/headerIncludes.php"); 

	if (isset($_GET['pid'])) {
		$pid = $_GET['pid'];
	} else {
			echo '<script type="text/javascript">location.href = "index.php";</script>';
	}


	getsubImage($pid);

	if($ggetsubImageResults = $GLOBALS['$getsubImageResults']->fetch_assoc()) {
		$subImg = $ggetsubImageResults["subjectImage"];

	}

	?>

	<meta property="og:type"          content="website" />
    <meta property="og:title"         content="Master Exams" />
    <meta property="og:description"   content="අන්තර්ජාලය වඩා යහපත් අරමුනු කරා බාවිතා කරමින් දැනුම පසු පස හබායන ඔබට A/L වානිජ , ගණිත , කලා , තාක්ශන ,O/L විශයන් සහ වෙනත් ඔබට වැදගත් විභාග සදහා ප්‍රශ්න පත්තර පෙරහුරු වීමට ලබාදීම මෙම වෙබ් අඩවියෙන් බලලාපොරත්තු වේ." />
   	<meta property="og:image"         content="http://masterexams.com/<?php echo $subImg; ?>" />
	
	
	<style>
		body{
    		background: #f5f5f0;
		}

		.fa-search{
			color:#000;
		}

		.search-input button{
		    border:1px solid #fff;
		    padding:0.15em 0.5em;
		    margin-left: -0.33em;
		    background: #fff;
		    cursor: pointer;
		}

		.search-input button .fa{
		    transition: 0.3s;
		}


		.search-input button .fa:hover{
		     transform: scale(1.2);
		}


		.paper-container{
		    background: #fff!important;
		}

		.tab {
		  	display: none;
		}

		button {
		  	background-color: #4CAF50;
		  	color: #ffffff;
		  	border: none;
		  	padding: 10px 20px;
		  	font-size: 17px;
		  	font-family: Raleway;
		  	cursor: pointer;
		}

		button:hover {
		  	opacity: 0.8;
		}

		#prevBtn {
		  	background-color: #bbbbbb;
		}

		/* Make circles that indicate the steps of the form: */
		.step {
		  	height: 15px;
		  	width: 15px;
		  	margin: 0 2px;
		  	background-color: #bbbbbb;
		  	border: none;  
		  	border-radius: 50%;
		  	display: inline-block;
		  	opacity: 0.5;
		  	font-size: 10px;
		}

		.step.active {
		  	opacity: 1;
		}

		/* Mark the steps that are finished and valid: */
		.step.finish {
		  	background-color: #4CAF50;
		}

	</style>


	<script>
		
		function markAnswers(totalQ,paperID,stuID){
			document.getElementById("paperform").style.display = "none";
			document.getElementById("nextPrevBtns").style.display = "none";

			var answerlist = [];

			for(var i=1;i<=totalQ;i++){
				var selectedAns = $('#multipleanswers'+i+' input:radio:checked').val();

				if(selectedAns===undefined){
					pusharrayAns = 0;
				}else{
					pusharrayAns = selectedAns;
				}

				answerlist.push(pusharrayAns);
			}
			var answersString = answerlist.join();
		
			$.ajax({
                type: 'post',
                url: 'controller/paperMarking.php',
                data: {
                	paper_ID:paperID,
                	stu_ID:stuID,
                	q_count:totalQ,
                	answerlist:answersString,
                },
                success: function (response) {
                	$('#markingScheme').html(response);
                }
            });

		}

		function gobacktoPaper(){
			document.getElementById("paperform").reset();
			document.getElementById("markingScheme").style.display = "none";
			location.reload(); 
		}

		</script>


</head>
<body>

	<header class="header-area">
        <?php 
        	include_once("templates/topHeader.php");
        ?>
	</header>

	<div class="body-wrapper">
		<div class="container">

			<?php 
				if(!isset($_SESSION['userLogin']) && empty($_SESSION['userLogin'])){
					$disClass = "disabled";

					

					
			?>
				<div class="paper-container" id="loginwarningmsg" style="color: red;font-weight: bold;">
					<center>You should login to the website first.</center>
				</div>
			<?php } else{ 

				if(isset($_SESSION['userID'])){
						$studentID = $_SESSION['userID'];
					}else{
						$studentID = 0;
					}

				$disClass = "";}?>



			<div class="paper-container">
				<div class="col-12">
					<div class="paper-heading text-center">
						<h4><b>
							<?php 
								
								getPaperNameByID($pid);
								if($getPaperNameByIDResults = $GLOBALS['$getPaperNameByIDResults']->fetch_assoc()) {
									$paperName = $getPaperNameByIDResults["paperName"];

									echo $paperName;
								}
								$numofQ = getpaperQCount($pid);
								

							?>
							
						</b></h4>
					</div>

					<div class="paper">
						<form method="POST" id="paperform">

							<div class="tab">
								<?php 
									$x=0;
									getpaperQuestions($pid,0);
									while($getPQRow = $GLOBALS['$getpaperQuestionsResults']->fetch_assoc()){
									$paperQ1 = $getPQRow["question"];
									$paperIMG1 = $getPQRow["questionImage"];
									$ans11 = $getPQRow["answer1"];
									$ans21 = $getPQRow["answer2"];
									$ans31 = $getPQRow["answer3"];
									$ans41 = $getPQRow["answer4"];
									$ans51 = $getPQRow["answer5"];
									$qid1 = $getPQRow["questionID"];

									$a=$x+1;
									$x=$a;
								?>


									<div class="paper-questions">
										
										<div class="question">
											<p><b>
												<?php echo $a; ?>)&nbsp;<?php echo $paperQ1; ?>
											</b></p>
										</div>

										<?php if($paperIMG1!= ""){ ?>
											<div class="<?php if($paperQ1!="") { ?>
													question-images
													<?php } else{?> question-images2 <?php } ?>">
												<img class="img-fluid" src="<?php echo $paperIMG1; ?>" id="inline" >
											</div>
										<?php } ?>

										<div class="multiple-answers">
											<fieldset id="multipleanswers<?php echo $a; ?>" name="multipleanswers" class="multipleanswers" <?php echo $disClass; ?>  >
												<input type="radio" name="answerValueQ<?php echo $a; ?>" value="1" id="answerValueQ<?php echo $a; ?>">&nbsp;&nbsp;<?php echo $ans11; ?>
												<br>
												<input type="radio" name="answerValueQ<?php echo $a; ?>" value="2" id="answerValueQ<?php echo $a; ?>">&nbsp;&nbsp;<?php echo $ans21; ?>
												<br>
												<input type="radio" name="answerValueQ<?php echo $a; ?>" value="3" id="answerValueQ<?php echo $a; ?>">&nbsp;&nbsp;<?php echo $ans31; ?>
												<br>
												<input type="radio" name="answerValueQ<?php echo $a; ?>" value="4" id="answerValueQ<?php echo $a; ?>">&nbsp;&nbsp;<?php echo $ans41; ?>
												<br>
												<input type="radio" name="answerValueQ<?php echo $a; ?>" value="5" id="answerValueQ<?php echo $a; ?>">&nbsp;&nbsp;<?php echo $ans51; ?>
												<br>
											</fieldset>
										</div>
									</div>
									<hr>


								<?php  }?>
							</div>

							<?php if($numofQ>10){?>
								<div class="tab">
									<?php 
										$y=10;
										getpaperQuestions($pid,10);
										while($getPQRow2 = $GLOBALS['$getpaperQuestionsResults']->fetch_assoc()){
										$paperQ2 = $getPQRow2["question"];
										$paperIMG2 = $getPQRow2["questionImage"];
										$ans12 = $getPQRow2["answer1"];
										$ans22 = $getPQRow2["answer2"];
										$ans32 = $getPQRow2["answer3"];
										$ans42 = $getPQRow2["answer4"];
										$ans52 = $getPQRow2["answer5"];
										$qid2 = $getPQRow2["questionID"];

										$b=$y+1;
										$y=$b;
									?>
									<div class="paper-questions">

										<div class="question">
											<p><b><?php echo $b; ?>)&nbsp;<?php echo $paperQ2; ?></b></p>
										</div>

										<?php if($paperIMG2!= ""){ ?>
											<div class="<?php if($paperQ2!="") { ?>
													question-images
													<?php } else{?> question-images2 <?php } ?>">
												<img class="img-fluid" src="<?php echo $paperIMG2; ?>" id="inline"  style="">
											</div>
										<?php } ?>

										<div class="multiple-answers">

											<fieldset id="multipleanswers<?php echo $b; ?>" name="multipleanswers" class="multipleanswers" <?php echo $disClass; ?>>
												<input type="radio" name="answerValueQ<?php echo $b; ?>" value="1">&nbsp;&nbsp;<?php echo $ans12; ?>
												<br>
												<input type="radio" name="answerValueQ<?php echo $b; ?>" value="2">&nbsp;&nbsp;<?php echo $ans22; ?>
												<br>
												<input type="radio" name="answerValueQ<?php echo $b; ?>" value="3">&nbsp;&nbsp;<?php echo $ans32; ?>
												<br>
												<input type="radio" name="answerValueQ<?php echo $b; ?>" value="4">&nbsp;&nbsp;<?php echo $ans42; ?>
												<br>
												<input type="radio" name="answerValueQ<?php echo $b; ?>" value="5">&nbsp;&nbsp;<?php echo $ans52; ?>
												<br>
											</fieldset>
										</div>
									</div>
									<hr>
								<?php } ?>
								</div>
							<?php } ?>

							<?php if($numofQ>20){?>
								<div class="tab">
									<?php 
										$z=20;
										getpaperQuestions($pid,20);
										while($getPQRow3 = $GLOBALS['$getpaperQuestionsResults']->fetch_assoc()){
										$paperQ3 = $getPQRow3["question"];
										$paperIMG3 = $getPQRow3["questionImage"];
										$ans13 = $getPQRow3["answer1"];
										$ans23 = $getPQRow3["answer2"];
										$ans33 = $getPQRow3["answer3"];
										$ans43 = $getPQRow3["answer4"];
										$ans53 = $getPQRow3["answer5"];
										$qid3 = $getPQRow3["questionID"];

										$c = $z+1;
										$z = $c;
									?>
										<div class="paper-questions">

											<div class="question">
												<p><b><?php echo $c; ?>)&nbsp;<?php echo $paperQ3; ?></b></p>
											</div>

											<?php if($paperIMG3!= ""){ ?>
												<div class="<?php if($paperQ3=="") { ?>
														question-images
														<?php } else{?> question-images2 <?php } ?>">
													<img class="img-fluid" src="<?php echo $paperIMG3; ?>" id="inline"  style="">
												</div>
											<?php } ?>

											<div class="multiple-answers">
												<fieldset id="multipleanswers<?php echo $c; ?>" name="multipleanswers" class="multipleanswers" <?php echo $disClass; ?>>
													<input type="radio" name="answerValueQ<?php echo $c; ?>" value="1">&nbsp;&nbsp;<?php echo $ans13; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $c; ?>" value="2">&nbsp;&nbsp;<?php echo $ans23; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $c; ?>" value="3">&nbsp;&nbsp;<?php echo $ans33; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $c; ?>" value="4">&nbsp;&nbsp;<?php echo $ans43; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $c; ?>" value="5">&nbsp;&nbsp;<?php echo $ans53; ?>
													<br>
												</fieldset>
											</div>
										</div>
										<hr>
									<?php } ?>
								</div>
							<?php } ?>

							<?php if($numofQ>30){?>
								<div class="tab">
									<?php 
										$v = 30;

										getpaperQuestions($pid,30);
										while($getPQRow4 = $GLOBALS['$getpaperQuestionsResults']->fetch_assoc()){
										$paperQ4 = $getPQRow4["question"];
										$paperIMG4 = $getPQRow4["questionImage"];
										$ans14 = $getPQRow4["answer1"];
										$ans24 = $getPQRow4["answer2"];
										$ans34 = $getPQRow4["answer3"];
										$ans44 = $getPQRow4["answer4"];
										$ans54 = $getPQRow4["answer5"];
										$qid4 = $getPQRow4["questionID"];

										$d = $v+1;
										$v = $d;
									?>
										<div class="paper-questions">

											<div class="question">
												<p><b><?php echo $d; ?>)&nbsp;<?php echo $paperQ4; ?></b></p>
											</div>

											<?php if($paperIMG4!= ""){ ?>
												<div class="<?php if($paperQ!="") { ?>
														question-images
														<?php } else{?> question-images2 <?php } ?>">
													<img class="img-fluid" src="<?php echo $paperIMG4; ?>" id="inline"  style="">
												</div>
											<?php } ?>

											<div class="multiple-answers">
												<fieldset id="multipleanswers<?php echo $d; ?>" name="multipleanswers" class="multipleanswers"<?php echo $disClass; ?> >
													<input type="radio" name="answerValueQ<?php echo $d; ?>" value="1">&nbsp;&nbsp;<?php echo $ans14; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $d; ?>" value="2">&nbsp;&nbsp;<?php echo $ans24; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $d; ?>" value="3">&nbsp;&nbsp;<?php echo $ans34; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $d; ?>" value="4">&nbsp;&nbsp;<?php echo $ans44; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $d; ?>" value="5">&nbsp;&nbsp;<?php echo $ans54; ?>
													<br>
												</fieldset>
											</div>
										</div>
										<hr>
									<?php } ?>
								</div>
							<?php } ?>

							<?php if($numofQ>40){?>
								<div class="tab">
									<?php 

										$s = 40;

										getpaperQuestions($pid,40);
										while($getPQRow5 = $GLOBALS['$getpaperQuestionsResults']->fetch_assoc()){
										$paperQ5 = $getPQRow5["question"];
										$paperIMG5 = $getPQRow5["questionImage"];
										$ans15 = $getPQRow5["answer1"];
										$ans25 = $getPQRow5["answer2"];
										$ans35 = $getPQRow5["answer3"];
										$ans45 = $getPQRow5["answer4"];
										$ans55 = $getPQRow5["answer5"];
										$qid5 = $getPQRow5["questionID"];

										$e = $s+1;
										$s = $e;
									?>
										<div class="paper-questions">

											<div class="question">
												<p><b><?php echo $e; ?>)&nbsp;<?php echo $paperQ5; ?></b></p>
											</div>

											<?php if($paperIMG5!= ""){ ?>
												<div class="<?php if($paperQ!="") { ?>
														question-images
														<?php } else{?> question-images2 <?php } ?>">
													<img class="img-fluid" src="<?php echo $paperIMG5; ?>" id="inline"  style="">
												</div>
											<?php } ?>

											<div class="multiple-answers">
												<fieldset id="multipleanswers<?php echo $e; ?>" name="multipleanswers" class="multipleanswers"<?php echo $disClass; ?> >
													<input type="radio" name="answerValueQ<?php echo $e; ?>" value="1">&nbsp;&nbsp;<?php echo $ans15; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $e; ?>" value="2">&nbsp;&nbsp;<?php echo $ans25; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $e; ?>" value="3">&nbsp;&nbsp;<?php echo $ans35; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $e; ?>" value="4">&nbsp;&nbsp;<?php echo $ans45; ?>
													<br>
													<input type="radio" name="answerValueQ<?php echo $e; ?>" value="5">&nbsp;&nbsp;<?php echo $ans55; ?>
													<br>
												</fieldset>
											</div>
										</div>
										<hr>
									<?php } ?>
								</div>
							<?php } ?>

							<div style="text-align:center;margin-top:40px;">
							    <span class="step">1</span>

							    <?php if($numofQ>10){?>
							    	<span class="step">2</span>
							    <?php } ?>
							    <?php if($numofQ>20){?>
							    	<span class="step">3</span>
							    <?php } ?>
							    <?php if($numofQ>30){?>
							    	<span class="step">4</span>
							    <?php } ?>
							    <?php if($numofQ>40){?>
							    	<span class="step">5</span>
							    <?php } ?>
							</div>
						</form>

							<div style="overflow:auto;" id="nextPrevBtns">
						    	<div style="float:right;">
						      		<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
						      		<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
						      		<button id="subBtn" style="display: none;"
						      		onclick="markAnswers(<?php echo $numofQ;?>,<?php echo $pid; ?>,<?php  echo $studentID;?>)" 

						      		>
						      			Submit
						      		</button>
						    	</div>
						  	</div>

						  	<div id="markingScheme">


						  	</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	

	<?php include_once("templates/jsIncludes.php"); ?>

	<?php include_once("templates/footer.php"); ?>


	<script>
		var currentTab = 0;
		showTab(currentTab);


		function showTab(n) {
			// This function will display the specified tab of the form...
			var x = document.getElementsByClassName("tab");
			x[n].style.display = "block";
			//... and fix the Previous/Next buttons:
			if (n == 0) {
			  	document.getElementById("prevBtn").style.display = "none";
			} else {
			    document.getElementById("prevBtn").style.display = "inline";
			}
			if (n == (x.length - 1)) {
				document.getElementById("nextBtn").style.display = "none";
				document.getElementById("subBtn").style.display = "inline";
			} else {	
				document.getElementById("subBtn").style.display = "none";
			  	document.getElementById("nextBtn").style.display = "inline";
			}
			  
			fixStepIndicator(n)
		}

		function nextPrev(n) {
			// This function will figure out which tab to display
			var x = document.getElementsByClassName("tab");
			// Exit the function if any field in the current tab is invalid:
			if (n == 1 && !validateForm()) return false;
			// Hide the current tab:
			x[currentTab].style.display = "none";
			// Increase or decrease the current tab by 1:
			currentTab = currentTab + n;
			// if you have reached the end of the form...
			if (currentTab >= x.length) {
			  	// ... the form gets submitted:
			  	//document.getElementById("paperform").submit();
			  	return false;
			}
			// Otherwise, display the correct tab:
			showTab(currentTab);
		}

		function validateForm() {
		  	// This function deals with validation of the form fields
			var  valid = true;
			
		  	// If the valid status is true, mark the step as finished and valid:
			  	if (valid) {
			    	document.getElementsByClassName("step")[currentTab].className += " finish";
			  	}
		  	return valid; // return the valid status
		}

		function fixStepIndicator(n) {
		  	// This function removes the "active" class of all steps...
		  	var i, x = document.getElementsByClassName("step");
			  for (i = 0; i < x.length; i++) {
			    x[i].className = x[i].className.replace(" active", "");
			  }
			  //... and adds the "active" class on the current step:
			  x[n].className += " active";
		}
	</script>

</body>
</html>