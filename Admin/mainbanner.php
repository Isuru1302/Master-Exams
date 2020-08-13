<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>


    <script>
        
        function addImg(ID){
            if(ID){
                $.ajax({
                type: 'post',
                url: 'controller/addImg.php',
                data: {
                img_ID:ID,
                },
                success: function (response) {
                    $("#mbImgTable").load(location.href + " #mbImgTable");
                }
            });
            }
        }

        function removeImg(ID){
            if(ID){
                $.ajax({
                type: 'post',
                url: 'controller/removeImg.php',
                data: {
                img_ID:ID,
                },
                success: function (response) {
                    $("#mbImgTable").load(location.href + " #mbImgTable");
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
                                    <h2 class="text-white pb-2 fw-bold">Main Banner</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <button style="background: transparent;border:none;float: right;"  data-toggle="modal" data-target="#addnewImg"><i class="fa fa-plus"></i></button>
                                        <div class="card-title">Main Banner</div>
                                            <div id="faqclass">
                                                <table class="table table-bordered" id="mbImgTable" width="" cellspacing="">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Image</th>
                                                            <th>Add/Remove</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php
                                                            mainBanner();
                                                            while ($getMBRow = $GLOBALS['$mainBannerResults']->fetch_assoc()) {
                                                                    $mbID = $getMBRow["id"];
                                                                    $mbImg = $getMBRow["bannerImage"];
                                                                    $mbImgStats = $getMBRow["imageStatus"];
                                                        ?>   
                                                            <tr>
                                                                <td>
                                                                    <?php echo $mbID; ?>
                                                                </td>

                                                                <td>
                                                                   <img src="../<?php echo $mbImg;?>" style="height: 40px;"> 
                                                                </td>
                                                                <td>
                                                                    <center>
                                                                        <?php if($mbImgStats==0){ ?>
                                                                            <button onclick="addImg(<?php echo $mbID; ?>);" 
                                                                                style=" color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">+
                                                                            </button>
                                                                        <?php } else{?>
                                                                            <button onclick="removeImg(<?php echo $mbID; ?>);" 
                                                                                style=" color:#fff;background:red;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">X
                                                                            </button>   

                                                                        <?php } ?>
                                                                    </center>
                                                                </td>
                                                                
                                                            </tr>
                                                        <?php  } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal" id="addnewImg">
                    <div class="modal-dialog">
                        <div class="modal-content">
                      
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"><b>Add new Image</b></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                        
                              <!-- Modal body -->
                            <div class="modal-body">
                                <form  method="post" action="controller/mainbanner.php" enctype="multipart/form-data">
                                    Main Banner Image:<br>
                                    <input type="file" name="mbimage" id="mbimage" accept="image/*" required>
                                   
                                   <br>
                                   <center>
                                        <button  type="submit" name="addimg" style="margin-top: 0.5em;padding: 0.5em 2em;cursor:pointer;background: #1e91cf;border:1px solid #1e91cf;color:#fff;">Add
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
                $('#mbImgTable').DataTable({
                    "order": [[ 0, "desc" ]]
                });
            } );
        </script>
</body>
</html>