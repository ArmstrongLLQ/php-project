<?php 
	class MongoHelper{
		public $conn_url = "mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin";
		public $manager;

		public function __construct(){
			$this->manager = new MongoDB\Driver\Manager($this->conn_url); 
			if (!$this->manager) {
				die("conn failed.");
			}
		}

		public function executeQuery($filter, $options){
			$query = new MongoDB\Driver\Query($filter, $options);
			$cursor = $this->manager->executeQuery('crawl.CrawlHtml', $query);
			return $cursor;
		}
		
		public function executeCommand($command){
// 		    $command = new MongoDB\Driver\Command([
// 		        'count' => 'CrawlHtml',
// 		        'cursor' => new stdClass,
// 		    ]);
		    
		    $cursor = $this->manager->executeCommand('crawl', $command);
		    return $cursor;
		}
	}
 ?>
