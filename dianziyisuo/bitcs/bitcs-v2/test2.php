<?php

$data_arr = array();
$manage = new MongoClient("mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin");
$db = $manage->informatization;
$collection = $db->inforday;

$retval = $collection->distinct("Name");
var_dump($retval);
$content_id = new MongoId("599451779d39b417b60c7daf");
// $where = array('_id'=>(object)$content_id);
// $cursor = $collection->findOne();

// // print_r($cursor);
// print_r($cursor['time']);
// $date_trans = getdate($cursor['time']->sec);
// print_r($date_trans);
// $date = $date_trans['year']."-".$date_trans['mon']."-".$date_trans['mday'];
// print($date);

$start = new MongoDate(strtotime('2016-12'));
$start_trans = getdate($start->sec);
print_r($start);
print_r($start_trans);

// print($cursor['content']);
// $content = str_replace("\r\n", "<br>", $cursor['content']);
// print($content);
// print($cursor['url']);


?>

