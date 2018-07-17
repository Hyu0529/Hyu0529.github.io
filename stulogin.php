<?php
session_start();
//设置字符集
header("Content-type:text/html;charset=utf-8");
//设置数据库的DSN信息
$dsn='mysql:host=127.0.0.1;dbname=students;charset=utf8';
try{
	$pdo=new PDO($dsn,'hyu','root');
}catch(PDOException $e){
	//连接失败，输出异常信息
	exit('PDO连接数据库失败：'.$e->getMessage());
}
//echo'PDO 连接数据库成功';
$link=mysqli_connect('localhost','hyu','root','students');  //链接数据库
//mysqli_set_charset($link ,'utf8'); //设定字符集 
$name=$_POST['username'];
$pwd=$_POST['password'];


//创建连接
$mysqli=new mysqli("localhost","hyu","root","students");

//设置mysqli编码
mysqli_query($mysqli,"SET NAMES utf8"); 

//检查连接是否被创建
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
} 
 if($name==''){
        echo "<script>alert('username');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        exit;
    }
    if($pwd==''){
        echo "<script>alert('password');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        exit;
    }
    $sql_select="select id,username,password from user where username= ?";      //从数据库查询信息
	

    $stmt=mysqli_prepare($link,$sql_select);
    mysqli_stmt_bind_param($stmt,'s',$name);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($result);
	
    if($row){
        if($pwd !=$row['password'] || $name !=$row['username']){
            echo "<script>alert('密码错误，请重新输入');location='./view/stulogin.html'</script>";
            exit;
        }
        else{
            $_SESSION['username']=$row['username'];
            $_SESSION['id']=$row['id'];
            echo "<script>alert('登录成功');location='./view/student.html'</script>";
        }
    }else{
        echo "<script>alert('您输入的用户名不存在');location='./view/stulogin.html'</script>";
        exit;
    };
require './view/stulogin.html';
?>