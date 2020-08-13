<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php");?>


    <script>

        function enableup(ID){
            $("#faqformFiled"+ID).removeAttr("disabled");
            document.getElementById("upbtn"+ID).style.display = "block";
            document.getElementById("enableup"+ID).style.display = "none";
            document.getElementById("addbtn"+ID).style.marginTop  = "-1.75em";
        }

        function updateQ(ID){
            
            var Ques = document.getElementById("fquestion"+ID).value;
            var Ans = document.getElementById("fanswer"+ID).value;
            
            if(Ques && Ans){

                $.ajax({
                type: 'post',
                url: 'controller/faq.php',
                data: {
                    qID:ID,    
                    ques:Ques,
                    ans:Ans,
                },

                    success: function (response) {
                        $("#faqclass").load(location.href + " #faqclass");
                        
                    }
                });

            }else{
                alert("Fileds are Required");
            }
        }

        function addFAQ(ID){

            $.ajax({
                type: 'post',
                url: 'controller/addfaq.php',
                data: {
                    qID:ID,   
                },

                    success: function (response) {
                        $("#faqclass").load(location.href + " #faqclass");
                        
                    }
                });
        }

        function remFAQ(ID){
            $.ajax({
                type: 'post',
                url: 'controller/remfaq.php',
                data: {
                    qID:ID,  
                },

                    success: function (response) {
                        $("#faqclass").load(location.href + " #faqclass");
                        
                    }
                });
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
                                    <h2 class="text-white pb-2 fw-bold">FAQ</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row mt--2">

                            <div class="col-md-12">
                                <div class="card full-height">
                                    <div class="card-body">
                                        <div class="card-title">All FAQ</div>
                                            <div id="faqclass">
                                                <?php 
                                                    adgetFaq();
                                                    while ($getfaqRow = $GLOBALS['$adgetFaqResults']->fetch_assoc()) {
                                                        $fid = $getfaqRow["ID"];
                                                        $faq = $getfaqRow["FAQ"];
                                                        $fan = $getfaqRow["answer"];
                                                        $qsta = $getfaqRow["status"];
                                                ?>
                                                    <div class="formdiv">
                                                        <form id="faqform<?php echo $fid; ?>" class="faqform">
                                                            <h5><b>Question <?php echo $fid; ?></b></h5>
                                                            <fieldset id="faqformFiled<?php echo $fid; ?>" disabled="disabled">
                                                                <input type="text" name="fquestion" value="<?php echo $faq; ?>" id="fquestion<?php echo $fid; ?>">
                                                                <input type="text" name="fanswer" value="<?php echo $fan; ?>" id="fanswer<?php echo $fid; ?>">
                                                            </fieldset>
                                                        </form>
                                                        <button onclick="enableup(<?php echo $fid; ?>)" style="cursor: pointer;" id="enableup<?php echo $fid; ?>">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>
                                                        <button style="cursor: pointer;display: none;" id="upbtn<?php echo $fid; ?>" onclick="updateQ(<?php echo $fid; ?>)">Update</button>

                                                        <?php if($qsta==0){?>
                                                            <button onclick="addFAQ(<?php echo $fid; ?>)" id="addbtn<?php echo $fid; ?>" style="cursor: pointer; right:0;margin-right: 3em;position: absolute;">+</button>
                                                        <?php } else{?>
                                                            <button onclick="remFAQ(<?php echo $fid; ?>)" id="rembtn<?php echo $fid; ?>" style="cursor: pointer; right:0;margin-right: 3em;position: absolute;">-</button>
                                                        <?php } ?>

                                                    </div>

                                                <?php } ?>
                                            </div>
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
</body>
</html>