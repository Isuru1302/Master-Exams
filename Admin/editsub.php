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
                                            if (isset($_GET['id'])) {
                                                $sid = $_GET['id'];
                                            }else{
                                                echo '<script type="text/javascript">location.href = "Subjects.php";</script>';
                                            }
                                        ?>

                                        <form action="editsub.php?id=<?php echo $sid; ?>" method="POST" class="editSub">
                                            
                                            <?php

                                                

                                                adminGetSubByID($sid);
                                                while ($getSubRow = $GLOBALS['$getSubByIDResults']->fetch_assoc()) {

                                                    $subID = $getSubRow["subSubID"];
                                                    $subName = $getSubRow["subSubName"];

                                                }

                                            ?>  
                                            Subject ID:<br>
                                            <input type="text" name="subID" readonly value="<?php echo $subID;?>">
                                            Subject Name:<br>
                                            <input type="text" name="subname" required value="<?php echo $subName;?>">
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
                        $subid = $_POST["subID"];
                        $subName = $_POST["subname"];
                        $insertSQL = "UPDATE subcategory SET subSubName = '$subName' WHERE subSubID = '$subid'";
                        $conn->query($insertSQL);
                        $conn->close();
                        echo '<script type="text/javascript">location.href = "Subjects.php";</script>';
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