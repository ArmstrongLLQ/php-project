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
</head>
<body>
<h2>Doaj数据</h2>
<?php
require_once "mysqlTools.php";

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

$mysql_tools = new MysqlTools("172.16.155.11","doaj","Doa123!@#j", "doaj");
$conn = $mysql_tools->connectMysql();

$pagesize = 100; 

//查询记录总数 
$total_sql = @$_GET['my_sql'] ? "select COUNT(*) ".strstr($_GET['my_sql'], "from doaj_data"):"select COUNT(*) from doaj_data"; 
$chaxun = @$_GET['my_sql'] ? $_GET['my_sql'] : "";

list($total, $page, $pageprev, $pagenext, $offset, $total_row) = selectData($conn, $total_sql, $pagesize);
?>

<h3>
    <a href='page.php?my_sql=<?php echo $chaxun;?>'>首页</a> 丨 
    <a href='page.php?p=<?php echo $pageprev;?>&my_sql=<?php echo $chaxun;?>'>上一页</a> | 
    <a href='page.php?p=<?php echo $pagenext;?>&my_sql=<?php echo $chaxun;?>'>下一页</a> 丨 
    <a href='page.php?p=<?php echo $total;?>&my_sql=<?php echo $chaxun;?>'>尾页</a> | 
    <a href='page.php'>返回</a>
</h3>

<form action='' method='get'>
总条数：<?php echo $total_row;?> | 第 <?php echo $page;?>/<?php echo $total;?> 页 | 页码：<input type="text" name="p" style="width:50px"><input type="hidden" name="my_sql" value="<?php echo $chaxun ?>" "><input type="submit" value="跳转">
</form> 

<div style="margin:20px 0;"></div>
<table class="easyui-datagrid" title="Frozen Columns in DataGrid" style="width:100%;height: 100%"
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
$result = mysqli_query($conn, $sql);
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
</form> 

<?php
mysqli_free_result($result); 
mysqli_close($conn); 
?>

</body>
</html>