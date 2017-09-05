<?php 
/**
* php 操作mysql类库
*/
class MysqlTools
{
	private $my_host;
	private $my_username;
	private $my_password;
	private $my_database;

	function __construct($my_host = "172.16.155.11", $my_username = "doaj", $my_password = "Doa123!@#j", $my_database = "doaj")
	{
		$this->my_host = $my_host;
		$this->my_username = $my_username;
		$this->my_password = $my_password;
		$this->my_database = $my_database;
	}

	public function connectMysql()
	{
		$conn = mysqli_connect($this->my_host, $this->my_username, $this->my_password, $this->my_database);
	    mysqli_query($conn, "SET NAMES 'utf8'");
	    mysqli_query($conn, "SET CHARACTER SET utf8");
	    if(!$conn)
	    {
	        die("连接失败: " . mysqli_connect_error());
	    }
	    return $conn;
	}
}

 ?>