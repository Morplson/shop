<?php

include '../open.php';

$pdo = new PDO ( 'mysql:host=localhost;dbname=shop' , 'root' , '' );
//echo nl2br(print_r($_SESSION,true));

if ($_SESSION [ 'istAngemeldet' ]==true&&$_SESSION [ 'istAngemeldet' ]!=NULL ) {
$nummer = $_SESSION['userid'];													//Need to be deletedS
$n2=$nummer;

$sql = "SELECT email FROM user WHERE uname = $bname" ;  //Note this does not work
$email = $pdo -> query ( $sql );


echo "Username: ";
echo $_SESSION['name'];
echo "<br>";
echo "UserId ";
echo $n2;
echo "<br>";
echo "E-mail: ";
echo $email;
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>

</body>
</html>
