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
                                    <h2 class="text-white pb-2 fw-bold">Answers(Marks)</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <div class="card-title">All Answers(Marks)</div>
                                        <table class="table table-bordered" id="answerTable" width="" cellspacing="">
                                            <thead>
                                                <tr>
                                                    
                                                    <th><center>Stu ID</center></th>
                                                    <th><center>Paper</center></th>
                                                    <th><center>Marks</center></th>
                                                    <th><center>Date</center></th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                               <?php 
                                                    getAllAnswers();
                                                    while ($getansRow = $GLOBALS['$getAllAnswersResults']->fetch_assoc()) {
                                                        $stuID = $getansRow["stuID"];
                                                        $paperID = $getansRow["paperID"];
                                                        $Marks = $getansRow["Marks"];
                                                        $Date = $getansRow["ansdate"];
                                                ?>
                                                    
                                                        
                                                        <td><center><?php echo $stuID; ?></center></td>
                                                       
                                                        <td>
                                                        	<center>
                                                            	<?php echo $paperID; ?>
                                                            </center>
                                                        </td>
                                                        <td><center><?php echo $Marks; ?></center></td>
                                                        <td><center><?php echo $Date; ?></center></td>
                                                        
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

        <script>
            $(document).ready(function () {
                $('#answerTable').DataTable();
            });
        </script>



	<?php include_once("templates/jsIncludes.php");?>
</body>
</html>