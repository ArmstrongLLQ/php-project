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
<h2>Doaj查询结果</h2>

<?php
    require_once 'DoajService.class.php';
    
    $chaxun = @$_POST['search_sql'] ? $_POST['search_sql']:$_POST['page_sql'];
    $pagesize = 100;
    $total_sql = "select COUNT(*) ".strstr($chaxun, "from doaj_data");
    
    $doaj_service = new DoajService();
    list($total_row,$page_count) = $doaj_service->getPageCount($total_sql, $pagesize);
    $page_now = @$_POST['page_now'] ? $_POST['page_now'] : 1;
    //上一页 、下一页
    if ($page_now <= 1){
        $page_now = 1;
        $page_pre = 1;
        $page_next = $page_now + 1;
    }elseif($page_now >= $page_count){
        $page_now = $page_count;
        $page_pre = $page_now - 1;
        $page_next = $page_count;
    }else{
        $page_pre = $page_now - 1;
        $page_next = $page_now + 1;
    }

?>

<form action="" method="post" style="float:left">
    <input type="hidden" name="page_now" value="<?php echo 1; ?>">
    <input type="hidden" name="page_sql" value="<?php echo $chaxun; ?>">
    <input type="submit" value="首页">
</form>

<form action="" method="post" style="float:left">
    <input type="hidden" name="page_now" value="<?php echo $page_pre; ?>">
    <input type="hidden" name="page_sql" value="<?php echo $chaxun; ?>">
    <input type="submit" value="上一页">
</form>

<form action="" method="post" style="float:left">
    <input type="hidden" name="page_now" value="<?php echo $page_next; ?>">
    <input type="hidden" name="page_sql" value="<?php echo $chaxun; ?>">
    <input type="submit" value="下一页">
</form>

<form action="" method="post">
    <input type="hidden" name="page_now" value="<?php echo $page_count; ?>">
    <input type="hidden" name="page_sql" value="<?php echo $chaxun; ?>">
    <input type="submit" value="尾页">
</form>

<form action='' method='post'>
总条数<?php echo $total_row;?> |第 <?php echo $page_now;?>/<?php echo $page_count;?> 页 | 页码
<input type="text" name="page_now" style="width:50px">
<input type="hidden" name="page_sql" value="<?php echo $chaxun; ?>">
<input type="submit" value="跳转">
</form> 

<div style="margin:20px 0;"></div>
<table class="easyui-datagrid" title="Frozen Columns in DataGrid" style="width:100%;height: 600px"
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
$sql = $chaxun. " order by id limit {$offset},{$pagesize}" ;
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
<br>

<form method="post" action="resultSave.php" style="float:right">
    <input type="hidden" name="export_sql" value="<?php echo $chaxun ?>">
    <input type="submit" name="submit" value="导出">
</form>

<input type="button" name="search" onclick="window.location.href='searchPage.php'" value="查询" style="float:right"> 

<?php
mysqli_free_result($result); 

?>

</body>
</html>