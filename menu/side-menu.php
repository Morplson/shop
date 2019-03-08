<head>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 

</head>


<style>

		*{
			font-size: 16pt;
		    font-family: 'Raleway', sans-serif;
		}
		body{
			x-overflow: hidden;
			padding: 0;
			margin: 0;
		}

		.overlay{
			z-index: -10;
			height: 100%;
			width: 100%;
			position: fixed;
			top: 0;
			left: 0;

			background-color: black;
			
			transition: opacity 0.6s;
			opacity: 0;
		}

		.moreinfo{
			z-index: 20;
			height: 100%;
			position: fixed;
			right:0;
			background-color: white;

			box-shadow: 1rem 0 1rem 1rem #999999;
		}

		.itembar{
			float: left;
			height: 100%;

			-webkit-user-select: none; /* Safari */        
			-moz-user-select: none; /* Firefox */
			-ms-user-select: none; /* IE10+/Edge */
			user-select: none; /* Standard */
		}

		.itembarmodul{
			margin: 0.5rem 0.5rem 0 0.5rem;
			height: 3rem;
			overflow: hidden;
			text-align: center;
			transition: background-color 0.6s;
		}

		.itembarmodul div{
			display: inline-block;
		}

		.itembarmodul:hover{
			background-color: #f2f2f2;
		}

		.itembartext{
			float: left;
			padding: 1rem 0;
			font-size: 1rem;

			width:0;

			transition: width 0.6s ease, padding 0.6s ease
		}

		.itembar:hover .itembartext{
			width: 6rem;
			padding: 1rem;
		}

		.itembaricon{
			float: left;
			width: 3rem;
			height: 3rem;
		}

		i.si{
			margin-top: 0.5rem; 
			font-size: 2rem;
		}

		i.cl{
			font-size: 3rem;
		}

		
		.sidecontainer{
			z-index: inherit;
			float:left;
			
			height: 100%;
			width: 0;
			
			transition: width 0.6s ease-out;

			top: 0;
			
		}

		.sidecontainer>div{
			height: 100%;
			width: 26rem;
			display: none;
		}

		.closeside{
			float: right;
			width: 3rem;
			height: 3rem;
			right: 0.5rem;
			top: 0.5rem;
			transition: opacity 0.6s;
			opacity: 0;
			display: none;
			position: fixed;
			text-align: center;
		}


		
</style>


	<div class="overlay" id="overlay"></div>

	<div class="moreinfo">
		<div class="itembar" id="itembar">

			<div class="itembarmodul" id="info" >
					<div class="itembaricon"><i class="si fas fa-shopping-basket"></i></div>
					<div class="itembartext">Wahrenkorb</div>
			</div>
			<div class="itembarmodul" id="profile" >
					<div class="itembaricon"><i class="si fas fa-user"></i></div>
					<div class="itembartext">Profil</div>
			</div>
			<div class="itembarmodul" id="playlist">
					<div class="itembaricon"><i class="si fas fa-cog"></i></div>
					<div class="itembartext">Playlists</div>
			</div>
			<div class="itembarmodul" id="upload">
					<div class="itembaricon"><i class="si fas fa-upload"></i></div>
					<div class="itembartext">Hochladen</div>
			</div>
		</div>
		<div class="sidecontainer" id="sidecontainer">
			<div class="sideinfo" id="sideinfo"></div>
			<div class="sideprofile" id="sideprofile"></div>
			<div class="sideconfig" id="sideconfig"></div>
			<div class="sideupload" id="sideupload"></div>
			
		</div>
		<div class="closeside" id="closeside"><i class="cl fas fa-times"></i></div>
	</div>
	


<script>
document.addEventListener('DOMContentLoaded', function(){
	document.getElementById("info").addEventListener("click", animationTrigger, false);
	document.getElementById("profile").addEventListener("click", animationTrigger, false);
	document.getElementById("playlist").addEventListener("click", animationTrigger, false);
	document.getElementById("upload").addEventListener("click", animationTrigger, false);
	document.getElementById("overlay").addEventListener("click", animationTrigger, false);
	document.getElementById("closeside").addEventListener("click", animationTrigger, false);

	function animationTrigger(e){
		e.preventDefault();	
			switch(e.currentTarget.id){
				case "info":
					
					var url = "http://localhost/shop/info/";
					var body = JSON.stringify({});
					
					if(document.getElementById("sideinfo").style.display != "block"){
							document.getElementById("sideupload").style.display = "none";
							document.getElementById("sideconfig").style.display = "none";
							document.getElementById("sideprofile").style.display = "none";

							var destination = "sideinfo"; 
							sideLoader(url, body, destination);
					}

	
					break;
				case "profile":
					var url = "http://localhost/shop/profile/";
					var body = JSON.stringify({});
					
					if(document.getElementById("sideprofile").style.display != "block"){
							document.getElementById("sideinfo").style.display = "none";
							document.getElementById("sideupload").style.display = "none";
							document.getElementById("sideconfig").style.display = "none";

							var destination = "sideprofile"; 
							sideLoader(url, body, destination);
					}
					break;
				case "playlist":
					var url = "http://localhost/shop/playlist/";
					var body = JSON.stringify({});
	
					if(document.getElementById("sideconfig").style.display != "block"){
							document.getElementById("sideprofile").style.display = "none";
							document.getElementById("sideinfo").style.display = "none";
							document.getElementById("sideupload").style.display = "none";

							var destination = "sideconfig"; 
							sideLoader(url, body, destination);
					}
					break;
				case "upload":
					var url = "http://localhost/shop/upload/";
					var body = JSON.stringify({});
	
					if(document.getElementById("sideupload").style.display != "block"){
							document.getElementById("sideconfig").style.display = "none";
							document.getElementById("sideprofile").style.display = "none";
							document.getElementById("sideinfo").style.display = "none";

							var destination = "sideupload"; 
							sideLoader(url, body, destination);
					}
					break;
				case "overlay": case "closeside":
					document.getElementById("sidecontainer").style.width = "0";
					document.getElementById("overlay").style.opacity = "0";
					document.getElementById("closeside").style.opacity = "0";

					setTimeout(()=>{
						document.getElementById("overlay").style.zIndex = "-10";
						document.getElementById("closeside").style.display = "none";

						document.getElementById("sideconfig").style.display = "none";
						document.getElementById("sideprofile").style.display = "none";
						document.getElementById("sideinfo").style.display = "none";
						document.getElementById("sideupload").style.display = "none";
					}, 666);

					
					break;
				default:
					break;
	
			}
	}

	function sideLoader(url, body, destination){
			document.getElementById("sidecontainer").style.width = "26rem";
			document.getElementById("overlay").style.opacity = "0.25";
			document.getElementById("overlay").style.zIndex = "19";
			document.getElementById("closeside").style.display = "block";
			document.getElementById("closeside").style.opacity = "1";
			

			fetch(url, {
				method: 'post',
				headers: {
					"Content-type": "text/html"
				},
				body: body
			}).then(function (response) {
				return response.text();
			}).then(function (data) {
				//console.log(data);
				document.getElementById(destination).style.display = "block";
				document.getElementById(destination).innerHTML = ""+data;
	
			}).catch(function (error) {
				console.log('Request failed', error);
			});
		

	}
});
</script>