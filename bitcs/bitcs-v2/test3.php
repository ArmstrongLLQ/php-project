
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>信息化定制采集</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>s
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="head" align="center">
        <h1>
        <b>信息化定制采集</b>
        </h1>
  <FORM METHOD="post" ACTION="p?act=search">
<INPUT TYPE="Text" NAME="QueryString">
<INPUT TYPE="Submit" VALUE="搜索">
<input type="button" name="AdvancedSearch" value="高级搜索">
</FORM>
</div>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-1 column">
        </div>
        <div class="col-md-10 column">
            <ul class="breadcrumb">
                <li>
                     <a href="mainPage.php">首页</a>
                </li>
                
                <li class="active">
                    搜索结果
                </li>
            </ul>
            <div id="news_list">
              <table class="table" style="table-layout: fixed;width: 100%">
                <thead>
                  <tr>
                    <th width="85%">
                      搜索结果
                    </th>
                    <th width="15%" align="right">
                      时间
                    </th>
                  </tr>
                </thead>
                <tbody>
                <?php 

require_once "BitcsService.class.php";

$key_involve_one_arr = null;
$key_involve_all_arr = null;
$key_not_involve_arr = null;

$key_involve_one = "延安 煤油";
$key_involve_all = "公示";
$key_not_involve = "仪表";

$where = array();

if (!empty($key_involve_one)) {
    $key_involve_one_arr = explode(" ", $key_involve_one);
    for ($i=0; $i < count($key_involve_one_arr); $i++) { 
        $key_involve_one_arr[$i] = new MongoRegex("/".$key_involve_one_arr[$i]."/");
    }   
}
if (!empty($key_involve_all)) {
    $key_involve_all_arr = explode(" ", $key_involve_all);
    for ($i=0; $i < count($key_involve_all_arr); $i++) { 
        $key_involve_all_arr[$i] = new MongoRegex("/".$key_involve_all_arr[$i]."/");  
    }
}


if (!empty($key_not_involve)) {
    $key_not_involve_arr = explode(" ", $key_not_involve);
    for ($i=0; $i < count($key_not_involve_arr); $i++) { 
        $key_not_involve_arr[$i] = new MongoRegex("/".$key_not_involve_arr[$i]."/");
    }
}

$where4 = array('$in' => $key_involve_one_arr, '$all' => $key_involve_all_arr, '$nin' => $key_not_involve_arr);

// print_r($key_involve_one_arr);
$where = array('title' => $where4);

print_r($where);



$bitcs_service = new BitcsService();

$pagesize = 20;
$page_now = @$_GET['p'] ? $_GET['p'] : 1;

list($total_row,$page_count) = $bitcs_service->getPageCount($pagesize, $where);
$page_data = $bitcs_service->getPageData($page_now, $pagesize, $where);

foreach($page_data as $row){
    $detail_url = "detailPage.php?id=".$row['contentId'];
    $date_trans = getdate($row['time']->sec);
    $time = $date_trans['year']."-".$date_trans['mon']."-".$date_trans['mday'];
    $title = $row['title'];
    

    echo "<tr>";
    echo "<td style='white-space: nowrap;;overflow: hidden;text-overflow: ellipsis;'>".$row['Name']." | <a href=$detail_url>".$title."</td><td>".$time."</td>";
    echo "</tr>";
}

?>
</tbody>
</table>
</div>
<div>
      <ul class="pagination">
        <?php
            //上一页 、下一页
            if ($page_now <= 1){
                $page_now = 1;
                $page_pre = 1;
                $page_ten_pre = 1;
                $page_next = $page_now + 1;
                if ($page_next >= $page_count) {
                    $page_next = $page_count;
                }
                $page_ten_next = $page_now + 10;
                if ($page_ten_next >= $page_count) {
                    $page_ten_next = $page_count;
                }
            }elseif($page_now >= $page_count){
                $page_now = $page_count;
                $page_pre = $page_now - 1;
                $page_ten_pre = $page_now - 10;
                $page_next = $page_count;
                $page_ten_next = $page_count;
            }else{
                $page_pre = $page_now - 1;
                $page_next = $page_now + 1;
                if ($page_next >= $page_count) {
                    $page_next = $page_count;
                }
                $page_ten_pre = $page_now - 10;
                if ($page_ten_pre <= 1) {
                    $page_ten_pre = 1;
                }
                $page_ten_next = $page_now + 10;
                if ($page_ten_next >= $page_count) {
                    $page_ten_next = $page_count;
                }

            }

            echo "<li>";
            echo "<a href='?p=1'>Home</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='?p=$page_ten_pre'><<</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='?p=$page_pre'>Prev</a>";
            echo "</li>";
            $start = $page_now;
            if ($page_count <= 10) {
                for ($i=1; $i <= $page_count; $i++) { 
                echo "<li>";
                echo "<a href='?p=$i'>$i</a>";
                echo "</li>";
                }
            }elseif ($page_now + 10 > $page_count) {
                for ($i=$page_now; $i <= $page_count; $i++) { 
                echo "<li>";
                echo "<a href='?p=$i'>$i</a>";
                echo "</li>";
                }
            }else{
                for ($i=$page_now ; $i < $start +10; $i++) { 
                echo "<li>";
                echo "<a href='?p=$i'>$i</a>";
                echo "</li>";
                }
            }
            
            echo "<li>";
            echo "<a href='?p=$page_next'>Next</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='?p=$page_ten_next'>>></a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='?p=$page_count'>End</a>";
            echo "</li>";
        ?>
      </ul>
    </div>
</div>
        <div class="col-md-1 column">
        </div>
    </div>
</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

