<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>

    <script>
        function removeAd(stuID){
            if(stuID){

                $.ajax({
                type: 'post',
                url: 'controller/removeAd.php',
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
                                    <h2 class="text-white pb-2 fw-bold">Admins</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <div class="card-title">All Admins</div>
                                        <table class="table table-bordered" id="studentsTable" width="" cellspacing="">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>ID</th>
                                                    <th>Admin Name</th>
                                                    <th>Admin Email</th>
                                                    <td>Contact No</td>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                               <?php

                                                    getAllAdmings();
                                                    while ($getAdRow = $GLOBALS['$getAllAdminsSQLResults']->fetch_assoc()) {
                                                        $stringEmail1 = $getAdRow["stuEmail"];
                                                        $stringEmail2 = "masterexams@gmail.com";
                                                ?>

                                                    <tr>
                                                        <td><?php echo $getAdRow["stuID"]; ?></td>
                                                        <td>
                                                            <?php echo $getAdRow["stuName"]; ?>&nbsp;<?php echo $getAdRow["stuLast"]; ?>
                                                        </td>
                                                        <td><?php echo $getAdRow["stuEmail"]; ?></td>
                                                        <td><?php echo $getAdRow["stuContactNo"]; ?></td>
                                                        <td>
                                                            <center>
                                                                <?php if(strcmp($stringEmail1,$stringEmail2)) {?>
                                                                    <button onclick="removeAd(<?php echo $getAdRow["stuID"]; ?>);" 
                                                                        style=" color:#fff;background:red;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">X
                                                                    </button>
                                                                <?php } ?>
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
                $('#studentsTable').DataTable();
            });
        </script>



	
</body>
</html>