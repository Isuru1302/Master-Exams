<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>

    <script>
        function removeStu(stuID){
            if(stuID){
                $.ajax({
                type: 'post',
                url: 'controller/removeStu.php',
                data: {
                stu_ID:stuID,
                },
                success: function (response) {
                    $("#studentsTable").load(location.href + " #studentsTable");
                }
            });
            }
        }

        function addStu(stuID){
           if(stuID){
                $.ajax({
                type: 'post',
                url: 'controller/addStu.php',
                data: {
                stu_ID:stuID,
                },
                success: function (response) {
                    $("#studentsTable").load(location.href + " #studentsTable");
                }
            });
            }
        }

        function makeAdmin(stuID){
           if(stuID){
                $.ajax({
                type: 'post',
                url: 'controller/makeAdmin.php',
                data: {
                stu_ID:stuID,
                },
                success: function (response) {
                    $("#studentsTable").load(location.href + " #studentsTable");
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
                                    <h2 class="text-white pb-2 fw-bold">Students</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <div class="card-title">All Students</div>
                                        
                                        <table class="table table-bordered" id="studentsTable" width="" cellspacing="">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>ID</th>
                                                    <th>Student Name</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                    <th>City</th>
                                                    <th>Make Admin</th>
                                                    <th>Add/Remove</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php

                                                    getAllStudents();
                                                    while ($getStuRow = $GLOBALS['$getAllStudentsSQLResults']->fetch_assoc()) {

                                                ?>   
                                                    <tr>
                                                        <td>
                                                            <span id="studentID">
                                                                <?php echo $getStuRow["stuID"]; ?>
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <?php echo $getStuRow["stuName"]; ?>&nbsp;
                                                            <?php echo $getStuRow["stuLast"]; ?>

                                                            <?php if($getStuRow["olyear"] != ""){ ?>
                                                                <b>(<?php echo $getStuRow["olyear"]; ?>)</b>
                                                            <?php } ?>

                                                        </td>
                                                        <td><?php echo $getStuRow["stuEmail"]; ?></td>
                                                        <td><?php echo $getStuRow["stuContactNo"]; ?></td>
                                                        <td><?php echo $getStuRow["stuCity"]; ?>
                                                            
                                                             <?php if($getStuRow["udistrict"] != ""){ ?>
                                                            <b>(<?php echo $getStuRow["udistrict"]; ?>)</b>
                                                        <?php } ?>
                                                        </td>
                                                       
                                                        <td>
                                                            <center>
                                                                <button onclick="makeAdmin(<?php echo $getStuRow["stuID"]; ?>);" 
                                                                    style=" color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">+
                                                                </button>
                                                            </center>

                                                        </td>
                                                        <td>
                                                            <?php if($getStuRow["stuStatus"]==0){ ?>
                                                                <center>
                                                                    <button onclick="addStu(<?php echo $getStuRow["stuID"]; ?>);" 
                                                                        style=" color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">+
                                                                    </button>
                                                                </center>
                                                            <?php } else{?>
                                                                <center>
                                                                    <button onclick="removeStu(<?php echo $getStuRow["stuID"]; ?>);" 
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
            $(document).ready( function () {
                $('#studentsTable').DataTable({
                    "order": [[ 0, "desc" ]]
                });
            } );
        </script>
</body>
</html>