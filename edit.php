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
	<div class="body-wrapper">
		<div class="container">
			<div class="paper-container">
				<div class="row">
					<div class="edit-form">
						<form action="#" method="POST">
							first name: <input type="text" name="uFname" required>
							last name: <input type="text" name="uLname" required>
							emial: <input type="emial" name="uEmail" required>
							contact: <input type="text" name="uContact" keypress="allowNumbersOnly(event)" required>
							city: <input type="text" name="uCity" required>
							
						</form>

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