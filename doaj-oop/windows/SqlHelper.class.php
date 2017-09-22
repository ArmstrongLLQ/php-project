<?php
    // ����һ�������࣬��ɶ����ݿ�Ĳ���
    class SqlHelper{
        public $conn;
        public $host = "172.16.155.11";
        public $username = "doaj";
        public $password = "Doa123!@#j";
        public $dbname = "doaj";
        
        public function __construct(){
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
            if (!$this->conn){
                die("conn failed".mysqli_errno($this->conn));
            }
        }
        
        public function executeDql($sql){
            $res = mysqli_query($this->conn, $sql);
            return $res;
        }
        
        public function executeDql2($sql){
            $arr = array();
            $res = mysqli_query($this->conn, $sql);
            while ($row = mysqli_fetch_assoc($res)){
                $arr[] = $row;
            }
            mysqli_free_result($res);
            return $arr;
        }
        
        public function executeDml($sql){
            $b = mysqli_query($this->conn, $sql);
            if (!$b){
                return 0;
            }else{
                if (mysqli_affected_rows($this->conn) > 0){
                    return 1;
                }else{
                    return 2;
                }
            }            
        }
        
        public function closeConnect(){
            if (empty($this->conn)){
                mysqli_close($this->conn);
            }
        }
    }
?>