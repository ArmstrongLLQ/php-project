<?php 
/**
* php 操作mysql类库
*/
class MysqlTools
{
	private $conn;
	private $my_host;
	private $my_username;
	private $my_password;
	private $my_database;
 
	function __construct($my_host = "127.0.0.1", $my_username = "lilanqing", $my_password = "resolution", $my_database = "testdb")
	{
		$this->my_host = $my_host;
		$this->my_username = $my_username;
		$this->my_password = $my_password;
		$this->my_database = $my_database;
	}

	public function connectMysql()
	{
		$this->conn = mysqli_connect($this->my_host, $this->my_username, $this->my_password, $this->my_database);
	    mysqli_query($this->conn, "SET NAMES 'utf8'");
	    mysqli_query($this->conn, "SET CHARACTER SET utf8");
	    if(!$this->conn)
	    {
	        die("连接失败: " . mysqli_connect_error());
	    }
	}

	public function executeDql($sql) {
		$res = mysqli_query($this->conn, $sql) or die(mysql_error());
		return $res;
	}

	public function executeDml($sql) {
		$b = mysqli_query($this->conn, $sql);
		if (!$b) {
			return 0;//fail
		}else {
			if (mysqli_affected_rows($this->conn) > 0) {
				return 1;//success
			}else {
				return 2;//no affected
			}
		}
	}
}
// $a=new MysqlTools();
// $a->connectMysql();
// $sql = "select * from words";
// $res = $a->executeDql($sql);
// var_dump($res);


 ?>