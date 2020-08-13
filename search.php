<!DOCTYPE html>
<html>
<head>
	<?php include_once("templates/headerIncludes.php"); ?>

	<style>
		body{
    		background: #f5f5f0;
		}


		.paper-container{
		    background: #fff!important;
		}

		.page-path li{
			display: inline-block;
		}

		.mainC,.subC{
			font-size: 1em;
			margin-top: -0.1em;
		}

		.fa-home{
			border:1px solid blue;
			padding: 0.1em 0.15em;
			border-radius: 50%;
			position: relative;
			font-size: 1.7em;
			transition: 0.5s;
		}

		.fa-home:hover{
			transform: scale(1.1);
		}

		li img{
			height: 1em;
			margin-top: -0.1em;
		}


		.mainC span{
			margin-top: -0.5em;
		}

	</style>
</head>
<body>

	<header class="header-area">
        <?php include_once("templates/topHeader.php");?>
	</header>

	<?php

		if (isset($_GET['subId'])) {
			$sid = $_GET['subId'];
			$chStatus = checkSubAvailable($sid);

			if($chStatus==0){
				echo '<script type="text/javascript">location.href = "papers.php";</script>';
			}

			if (isset($_GET['caID'])) {
				$caID = $_GET['caID'];
				$chSubStatus= checkSubCategory($caID);

				if($chSubStatus==0){
				echo '<script type="text/javascript">location.href = "?subId="'.$sid.'";</script>';
				}

				if (!isset($_GET['subId'])) {
					echo '<script type="text/javascript">location.href = "index.php";</script>';
				}
			}
		}

		
		if(isset($_GET["searchword"])){
			$sWord = $_GET['searchword'];
		}else{
			echo '<script type="text/javascript">history.go(-1);</script>';
		}


	?>

	<div class="body-wrapper">

		<div class="container path-container">
			<div class="col-12">
				<div class="page-path">

					<ul>

						<li><a href="index.php"><i class="fa fa-home"></i></a></li>

						<li><img src="images/rightarrow.png"></li>

						<li><a href="#">Search</a></li>

					</ul>

				</div>
			</div>
		</div>

		<div class="container paper-container">
			<div class="row">

					<div class="col-12 col-md-3 col-lg-2 category-area">
						<div class="category-div">
							<ul>
								<?php
									getAllAvialableSubjects();
									while($getRow = $GLOBALS['$getSubjectsResults']->fetch_assoc()){
								?>
									<li><a href="papers.php?subId=<?php echo $getRow["subjectID"];?>"><?php echo $getRow["subjectName"]; ?></a></li>

								<?php } ?>
							</ul>
						</div>
					</div>


					<div class="col-12 col-md-9 col-lg-7 paper-area">
						<div class="row">
							<?php 
								getSearchResults($sWord);
								while($getSearchPaper = $GLOBALS['$getSearchResults']->fetch_assoc())
							{ ?>

								<div class="single-paper col-12 col-sm-6 col-md-4" onclick="location.href='paper.php?pid=<?php echo $getSearchPaper["paperID"];?>';">
									<img src="<?php echo $getSearchPaper["subjectImage"];?>" alt="paper-cover-image" style="height: 8em;width: 100%;">
									<p><b><?php echo $getSearchPaper["paperName"];?></b></p>
								</div>

							<?php }?>
						</div>
					</div>

				<div class="col-12 col-md-12 col-lg-3 adv-area">
					<div class="row">
						<?php for($i=0;$i<3;$i++){ ?>
							<div class="single-ad col-12 col-md-3 col-lg-12">
								<img src="images/Advertise.jpg">
							</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>

		<!-- Web Details -->
			<?php include_once("templates/webdetails.php"); ?>
        <!-- Web Details End-->
	</div>


	<?php include_once("templates/jsIncludes.php"); ?>

	<?php include_once("templates/footer.php"); ?>
</body>
</html>