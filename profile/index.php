<?php

include '../open.php';

//echo nl2br(print_r($_SESSION,true));

if ($_SESSION [ 'istAngemeldet' ]==true&&$_SESSION [ 'istAngemeldet' ]!=NULL ) {
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
if($_SESSION['id']!=0){
echo $email[$_SESSION['id']-1];
}
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
