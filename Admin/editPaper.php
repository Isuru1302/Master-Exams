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
                                    <h2 class="text-white pb-2 fw-bold">Edit Paper</h2>
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
                                                echo '<script type="text/javascript">location.href = "allPapers.php";</script>';
                                            }
                                        ?>

                                        <form action="editPaper.php?id=<?php echo $sid; ?>" method="POST" class="editPaper" enctype="multipart/form-data">
                                            
                                            <?php
                                                
                                                adminGetPaperByID($sid);
                                                while ($getPRow = $GLOBALS['$getPaperByIDResults2']->fetch_assoc()) {

                                                    $paperName = $getPRow["paperName"];
                                                    $subjectID = $getPRow["subjectID"];
                                                    $sSubjectID = $getPRow["subSubjectID"];
                                                }
                                            ?>  

                                            <input type="text" name="pID" value="<?php echo $sid; ?>" style="display: none;">

                                            Paper Name:<br>
                                            <input type="text" name="pName" value="<?php echo $paperName; ?>"><br>

                                            Main Subject:<br>
                                            <select name="mainC">
                                                <?php
                                                    getALlAvailableMainSub();
                                                    while ($getMCRow = $GLOBALS['$getALlAvailableMainSubResults']->fetch_assoc()) {

                                                ?>

                                                    <option <?php if($getMCRow["subjectID"]==$subjectID) {?> selected <?php }?> 
                                                    value="<?php echo $getMCRow["subjectID"];  ?>"
                                                    >
                                                        <?php echo $getMCRow["subjectName"];  ?>
                                                    </option>

                                            <?php }?>

                                            </select>
                                            <br>

                                            Subject Name:<br>
                                            <select name="subC">
                                                <?php
                                                    getALlAvailableSub();
                                                    while ($getSCRow = $GLOBALS['$getALlAvailableSubResults']->fetch_assoc()) {

                                                ?>

                                                    <option <?php if($getSCRow["subSubID"]==$sSubjectID) {?> selected <?php }?> 
                                                    value="<?php echo $getSCRow["subSubID"];  ?>"
                                                    >
                                                        <?php echo $getSCRow["subSubName"];  ?>
                                                    </option>

                                            <?php }?>

                                            </select>
                                            <br>
                                           
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
                        $pid = $_POST["pID"];
                        $pName = $_POST["pName"];
                        $MC = $_POST["mainC"];
                        $SC = $_POST["subC"];
                    
                        $updateSQL = "UPDATE paper SET paperName = '$pName',subjectID = '$MC',subSubjectID='$SC' WHERE paperID='$pid' ";


                        $conn->query($updateSQL);
                        $conn->close();
                        echo '<script type="text/javascript">location.href = "allPapers.php";</script>';
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