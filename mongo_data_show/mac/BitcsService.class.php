<?php
    require_once 'MongoHelper.class.php';
    
    class BitcsService{
        public function getPageCount($pagesize){
            $page_para = array();
            $mongo_helper = new MongoHelper();
            $command = new MongoDB\Driver\Command([
                'count' => 'CrawlHtml',
                'cursor' => new stdClass,
            ]);
            $cursor = $mongo_helper->executeCommand($command);
            foreach ($cursor as $document) {
                $total_row = $document->n;
            }
            $page_count = ceil($total_row / $pagesize);
            $page_para[] = $total_row;
            $page_para[] = $page_count;
            
            return $page_para;
        }
        
        public function getPageData($page_now, $pagesize){
            $filter = ['Category' => "新闻"];
            $options = [
            	"skip" => ($page_now - 1) * $pagesize,
            	"limit" => $pagesize,
            ];
            $mongo_helper = new MongoHelper();
            $cursor = $mongo_helper->executeQuery($filter, $options);
            return $cursor;
        }
    }