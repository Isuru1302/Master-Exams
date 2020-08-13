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
                                    <h2 class="text-white pb-2 fw-bold">Messages</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <div class="card-title">All Messages</div>
                                        <table class="table table-bordered" id="studentsTable" width="" cellspacing="">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Message</th>
                                                    <th>Reply</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                               <?php 
                                                    getAllMessages();
                                                    while ($getmsgRow = $GLOBALS['$getALlMessagesResults']->fetch_assoc()) {
                                                        $mgsID = $getmsgRow["messageID"];
                                                        $msgName = $getmsgRow["messageBy"];
                                                        $msgMessage = $getmsgRow["message"];
                                                        $msgDate = $getmsgRow["messageDate"];
                                                        $msgStaus = $getmsgRow["messageStatus"];
                                                ?>
                                                    <tr <?php if($msgStaus==1) {?>style="font-weight: bold;" <?php }else{?> style="font-style: italic;"<?php } ?> >
                                                        
                                                        <td><?php echo $mgsID; ?></td>
                                                        <td><?php echo $msgName; ?></td>
                                                        <td>
                                                            <?php 

                                                                if(strlen($msgMessage)>50){
                                                                    echo substr($msgMessage,0,50)."...";
                                                                }else{
                                                                    echo $msgMessage;
                                                                }

                                                            ?>
                                                        </td>
                                                        <td><?php echo $msgDate; ?></td>
                                                        <td>
                                                            <center>
                                                                <button onclick="location.href='readMessage.php?id=<?php echo $mgsID;?>';" 
                                                                    style= "color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">
                                                                    <i class="fa fa-pencil"></i>
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
                $('#studentsTable').DataTable();
            });
        </script>



	<?php include_once("templates/jsIncludes.php");?>
</body>
</html>