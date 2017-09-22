<?php 
	class MongoHelper{
		public $conn_url = "mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin";
		public $manager;

		public function __construct(){
			$this->manager = new MongoDB\Driver\Manager($conn_url); 
			if (!$this->manager) {
				die("conn failed.");
			}
		}

		public function executeDql($sql){
			$arr = array();
			$res = 
		}
		 
	}
 ?>		}
