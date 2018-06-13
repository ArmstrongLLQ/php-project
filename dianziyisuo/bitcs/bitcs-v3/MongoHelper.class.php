<?php 
	class MongoHelper{
		public $conn_url = "mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin";
		public $manager;
		public $db;
		public $collection;

		public function __construct($db, $collection){

			$this->manager = new MongoClient($this->conn_url); 
			if (!$this->manager) {
				die("conn failed.");
			}
			$this->db = $this->manager->selectDB($db);
            $this->collection = $this->db->selectCollection($collection);
		}
	}
 ?>
