<?php include 'header-gui.php';?>
		<h2>Anmelden:</h2>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<?php echo $messege;?>
				<div class="inline">
					<div>Name</div>
					<div>Passwort</div>

				</div>
				<div class="inline">
					<div>
						<input type="text" name="name"
						 value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
					</div>
					<div>
						<input type="password" name="psw"
						 value="<?php if (isset($_POST['psw'])) echo $_POST['psw']; ?>">
					</div>

				</div>
				<br>
			<input type="submit" name="anmelden" value="Anmelden">
			<input type="submit" name="abbrechen" value="Abbrechen">
		</form>
	
		
	
<?php	include 'footer-gui.php';