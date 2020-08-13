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
                                    <h2 class="text-white pb-2 fw-bold">Invitations</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <div class="card-title">All Invitations</div>
                                        <table class="table table-bordered" id="inviteTable" width="" cellspacing="">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Invite By</th>
                                                    <th>Invitation Email</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                    getAllInvitations();
                                                    while ($getInviteRow = $GLOBALS['$getAllInvitationsResults']->fetch_assoc()) {

                                                ?>   
                                               
                                                    <tr>

                                                        <td><?php echo $getInviteRow["inviteID"];?></td>
                                                        <td><?php echo $getInviteRow["invitedBy"];?></td>
                                                        <td><?php echo $getInviteRow["invitedTo"];?></td>
                                                        <td><?php echo $getInviteRow["inviteDate"];?></td>
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
                $('#inviteTable').DataTable({
                    "order": [[ 0, "desc" ]]
                });
            });
        </script>

</body>
</html>