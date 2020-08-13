<!DOCTYPE html>
<html>
<head>
	<?php include_once("templates/headerIncludes.php"); ?>
	<link rel="stylesheet" type="text/css" href="css/loginCss.css">

	<script>
		function checkNewPW(){
			var newpw1 =document.getElementById("newpw1").value;
			var newpw2 =document.getElementById("newpw2").value;
			var n = newpw2.length; 

			if(newpw1===newpw2 && n>4){
				document.getElementById("confirmPW").submit(); 
			}else{
				document.getElementById("upbtn").style.cursor= "no-drop";
			}

		}

		function showhide2(){
		    var x = document.getElementById("newpw2");
		    if (x.type === "password") {
		        x.type = "text";
		    } else {
		        x.type = "password";
		    }
		}

		function passcheck(){
			var newpw1 =document.getElementById("newpw1").value;
			var newpw2 =document.getElementById("newpw2").value;
			
			if(newpw1===newpw2){
				document.getElementById("pwmatchingtext").innerHTML = "Passwords are matching";
				document.getElementById("pwmatchingtext").style.color = "green";
			}else{
				document.getElementById("pwmatchingtext").innerHTML = "Passwords are not matching";
				document.getElementById("pwmatchingtext").style.color = "red";
			}
		}

		function passlength(){
			var newpw1 =document.getElementById("newpw1").value;
			var n = newpw1.length; 

			if(n<5){
				document.getElementById("pwlengthtext").innerHTML = "Passwords use at least 5 characters";
				document.getElementById("pwlengthtext").style.color = "red";
			}else{
				document.getElementById("pwlengthtext").innerHTML = "";
			}
		}

	</script>
</head>

<body style="background-image: url(images/loginback.jpeg);">

	<?php

		if (!isset($_GET['uname']) || !isset($_GET['token'])) {
			echo '<script type="text/javascript">location.href = "index.php";</script>';
		}

		if (isset($_GET['uname'])) {
			$urlUname = $_GET['uname'];
		}

		if (isset($_GET['token'])) {
			$urlToken = $_GET['token'];
		}

		$status = confirmEmail($urlUname,$urlToken);
		
		if($status==0){
			echo '<script type="text/javascript">location.href = "index.php?error=noaccount";</script>';
		}

		else if($status==-1){
			echo '<script type="text/javascript">location.href = "index.php?error=already";</script>';
		}

		else{
			$selUID = getnewuID($urlUname);
			
		}
	?>

	<div class="login_form" style="display: block!important;">

            <div class="container-login100">
                <div class="wrap-login100">
                    <form class="login100-form validate-form" method="POST" action="controller/confirmPW.php" id="confirmPW">
                        <span class="login100-form-title p-b-26">
                            Welcome to<br> Master-Exams
                        </span>
                        
                        <input class="input100" style="display: none;" type="text" id="urlun" name="urlun" value="<?php echo $urlUname;?>">

                        <input class="input100" style="display: none;" type="text" id="urluname" name="urluname" value="<?php echo $selUID;?>">

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="Password" onkeyup="passlength()" onkeydown="passlength()" onkeypress="passlength()" minlength="5" id="newpw1" name="newpw1" placeholder="New Password"  required>
                        </div>
                        <p> <label id="pwlengthtext" style="margin-top: -2em;position: absolute;"></label></p>

                        <div class="wrap-input100 validate-input">
                        	<span class="btn-show-pass">
                                <i class="fa fa-eye" onclick="showhide2();" style="cursor: pointer;" aria-hidden="true"></i>
                            </span>
                            <input class="input100" onkeyup="passcheck()" onkeydown="passcheck()" onkeypress="passcheck()" type="Password" id="newpw2" minlength="5" name="newpw2" placeholder="Confirm Password" required>
                        </div>

                    </form>
                   	<p> <label id="pwmatchingtext" style="margin-top: -1.8em;position: absolute;"></label></p>

                    	<div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn" onclick="checkNewPW()">
                                    Update
                                </button>
                            </div>
                        </div>
                    

                </div>
            </div>

            <div class="d-flex justify-content-around " >

            </div>

        </div>

</body>
</html>