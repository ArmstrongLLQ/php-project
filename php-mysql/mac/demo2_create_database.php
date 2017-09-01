<?php

$servername = "127.0.0.1";
$username = "root";
$password = "resolution";

try {
$conn = new PDO("mysql:host=$servername;dbname=TESTDB", $username, $password); // 设置 PDO 错误模式为异常
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "CREATE DATABASE PHP_DB";
// 使用 exec() ，因为没有结果返回
$conn->exec($sql);
echo "Database created successfully<br>";
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;

?>