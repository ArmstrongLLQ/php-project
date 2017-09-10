<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
<?php 
 
$mysqli = new MySQLi('127.0.0.1', 'lilanqing', 'resolution', 'testdb');
if ($mysqli->connect_error) {
	die('connect failed' . $mysqli->connect_error);
}

$mysqli->query('set names utf8');

$sql = 'select * from words';
$res = $mysqli->query($sql);

while ($row = $res->fetch_row()) {
	foreach ($row as $key => $value) {
		echo '--' . $value;
	}
	echo '<br>';
}

 ?>
</body>
</html>
