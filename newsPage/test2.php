<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
<?php
$manager = new MongoDB\Driver\Manager("mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin");  

// 插入数据
// $bulk = new MongoDB\Driver\BulkWrite;

// $manager->executeBulkWrite('test.sites', $bulk);

// $filter = ['x' => ['$gt' => 1]];
// $options = [
//     'projection' => ['_id' => 0],
//     'sort' => ['x' => -1],
// ];
$page = 0;
$rows = 10;
$filter = ['Category' => "新闻"];
$options = [
	"skip" => $page,
	"limit" => $rows,
];
// 查询数据
$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('crawl.CrawlHtml', $query);

$response = $cursor->toArray();
var_dump($response);
?>
</body>
</html>