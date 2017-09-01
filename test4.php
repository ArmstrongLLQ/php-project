<?php 
 $localhost = "localhost"; 
 $username = "root"; 
 $password = "root"; 
 $db = "test";   //信息 
 $pagesize = 5; 
 $conn = mysql_connect($localhost,$username,$password); //链接数据库 
  if(!$conn){ 
   echo "数据库链接失败".mysql_error(); 
  } 
 mysql_query("SET NAMES 'UTF8'"); //编码转化 
 $db_select = mysql_select_db($db); //选择表 
          //查询记录总数 
 $total_sql = "select COUNT(*) from page"; 
 $total_result = mysql_query($total_sql); 
 $total_row_arr = mysql_fetch_row($total_result); 
 $total_row = $total_row_arr[0];   //总条数 
 //总页数 
 $total = ceil($total_row / $pagesize); 
 //当前页数 
 $page = @$_GET['p'] ? $_GET['p'] : 1; 
  //limit 下限 
 $offset = ($page - 1)*$pagesize; 
   
 $sql = "select * from page order by id limit {$offset},{$pagesize}"; 
 $result = mysql_query($sql); 
 echo "<p>PHP分页代码的小模块</p>"; 
 echo "<table border=1 cellspacing=0 WIDTH=60% align=center>"; 
 echo "<tr><td>ID</td><td>NAME</td></tr>"; 
 while($row = mysql_fetch_assoc($result)){ 
  $id = $row['id']; 
  $name = $row['name']; 
  echo "<tr><td>".$id."</td><td>".$name."</td></tr>"; 
 } 
 echo "</table>"; 
 //上一页 、下一页 
 $pageprev = $page -1 ; 
  if($page > $total){ 
   $pagenext = $total; 
  } else{ 
   $pagenext = $page +1; 
  } 
 // 做链接 跳转； 
 echo "<h3> <a href='page.php?p={$pageprev}'>上一页</a> 丨<a href='page.php?p={$pagenext}'>下一页</a></h3>"; 
   
 mysql_free_result($result); 
 mysql_close($conn); 
?>