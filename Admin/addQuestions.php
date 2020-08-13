<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>

    <script>
        function deleteQ(qid){
            if(qid){
                $.ajax({
                type: 'post',
                url: 'controller/deleteQ.php',
                data: {
                q_ID:qid,
                },
                success: function (response) {
                    $("#questionTable").load(location.href + " #questionTable");
                }
            });
            }
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
                                    <h2 class="text-white pb-2 fw-bold">Add Questions</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">

                                    <div class="card-body">

                                        <button style="background: transparent;border:none;float: right;"  data-toggle="modal" data-target="#addNewQuestion"><i class="fa fa-plus"></i></button>
                                        <div class="card-title">&nbsp;</div>

                                        <?php 
                                            if (isset($_GET['id'])) {
                                                $sid = $_GET['id'];
                                            }else{
                                                echo '<script type="text/javascript">location.href = "allPapers.php";</script>';
                                            }

                                        ?>


                                        <table class="table table-bordered" id="questionTable" width="" cellspacing="">
                                            
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Question</th>
                                                    <th>Qustion Image</th>
                                                    <th>Answers</th>
                                                    <th>Correct<br>answer</th>
                                                    <th>Edit</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                    getQuestionByPaperID($sid);
                                                    while ($getQRow = $GLOBALS['$getQuestionByPaperIDResults']->fetch_assoc()) {

                                                        $question = $getQRow["question"];
                                                        $ans1 = $getQRow["answer1"];
                                                        $ans2 = $getQRow["answer2"];
                                                        $ans3 = $getQRow["answer3"];
                                                        $ans4 = $getQRow["answer4"];
                                                        $ans5 = $getQRow["answer5"];
                                                        $cans = $getQRow["correctAnswer"];
                                                        $img = $getQRow["questionImage"];
                                                ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo substr($question,0,20); ?></td>
                                                        <td>
                                                            <center>
                                                                <?php if($img!=""){?>
                                                                    <img style="height: 5em;" src="../<?php echo $img ;?>">
                                                                <?php } else{echo "no-image";}?>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            1)<?php echo substr($ans1,0,20); ?><br>
                                                            2)<?php echo substr($ans2,0,20); ?><br>
                                                            3)<?php echo substr($ans3,0,20); ?><br>
                                                            4)<?php echo substr($ans4,0,20); ?><br>
                                                            5)<?php echo substr($ans5,0,20); ?>
                                                        </td>
                                                        <td><center><?php echo $cans;?></center></td>
                                                        <td>
                                                            <center>
                                                                <button onclick="location.href='editQ.php?pid=<?php echo $sid; ?>&id=<?php echo $getQRow["questionID"];?>';" 
                                                                    style=" color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;"><i class="fa fa-pencil"></i>
                                                                </button>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <button onclick="deleteQ(<?php echo $getQRow["questionID"]; ?>);" 
                                                                    style=" color:#fff;background:red;cursor:pointer;border: 1px solid transparent;border-radius: 10px;"><i class="fa fa-trash"></i>
                                                                </button>
                                                            </center>
                                                        </td>
                                                       
                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                  

                </div>

            </div>  


    </div>


           
        
  
                <div class="modal" id="addNewQuestion">
                    <div class="modal-dialog">
                        <div class="modal-content">
                      
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><b>Add new Question</b></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                        
                              <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" class="row-border" enctype="multipart/form-data" action="addQuestions.php?id=<?php echo $sid;?>">
                                    
                                    <input type="text" name="paperID" value="<?php echo $sid;?>" style="display: none;"><br>

                                    Question:<br>
                                    <input type="text" name="question"><br>

                                    Question Image<br>
                                    <input type="file" name="questionImage" accept="image/*"><br>

                                    Answer 01:<br>
                                    <input type="text" name="answer1" required><br>

                                    Answer 02:<br>
                                    <input type="text" name="answer2" required><br>

                                    Answer 03:<br>
                                    <input type="text" name="answer3" required><br>

                                    Answer 04:<br>
                                    <input type="text" name="answer4" required><br>

                                    Answer 05:<br>
                                    <input type="text" name="answer5"><br>

                                    Correct Answer:<br>
                                    <select name="Canswer" required>
                                        <option value="">--SELECT--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <center>
                                        <input name="submitbtn" type="submit" name="addsub" style="margin-top: 0.5em;padding: 0.5em 2em;cursor:pointer;background: #1e91cf;border:1px solid #1e91cf;color:#fff;" value="Add">
                                    </center>
                                </form>

                                    
                              </div>
                        
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                        
                          </div>
                      </div>
                    </div>    

                </div>

        <?php include_once("templates/jsIncludes.php");?>


        <?php

            if(isset($_POST["submitbtn"])){

                require_once('model/dao.php');
                $conn = dbConnection();
                $pID = $_POST["paperID"];
                $ques = $_POST["question"];
                $ans1 = $_POST["answer1"];
                $ans2 = $_POST["answer2"];
                $ans3 = $_POST["answer3"];
                $ans4 = $_POST["answer4"];
                $ans5 = $_POST["answer5"];
                $corans = $_POST["Canswer"];
                $dbImg = "";

                $target_dir = "../questionImages/";
                $target_dir2 = "questionImages/";

                if ($_FILES['questionImage']['name'] == "")
                {
                     $dbImg = "";
                            
                }else{
                    $dbImg = $target_dir2 . basename($_FILES["questionImage"]["name"]);
                    $target_file = $target_dir . basename($_FILES["questionImage"]["name"]);
                    if($target_dir2 . basename($_FILES["questionImage"]["name"]) != $oldImage){
                        move_uploaded_file($_FILES["questionImage"]["tmp_name"], $target_file);
                    }

                }

                $insSQL = "INSERT INTO questions (question,questionImage,answer1,answer2,answer3,answer4,answer5,correctAnswer,questionStatus,paperID) VALUES ('$ques','$dbImg','$ans1','$ans2','$ans3','$ans4','$ans5','$corans','1','$pID')";
                $conn->query($insSQL);
                $conn->close();
                echo '<script type="text/javascript">location.href = "addQuestions.php?id='. $pID.'";</script>';
            }


        ?>
        <script>
            $(document).ready( function () {
                var t = $('#questionTable').DataTable({
                    "order": [[ 0, "desc" ]]
                });

                t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();
            } );
        </script>


	
</body>
</html>