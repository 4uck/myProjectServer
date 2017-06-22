<?php
	
$user="root";
$password="";
$database="test";

mysql_connect("localhost",$user,$password) or
die("unable connect");
@mysql_select_db($database) or
die("unable select");

$perem = $_POST['content'];

$query="SELECT *
		FROM `first` WHERE room_id = '$perem'
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

/*function normJsonStr($str){
    $str = preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $str);
    return iconv('cp1251', 'utf-8', $str);
}*/
	
?>