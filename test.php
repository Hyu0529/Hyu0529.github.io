
<?php
//设定字符集
header('content-type:text/html;charset=utf-8');
//require './view/eatinghot.html';
//引入连接数据库的代码
require './init.php';
//载入分页类
require './library/Page.class.php';
//获取当前访问的页码
$page = isset($_GET['page']) ? (int)$_GET['page'] :  1;
//获取总记录数
$sql = "select count(*) as total from `canteen`";
$total = $pdo->query($sql)->fetchColumn();
//实例化分页类
$Page = new Page($total,20,$page); //page(总页数，每页显示条数，当前页)
//获取limit条件
$limit = $Page->getLimit();
//获取分页HTML链接
$page_html = $Page->showPage();
//分页查询学生信息列表
$sql = "select `id`,`name`,`price`,`position`,`popularity` from `canteen`";
//执行SQL语句，处理结果集
$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//引入HTML模板文件
require 'news.html';

?>
