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


    return $page_para;
}


$con = connectMysql("172.16.155.11","doaj","Doa123!@#j", "doaj");

$pagesize = 100; 

//查询记录总数 
$total_sql = @$_GET['my_sql'] ? "select COUNT(*) ".strstr($_GET['my_sql'], "from doaj_data"):"select COUNT(*) from doaj_data"; 

list($total, $page, $pageprev, $pagenext, $offset) = selectData($con, $total_sql, $pagesize);

echo "<h3> <a href='page3.php'>首页</a> 丨<a href='page3.php?p={$pageprev}'>上一页</a> |<a href='page3.php?p={$pagenext}'>下一页</a> 丨<a href='page3.php?p={$total}'>尾页</a></h3>
    <form action='' method='get'>
    第 $page/$total 页 |页码：<input type='text' name='p'><input type='submit' value='跳转'>
    </form> ";
?>
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
            </tr>
        </thead>


<?php
$sql = @$_GET['my_sql'] ? $_GET['my_sql'] . " order by id limit {$offset},{$pagesize}" : "select * from doaj_data order by id limit {$offset},{$pagesize}"; 
$result = mysqli_query($con, $sql);
while($sql_arr = mysqli_fetch_assoc($result)){ 
        $id = $sql_arr['id'];
        $title = $sql_arr['title'];
        $title_translation = $sql_arr['title_translation'];
        $abstract = $sql_arr['abstract'];
        $abstract_translation = $sql_arr['abstract_translation'];
        $year = $sql_arr['year'];
        $url = $sql_arr['url'];
        $start_page = $sql_arr['start_page'];
        $end_page = $sql_arr['end_page'];
        $article_created_date = $sql_arr['article_created_date'];
        $article_last_updated = $sql_arr['article_last_updated'];
        $journals_publisher = $sql_arr['journals_publisher'];
        $journals_language = $sql_arr['journals_language'];
        $journals_licenseId = $sql_arr['journals_licenseId'];
        $journals_title = $sql_arr['journals_title'];
        $journals_country = $sql_arr['journals_country'];
        $journals_number = $sql_arr['journals_number'];
        $journals_volume = $sql_arr['journals_volume'];
        $journals_issns = $sql_arr['journals_issns'];
        $journals_create_date = $sql_arr['journals_create_date'];
        $term = $sql_arr['term'];
        $term_code = $sql_arr['term_code'];
        $term_l1 = $sql_arr['term_l1'];
        $keyword = $sql_arr['keyword'];
        $keyword_translation = $sql_arr['keyword_translation'];
        $author_name = $sql_arr['author_name'];
        $author_affiliation = $sql_arr['author_affiliation'];
        $author_email = $sql_arr['author_email'];
        $identifier_type = $sql_arr['identifier_type'];
        $identifier_identifierId = $sql_arr['identifier_identifierId'];
        $license_type = $sql_arr['license_type'];
        $license_title = $sql_arr['license_title'];
        $license_url = $sql_arr['license_url'];
        echo "<tr><td>$id</td><td>$title</td><td>$title_translation</td><td>$abstract</td><td>$abstract_translation</td><td>$year</td><td>$url</td><td>$start_page</td><td>$end_page</td><td>$article_created_date</td><td>$article_last_updated</td><td>$journals_publisher</td><td>$journals_language</td><td>$journals_licenseId</td><td>$journals_title</td><td>$journals_country</td><td>$journals_number</td><td>$journals_volume</td><td>$journals_issns</td><td>$journals_create_date</td><td>$term</td>
         <td>$term_code</td><td>$term_l1</td><td>$keyword</td><td>$keyword_translation</td><td>$author_name</td><td>$author_affiliation</td><td>$author_email</td><td>$identifier_type</td><td>$identifier_identifierId</td><td>$license_type</td><td>$license_title</td><td>$license_url</td></tr>";
} 
?>
</table>

<form method="get" action="">
    查询语句：<textarea name="my_sql" rows="3" cols="40"></textarea>
    <input type="submit" name="submit" value="查询">
</form> 


<?php
mysqli_free_result($result); 
mysqli_close($con); 
?>

</body>
</html>