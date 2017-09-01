<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lilanqing";
 
try { 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); 

    // 设置 PDO 错误模式为异常 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //使用sql创建数据表
    $sql = "CREATE TABLE myguest (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_data TIMESTAMP
    )"; 

    // 使用 exec() ，因为没有结果返回 
    $conn->exec($sql); 

    echo "数据表myguest创建成功<br>"; 
} 
catch(PDOException $e) 
{ 
    echo $sql . "<br>" . $e->getMessage(); 
} 

$conn = null;
?>