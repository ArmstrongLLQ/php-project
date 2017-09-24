<?php
    
    class BitcsService{
        public function getPageCount($pagesize){
            $page_para = array();
            $manage = new MongoClient();
            $db = $manage->test;
            $collection = $db->bitcs;
            $cursor = $collection->find();
            $total_row = $cursor->count();
            $page_count = ceil($total_row / $pagesize);
            $page_para[] = $total_row;
            $page_para[] = $page_count;
            
            return $page_para;
        }
        
        public function getPageData($page_now, $pagesize){
            $data_arr = array();
            $manage = new MongoClient();
            $db = $manage->test;
            $collection = $db->bitcs;
            $cursor = $collection->find()->limit($pagesize)->skip(($page_now - 1) * $pagesize);
            foreach ($cursor as $doc) {
                $data_arr[] = $doc;
            }
            return $data_arr;
        }
    }