<?php

include '../open.php';

$log=file("../global/data/logedIn.txt" ) ;

if($log[0]=="yes"){
$nummer = file ( "../global/data/idUsedNow.txt" ) ;
$n2=$nummer[0];

$name = file ( "../global/data/bname.txt" ) ;

$email = file ( "../global/data/bemail.txt" ) ;

echo $n2;
echo ";";
echo $name[$n2];
echo ";";
echo $email[$n2];
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
