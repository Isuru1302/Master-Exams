<!DOCTYPE html>
<html>
<head>
	<?php include_once("templates/headerIncludes.php"); ?>
	<style>
		body{
    		background: #f5f5f0;
		}


		.paper-container{
		    background: #fff!important;
		}

	</style>

	<script>

		function updateForm(ID){
			var ufname = document.getElementById("ufname").value;
			var ulname = document.getElementById("ulname").value;
			var uemail = document.getElementById("uemail").value;
			var ucon = document.getElementById("ucon").value;
			var ucity = document.getElementById("ucity").value;

			if(ufname && uemail && ucon && ucity && ulname){
				
				//document.getElementById("allp").style.display = "none";
				$.ajax({
	                type: 'post',
	                url: 'controller/updateProfile.php',
	                data: {
		               	stuID:ID,
		                stuName:ufname,
		                stuLName:ulname,
		                stuEmail:uemail,
		                stuCon:ucon,
		                stuCity:ucity,

	                },
	                success: function (response) {
	                    $("#edituDetails").load(location.href + " #edituDetails");
	                    $("#edituDetailsFiledset").attr("disabled");
	                    document.getElementById("uedit").style.display = "block";
						document.getElementById("updateb").style.display = "none";
	                }
	            });
			}
			else{
				document.getElementById("allp").style.display = "block";
			}
		}

		function enableUpdate(){
			$("#edituDetailsFiledset").removeAttr("disabled");
			document.getElementById("uedit").style.display = "none";
			document.getElementById("updateb").style.display = "block";
		}

		function updatePWView(){
			document.getElementById("editPWForm").style.display = "block";
			document.getElementById("upPW").style.display = "block";
			document.getElementById("editPW").style.display = "none";
		}

		function passcheck(){
			var newpw1 =document.getElementById("newpw1").value;
			var newpw2 =document.getElementById("newpw2").value;

			if(newpw1===newpw2){
				document.getElementById("matchPW").style.display = "block";
				document.getElementById("notmatchPW").style.display = "none";
			}else{
				document.getElementById("matchPW").style.display = "none";
				document.getElementById("notmatchPW").style.display = "block";
			}
		}

		function passlength(){
			var newpw1 =document.getElementById("newpw1").value;
			var n = newpw1.length; 
			if(n<5){
				document.getElementById("pwlength").style.display = "block";
			}else{
				document.getElementById("pwlength").style.display = "none";
			}
		}

		function updatePW(ID){
			var newpw1 =document.getElementById("newpw1").value;
			var newpw2 =document.getElementById("newpw2").value;
			var n = newpw1.length; 

			if(newpw1===newpw2 && n>4){
				
				$.ajax({
	                type: 'post',
	                url: 'controller/updatePw.php',
	                data: {
		               	stuID:ID,
		                newPw:newpw2,
	                },
	                success: function (response) {
	                   	if(response==="success"){
	                   		document.getElementById("pwupok").style.display = "block";
	                   		document.getElementById("pwuperror").style.display = "none";
	                   		document.getElementById("editPWForm").style.display = "none";
	                   		document.getElementById("upPW").style.display = "none";
	                   		document.getElementById("editPW").style.display = "block";
	                   		document.getElementById("editPWForm").reset(); 
	                   		document.getElementById("matchPW").style.display = "none";
	                   	}else{
	                   		document.getElementById("pwupok").style.display = "none";
	                   		document.getElementById("pwuperror").style.display = "block";
	                   		document.getElementById("editPWForm").style.display = "none";
	                   		document.getElementById("upPW").style.display = "none";
	                   		document.getElementById("editPW").style.display = "block";
	                   		document.getElementById("editPWForm").reset();
	                   		document.getElementById("matchPW").style.display = "none";
	                   	}
	                }
	            });


			}else{
				document.getElementById("upPW").style.cursor= "no-drop";
			}
		}

	</script>

</head>

