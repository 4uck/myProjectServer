<?php
	
$user="root";
$password="";
$database="test";
mysql_connect("localhost",$user,$password) or
die("unable connect");
@mysql_select_db($database) or
die("unable select");

$number = $_POST['content'];

$query="SELECT *
		FROM `first` WHERE code = $number";

$q=mysql_query($query);

while($e=mysql_fetch_assoc($q))
        $output[]=$e;
print(json_encode($output));

mysql_close();
	
?>