
<?php 
    require_once "BitcsService.class.php";
    $menu_name = isset($_GET["menu_name"]) ? intval($_GET["&menu_name=$menu_name"]) : "";

    $bitcs_service = new BitcsService();
    
    $pagesize = 10;

    $page_now = @$_GET['p'] ? $_GET['p'] : 1;
    $where = array('MenuName' => $menu_name);

    print_r($where);
    list($total_row,$page_count) = $bitcs_service->getPageCount($pagesize, $where);
    $page_data = $bitcs_service->getPageData($page_now, $pagesize, $where);

    echo '<table class="table">
<thead>
  <tr>
    <th width="85%">
      动态信息
    </th>
    <th width="15%" align="right">
      时间
    </th>
  </tr>
</thead>
<tbody>';
    foreach($page_data as $row){
        $detail_url = "detailPage.php?id=".$row['contentId'];
        $date_trans = getdate($row['time']->sec);
        $time = $date_trans['year']."-".$date_trans['mon']."-".$date_trans['mday'];
        echo "<tr>";
        echo "<td>".$row['Name']." | <a href=$detail_url>".$row['title']."</td><td>".$time."</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
echo '<div>
  <ul class="pagination">';


//上一页 、下一页
if ($page_now <= 1){
    $page_now = 1;
    $page_pre = 1;
    $page_ten_pre = 1;
    $page_next = $page_now + 1;
    $page_ten_next = $page_now + 10;
}elseif($page_now >= $page_count){
    $page_now = $page_count;
    $page_pre = $page_now - 1;
    $page_ten_pre = $page_now - 10;
    $page_next = $page_count;
    $page_ten_next = $page_count;
}else{
    $page_pre = $page_now - 1;
    $page_next = $page_now + 1;
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
echo "<a href='mainPage.php?p=1&menu_name=$menu_name'>Home</a>";
echo "</li>";
echo "<li>";
echo "<a href='mainPage.php?p=$page_ten_pre&menu_name=$menu_name'><<</a>";
echo "</li>";
echo "<li>";
echo "<a href='mainPage.php?p=$page_pre&menu_name=$menu_name'>Prev</a>";
echo "</li>";
$start = $page_now;
if ($page_now + 10 < $page_count) {
    for ($i=$page_now; $i < $start + 10; $i++) { 
    echo "<li>";
    echo "<a href='mainPage.php?p=$i&menu_name=$menu_name'>$i</a>";
    echo "</li>";
    }
}else{
    for ($i=$page_now - 10; $i < $start; $i++) { 
    echo "<li>";
    echo "<a href='mainPage.php?p=$i&menu_name=$menu_name'>$i</a>";
    echo "</li>";
    }
}
        
echo "<li>";
echo "<a href='mainPage.php?p=$page_next&menu_name=$menu_name'>Next</a>";
echo "</li>";
echo "<li>";
echo "<a href='mainPage.php?p=$page_ten_next&menu_name=$menu_name'>>></a>";
echo "</li>";
echo "<li>";
echo "<a href='mainPage.php?p=$page_count&menu_name=$menu_name'>End</a>";
echo "</li>";
    
 echo "</ul>
</div>";

?>