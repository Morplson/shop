
<head>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 

</head>


<style>




		
</style>


	<div class="overlay" id="overlay"></div>

	<div class="moreinfo">
		<div class="itembar" id="itembar">

			<div class="itembarmodul" id="info" >
					<div class="itembaricon"><i class="si fas fa-shopping-basket"></i></div>
					<div class="itembartext">Warenkorb</div>
			</div>
			<div class="itembarmodul" id="profile" >
					<div class="itembaricon"><i class="si fas fa-user"></i></div>
					<div class="itembartext">Profil</div>
			</div>
			<div class="itembarmodul" id="playlist">
					<div class="itembaricon"><i class="si fas fa-heart"></i></div>
					<div class="itembartext">Wunschliste</div>
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
					
					var url = "korb/";
					var body = JSON.stringify({});
					
					if(document.getElementById("sideinfo").style.display != "block"){
							document.getElementById("sideupload").style.display = "none";
							document.getElementById("sideconfig").style.display = "none";
							document.getElementById("sideprofile").style.display = "none";

							var destination = "sideinfo"; 
							sideLoader(url, body, destination);
							requestkorb("korb");
					}

	
					break;
				case "profile":
					var url = "profile/";
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
					var url = "wunschliste/";
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
					var url = "upload/";
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