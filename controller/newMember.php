<?php


	$firstName = $_POST["userFirst"];
	$lastName = $_POST["userLast"];
	$uEmail = $_POST["uEmail"];
	$contactNum = $_POST["cNumber"];
	$uCity = $_POST["usercity"];
	$adline2 = $_POST["adline2"];
	$userName = $_POST["username"];
	$olyear = $_POST["olyear"];
	$udistrict = $_POST["udistrict"];

	$uAddress = $uCity . " " . $adline2;

	require '../phpmailer/PHPMailerAutoload.php';
	require_once('Bcrypt.php');
	require_once('../model/dao.php');

	$mail = new PHPMailer();

	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->Username = 'masterexams123@gmail.com';
	$mail->Password = 'arachchi@1029';
	$mail->isHTML(true);
	$mail->ClearReplyTos();

	$mail->setFrom('masterexams123@gmail.com', 'No-Reply@masterexams');
	$mail->addAddress($uEmail);
		

	$subject = "Master Exams E-mail verification!!";
	$token = substr(md5(microtime()),rand(0,26),7);
	$dbToken = Bcrypt::hashPassword($token, PASSWORD_DEFAULT);

	$link = "http://masterexams.com/confirmEmail.php?uname=$userName&token=$token";

	$message = "<h1><i>Hello $userName !!!</i></h1><br><h3><b>click here to verify your email</b></h3><br><a style='color:white;font-weight:bold;background-color:#e0c21a;font-size:2em;padding:0.2em 3em 0.2em 3em;text-align:center;cursor: pointer;border-radius:10px;text-decoration: none;' href='$link'>Verify</a>";

	$mail->Subject = $subject;
	$mail->Body = $message;
	

	if ($mail->send()){
	    $conn = dbConnection();
		$newMemberSQL = "INSERT INTO students (stuName,stuLast,stuEmail,stuUserName,stuContactNo,stuCity,stuStatus,tempPW,olyear,udistrict) VALUES('$firstName','$lastName','$uEmail','$userName','$contactNum','$uAddress','0','$dbToken','$olyear','$udistrict')";

		if ($conn->query($newMemberSQL) === true) {
		    echo '<script type="text/javascript">location.href = "../?add=success";</script>';
		} else {
		    echo '<script type="text/javascript">location.href = "../register.php?error=try";</script>';
		}

	}else{
		echo '<script type="text/javascript">location.href = "../register.php?error=try";</script>';
	}
?>