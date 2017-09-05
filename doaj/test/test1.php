<?php 
$i = 1;

header ( "Content-type:application/vnd.ms-excel" );  
header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GB18030", "$i" ) . ".csv" ); 

$fp = fopen('php://output', 'a');   
$row[] = ['1','2'];
fputcsv($fp, $rows); 
exit();  
 ?>