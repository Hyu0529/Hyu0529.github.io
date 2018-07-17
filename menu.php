<?php 
//第一步 连接数据库服务器
//$link = mysqli_connect("localhost", "root", "");   
$link = @mysql_connect('localhost','hyu','root');
	 //第2步设置数据库字符集
  //mysqli_query($link, "SET NAMES utf8");
    mysql_query('set names utf8');
   //第3步选择所用的数据库名称
   $database="students";
 // mysqli_select_db($link, $database);
    mysql_select_db($database);
//执行SQL语句
$sql = 'select * from `canteen`' ;
$result = mysql_query($sql);
//处理结果集
$data = array(); //定义数组用于保存数据
while($row = mysql_fetch_assoc($result)){
	$data[] = $row;
}	
?>
<html>
<head>
<meta charset="utf-8">
<title>食堂</title>
</head>
<body>
<table>
			<tr>
            <!-- <th>ID</th> -->
            <th>菜名</th>
            <th width="200">价格</th>
            <th width="200">地点</th>
            <th width="200">人气</th></tr>
			<?php foreach($data as $v):?>
				<tr>
					<!-- <td><?php echo $v['id'];?></td> -->
					<td><?php echo $v['name'];?></td>
					<td><?php echo $v['price'];?></td>
                    <td><?php echo $v['position'];?></td>
					<td><?php echo $v['popularity'];?></td>
                    
                    <td><?php $id=isset($_GET[$v['id']])?(int)$_GET[$v['id']]:0;?><a href="update.php?id=<?php echo $v['id'];?>">点赞</a></td>
				</tr>
			<?php endforeach;?>
		</table>
</body>
</html>
