<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>

    <script>
        
        function removePic(qID){
            $.ajax({
                type: 'post',
                url: 'controller/remQImage.php',
                data: {
                    qID:qID,  
                },
                    success: function (response) {
                        document.getElementById("oldImg").style.display = "none";
                        document.getElementById("rembtn").style.display = "none";
                    }
                });

            }

    </script>
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
                                    <h2 class="text-white pb-2 fw-bold">Edit Subjects</h2>
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

                                            if (isset($_GET['pid'])) {

                                                $pid = $_GET['pid'];

                                                if (isset($_GET['id'])) {
                                                    $sid = $_GET['id'];
                                                }else{
                                                    echo '<script type="text/javascript">location.href = "addQuestions.php?id='. $pid.'";</script>';
                                                }
                                            }
                                            else{
                                                echo '<script type="text/javascript">location.href = ""addQuestions.php?id='. $pid.'";</script>';
                                            }
                                        ?>

                                        <form action="editQ.php?pid=<?php echo $pid; ?>&id=<?php echo $sid; ?>" method="POST" class="editQues" enctype="multipart/form-data">
                                            
                                            <?php
                                              getQbyQID($sid);

                                              while ($getQRow = $GLOBALS['$getQbyQIDResults']->fetch_assoc()) {

                                                $ques = $getQRow["question"];
                                                $ans1 = $getQRow["answer1"];
                                                $ans2 = $getQRow["answer2"];
                                                $ans3 = $getQRow["answer3"];
                                                $ans4 = $getQRow["answer4"];
                                                $ans5 = $getQRow["answer5"];
                                                $cans = $getQRow["correctAnswer"];
                                                $oldImage = $getQRow["questionImage"];
                                            }

                                            ?>  

                                            <input style="display: none;" type="text" value="<?php echo $pid; ?>" name="pID">
                                            <input style="display: none;" type="text" name="oldImage" readonly value="<?php echo $oldImage;?>"><br>


                                            Question:<br>
                                            <input type="text" name="ques"  value="<?php echo $ques;?>"><br>

                                            Question Image<br>

                                            <?php if($oldImage!=""){ ?>

                                                <a id="oldImg" href="../<?php echo $oldImage; ?>"><img src="../<?php echo $oldImage; ?>" style="height: 5em;float: left;"></a><br>

                                           

                                            <button id="rembtn" type="button" style="margin-left: 2em;cursor: pointer;" onclick="removePic(<?php echo $sid; ?>)">Remove</button>

                                             <?php } ?>
                                            
                                            <input type="file" name="questionImage" accept="image/*"><br>

                                            Answer 1:<br>
                                            <input type="text" name="ans1" required value="<?php echo $ans1;?>"><br>

                                            Answer 2:<br>
                                            <input type="text" name="ans2" required value="<?php echo $ans2;?>"><br>

                                            Answer 3:<br>
                                            <input type="text" name="ans3" required value="<?php echo $ans3;?>"><br>

                                            Answer 4:<br>
                                            <input type="text" name="ans4" required value="<?php echo $ans4;?>"><br>

                                            Answer 5:<br>
                                            <input type="text" name="ans5" value="<?php echo $ans5;?>"><br>

                                            Correct Answer:<br>
                                            <select name="corans">
                                                
                                                <option value="1" <?php if($cans==1) {?> selected <?php } ?> >1</option>
                                                <option value="2" <?php if($cans==2) {?> selected <?php } ?> >2</option>
                                                <option value="3" <?php if($cans==3) {?> selected <?php } ?> >3</option>
                                                <option value="4" <?php if($cans==4) {?> selected <?php } ?> >4</option>
                                                <option value="5" <?php if($cans==5) {?> selected <?php } ?> >5</option>

                                            </select><br>

                                           
                                            <input type="submit" name="submitbtn" value="Submit" style="cursor: pointer;">
                                        </form>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php

                    if(isset($_POST["submitbtn"])){
                        require_once('model/dao.php');
                        $conn = dbConnection();
                        $pID = $_POST["pID"];
                           
                        $ques = $_POST["ques"]; 
                        $ans1 = $_POST["ans1"];
                        $ans2 = $_POST["ans2"];
                        $ans3 = $_POST["ans3"];
                        $ans4 = $_POST["ans4"];
                        $ans5 = $_POST["ans5"];

                        $cAns = $_POST["corans"];
                        $oldImage = $_POST["oldImage"];

                        
                        $target_dir = "../questionImages/";
                        $target_dir2 = "questionImages/";
                        $uploadOk = 1;
                        $dbimageName="";

                        if ($_FILES['questionImage']['name'] == "")
                        {
                            $dbimageName = $oldImage;
                            
                        }else{
                            $dbimageName = $target_dir2 . basename($_FILES["questionImage"]["name"]);
                            $target_file = $target_dir . basename($_FILES["questionImage"]["name"]);
                            if($target_dir2 . basename($_FILES["questionImage"]["name"]) != $oldImage){
                                move_uploaded_file($_FILES["questionImage"]["tmp_name"], $target_file);
                            }

                        }

                    
                        $updateSQL = "UPDATE questions SET question = '$ques',answer1 = '$ans1',answer2 = '$ans2',answer3 = '$ans3',answer4 = '$ans4',answer5 = '$ans5',questionImage = '$dbimageName',correctAnswer = '$cAns' WHERE questionID ='$sid' ";


                        $conn->query($updateSQL);
                        $conn->close();
                        echo '<script type="text/javascript">location.href = "addQuestions.php?id='. $pID.'";</script>';
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