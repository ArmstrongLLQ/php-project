<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lilanqing";

// 使用预处理语句进行数据插入
try { 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); 

    // 设置 PDO 错误模式为异常 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    // 使用命名占位符
    $stmt = $conn->prepare("INSERT INTO myguest (firstname, lastname, email) 
        VALUES (:firstname, :lastname, :email)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);

    $firstname = 'John';
    $lastname = 'Snow';
    $email = 'Snow@example.com';
    $stmt->execute();

    $firstname = 'John';
    $lastname = 'Rrin';
    $email = 'Rain@example.com';
    $stmt->execute();

    $firstname = 'John';
    $lastname = 'Sunny';
    $email = 'Sunny@example.com';
    $stmt->execute();

    echo "新纪录插入成功<br>"; 

    // 使用?占位符
    $stmt = $conn->prepare("INSERT INTO myguest (firstname, lastname, email) 
        VALUES (?, ?, ?)");
    $stmt->bindParam(1, $firstname);
    $stmt->bindParam(2, $lastname);
    $stmt->bindParam(3, $email);

    $firstname = 'John';
    $lastname = 'Red';
    $email = 'Red@example.com';
    $stmt->execute();

    $firstname = 'John';
    $lastname = 'Black';
    $email = 'Black@example.com';
    $stmt->execute();

    echo "新纪录插入成功<br>"; 
} 

catch(PDOException $e) 
{ 
    echo $sql . "<br>" . $e->getMessage(); 
} 


$conn = null;
?>