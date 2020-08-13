<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>

    <script>
        function removesub(subID){
            if(subID){
                $.ajax({
                type: 'post',
                url: 'controller/removesub.php',
                data: {
                sub_ID:subID,
                },
                success: function (response) {
                    $("#subjectsTable").load(location.href + " #subjectsTable");
                }
            });
            }
        }

        function addsub(subID){
           if(subID){
                $.ajax({
                type: 'post',
                url: 'controller/addsub.php',
                data: {
                sub_ID:subID,
                },
                success: function (response) {
                    $("#subjectsTable").load(location.href + " #subjectsTable");
                }
            });
            }
        }

        function addNewSub(){
            var category = document.getElementById("selCate").value;
            var newSub = document.getElementById("subName").value;

            if(category && newSub){
                $.ajax({
                type: 'post',
                url: 'controller/addnewSubject.php',
                data: {
                category:category,
                new_Sub:newSub,
                },
                success: function (response) {

                    if(response==="exists"){
                        alert("Subject Already Exists");
                    }else{
                        $("#subjectsTable").load(location.href + " #subjectsTable");
                        $('#addnewSub').modal('hide');
                    }

                    
                }
            });

            }else{
                alert("Please fill all fields");
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
                                    <h2 class="text-white pb-2 fw-bold">Subjects</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">

                                        <button style="background: transparent;border:none;float: right;"  data-toggle="modal" data-target="#addnewSub"><i class="fa fa-plus"></i></button>

                                        <div class="card-title">All Subjects</div>
                                        <table class="table table-bordered" id="subjectsTable" width="" cellspacing="">
                                            <thead>
                                                <tr>
                                                    <th>Subject ID</th>
                                                    <th>Main Subject</th>
                                                    <th>Subject Name</th>
                                                    <th>Edit</th>
                                                    <th>Add/Remove</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                               <?php

                                                    getAllSubjects();
                                                    while ($getsubRow = $GLOBALS['$getAllSubjectsResults']->fetch_assoc()) {

                                                ?>   
                                                    <tr>
                                                        
                                                        <td><?php echo $getsubRow["subSubID"]; ?></td>
                                                        <td><?php echo $getsubRow["subjectName"]; ?></td>
                                                        <td><?php echo $getsubRow["subSubName"]; ?></td>
                                                        <td>
                                                            <center>
                                                                <button onclick="location.href='editsub.php?id=<?php echo $getsubRow["subSubID"];?>';" 
                                                                    style= "color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <?php if($getsubRow["subSubStatus"]==0){ ?>
                                                                <center>
                                                                    <button onclick="addsub(<?php echo $getsubRow["subSubID"]; ?>);" 
                                                                        style=" color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">+
                                                                    </button>
                                                                </center>
                                                            <?php } else{?>
                                                                <center>
                                                                    <button onclick="removesub(<?php echo $getsubRow["subSubID"]; ?>);" 
                                                                        style=" color:#fff;background:red;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">X
                                                                    </button>
                                                                </center>
                                                            <?php } ?>
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


                
                <div class="modal" id="addnewSub">
                    <div class="modal-dialog">
                        <div class="modal-content">
                      
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><b>Add new Subject</b></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                        
                              <!-- Modal body -->
                            <div class="modal-body">
                                <form  method="post" >
                                    Main Subject:<br>

                                    <select id="selCate" required>
                                        <option value="">--Select--</option>
                                        <?php 
                                            getAllAvialableSubjects();
                                            while ($getStuRow = $GLOBALS['$getSubjectsResults']->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $getStuRow["subjectID"]; ?>"><?php echo $getStuRow["subjectName"]; ?></option>

                                        <?php } ?>
                                    </select><br>

                                    Subject:<br>
                                    <input type="text" name="subName" id="subName" placeholder="Subject Name" required>
                                   
                                   <br>

                                </form>

                                    <center>
                                        <button onclick="addNewSub();" type="submit" name="addsub" style="margin-top: 0.5em;padding: 0.5em 2em;cursor:pointer;background: #1e91cf;border:1px solid #1e91cf;color:#fff;">Add
                                        </button>
                                    </center>
                              </div>
                        
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                        
                          </div>
                      </div>
                    </div>    

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
        <script>
            $(document).ready(function () {
                $('#subjectsTable').DataTable({
                    "order": [[ 0, "desc" ]]
                });
            });
        </script>
	
</body>
</html>