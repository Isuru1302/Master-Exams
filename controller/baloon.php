<style>
	
	.balloonclass { 
		margin:20px;  
		text-align:center; 
		position: relative;
		z-index: 999;
		animation: mymove 12s;
	}

	.balloon {
		display:inline-block;
		width:120px;
		height:145px;
		background:hsl(215,50%,65%);
		border-radius:80%;
		position:relative;
		box-shadow:inset -10px -10px 0 rgba(0,0,0,0.07);
		margin:20px 30px;
		transition:transform 0.5s ease;
		z-index:10;
		animation:balloons 4s ease-in-out infinite;
		transform-origin:bottom center;
		vertical-align: middle;
		line-height: 145px;
		font-size: 3em;
		color: #fff;
	}

	@keyframes balloons {
	  	0%,100%{ transform:translateY(0) rotate(-4deg); }
	  	50%{ transform:translateY(-25px) rotate(4deg); }
	}


	.balloon:before {
	  	content:"";
	  	font-size:20px;
	  	color:hsl(215,30%,50%);
	  	display:block;
	  	text-align:center;
	  	width:100%;
	  	position:absolute;
	  	bottom:-12px;
	  	z-index:-100;
	}

	.balloon:after {
	 	display:inline-block; top:153px;
	  	position:absolute;
	  	height:250px;
	  	width:1px;
	  	margin:0 auto;
	  	content:"";
	  	background:rgba(0,0,0,0.2); 
	}

	.balloon:nth-child(2){ background:hsl(245,40%,65%); animation-duration:3.5s; }
	.balloon:nth-child(2):before { color:hsl(245,40%,65%);  }

	.balloon:nth-child(3){ background:hsl(139,50%,60%); animation-duration:3s; }
	.balloon:nth-child(3):before { color:hsl(139,30%,50%);  }

	.balloon:nth-child(4){ background:hsl(59,50%,58%); animation-duration:4.5s; }
	.balloon:nth-child(4):before { color:hsl(59,30%,52%);  }

	.balloon:nth-child(5){ background:hsl(23,55%,57%); animation-duration:5s; }
	.balloon:nth-child(5):before { color:hsl(23,44%,46%);  }


	@keyframes mymove {
		from {top: 700px; }
	  	to {top: -500px;}
	}


</style>

<?php 
	$i=2;
	if($i/2==1){
	
?>

	<div class="balloonclass" id="balloonclass">
		<div class="balloon">&nbsp;</div>
		<div class="balloon">G</div>
		<div class="balloon">O</div>
		<div class="balloon">O</div>
		<div class="balloon">D</div>
		<div class="balloon">&nbsp;</div>
	</div>

<?php } ?>

<script>
	var myBox = document.getElementById('balloonclass');
	myBox.addEventListener('webkitAnimationEnd',function( event ) { myBox.style.display = 'none'; }, false);
</script>