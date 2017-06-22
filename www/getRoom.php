<?php

$user="root";
$password="";
$database="test";

mysql_connect("localhost",$user,$password) or
die("unable connect");
@mysql_select_db($database) or
die("unable select");

$query="SELECT *
		FROM `room`
";

mysql_query("SET NAMES utf8");

$q=mysql_query($query);

while($e=mysql_fetch_assoc($q)){
        $output[]=$e;
		/*foreach($e as $key => $value){
			echo("{$key} => {$value} ");
		}
		echo("</br>");*/
	}
print(json_encode($output));

mysql_close();

?>