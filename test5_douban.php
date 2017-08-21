<!DOCTYPE html>
<html>
<head>
    <title>数据库显示</title>
</head>
<body>
<?php
// 建立数据库连接
$link = mysqli_connect("172.16.155.11","doaj","Doa123!@#j", "doaj");
if(!$link){
    die("连接失败: " . mysqli_connect_error());
}

//设置字符集，将字符集设置为utf8 的格式，这是大多数的中文都识别的
mysqli_query($link, "SET NAMES 'utf8'");
mysqli_query($link, "SET CHARACTER SET utf8");

// 获取当前页数
if( isset($_GET['page']) ){
$page = intval( $_GET['page'] );
}
else{
$page = 1;
}

// 每页数量
$page_size = 10;
// 获取总数据量
$sql = "select count(*) from doaj_data";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);
$amount = $row[0];
// 记算总共有多少页
if( $amount ){
if( $amount < $page_size ){ $page_count = 1; }               //如果总数据量小于$PageSize，那么只有一页
if( $amount % $page_size ){                                  //取总数据量除以每页数的余数
$page_count = (int)($amount / $page_size) + 1;           //如果有余数，则页数等于总数据量除以每页数的结果取整再加一
}else{
$page_count = $amount / $page_size;                      //如果没有余数，则页数等于总数据量除以每页数的结果
}
}
else{
$page_count = 0;
}
// 翻页链接
$page_string = '';
if( $page == 1 ){
$page_string .= '第一页|上一页|';
}
else{
$page_string .= '<a href=?page=1>第一页</a>|<a href=?page='.($page-1).'>上一页</a>|';
}
if( ($page == $page_count) || ($page_count == 0) ){
$page_string .= '下一页|尾页';
}
else{
$page_string .= '<a href=?page='.($page+1).'>下一页</a>|<a href=?page='.$page_count.'>尾页</a>';
}
// 获取数据，以二维数组格式返回结果
if( $amount ){
$sql = "select * from doaj_data order by id desc limit ". ($page-1)*$page_size .", $page_size";
$result = mysqli_query($link, $sql); 
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
        echo "<tr><th>$id</th><th>$title</th><th>$title_translation</th><th>$abstract</th><th>$abstract_translation</th><th>$year</th><th>$url</th><th>$start_page</th><th>$end_page</th><th>$article_created_date</th><th>$article_last_updated</th><th>$journals_publisher</th><th>$journals_language</th><th>$journals_licenseId</th><th>$journals_title</th><th>$journals_country</th><th>$journals_number</th><th>$journals_volume</th><th>$journals_issns</th><th>$journals_create_date</th><th>$term</th>
         <th>$term_code</th><th>$term_l1</th><th>$keyword</th><th>$keyword_translation</th><th>$author_name</th><th>$author_affiliation</th><th>$author_email</th><th>$identifier_type</th><th>$identifier_identifierId</th><th>$license_type</th><th>$license_title</th><th>$license_url</th></tr>";
} 
echo "</table>"; 
}
// 没有包含显示结果的代码，那不在讨论范围，只要用foreach就可以很简单的用得到的二维数组来显示结果
?>