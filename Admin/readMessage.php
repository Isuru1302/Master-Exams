<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>


</head>
<body>

	<?php include_once("templates/header.php");?>

	<div class="wrapper">

            <jsp:include page="templates/header.jsp" /> 

            <div class="main-panel">
                <div class="content">
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-5">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div>
                                    <h2 class="text-white pb-2 fw-bold">Reply messages</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">

                                        <?php 
                                            if (isset($_GET['id'])) {
                                                $sid = $_GET['id'];
                                            }else{
                                                echo '<script type="text/javascript">location.href = "Subjects.php";</script>';
                                            }
                                        ?>

                                        <form action="readMessage.php?id=<?php echo $sid; ?>" method="POST" class="replyMsg">
                                            
                                            <?php 

                                                getMessageByID($sid);
                                                    while ($getmsgIDRow = $GLOBALS['$getMessageByIDResults']->fetch_assoc()) {

                                                        $msgBy = $getmsgIDRow["messageBy"];
                                                        $msgemail = $getmsgIDRow["messageEmail"];
                                                        $msgDate = $getmsgIDRow["messageDate"];
                                                        $message = $getmsgIDRow["message"];
                                            ?>

                                                Message ID:<br>
                                                <input type="text" name="msgID" value="<?php echo $sid; ?>" readonly><br>

                                                Message By:<br>
                                                <input type="text" name="msgBy" value="<?php echo $msgBy; ?>" readonly><br>
                                               
                                                Message Email:<br>
                                                <input type="text" name="msgEmail" value="<?php echo $msgemail; ?>" readonly><br>

                                                Message Date:<br>
                                                <input type="text" name="msgDate" value="<?php echo $msgDate; ?>" readonly><br>

                                                Message:<br>
                                                <textarea readonly rows="10"><?php echo $message; ?></textarea><br>

                                                Reply Message:<br>
                                                <textarea name="replymessage" rows="10"></textarea><br>

                                                <input type="submit" name="submitbtn" value="Reply" style="cursor: pointer;">

                                            <?php } ?>

                                        </form>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php

                    if(isset($_POST["submitbtn"])){
                        require_once('model/dao.php');
                        require 'phpmailer/PHPMailerAutoload.php';
                        $conn = dbConnection();
                        
                        $msgID = $_POST["msgID"];
                        $msgMail = $_POST["msgEmail"];
                        $msg = $_POST["replymessage"];

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
                        $mail->addAddress($msgMail);

                        $subject = "Master Exams";

                        $message = $msg;

                        $mail->Subject = $subject;
                        $mail->Body = $message;

                        if ($mail->send()){
                            $updateSQL = "UPDATE messages SET messageStatus = 0 WHERE messageID = '$msgID'";
                            $conn->query($updateSQL);
                            $conn->close();
                            echo '<script type="text/javascript">location.href = "messages.php";</script>';
                        }

                    }

                ?>

                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul class="nav">

                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Help
                                    </a>
                                </li>

                            </ul>
                        </nav>
                        <div class="copyright ml-auto">
                            Copyright ©2019 All rights reserved
                        </div>				
                    </div>
                </footer>
            </div>
        </div>

        <?php include_once("templates/jsIncludes.php");?>
    
	
</body>
</html>