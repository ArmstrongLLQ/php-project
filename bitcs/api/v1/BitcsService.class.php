<?php
	require_once "MongoHelper.class.php";
    class BitcsService{
        public function getPageCount($pagesize, $where, $db, $collection){
            $page_para = array();
            $mongo_helper = new MongoHelper($db, $collection);
            
            $cursor = $mongo_helper->collection->find($where);
            $total_row = $cursor->count();
            $page_count = ceil($total_row / $pagesize);
            $page_para[] = $total_row;
            $page_para[] = $page_count;
            
            return $page_para;
        }

        public function getPageData($page_now, $pagesize, $where, $db, $collection){
            $data_arr = array();
            $mongo_helper = new MongoHelper($db, $collection);
            
            $cursor = $mongo_helper->collection->find($where)->sort(array('time' => -1))->limit($pagesize)->skip(($page_now - 1) * $pagesize);
            foreach ($cursor as $doc) {
                $data_arr[] = $doc;
            }
            return $data_arr;
        }
        
        // 获取数据来源列表
        public function getSourceList($db, $collection){
        	$mongo_helper = new MongoHelper($db, $collection);
        	$retval = $mongo_helper->collection->distinct("Name");
        	return $retval;
        }

        // 根据content_id字段查找详细内容
        public function getDetailPage($content_id, $db, $collection){
            $data_arr = array();
            $mongo_helper = new MongoHelper($db, $collection);
            
            $content_id = new MongoId($content_id);
            $where = array('_id'=>(object)$content_id);
            $cursor = $mongo_helper->collection->findOne($where);
            // foreach ($cursor as $doc) {
            //     $data_arr[] = $doc;
            // }
            // return $data_arr;
            return $cursor;
        }


    }