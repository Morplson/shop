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
	}

	.label{
		font-weight: bold;

	}

	.topleftli{

		transition: background-color .6s;

		padding: 1rem;
		float: left;
	}

	.toprightli{
		transition: background-color .6s;

		padding: 1rem;
		float: right;
	}
</style>
	<div class="header">
		<a href="shop/"><div class="label topleftli">Boorushop</div></a>
		<a href="shop/"><div class="topleftli">Beliebt</div></a>
		<a href="shop/"><div class="topleftli">Neu</div></a>

		<a href=""><div class="toprightli">Login</div></a>
		<div class="toprightli"><input class="search" type="text" placeholder="Search..." name="sInput"></div>

	</div>