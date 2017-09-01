<?php
$servername = "localhost";
$username = "root";
$password = "";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=lilanqing", $username, $password);
    echo "连接成功"; 
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

$conn = null;
?>