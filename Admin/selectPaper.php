<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>

    <script>
        function removePaper(pID){
            if(pID){
                $.ajax({
                type: 'post',
                url: 'controller/removepaper.php',
                data: {
                p_ID:pID,
                },
                success: function (response) {
                    $("#paperTable").load(location.href + " #paperTable");
                }
            });
            }
        }

        function addPaper(pID){
           if(pID){
                $.ajax({
                type: 'post',
                url: 'controller/addpaper.php',
                data: {
                p_ID:pID,
                },
                success: function (response) {
                    $("#paperTable").load(location.href + " #paperTable");
                }
            });
            }
        }

        function addNewPaper(){
            var mainC = document.getElementById("selMainCate").value;
            var cate = document.getElementById("selCate").value;
            var paperName = document.getElementById("papername").value;


            if(mainC && cate && paperName){
                $.ajax({
                type: 'post',
                url: 'controller/addnewPaper.php',
                data: {
                main_C:mainC,
                cat_e:cate,
                paper_Name:paperName,
                },
                success: function (response) {
                    $("#paperTable").load(location.href + " #paperTable");
                    $('#addNewPaper').modal('hide'); 
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
                                    <h2 class="text-white pb-2 fw-bold">Select The Paper</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">

                                        <button style="background: transparent;border:none;float: right;"  data-toggle="modal" data-target="#addNewPaper"><i class="fa fa-plus"></i></button>

                                        <div class="card-title">All Papers</div>
                                        <table class="table table-bordered" id="paperTable" width="" cellspacing="">
                                            <thead>
                                                <tr>
                                                    <th>Paper ID</th>
                                                    <th>Paper Name</th>
                                                    <th>Main Categoty</th>
                                                    <th>Subject</th>
                                                    <th>Add Questions</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                               <?php
                                                   getALLPapers();
                                                    while ($getpapRow = $GLOBALS['$getALLPapersResults']->fetch_assoc()) {
                                                        $pid = $getpapRow["paperID"];
                                                        $pName = $getpapRow["paperName"];
                                                        $mc = $getpapRow["subjectName"];
                                                        $sub = $getpapRow["subSubName"];

                                                ?>   
                                                    <tr>
                                                        
                                                        <td><?php echo $pid; ?></td>
                                                        <td><?php echo $pName; ?></td>
                                                        <td><?php echo $mc; ?></td>
                                                        <td><?php echo $sub; ?></td>
                                                        <td>
                                                            
                                                            
                                                                <center>
                                                                    <button onclick="location.href='addQuestions.php?id=<?php echo $getpapRow["paperID"];?>';" 
                                                                        style=" color:#fff;background:greenyellow;cursor:pointer;border: 1px solid transparent;border-radius: 10px;">+
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


                
                <div class="modal" id="addNewPaper">
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

                                    <?php 

                                        $selected1 = "1";
                                    ?>

                                    <select id="selMainCate" required>
                                        <option value="">--Select--</option>
                                        <?php 
                                            getAllAvialableSubjects();
                                            while ($getStuRow = $GLOBALS['$getSubjectsResults']->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $getStuRow["subjectID"]; ?>"><?php echo $getStuRow["subjectName"]; ?></option>

                                        <?php } ?>
                                    </select><br>

                                    Subject:<?php echo $selected1;?><br>
                                    <select id="selCate" required>
                                        <option value="">--Select--</option>
                                    <?php 

                                        getALlAvailableSub();
                                        while ($getssubRow = $GLOBALS['$getALlAvailableSubResults']->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $getssubRow["subSubID"]; ?>"><?php echo $getssubRow["subSubName"]; ?></option>

                                    <?php } ?>
                                   </select>
                                   <br>

                                   Paper Name:<br>
                                   <input type="text" name="papername" id="papername" required minlength="3">

                                </form>

                                    <center>
                                        <button onclick="addNewPaper();" type="submit" name="addsub" style="margin-top: 0.5em;padding: 0.5em 2em;cursor:pointer;background: #1e91cf;border:1px solid #1e91cf;color:#fff;">Add
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
                $('#paperTable').DataTable({
                    "order": [[ 0, "desc" ]]
                });
            });
        </script>
	
</body>
</html>