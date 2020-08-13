<style>
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

<?php

	if (isset($_GET['subId'])) {
		$sid = $_GET['subId'];

		getMainByID($sid);
		while($getMain = $GLOBALS['$getMainByIDResults']->fetch_assoc()){
			$main = $getMain["subjectName"];
		}


	}if(isset($_GET['caID'])){
		$caID = $_GET['caID'];

		getSubByID($caID);
		while($getSub = $GLOBALS['$getSubByIDResults']->fetch_assoc()){
			$sub = $getSub["subSubName"];
		}
	}

?>

<div class="page-path">

	<ul>

		<li><a href="index.php"><i class="fa fa-home"></i></a></li>

		<li><img src="images/rightarrow.png"></li>

		<?php if (!isset($_GET['subId']) && !isset($_GET['caID'])) { ?>
			<li class="mainCLi"><a href="papers.php" class="mainC"><span>All Papers</span></a></li>
		<?php } else{ ?>	

			<?php if(isset($_GET['subId'])){?>
				<li class="mainCLi"><a href="?subId=<?php echo $sid; ?>" class="mainC"><span><?php echo $main; ?></span></a></li>
			<?php } ?>

			<?php  if(isset($_GET['caID'])){?>
				<li><img src="images/rightarrow.png"></li>

				<li><a href="?subId=<?php echo $sid; ?>&caID=<?php echo $caID; ?>" class="subC"><span><?php echo $sub; ?></span></a></li>
			<?php } ?>
		<?php }?>	

	</ul>

</div>