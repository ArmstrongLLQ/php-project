<?php

// $bulk = new MongoDB\Driver\BulkWrite;
// $document = ['_id' => new MongoDB\BSON\ObjectID, 'name' => '菜鸟教程'];

// $_id= $bulk->insert($document);

// var_dump($_id);

// $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
// var_dump($manager);
// $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
// $result = $manager->executeBulkWrite('test.runoob', $bulk, $writeConcern);
// var_dump($manager);




$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");  

// 插入数据
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert(['x' => 1, 'name'=>'菜鸟教程', 'url' => 'http://www.runoob.com']);
$bulk->insert(['x' => 2, 'name'=>'Google', 'url' => 'http://www.google.com']);
$bulk->insert(['x' => 3, 'name'=>'taobao', 'url' => 'http://www.taobao.com']);
$manager->executeBulkWrite('test.sites', $bulk);

$filter = ['x' => ['$gt' => 1]];
$options = [
    'projection' => ['_id' => 0],
    'sort' => ['x' => -1],
];

// 查询数据
$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('test.sites', $query);

foreach ($cursor as $document) {
    print_r($document);
}
?>