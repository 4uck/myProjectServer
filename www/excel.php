<?php

$user="root";
$password="";
$database="test";

mysql_connect("localhost",$user,$password) or
die("unable connect");
@mysql_select_db($database) or
die("unable select");

$str1=$_POST['json'];
$str = str_replace("\\", "", $str1);

$json = json_decode($str);


$excel = new COM("Excel.Application");
$book = $excel->Workbooks->Open("C:/WebServers/home/192.168.1.40/www/Reports/test.xlsx");
$sheet = $book->WorkSheets->Add();
		  
$query="SELECT *
		FROM `room` WHERE id = '$json[0]'
";

mysql_query("SET NAMES utf8");

$q=mysql_query($query);

$name = mysql_result($q,0,"name");

$sheet->Name = "$name" . " " . date("m.d.y");

$sheet->Columns(2)->ColumnWidth = 25;
$sheet->Columns(3)->ColumnWidth = 50;
$sheet->Columns(4)->ColumnWidth = 40;
$sheet->Columns(5)->ColumnWidth = 10;

$sheet->cells(2,2)->value = "Code";
$sheet->cells(2,3)->value = "Name";
$sheet->cells(2,4)->value = "Responsible Person";
$sheet->cells(2,5)->value = "Presence";

$query = "SELECT *
         FROM `first` WHERE room_id = '$json[0]'";

mysql_query("SET NAMES cp1251");

$q=mysql_query($query);

$i = 2;
while($e=mysql_fetch_assoc($q)){
	
	$i++;
    
    foreach($e as $key => $value){
        switch ($key){
        case "code":
            $sheet->cells($i,2)->value = $value;
            if (array_search($value, $json, $strict) == FALSE){
                $sheet->cells($i,5)->value = "No";
            } else {
              $sheet->cells($i,5)->value = "Yes";  
            }
            break;
        case "name":
            $sheet->cells($i,3)->value = $value;
            break;
        }
    }   
}

$sheet->Range("B3:B$i")->NumberFormat = "0";
$sheet->Range("B2:E$i")->HorizontalAlignment = -4108;
$sheet->Range("B2:E$i")->Borders->LineStyle = 1;


print "Complete!";

mysql_close();
$book->Save();
$excel->Workbooks->Application->DisplayAlerts = False;
$excel->Workbooks->Close();
$excel->quit();

?>