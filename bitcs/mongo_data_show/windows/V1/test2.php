<?php
 // require_once "BitcsService.class.php";
 //            $bitcs_service = new BitcsService();
            
 //            $pagesize = 10;
 //            $page_now = 1;

 //            $page_data = getPageData($page_now, $pagesize);

 //            foreach($page_data as $row){
 //                echo "<tr>";
 //                echo "<td>".$row['Name']." | <a href='#'>".$row['title']."</td><td>".$row['time']."</td>";
 //                echo "</tr>";
 //            }
$m = new MongoClient();    // 连接到mongodb
$db = $m->test;            // 选择一个数据库
$collection = $db->bitcs; // 选择集合

for ($i=0; $i < 100; $i++) { 
	$document = array("title" => "MongoDB", "time" =>  "2010-01-01", "id" =>  $i, "source" =>  "source");
	$collection->insert($document);
}

echo "数据插入成功";
?>

