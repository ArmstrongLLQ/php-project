<?php 
header ( "Content-type:application/vnd.ms-excel" );  
header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GB18030", "query_user_info" ) . ".csv" );  
  
// 打开PHP文件句柄，php://output 表示直接输出到浏览器  
$fp = fopen('php://output', 'a');   

require_once "mysqlTools.php";

$mysql_tools = new MysqlTools();
$conn = $mysql_tools->connectMysql();

function selectData($conn, $select_sql, $pagesize)
{
    $total_result = mysqli_query($conn, $select_sql); 
    if (!$total_result) {
     printf("Error: %s\n", mysqli_error($conn));
     exit();
    }
    $total_row_arr = mysqli_fetch_row($total_result); 
    $total_row = $total_row_arr[0];   //总条数 
    //总页数 
    $total = ceil($total_row / $pagesize); 
    //当前页数 
    $page = @$_GET['p'] ? $_GET['p'] : 1; 
    //limit 下限 
    $offset = ($page - 1)*$pagesize; 

    //上一页 、下一页 
    $pageprev = $page -1 ; 
    if($page > $total){ 
     $pagenext = $total; 
    } else{ 
     $pagenext = $page +1; 
    }

    // 需要返回的参数列表，分别是总页数、当前页、前一页、后一页、数据库查询偏移量
    $page_para[] = $total;
    $page_para[] = $page;
    $page_para[] = $pageprev;
    $page_para[] = $pagenext;
    $page_para[] = $offset;
    $page_para[] = $total_row;

    return $page_para;
}

$pagesize = 10000; 
$total_sql = "select COUNT(*) from doaj_data";
list($total, $page, $pageprev, $pagenext, $offset, $total_row) = selectData($conn, $total_sql, $pagesize);

// // 将中文标题转换编码，否则乱码  
// foreach ($column_name as $i => $v) {    
//        $column_name[$i] = iconv('utf-8', 'GB18030', $v);    
//    }  
//    // 将标题名称通过fputcsv写到文件句柄    
//    fputcsv($fp, $column_name);  

for ($i=0; $i < $total; $i++) { 
    $offset = $i * $pagesize;
    $sql = "select * from doaj_data order by id limit {$offset},{$pagesize}";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $item) {
    	$rows = array(); 
    	foreach ( $item as $export_obj){  
            $rows[] = iconv('utf-8', 'GB18030', $export_obj);  
        } 
        fputcsv($fp, $rows);  
    }
    unset($export_data);  
    ob_flush();  
    flush(); 
}
 
exit ();  
 ?>