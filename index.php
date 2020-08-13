<!DOCTYPE html>
<html>
<head>
	
	<?php include_once("templates/headerIncludes.php"); ?>


</head>
<body>
	<header class="header-area">
        <?php include_once("templates/topHeader.php");?>
	</header>
	

	<!-- Wrapper strat -->
	<div class="body-wrapper">
		<div class="container">
			<div class="row">

				<div class="lft-pt col-12 col-sm-12 col-md-7 col-lg-7">
					<div class="main-slider">
						

                        <!--Main Slide-->
                        <section class="main-slide">
                            <div class="main-slides owl-carousel owl-theme">

                                <?php 
                                    getmainBanner();
                                    while ($getiMBRow = $GLOBALS['$getmainBannerResults']->fetch_assoc()) {

                                ?>
                                    <!-- Single Hero Slide -->
                                    <div class="single-main-slide bg-img" style="background-image: url(<?php echo $getiMBRow["bannerImage"]; ?>);">
                                        <div class="container h-100">
                                            <div class="row h-100 align-items-center">
                                                <div class="col-12">
                                                    <!-- <div class="main-slides-content" style="margin-left: 3em;">
                                                        <h4 data-animation="fadeInUp" data-delay="100ms" style="color:#000;"><b><i>Challenge your self</i></b></h4>
                                                        <h2 data-animation="fadeInUp" data-delay="400ms" style="color:#000;">Welcome to  <br>MemDollar.Com</h2>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                               
                            </div>
                        </section>
                        <!--Main Slide End-->

					</div>
					<div class="description-area">
						<p>අන්තර්ජාලය වඩා යහපත් අරමුනු කරා බාවිතා කරමින් දැනුම පසු පස හබායන ඔබට   A/L  වානිජ , ගණිත , කලා , තාක්ශන ,O/L  විශයන් සහ වෙනත් ඔබට වැදගත් විභාග සදහා ප්‍රශ්න පත්තර පෙරහුරු වීමට ලබාදීම මෙම වෙබ් අඩවියෙන් බලලාපොරත්තු වේ.</p>
					</div>


				</div>

				<div class="rgt-pt col-12 col-sm-12 col-md-5 col-lg-5">
					<div class="row">
					
						<div class="news-letter col-12"  style="display: none;">
							<h6>News</h6>
                            <a href="#">
    							<div class="news-items" style="display: none;">
    								
    							</div>
                            </a>
						</div>	

						<div class="recent-papers col-12">
							<h6>New papers</h6>

                            <?php 
                                getLatestPapers(0,3);
                                while ($getNewPapersRow = $GLOBALS['$getLatestPapersResults']->fetch_assoc()) {

                            ?>
                            <a href="paper.php?pid=<?php echo $getNewPapersRow["paperID"];?>">
							    <div class="paper-items">
								    <?php echo $getNewPapersRow["paperName"]; ?><img src="images/new.png">
							    </div>
                            </a>
                        <?php } ?>
						</div>	
					
					</div>
				</div>


			</div>
		</div>
		
		<!-- Testimonials -->
        <div class="testimonials-area section-padding-100 bg-img bg-overlay" style="background-image: url(images/bg-1.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-center mx-auto white wow fadeInUp" data-wow-delay="300ms">
                            <span>our teachers</span>
                            <h3>Let's see about our teachers </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Single Testimonials Area -->
                    <div class="col-12 col-md-6">
                        <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="400ms">
                            <div class="testimonial-thumb">
                                <img src="images/t1.jpg" alt="">
                            </div>
                            <div class="testimonial-content">
                                <h5>Kasun Kalhara</h5>
                                <p>His music career started along with Indrachapa Liyanage and his schoolmates from Ananda College in the year 2000. At this time his mother was a big supporter of his musical career and was very proud of every step her son had taken. </p>
                                <!-- <h6><span>Maria Smith,</span> Student</h6> -->
                            </div>
                        </div>
                    </div>
                    <!-- Single Testimonials Area -->
                    <div class="col-12 col-md-6">
                        <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="500ms">
                            <div class="testimonial-thumb">
                                <img src="images/t2.jpg" alt="">
                            </div>
                            <div class="testimonial-content">
                                <h5>Easy and user friendly courses</h5>
                                <p>Tips Towards Α User-Friendly eLearning Course. Provide Detailed Instructions. Keep Text Short And Succinct. Test Out Your eLearning Course Navigation. Opt For Brief Bursts Of Information. Include Optional Tips And Tricks. Create An Effective eLearning Course Menu. Integrate Supplemental Links.</p>
                                <!-- <h6><span>Shawn Gaines,</span> Student</h6> -->
                            </div>
                        </div>
                    </div>
                    <!-- Single Testimonials Area -->
                    <div class="col-12 col-md-6">
                        <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="600ms">
                            <div class="testimonial-thumb">
                                <img src="images/t3.jpg" alt="">
                            </div>
                            <div class="testimonial-content">
                                <h5>I just love the courses here</h5>
                                <p>Udemy is an online learning and teaching marketplace with over 100000 courses and 24 million students. Learn ... My goal is to become a freelance web developer, and thanks to Udemy, I'm really close. Borivoje ... Teach what you love.</p>
                                <!-- <h6><span>Ross Cooper,</span> Student</h6> -->
                            </div>
                        </div>
                    </div>
                    <!-- Single Testimonials Area -->
                    <div class="col-12 col-md-6">
                        <div class="single-testimonial-area mb-100 d-flex wow fadeInUp" data-wow-delay="700ms">
                            <div class="testimonial-thumb">
                                <img src="images/t4.jpg" alt="">
                            </div>
                            <div class="testimonial-content">
                                <h5>One good academy</h5>
                                <p>I felt I made good progress, the teachers are great and I really enjoyed the variety.' Jakob Germany ... I will strongly recommend your school to all my friends.</p>
                                <!-- <h6><span>James Williams,</span> Student</h6> -->
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Testimonials End -->

         <!-- Invite Friends -->
        <div class="invite-friends" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="invite-friends-content d-flex align-items-center justify-content-between flex-wrap">
                            <h3>Invite Your Friends To Follow This Page!</h3>
                            <button type="button" class="btn invite-btn page-btn" data-toggle="modal" data-target="#invite_friend">Invite</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Invite Friends End -->

        <!-- Web Details -->
			<?php include_once("templates/webdetails.php"); ?>
        <!-- Web Details End-->
	</div>







	<?php include_once("templates/jsIncludes.php"); ?>

	<?php include_once("templates/footer.php"); ?>

    <script>
            (function ($) {
            'use strict';
                    var browserWindow = $(window);
                    // :: 3.0 Sliders Active Code
                    if ($.fn.owlCarousel) {
            var welcomeSlide = $('.main-slides');
                    var aboutSlide = $('.about-slides');
                    welcomeSlide.owlCarousel({
                    items: 1,
                            margin: 0,
                            loop: true,
                            nav: true,
                            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                            dots: true,
                            autoplay: true,
                            autoplayTimeout: 7000,
                            smartSpeed: 2000
                    });
                    welcomeSlide.on('translate.owl.carousel', function () {
                    var slideLayer = $("[data-animation]");
                            slideLayer.each(function () {
                            var anim_name = $(this).data('animation');
                                    $(this).removeClass('animated ' + anim_name).css('opacity', '0');
                            });
                    });
                    welcomeSlide.on('translated.owl.carousel', function () {
                    var slideLayer = welcomeSlide.find('.owl-item.active').find("[data-animation]");
                            slideLayer.each(function () {
                            var anim_name = $(this).data('animation');
                                    $(this).addClass('animated ' + anim_name).css('opacity', '1');
                            });
                    });
                    $("[data-delay]").each(function () {
            var anim_del = $(this).data('delay');
                    $(this).css('animation-delay', anim_del);
            });
                    $("[data-duration]").each(function () {
            var anim_dur = $(this).data('duration');
                    $(this).css('animation-duration', anim_dur);
            });
                    aboutSlide.owlCarousel({
                    items: 1,
                            margin: 0,
                            loop: true,
                            nav: true,
                            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                            dots: true,
                            autoplay: true,
                            autoplayTimeout: 7000,
                            smartSpeed: 2000
                    });
            }
            })(jQuery);
        </script>

</body>
</html>