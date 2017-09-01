<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>doaj</title>
    <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5.2/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5.2/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5.2/demo/demo.css">
    <script type="text/javascript" src="jquery-easyui-1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="jquery-easyui-1.5.2/jquery.easyui.min.js"></script>
    <script type="text/javascript">
        function exportxlm()
        {

        }
    </script>
</head>
<body>
<h2>Doaj数据</h2>
<?php
function connectMysql($my_host, $my_username, $my_password, $my_database)
{
    //连接数据库
    $con = mysqli_connect($my_host, $my_username, $my_password, $my_database);
    mysqli_query($con, "SET NAMES 'utf8'");
    mysqli_query($con, "SET CHARACTER SET utf8");
    if(!$con)
    {
        die("连接失败: " . mysqli_connect_error());
    }
    return $con;
}

function selectData($con, $select_sql, $pagesize)
{
    $total_result = mysqli_query($con, $select_sql); 
    if (!$total_result) {
     printf("Error: %s\n", mysqli_error($con));
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


$con = connectMysql("172.16.155.11","doaj","Doa123!@#j", "doaj");

$pagesize = 100; 

//查询记录总数 
$total_sql = @$_GET['my_sql'] ? "select COUNT(*) ".strstr($_GET['my_sql'], "from doaj_data"):"select COUNT(*) from doaj_data"; 
$chaxun = @$_GET['my_sql'] ? $_GET['my_sql'] : "";

list($total, $page, $pageprev, $pagenext, $offset, $total_row) = selectData($con, $total_sql, $pagesize);
?>

<h3>
    <a href='test.php?my_sql=<?php echo $chaxun;?>'>首页</a> 丨 
    <a href='test.php?p=<?php echo $pageprev;?>&my_sql=<?php echo $chaxun;?>'>上一页</a> | 
    <a href='test.php?p=<?php echo $pagenext;?>&my_sql=<?php echo $chaxun;?>'>下一页</a> 丨 
    <a href='test.php?p=<?php echo $total;?>&my_sql=<?php echo $chaxun;?>'>尾页</a> | 
    <a href='test.php'>返回</a>
</h3>

<form action='' method='get'>
总条数：<?php echo $total_row;?> | 第 <?php echo $page;?>/<?php echo $total;?> 页 | 页码：<input type="text" name="p"><input type="hidden" name="my_sql" value="<?php echo $chaxun ?>" "><input type="submit" value="跳转">
</form> 

<div style="margin:20px 0;"></div>
<table class="easyui-datagrid" title="Frozen Columns in DataGrid" style="width:100%;height: 800px"
        data-options="rownumbers:true,singleSelect:true,url:'datagrid_data1 - 副本.json',method:'get'">
<!--      <thead data-options="frozen:true">
        <tr>
            <th data-options="field:'id',width:40">id</th>
            <th data-options="field:'title',width:150">title</th>
        </tr>
    </thead> -->
    <thead>
        <tr>
        <th data-options="field:'id',width:40">id</th>
            <th data-options="field:'title',width:150">title</th>
            <th data-options="field:'ittitle_translationemid',width:150">title_translation</th>
            <th data-options="field:'abstract',width:150">abstract</th>
            <th data-options="field:'abstract_translation',width:150">abstract_translation</th>
            <th data-options="field:'year',width:150">year</th>
            <th data-options="field:'url',width:150">url</th>
            <th data-options="field:'start_page',width:150">start_page</th>
            <th data-options="field:'end_page',width:150">end_page</th>
            <th data-options="field:'article_created_date',width:150">article_created_date</th>
            <th data-options="field:'article_last_updated',width:150">article_last_updated</th>
            <th data-options="field:'journals_publisher',width:150">journals_publisher</th>
            <th data-options="field:'journals_language',width:150">journals_language</th>
            <th data-options="field:'journals_licenseId',width:150">journals_licenseId</th>
            <th data-options="field:'journals_title',width:150">journals_title</th>
            <th data-options="field:'journals_country',width:150">journals_country</th>
            <th data-options="field:'journals_number',width:150">journals_number</th>
            <th data-options="field:'journals_volume',width:150">journals_volume</th>
            <th data-options="field:'journals_issns',width:150">journals_issns</th>
            <th data-options="field:'journals_create_date',width:150">journals_create_date</th>
            <th data-options="field:'term',width:150">term</th>
            <th data-options="field:'term_code',width:150">term_code</th>
            <th data-options="field:'term_l1',width:150">term_l1</th>
            <th data-options="field:'keyword',width:150">keyword</th>
            <th data-options="field:'keyword_translation',width:150">keyword_translation</th>
            <th data-options="field:'author_name',width:150">author_name</th>
            <th data-options="field:'author_affiliation',width:150">author_affiliation</th>
            <th data-options="field:'author_email',width:150">author_email</th>
            <th data-options="field:'identifier_type',width:150">identifier_type</th>
            <th data-options="field:'identifier_identifierId',width:150">identifier_identifierId</th>
            <th data-options="field:'license_type',width:150">license_type</th>
            <th data-options="field:'license_title',width:150">license_title</th>
            <th data-options="field:'license_url',width:150">license_url</th>
            <th data-options="field:'license_url',width:150">update_time</th>
        </tr>
    </thead>

<?php
$sql = @$_GET['my_sql'] ? $_GET['my_sql'] . " order by id limit {$offset},{$pagesize}" : "select * from doaj_data order by id limit {$offset},{$pagesize}"; 
$result = mysqli_query($con, $sql);
while($sql_arr = mysqli_fetch_assoc($result)){ 
        echo "<tr>";
        foreach ($sql_arr as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
} 
?>
</table>

<form method="get" action="">
    查询语句：<textarea name="my_sql" rows="3" cols="40"></textarea>
    <input type="submit" name="submit" value="查询">
    <input type="button" name="export" onclick="window.location.href='getcustomer.php'" value="导出">
</form> 

<?php
mysqli_free_result($result); 
mysqli_close($con); 
?>

<?php 

// header("Content-Type:text/html;charset=utf-8");

// //引入PHPExcel库文件（路径根据自己情况）
// include './phpexcel/Classes/PHPExcel.php';
// //创建对象
// $excel = new PHPExcel();
// //Excel表格式,这里简略写了8列
// $letter = array('A','B','C','D','E','F','F','G');
// //表头数组
// $tableheader = array('学号','姓名','性别','年龄','班级');
// //填充表头信息
// for($i = 0;$i < count($tableheader);$i++) 
// {
//     $excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
// }
// $data = array(
//             array('1','小王','男','20','100'),
//             array('2','小李','男','20','101'),
//             array('3','小张','女','20','102'),
//             array('4','小赵','女','20','103')
// );

// //填充表格信息
// for ($i = 2;$i <= count($data) + 1;$i++)
// {
//     $j = 0;
//     foreach ($data[$i - 2] as $key=>$value) 
//     {
//         $excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
//         $j++;
//     }
// }
// //创建Excel输入对象
// $write = new PHPExcel_Writer_Excel5($excel);
// header("Pragma: public");
// header("Expires: 0");
// header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
// header("Content-Type:application/force-download");
// header("Content-Type:application/vnd.ms-execl");
// header("Content-Type:application/octet-stream");
// header("Content-Type:application/download");;
// header('Content-Disposition:attachment;filename="testdata.xls"');
// header("Content-Transfer-Encoding:binary");
// $write->save('php://output');
 ?>

</body>
</html>
