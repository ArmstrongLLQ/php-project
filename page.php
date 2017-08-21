<!DOCTYPE html>
<html>
<head>
    <title>数据库显示</title>
</head>
<body>
<?php 
//连接想要连接的数据库，localhost是本地服务器，root为数据库的账号，我的密码为0所以是空
$con = mysqli_connect("172.16.155.11","doaj","Doa123!@#j", "doaj");
//设置字符集，将字符集设置为utf8 的格式，这是大多数的中文都识别的
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, "SET CHARACTER SET utf8");
if(!$con){
    die("连接失败: " . mysqli_connect_error());
}

$pagesize = 10; 

//查询记录总数 
$total_sql = "select COUNT(*) from doaj_data"; 
$total_result = mysqli_query($con, $total_sql); 
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
echo "<h3> <a href='page.php'>首页</a> 丨<a href='page.php?p={$pageprev}'>上一页</a> 丨<a href='page.php?p={$pagenext}'>下一页</a> 丨<a href='page.php?p={$total}'>尾页</a></h3>"; 

$sql = "select * from doaj_data order by id limit {$offset},{$pagesize}"; 
$result = mysqli_query($con, $sql); 
echo "<p>PHP分页代码的小模块</p>"; 
echo "<table style='text-align:left;' border='1'>"; 
echo "<tr><th>id</th><th>title</th><th>title_translation</th><th>abstract</th><th>abstract_translation</th><th>year</th><th>url</th><th>start_page</th><th>end_page</th><th>article_created_date</th><th>article_last_updated</th><th>journals_publisher</th><th>journals_language</th><th>journals_licenseId</th><th>journals_title</th><th>journals_country</th><th>journals_number</th><th>journals_volume</th><th>journals_issns</th><th>journals_create_date</th><th>term</th>
         <th>term_code</th><th>term_l1</th><th>keyword</th><th>keyword_translation</th><th>author_name</th><th>author_affiliation</th><th>author_email</th><th>identifier_type</th><th>identifier_identifierId</th><th>license_type</th><th>license_title</th><th>license_url</th></tr>"; 
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
echo "</table>"; 
// //上一页 、下一页 
// $pageprev = $page -1 ; 
// if($page > $total){ 
//  $pagenext = $total; 
// } else{ 
//  $pagenext = $page +1; 
// } 
// 做链接 跳转； 
echo "<h3> <a href='page.php'>首页</a> 丨<a href='page.php?p={$pageprev}'>上一页</a> 丨<a href='page.php?p={$pagenext}'>下一页</a> 丨<a href='page.php?p={$total}'>尾页</a></h3>";  
 
mysqli_free_result($result); 
mysqli_close($con); 
?>

</body>
</html>