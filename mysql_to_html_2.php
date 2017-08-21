<!DOCTYPE html>
<html>
<head>
    <title>数据库显示</title>
</head>
<body>
//以表格的形式进行显示
<table style='text-align:left;' border='1'>
         <tr><th>id</th><th>title</th><th>title_translation</th><th>abstract</th><th>abstract_translation</th><th>year</th><th>url</th><th>start_page</th><th>end_page</th><th>article_created_date</th><th>article_last_updated</th><th>journals_publisher</th><th>journals_language</th><th>journals_licenseId</th><th>journals_title</th><th>journals_country</th><th>journals_number</th><th>journals_volume</th><th>journals_issns</th><th>journals_create_date</th><th>term</th>
         <th>term_code</th><th>term_l1</th><th>keyword</th><th>keyword_translation</th><th>author_name</th><th>author_affiliation</th><th>author_email</th><th>identifier_type</th><th>identifier_identifierId</th><th>license_type</th><th>license_title</th><th>license_url</th></tr>
    <?php
    //连接想要连接的数据库，localhost是本地服务器，root为数据库的账号，我的密码为0所以是空
    $con = mysqli_connect("172.16.155.11","doaj","Doa123!@#j", "doaj");
    //设置字符集，将字符集设置为utf8 的格式，这是大多数的中文都识别的
    mysqli_query($con, "SET NAMES 'utf8'");
    mysqli_query($con, "SET CHARACTER SET utf8");
    if(!$con){
        die("连接失败: " . mysqli_connect_error());
    }

    //查询数据表中的数据
    $sql = mysqli_query($con, "select * from doaj_data where id < 1000");
    $datarow = mysqli_num_rows($sql); //长度
    //循环遍历出数据表中的数据
    for($i=0;$i<$datarow;$i++){
        $sql_arr = mysqli_fetch_assoc($sql);
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
    ?>
</table>
</body>
</html>