<?php

	require_once "mysqlTools.php";

	// if(isset($_POST['enword'])){
	// 	$en_word = $_POST['enword'];
	// }else{
	// 	echo "输入为空";
	// 	echo "<a href='mainPage.php'>返回查询页面</a>";
	// }

	$en_word = 'boy';

	$sql = "select * from words where enword = " . $en_word
	;


	$mysql_tool = new MysqlTools();
	
	$mysql_tool->connectMysql();
	echo $en_word;
	$res = $mysql_tool->executeDql($sql);
	echo $en_word;
	var_dump($res);

	if ($row = mysqli_fetch_assoc($res)) {
		echo $en_word . "--------->" . $row[2];
	}else {
		echo "no result<br>";
		echo "<a href='mainView.php'>return search page</a>";
	}

	mysqli_free_result($res);

?>