<body>
	<header class="header-area">
        <?php 
        	include_once("templates/topHeader.php");
        	include_once("templates/checkLogin.php");
        ?>
	</header>

	<div class="body-wrapper">
		<div class="container">
			<div class="paper-container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-4 col-lg-3 profile-details" id="profiledetails">
						<center>
							<img src="images/defaultuser.png" style="height: 10em;margin-bottom: 0.5em;">
						</center>

						<form id="edituDetails">

							<?php 

								getStuDetails($userID);
								while($getURow = $GLOBALS['$getStuDetailsResults']->fetch_assoc()){
									$fname = $getURow["stuName"];
									$lname = $getURow["stuLast"];
									$email = $getURow["stuEmail"];
									$cnum = $getURow["stuContactNo"];
									$city = $getURow["stuCity"];
									$udis = $getURow["udistrict"];
									if($cnum==0){
										$disCnum = 'placeholder="Contact No"';
									}else{
										$disCnum = "value=".$cnum;
									}

									if($city==""){
										$disCAddress = 'placeholder="Address"';
									}else{
										$disCAddress = "value=".$city;
									}

									if($udis==""){
										$udist = 'placeholder="District"';
									}else{
										$udist = "value=".$udis;
									}
									
									
								}
							?>
							<fieldset disabled="disabled" id="edituDetailsFiledset">
								<input type="text" name="ufname" id="ufname" value="<?php echo $fname; ?>" required>
								<input type="text" name="ulname" id="ulname" value="<?php echo $lname; ?>" required>
								<input type="email" name="uemail" id="uemail" value="<?php echo $email; ?>" readonly disabled>
								<input type="text" onkeypress="allowNumbersOnly(event)" id="ucon" maxlength="10" name="ucon" <?php echo $disCnum; ?> required>
								<input type="text" name="ucity" id="ucity" <?php echo $disCAddress; ?> required>
								
							</fieldset>
							<p id="allp" style="color: red;display: none;">All the fields are required</p>
						</form>

						<center>
							<div class="upEdit">

								<input type="submit" onclick="updateForm(<?php echo $userID; ?>)" id="updateb" style="display: none;" name="updateb" value="Update">

								<input type="submit" onclick="enableUpdate()" id="uedit" name="uedit" value="Edit">

								<hr>
								<?php if(!isset($_SESSION["googleLogin"])) {?>
									<button id="editPW" onclick="updatePWView()">Change Password</button>
								<?php } ?>

								<p id="pwupok" style="color: green;display: none;">Password updated successfully!!</p>
								<p id="pwuperror" style="color: red;display: none;">Error, Try again!!</p>
							</div>
						</center>

						<form id="editPWForm" autocomplete="off">
							<input type="password" name="newpw1" id="newpw1" placeholder="New password" autocomplete="new-password" minlength="5" required onkeyup="passlength()" onkeydown="passlength()" onkeypress="passlength()"> 
							<input type="password" name="newpw2" id="newpw2" placeholder="New password Again" required onkeyup="passcheck()" onkeydown="passcheck()" onkeypress="passcheck()">
							<p id="notmatchPW" style="color: red;display: none;">Passwords are not matching!</p>
							<p id="matchPW" style="color: green;display: none;">Passwords are matching!</p>
							<p id="pwlength" style="display: none;color: red;">Passwords use at least 5 characters</p>
						</form>

						
							<button id="upPW" onclick="updatePW(<?php echo $userID; ?>)">Update Password</button>
						
					</div>
					<div class="col-12 col-sm-12 col-md-8 col-lg-9 profile-results">
						<div class="col-12 Overall">
							<h5>Overall</h5>

							<div class="row">
								<div class="col-6 col-sm-3">
									<div id="circles-1" class="20"></div>
									<p>All Papers</p>
								</div>

								<div class="col-6 col-sm-3">
									<div id="circles-2" class="20"></div>
									<p>Completed</p>
								</div>

								<div class="col-6 col-sm-3">
									<div id="circles-3" class="20"></div>
									<p>Total Marks</p>
								</div>

								<div class="col-6 col-sm-3">
									<div id="circles-4" class="20"></div>
									<p>Average</p>
								</div>
							</div>
							<a href="mypapers.php" style="color: blue;float: right;">See All >></a>

						</div>
						<div class="col-12 Recently">
							<h5>Papers you have done recently</h5>
							<div class="row">

								<?php 
									getRecentDonePapers($userID);
									while($getRow = $GLOBALS['$getRecentDonePapersResults']->fetch_assoc()){
								?>
								<div class="col-6 col-sm-6 col-md-3">
									<img src="<?php echo $getRow["subjectImage"];?>" alt="paper-cover-image" style="height: 6em;width: 100%;">
									<p><b><?php echo $getRow["paperName"];?></b></p>
								</div>
								
								<?php } ?>

							</div>
							
						</div>
					</div>
				</div>

			</div>
		</div>


		<div class="paper-details">
			<?php
				
				$totPapers = getAllAPaperCount();
				$totCPapers = completePapersCount($userID);
				$totMarks = totalMarks($userID);
				$totalQ = calTotalCompleteQ($userID);
			?>

			<form style="display: none;">
				<input type="text" id="totPapers" value="<?php echo $totPapers; ?>">
				<input type="text" id="totCPapers" value="<?php echo $totCPapers; ?>">
				<input type="text" id="totMarks" value="<?php echo $totMarks; ?>">
				<input type="text" id="totalQ" value="<?php echo $totalQ; ?>">
			</form>

		</div>



		<!-- Web Details -->
			<?php include_once("templates/webdetails.php"); ?>
        <!-- Web Details End-->

	</div>

	 <?php include_once("templates/jsIncludes.php"); ?>

	 <?php include_once("templates/footer.php"); ?>

	 <script>
            var totPapers = document.getElementById("totPapers").value;
           	var totCPapers = document.getElementById("totCPapers").value;
           	var totMarks = document.getElementById("totMarks").value;
           	var totalQ = document.getElementById("totalQ").value;

           	var finaltotcPapers = (totCPapers/totPapers)*100;
           	var finalTotalQ = (totMarks/totalQ)*100;
            
            var questionCount = "10";
            Circles.create({
                id: 'circles-1',
                radius: 50,
                value: 100,
                maxValue: 100,
                width: 7,
                text: totPapers,
                colors: ['#f1f1f1', '#FF9E27'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            

            Circles.create({
                id: 'circles-2',
                radius: 50,
                value: finaltotcPapers,
                maxValue: 100,
                width: 7,
                text: totCPapers,
                colors: ['#f1f1f1', '#F25961'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-3',
                radius: 50,
                value: 100,
                maxValue: 100,
                width: 7,
                text: totMarks,
                colors: ['#f1f1f1', '#2ff72f'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            

            Circles.create({
                id: 'circles-4',
                radius: 50,
                value: finalTotalQ,
                maxValue: 100,
                width: 7,
                text: finalTotalQ+"%",
                colors: ['#f1f1f1', '#5242ff'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })
    </script>
</body>

</html>