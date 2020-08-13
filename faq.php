<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php"); ?>



</head>
<body>
	<header class="header-area"><?php include_once("templates/topHeader.php");?>
		
	</header>
	


	<!-- Wrapper strat -->
	<div class="body-wrapper">
		
		<!--Top Image-->
        <div class="topimage bg-img" style="background-image: url(images/topimage.jpg);">
            <div class="topimageContent">
                <h2>FAQ</h2>
            </div>
        </div>
        <!--Top Image end-->


		  <!-- Contact Area Start -->
        <section class="FAQ-area" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="contact-content">
                            <div class="row">
                                <!-- Contact Information -->
                                <div class="col-12 col-lg-12">
                                    <div class="contact-information wow fadeInUp" data-wow-delay="400ms">
                                        <div class="section-heading text-left">
                                            <h3>Frequently Asked Questions</h3>
                                        </div>

                                        <div id="accordion">

                                            <?php
                                                getFaq();
                                                while($getFRow = $GLOBALS['$getFaqResults']->fetch_assoc()){
                                                    $fid = $getFRow["ID"];
                                            ?>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <a class="card-link" data-toggle="collapse" href="#collapse<?php echo $fid; ?>">
                                                            <?php echo $getFRow["FAQ"]; ?>
                                                            <span class="card-plus">
                                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div id="collapse<?php echo $fid; ?>" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                             <?php echo $getFRow["answer"]; ?>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php } ?>
                                          
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Area End -->



        <!-- Web Details -->
			<?php include_once("templates/webdetails.php"); ?>
        <!-- Web Details End-->
	</div>







	<?php include_once("templates/jsIncludes.php"); ?>

	<?php include_once("templates/footer.php"); ?>

</body>
</html>