
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "resolution";

//创建连接
try {
    $conn = new PDO("mysql:host=$servername;dbname=maizi", $username, $password);
    echo "连接成功"; 
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>