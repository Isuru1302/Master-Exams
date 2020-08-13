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

		
		


	?>

	<div class="body-wrapper">

		<div class="container path-container">
			<div class="col-12">
				<?php include_once("templates/path.php"); ?>
			</div>
		</div>

		<div class="container paper-container">
			<div class="row">
				
				<?php if(isset($_GET['subId'])) {?>

					<div class="col-12 col-md-3 col-lg-2 category-area">
						<div class="category-div">
							<ul>
								<li><a href="papers.php?subId=<?php echo $sid; ?>">All Subjects</a></li>
								<?php
									getAvailableSubCategoriesByID($sid);


									while($getsubCRow = $GLOBALS['$getAvailableSubCategoriesByIDResults']->fetch_assoc()){
								?>
									<li><a href="papers.php?subId=<?php echo $sid; ?>&caID=<?php echo $getsubCRow["subSubID"]; ?>"><?php echo $getsubCRow["subSubName"]; ?></a></li>

								<?php } ?>
							</ul>
						</div>
					</div>

					<div class="col-12 col-md-9 col-lg-7 paper-area">
						<div class="row">
							<?php 

								if (isset($_GET['subId']) && !isset($_GET['caID'])) {
									getPaperByID($sid);
								}else{
									$caID = $_GET['caID'];
									getPaperByID2($sid,$caID);
								}

								
								while($getPapersRow = $GLOBALS['$getPaperByIDResults']->fetch_assoc())
							{ ?>

								<div class="single-paper col-12 col-sm-6 col-md-4" onclick="location.href='paper.php?pid=<?php echo $getPapersRow["paperID"];?>';">
									<img src="<?php echo $getPapersRow["subjectImage"];?>" alt="paper-cover-image" style="height: 8em;width: 100%;">
									<p><b><?php echo $getPapersRow["paperName"];?></b></p>
								</div>

							<?php }?>
						</div>
					</div>

				<?php } else{?>

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
								getPapers();
								while($getPRow = $GLOBALS['$getPapersResults']->fetch_assoc())
							{ ?>

								<div class="single-paper col-12 col-sm-6 col-md-4" onclick="location.href='paper.php?pid=<?php echo $getPRow["paperID"];?>';">
									<img src="<?php echo $getPRow["subjectImage"];?>" alt="paper-cover-image" style="height: 8em;width: 100%;">
									<p><b><?php echo $getPRow["paperName"];?></b></p>
								</div>

							<?php }?>
						</div>
					</div>
				<?php }?>

				<div class="col-12 col-md-12 col-lg-3 adv-area">
					<div class="row">
						<?php 
							getAd();
							while($getaRow = $GLOBALS['$getAdResults']->fetch_assoc())
						{ 

								$adImg = $getaRow["AdImage"];
								$adLink = $getaRow["Link"];

							?>
							<div class="single-ad col-12 col-md-3 col-lg-12">


								<?php if($adLink==""){ ?>

									<img src="<?php echo $adImg; ?>">
								<?php } else{?>
									<a href="//<?php echo $adLink; ?>"><img src="<?php echo $adImg; ?>"></a>
								<?php } ?>

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