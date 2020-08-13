<!DOCTYPE html>
<html>
<head>
	<?php include_once("templates/headerIncludes.php"); ?>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
	<style>
		body{
    		background: #f5f5f0;
		}


		.paper-container{
		    background: #fff!important;
		}

		#mypapersTable_filter{
			
		}

	</style>

</head>

<body>
	<header class="header-area">
        <?php 
        	include_once("templates/topHeader.php");
        	include_once("templates/checkLogin.php");
        ?>
	</header>

	<div class="body-wrapper">
		<div class="container">
			<div class="paper-container">

					<button onclick="history.go(-1)" style="margin-bottom: 1em;padding: 0.5em 0.7em;border-radius: 50%;border:1px solid black;background: transparent;cursor: pointer;"><i class="fa fa-arrow-left"></i></button>
				
					<table id="mypapersTable" class="table table-bordered" width="" cellspacing="">
						<thead>
							<tr>
								<th width="5%">Paper</th>
								<th width="75%">Paper Name</th>
								<th width="10%">Date</th>
								<th width="10%">Marks</th>
							</tr>
						</thead>

						<tbody>

							<?php
								getAnswerdPapersbyID($userID);
								while($getAPRow = $GLOBALS['$getAnswerdPapersbyIDResults']->fetch_assoc()){
							?>

								<tr>
									<td></td>
									<td><?php echo $getAPRow["paperName"]; ?></td>
									<td><?php echo $getAPRow["ansdate"]; ?></td>
									<td><?php echo $getAPRow["Marks"]; ?></td>
								</tr>

							<?php } ?>
						</tbody>

					</table>


				
			</div>
		</div>




		<!-- Web Details -->
			<?php include_once("templates/webdetails.php"); ?>
        <!-- Web Details End-->

	</div>

	 <?php include_once("templates/jsIncludes.php"); ?>

	 <?php include_once("templates/footer.php"); ?>

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

	<script>
        $(document).ready(function () {
            var t = $('#mypapersTable').DataTable({
                rowReorder: {
	            selector: 'td:nth-child(0)'
	        	},
	        	responsive: true,
	        	"language": {
			      	"info": "Showing _START_ to _END_ of _TOTAL_ papers",
			    }
	        });

            t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();

	        });
    </script>
</body>

</html>