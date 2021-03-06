
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
        <br>
</div>

<div class="container">
    <div class="row clearfix">z 
        <div class="col-md-1 column">
        </div>
        <div class="col-md-10 column">
            <ul class="breadcrumb">
                <li>
                     <a href="mainPage.php">首页</a>
                </li>
                <li>
                    <a href="AdvSearchPage.php">返回高级搜索</a>
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
// echo $_POST['key_involve_one'];
// echo "<br>";
// echo $_POST['key_involve_all'];
// echo "<br>";
// echo $_POST['key_not_involve'];
// echo "<br>";
// echo $_POST['key_not_split'];
// echo "<br>";
// echo $_POST['source'];
// echo "<br>";
// echo $_POST['start_year'];
// echo "<br>";
// echo $_POST['start_month'];
// echo "<br>";
// echo $_POST['end_year'];
// echo "<br>";
// echo $_POST['end_month'];
// echo "<br>";
// echo $_POST['radio-1'];
// echo "<br>";
// echo $_POST['result_number'];
// echo "<br>";

require_once "BitcsService.class.php";

$key_involve_one_arr = null;
$key_involve_all_arr = null;
$key_not_involve_arr = null;

$key_involve_one = isset($_POST['key_involve_one']) ? $_POST['key_involve_one'] : "";
$key_involve_all = isset($_POST['key_involve_all']) ? $_POST['key_involve_all'] : "";
$key_not_involve = isset($_POST['key_not_involve']) ? $_POST['key_not_involve'] : "";
$key_not_split = isset($_POST['key_not_split']) ? $_POST['key_not_split'] : "";
$source = isset($_POST['source']) ? $_POST['source'] : "";
$start_year = isset($_POST['start_year']) ? $_POST['start_year'] : "";
$start_month = isset($_POST['start_month']) ? $_POST['start_month'] : "";
$end_year = isset($_POST['end_year']) ? $_POST['end_year'] : "";
$end_month = isset($_POST['end_month']) ? $_POST['end_month'] : "";
$key_position = isset($_POST['radio-1']) ? $_POST['radio-1'] : "";
$result_number = isset($_POST['result_number']) ? $_POST['result_number'] : "";


$key_involve_one = isset($_GET['key_involve_one']) ? $_GET['key_involve_one'] : $key_involve_one;
$key_involve_all = isset($_GET['key_involve_all']) ? $_GET['key_involve_all'] : $key_involve_all;
$key_not_involve = isset($_GET['key_not_involve']) ? $_GET['key_not_involve'] : $key_not_involve;
$key_not_split = isset($_GET['key_not_split']) ? $_GET['key_not_split'] : $key_not_split;
$source = isset($_GET['source']) ? $_GET['source'] : $source;
$start_year = isset($_GET['start_year']) ? $_GET['start_year'] : $start_year;
$start_month = isset($_GET['start_month']) ? $_GET['start_month'] : $start_month;
$end_year = isset($_GET['end_year']) ? $_GET['end_year'] : $end_year;
$end_month = isset($_GET['end_month']) ? $_GET['end_month'] : $end_month;
$key_position = isset($_GET['key_position']) ? $_GET['key_position'] : $key_position;
$result_number = isset($_GET['result_number']) ? $_GET['result_number'] : $result_number;

$string1 = "&key_involve_one=$key_involve_one&key_involve_all=$key_involve_all&key_not_involve=$key_not_involve&key_not_split=$key_not_split&source=$source&start_year=$start_year&start_month=$start_month&end_year=$end_year&end_month=$end_month&key_position=$key_position&result_number=$result_number";



$where = array();

// 包含以下任意一个关键词
if (!empty($key_involve_one)) {
    $key_involve_one_arr = explode(" ", $key_involve_one);
    for ($i=0; $i < count($key_involve_one_arr); $i++) { 
        $key_involve_one_arr[$i] = new MongoRegex("/".$key_involve_one_arr[$i]."/");
    }
    $keyword['$in'] = $key_involve_one_arr;
}

// 包含一下全部关键词
if (!empty($key_involve_all)) {
    $key_involve_all_arr = explode(" ", $key_involve_all);
    for ($i=0; $i < count($key_involve_all_arr); $i++) { 
        $key_involve_all_arr[$i] = new MongoRegex("/".$key_involve_all_arr[$i]."/");  
    }
    $keyword['$all'] = $key_involve_all_arr;
}

// 不包含一下关键词
if (!empty($key_not_involve)) {
    $key_not_involve_arr = explode(" ", $key_not_involve);
    for ($i=0; $i < count($key_not_involve_arr); $i++) { 
        $key_not_involve_arr[$i] = new MongoRegex("/".$key_not_involve_arr[$i]."/");
    }
    $keyword['$nin'] = $key_not_involve_arr;
}

// 完整不拆分的关键词
if (!empty($key_not_split)) {
    $key_not_split_arr = explode(" ", $key_not_split);
    for ($i=0; $i < count($key_not_split_arr); $i++) { 
        $key_not_split_arr[$i] = new MongoRegex("/".$key_not_split_arr[$i]."/");
    }
}

// 来源
if (!empty($source)) {
    if($source = "产业新闻"){
        $where['MenuName'] = '产业新闻';
    }
}

// 时间段选择-起始年
if (!empty($start_year)) {
    // 时间段选择-起始月
    if (!empty($start_month)) {
        $start = $start_year.'-'.$start_month;
        $start_date = new MongoDate(strtotime($start));
    }else{
        $start = $start_year.'-01-01';
        $start_date = new MongoDate(strtotime($start));
    }
}

// 时间段选择-结束年
if (!empty($end_year)) {
    // 时间段选择-结束月
    if (!empty($end_month)) {
    $end = $end_year.'-'.$end_month;
        $end_date = new MongoDate(strtotime($end));
    }else{
        $end = $end_year.'-01-01';
        $end_date = new MongoDate(strtotime($end));
    }

    $where['time'] = array('$gte' => $start_date, '$lte' => $end_date);
}


// 搜索词位置
if (!empty($key_position)) {
    if (!empty($keyword)) {
        if ($key_position == 'in_title') {
        $where['title'] = $keyword;
        }else{
            $where['content'] = $keyword;
        }
    }
    
}

// 每页显示条数
$pagesize = 10;
if (!empty($result_number)) {
    if ($result_number == "1") {
        $pagesize = 10;
    }elseif ($result_number == "2") {
        $pagesize = 15;
    }else{
        $pagesize = 20;
    }
}

// print_r($key_involve_one_arr);

$bitcs_service = new BitcsService();


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
            echo "<a href='?p=1$string1'>Home</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='?p=$page_ten_pre$string1'><<</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='?p=$page_pre$string1'>Prev</a>";
            echo "</li>";
            $start = $page_now;
            if ($page_count <= 10) {
                for ($i=1; $i <= $page_count; $i++) { 
                echo "<li>";
                echo "<a href='?p=$i$string1'>$i</a>";
                echo "</li>";
                }
            }elseif ($page_now + 10 > $page_count) {
                for ($i=$page_now; $i <= $page_count; $i++) { 
                echo "<li>";
                echo "<a href='?p=$i$string1'>$i</a>";
                echo "</li>";
                }
            }else{
                for ($i=$page_now ; $i < $start +10; $i++) { 
                echo "<li>";
                echo "<a href='?p=$i$string1'>$i</a>";
                echo "</li>";
                }
            }
            
            echo "<li>";
            echo "<a href='?p=$page_next$string1'>Next</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='?p=$page_ten_next$string1'>>></a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='?p=$page_count$string1'>End</a>";
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

