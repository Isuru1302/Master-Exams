<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php"); ?>

    <script>
        function addMessage(){
            var uName = document.getElementById("userName").value;
            var uEmail = document.getElementById("userEmail").value;
            var uMessage = document.getElementById("uMessage").value;

            if(uName && uEmail && uMessage){
                $("#reqMsg").hide();

                $.ajax({
                type: 'post',
                url: 'controller/sendMsg.php',
                data: {
                u_name:uName,
                u_email:uEmail,
                u_message:uMessage,
                },
                success: function (response) {
                    if(response==="success"){
                        document.getElementById("msgForm").reset();
                        $("#failMsg").hide();
                        $("#susMsg").show();
                    }else{
                        $("#failMsg").show();
                        $("#susMsg").hide();
                    }
                }
            });

            }else{
                $("#reqMsg").show();
                $("#failMsg").hide();
                $("#susMsg").hide();
            }

        }
    </script>

</head>
<body>
	<header class="header-area">
        <?php include_once("templates/topHeader.php");?>
	</header>
	


	<!-- Wrapper strat -->
	<div class="body-wrapper">
		
		<!--Top Image-->
        <div class="topimage bg-img" style="background-image: url(images/topimage.jpg);">
            <div class="topimageContent">
                <h2>Contact</h2>
            </div>
        </div>
        <!--Top Image end-->

        <!-- Contact Area Start -->
        <section class="contact-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="contact-content">
                            <div class="row">
                                <!-- Contact Information -->
                                <div class="col-12 col-lg-5">
                                    <div class="contact-information wow fadeInUp" data-wow-delay="400ms">
                                        <div class="section-heading text-left">
                                            <span>The Best</span>
                                            <h3>Contact Us</h3>
                                            <p class="mt-30">This web site is aimed at providing you with A / L Commerce, Maths, Arts, Technology, O / L subjects and other important exam papers for you to pursue knowledge using the internet for better purposes. </p>
                                        </div>

                                       

                                        <div class="single-contact-info d-flex" style="cursor: pointer;" onclick="window.open('https://www.facebook.com/masterexamscom-106380574241015');">
                                            
                                                <div  class="contact-icon mr-15" >
                                                    <i class="fa fa-facebook" style="font-size: 1.5em;"></i>
                                                </div>
                                                <p>Master Exams</p>
                                           
                                        </div>

                                        <!-- Single Contact Info -->
                                        <div class="single-contact-info d-flex">
                                            <div class="contact-icon mr-15">
                                                <i class="fa fa-mobile" style="font-size: 1.5em;"></i>
                                            </div>
                                            <p>Tp: 076-9160192</p>
                                        </div>

                                        <!-- Single Contact Info -->
                                        <div class="single-contact-info d-flex">
                                            <div class="contact-icon mr-15">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <p>masterexams123@gmail.com</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Contact Form Area -->
                                <div class="col-12 col-lg-7">
                                    <div class="contact-form-area wow fadeInUp" data-wow-delay="500ms">
                                        <form action="" method="post" id="msgForm">
                                            <input type="text" class="form-control" name="userName" id="userName" placeholder="Name">
                                            <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="E-mail">
                                            <textarea name="message" class="form-control" id="uMessage" cols="30" rows="10" placeholder="Message"></textarea>
                                            <p id="reqMsg" style="color: red; display: none;">All the fileds are required</p>

                                            <p id="failMsg" style="color: red; display: none;">Try Again!!</p>

                                            <p id="susMsg" style="color: green; display: none;">We got your message. We will contact you soon!</p>

                                        </form>

                                        <center>
                                            <button onclick="addMessage()" style="font-weight: bold;color: #fff;border-color: #891130;background: #891130;" class="btn page-btn mt-30" type="submit">Contact Us</button>
                                        </center>
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