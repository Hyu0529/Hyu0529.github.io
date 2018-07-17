<?php
//设置字符集
header('Content-Type:text/html;charset=utf-8');
//设置数据库的DSN信息
$dsn = 'mysql:host=localhost;dbname=project5;charset=utf8';
try{ 
    $pdo = new PDO($dsn, 'hyu','root');
}catch(PDOException $e){
    //连接失败，输出异常信息 
    exit('PDO连接数据库失1败：'.$e->getMessage());
}

