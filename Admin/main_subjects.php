<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>

    <script>
        function remMC(subID){
            if(subID){
                $.ajax({
                type: 'post',
                url: 'controller/remMC.php',
                data: {
                sub_ID:subID,
                },
                success: function (response) {
                    $("#mainSubTable").load(location.href + " #mainSubTable");
                }
            });
            }
        }

        function addMC(subID){
            if(subID){
                $.ajax({
                type: 'post',
                url: 'controller/addMC.php',
                data: {
                sub_ID:subID,
                },
                success: function (response) {
                    $("#mainSubTable").load(location.href + " #mainSubTable");
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
                                    <h2 class="text-white pb-2 fw-bold">Main Subjects</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">

                                        <button style="background: transparent;border:none;float: right;"data-toggle="modal" data-target="#addnewSub"><i class="fa fa-plus"></i></button>

                                        <div class="card-title">All Main Subjects</div>
                                        <table class="table table-bordered" id="mainSubTable" width="" cellspacing="">
                                            <thead>
                                                <tr>
                                                    <th>Subject ID</th>
                                                    <th>Subject Name</th>
                                                    <th>Subject Image</th>
                                                    <th>Edit</th>
                                                    <th>Add/Remove</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                               <?php

                                                    getAllMainCategories();
                                                    while ($getMainCRow = $GLOBALS['$getAllMainCategoriesResults']->fetch_assoc()) {

                                                ?>

                                                    <tr>
                                                        
                                                        <td><?php echo $getMainCRow["subjectID"]; ?></td>
                                                        <td><?php echo $getMainCRow["subjectName"]; ?></td>
                                                        <td>
                                                            <center>
                                                                <img style="height: 45px;" src="../<?php echo $getMainCRow["subjectImage"]; ?>">
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center> 
                                                                <button onclick="location.href='editmain_subjects.php?id=<?php echo $getMainCRow["subjectID"];?>';" 
                                                                    style= "color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <?php if($getMainCRow["subjectStatus"]==0){ ?>
                                                                    <button onclick="addMC(<?php echo $getMainCRow["subjectID"]; ?>);" 
                                                                        style=" color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">+
                                                                    </button>
                                                                <?php }else{?>
                                                                    <center>
                                                                        <button onclick="remMC(<?php echo $getMainCRow["subjectID"];; ?>);" 
                                                                            style=" color:#fff;background:red;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">X
                                                                        </button>
                                                                    </center>
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
                                <form  method="post" action="controller/main_subjects2.php" enctype="multipart/form-data">
                                    Subject Name:<br>
                                    <input type="text" name="subName" id="subName" placeholder="Subject Name" required>
                                   
                                   Display Image:<br>
                                   <input type="file" name="subImage" id="subImage" accept="image/*"  required>

                                   <br>

                                   <center>
                                        <button  type="submit" name="addsub" style="margin-top: 0.5em;padding: 0.5em 2em;cursor:pointer;background: #1e91cf;border:1px solid #1e91cf;color:#fff;">Add
                                        </button>
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
                $('#mainSubTable').DataTable();
            });
        </script>
	
</body>
</html>