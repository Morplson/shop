<?php

include '../open.php';


$jj = $_SESSION [ 'istAngemeldet' ];
echo $jj."asdas";

var_dump($_SESSION);

if ($_SESSION [ 'istAngemeldet' ]==true ) {
$nummer = $_SESSION['userid'];
$n2=$nummer;

$name = file ( "../global/data/bname.txt" ) ;

$email = file ( "../global/data/bemail.txt" ) ;

echo "Username: ";
echo $_SESSION['name'];
echo "<br>";
echo "UserId ";
echo $n2;
echo "<br>";
echo "E-mail: ";
echo $email[$_SESSION['id']-1];
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
