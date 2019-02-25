

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
		}
		#slideshow div{
			float: left;
		}
		#slideshow img{
    		max-width: 90%;
    		max-height: 20rem;
		}
		
		#slideshow video{
    		max-width: 90%;
    		margin: auto;
    		overflow: auto;
		}
		.loader{
			margin-top: 2rem;
			position: absolute;
    		bottom: 1rem;
    		width: 100%;
		}
		.lds-ring {
			position: relative;
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
	var loaded = 100;
	var folders = ["images/digs/"];
	var times = 40;

	$(document).ready(function(){


		

		request(times);



		$(document).keypress(function(event){
			switch(event.key){
				default:
					break;
			}
		});

		$(window).scroll(function () {
    		if ($(document).height() <= $(window).scrollTop() + $(window).height()-100) {
        		alert("End Of The Page");
        		//if(!blocked){
        			request(times);
        		//}
        		
    		}
		});

		
	});

	function nextBatsh() {
		request(times);
	}

	function request(times){
		console.log("loading...");
		$.post( "get.php", { times: times, 'folder[]': folders }, function( data ) {
			$( "#slideshow" ).append( data );
			console.log("done!");
		});
		
	}

</script>
</head>
<body>
	<div id="slideshow">
		
	</div>
	<div class="loader">
		<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
	</div>
</body>
</html>

