<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	
<?php
require_once "BitcsService.class.php";

$bitcs_service = new BitcsService();

$pagesize = 10;
$page_now = 2;

list($total_row, $page_count) = $bitcs_service->getPageCount($pagesize);

echo $page_count;

$page_data = $bitcs_service->getPageData($page_now, $pagesize);

foreach($page_data as $row){
	echo $row->title;
	echo "--------------------------<br>";
}

// $page = 0;
// $rows = 10;
// $filter = ['Category' => "新闻"];
// $options = [
// 	"skip" => $page,
// 	"limit" => $rows,
// ];
// $cursor = $mongo_helper->executeQuery($filter, $options);
// $cursor = $mongo_helper->executeCommand();

// $manager = new MongoDB\Driver\Manager("mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin");  

// 插入数据
// $bulk = new MongoDB\Driver\BulkWrite;

// $manager->executeBulkWrite('test.sites', $bulk);

// $filter = ['x' => ['$gt' => 1]];
// $options = [
//     'projection' => ['_id' => 0],
//     'sort' => ['x' => -1],
// ];

// 查询数据
// $query = new MongoDB\Driver\Query($filter, $options);
// $cursor = $manager->executeQuery('crawl.CrawlHtml', $query);
?>
</body>
</html>