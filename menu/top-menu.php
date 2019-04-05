
<style>
	input[type="text"].search {
		vertical-align: middle;
		margin: 0;
		padding: 0;

		background-color: transparent;
		border: none;
		color: black;
	}

	.header{
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;		
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		z-index: 5;
		padding-left: 3.5rem;
		padding-right: 9rem;
		background-color: white;

		height: 3rem;
		overflow: hidden;
	}

	.label{
		font-weight: bold;

	}

	.topleftli{

		transition: background-color .6s;

		padding: 0 1rem;
		line-height: 3rem;
		float: left;
	}

	.toprightli{
		transition: background-color .6s;

		padding: 0 1rem;
		line-height: 3rem;
		float: right;
	}

	@media only screen and (max-width: 768px) {
		.desktop {
			display: none;
		}
	}
	@media only screen and (min-width: 767px) {
		.mobile {
			display: none;
		}
	}

	.mobilecontainer{

		background-color: white;
		z-index: 30;

		position: fixed;
		box-sizing: content-box;

	}
	
	.mobilecontainer>.exput{
		transition: background-color .6s;
		line-height: 3rem;
		height: 3rem;
		padding: 0 1rem;
	}

	.exput:hover, .topleftli:hover, .toprightli:hover{
		background-color: #f2f2f2
	}

</style>
<script type="text/javascript">
	
</script>
	<div class="header">
		<a href="../shop/"><div class="label topleftli">Shop.com</div></a>
		<a><div id="mobilemenu" class="mobile topleftli"><i class="fas fa-bars"></i></div></a>
		<!--a href="../shop/search.php?q=top"><div class="desktop topleftli">Beliebt</div></a>
		<a href="../shop/search.php?q=new"><div class="desktop topleftli">Neu</div></a-->

		<a href="login/"><div class="desktop toprightli">Login</div></a>
		<div class="desktop toprightli">
			<input id="search" class="search" type="text" placeholder="Search..." name="sInput">
			<i class="fas fa-search" onclick="search()"></i>
		</div>



		
	</div>
	<div id="mobilehovercontainer" class="mobilecontainer" style="display: none;">
		<a class="exput" href="login/">Login</a>
		<div class="exput"><input id="searchm" class="search" type="text" placeholder="Search..." name="sInput"></div>
	</div>

	<script type="text/javascript">
		const searchinp = document.getElementById("search");
		searchinp.addEventListener("keyup", ()=>{
			if (event.key === "Enter") {
				search();
			}
		});

		const searchinpm = document.getElementById("searchm");
		searchinpm.addEventListener("keyup", ()=>{
			if (event.key === "Enter") {
				search();
			}
		});

		function search(){
       		window.location.replace("search.php?s="+searchinp.value);
    	}
	

		const mobilemenu = document.getElementById("mobilemenu");
		mobilemenu.addEventListener("mouseover", function(event) {
    		
       		let el = document.getElementById("mobilehovercontainer");
       		el.style.display = "block";
       		el.style.left = mobilemenu.offsetLeft+"px";
       		el.style.top =  mobilemenu.offsetTop+mobilemenu.offsetHeight+"px";

		});
		mobilemenu.addEventListener("mouseout", function(event) {
    		
       		let el = document.getElementById("mobilehovercontainer");
       		el.style.display = "none";
    	
		});



		const mobilehovercontainer = document.getElementById("mobilehovercontainer");
		mobilehovercontainer.addEventListener("mouseover", function(event) {
    		
       		let el = document.getElementById("mobilehovercontainer");
       		el.style.display = "block";
    	
		});
		mobilehovercontainer.addEventListener("mouseout", function(event) {
    		
       		let el = document.getElementById("mobilehovercontainer");
       		el.style.display = "none";
    	
		});



	</script>
	