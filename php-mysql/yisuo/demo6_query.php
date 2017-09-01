<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lilanqing";

function getGuest($conn)
{
	$sql = 'SELECT * FROM myguest ORDER BY lastname';
	foreach ($conn->query($sql) as $row) 
	{
		print $row['firstname'] . "\t";
		print $row['lastname'] . "\t";
		print $row['email'] . "\n";
	}
}
// 使用预处理语句进行数据插入
try { 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); 

    // 设置 PDO 错误模式为异常 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    getGuest($conn);
}

catch(PDOException $e) 
{ 
    echo $sql . "<br>" . $e->getMessage(); 
} 


$conn = null;
?>

