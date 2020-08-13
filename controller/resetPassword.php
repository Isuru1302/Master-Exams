<?php

	$resetEmail = $_POST["userEmailAddress"];

	require '../phpmailer/PHPMailerAutoload.php';
	require_once('Bcrypt.php');
	require_once('../model/dao.php');
	$conn = dbConnection();

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
	$mail->addAddress($resetEmail);
		

	$subject = "Master Exams Password Reset!!";
	$token = substr(md5(microtime()),rand(0,26),7);
	$dbtemp = Bcrypt::hashPassword($token, PASSWORD_DEFAULT);

	$userName = "";
	$resetGetUNameSQL = "SELECT stuUserName FROM students WHERE stuEmail = '$resetEmail'";
	$resetGetUNameResults = mysqli_query($conn,$resetGetUNameSQL);
	if($row = mysqli_fetch_assoc($resetGetUNameResults)){
		$userName = $row["stuUserName"];
	}


	$link = "http://masterexams.com/confirmEmail.php?uname=$userName&token=$token";

	$message = "<h3><b>click here to reset your password</b></h3><br><a style='color:white;font-weight:bold;background-color:#e0c21a;font-size:2em;padding:0.2em 3em 0.2em 3em;text-align:center;cursor: pointer;border-radius:10px;text-decoration: none;' href='$link'>Verify</a>";

	$mail->Subject = $subject;
	$mail->Body = $message;

	if ($mail->send()){
	    $resetPwSQL = "UPDATE students SET tempPW = '$dbtemp' WHERE stuEmail = '$resetEmail'";
	    if ($conn->query($resetPwSQL) === TRUE) {
		    echo "<script type='text/javascript'>location.href = '../login.php?reset=success';</script>";
		} else {
		    echo "<script type='text/javascript'>location.href = '../login?reset=error';</script>";
		}
	}

?>