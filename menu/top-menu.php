<?
	include 'open.php';
?>

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
	@media only screen and (min-width: 768px) {
		.mobile {
			display: none;
		}
	}
</style>
	<div class="header">
		<a href="shop/"><div class="label topleftli">Boorushop</div></a>
		<a><div class="mobile topleftli"><i class="fas fa-bars"></i></div></a>
		<a href="shop/"><div class="desktop topleftli">Beliebt</div></a>
		<a href="shop/"><div class="desktop topleftli">Neu</div></a>

		<a href=""><div class="desktop toprightli">Login</div></a>
		<div class="desktop toprightli"><input class="search" type="text" placeholder="Search..." name="sInput"></div>

		
	</div>
	