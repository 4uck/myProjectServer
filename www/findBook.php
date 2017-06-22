<?php

$user="root";
$password="";
$database="test";
mysql_connect("localhost",$user,$password) or
die("unable connect");
@mysql_select_db($database) or
die("unable select");
$query="
SELECT *
FROM `first`
";


$result=mysql_query($query);
//echo($result);
//echo($book_author);

$text="";
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++) {
  $id=mysql_result($result,$i,"id");
  $name=mysql_result($result,$i,"name");
  $code=mysql_result($result,$i,"code");
  $text="$text $name $code\n";
}

//$found_books=$text;
echo ("
<TEXTAREA NAME=\"ta_list_book\" ROWS=10 COLS=70>
$text
</TEXTAREA>
");
mysql_close();
?>