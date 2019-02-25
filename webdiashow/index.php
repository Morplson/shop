<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title></title>
	<style type="text/css">
		body{
			padding: 0;
			margin: 0;
			overflow: hidden;
		}
		#slideshow img{
		    position: fixed;
    		top: 0;
    		bottom: 0;
    		left: 0;
    		right: 0;
    		max-width: 90%;
    		height: 90%;
    		margin: auto;
    		overflow: auto;
		}
		
		#slideshow video{
		    position: fixed;
    		top: 0;
    		bottom: 0;
    		left: 0;
    		right: 0;
    		max-width: 90%;
    		height: 90%;
    		margin: auto;
    		overflow: auto;
		}

		.lds-ring {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			z-index: -1;
			display: inline-block;
			width: 64px;
			height: 64px;
		}
		.lds-ring div {
			box-sizing: border-box;
			display: block;
			position: absolute;
			width: 51px;
			height: 51px;
			margin: 6px;
			border: 6px solid #333333;
			border-radius: 50%;
			animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
			border-color: #333333 transparent transparent transparent;
		}
		.lds-ring div:nth-child(1) {
			animation-delay: -0.45s;
		}
		.lds-ring div:nth-child(2) {
			animation-delay: -0.3s;
		}
		.lds-ring div:nth-child(3) {
			animation-delay: -0.15s;
		}
		@keyframes lds-ring {
			0% {
				transform: rotate(0deg);
			}
			100% {
				transform: rotate(360deg);
			}
		}
	</style>

<script type="text/javascript">
	var hold = false;
	var loaded = 1;
	var folders = ["images/digs/"];
	var times = 7;

	$(document).ready(function(){


		

		request(times);



		$(document).keypress(function(event){
			switch(event.key){
				case "ArrowRight":
					nextSlide();
					break;
				case "ArrowLeft":
					lastSlide();
					break;
				case " ":
					if(hold){
						hold = false;
					}else{
						hold = true;
					}
					break;
				default:
					break;
			}
		});

		$("#slideshow > div:gt(0)").hide();

		setInterval(function() { 
			if(!hold){
				nextSlide();

			}
 		},  5000);
	});

	function nextSlide() {
		loaded++;
		if(loaded > times){
			request(times);
			loaded = 1;
		}else{
			$('#slideshow > div:first').fadeOut("slow").appendTo('#slideshow');
			$('#slideshow > div:first').fadeIn("slow");

			
			
		}
	}

	function lastSlide() {
		loaded--;
		if(loaded > times){
			request(times);
			loaded = 1;
		}else{
			$('#slideshow > div:first').fadeOut("slow");
			$('#slideshow > div:last').fadeIn("slow").prependTo('#slideshow');
			
		}
	}


	function request(times){
		$('#slideshow').find("div").css('display', 'none');
		$(".lds-ring").fadeIn("fast");
		$.post( "get.php", { times: times, 'folder[]': folders }, function( data ) {
			$( "#slideshow" ).prepend( data );
			$('#slideshow').find("div").css('display', 'none');
			$('#slideshow > div:first').fadeIn("slow");
			$(".lds-ring").fadeOut("fast");
		});
		
	}


</script>
</head>
<body>
	<div id="slideshow">
		
	</div>
	<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
</body>
</html>

