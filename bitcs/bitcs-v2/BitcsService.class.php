<?php
    class BitcsService{
        public function getPageCount($pagesize, $where){
            $page_para = array();
            $manage = new MongoClient("mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin");
            $db = $manage->crawl;
            $collection = $db->CrawlHtml; 
            $cursor = $collection->find($where);
            $total_row = $cursor->count();
            $page_count = ceil($total_row / $pagesize);
            $page_para[] = $total_row;
            $page_para[] = $page_count;
            
            return $page_para;
        }

        public function getPageCountByDiffCol($pagesize, $where, $col){
            $page_para = array();
            $manage = new MongoClient("mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin");
            $db = $manage->crawl;

            switch ($col) {
                case '产业新闻':
                    $collection = $db->CrawlHtml;
                    break;

                case '市场观察':
                    $collection = $db->CrawlHtml;
                    break;

                case '行业展览':
                    $collection = $db->CrawlHtml;
                    break;
                
                default:
                    $collection = $db->CrawlHtml;
                    break;
            }
            
            $cursor = $collection->find($where);
            $total_row = $cursor->count();
            $page_count = ceil($total_row / $pagesize);
            $page_para[] = $total_row;
            $page_para[] = $page_count;
            
            return $page_para;
        }
        
        public function getPageData($page_now, $pagesize, $where){
            $data_arr = array();
            $manage = new MongoClient("mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin");
            $db = $manage->crawl;
            $collection = $db->CrawlHtml;
            $cursor = $collection->find($where)->limit($pagesize)->skip(($page_now - 1) * $pagesize);
            foreach ($cursor as $doc) {
                $data_arr[] = $doc;
            }
            return $data_arr;
        }

        // 从不同的库里提取不同的数据
        public function getPageDataByDiffCol($page_now, $pagesize, $where, $col){
            $data_arr = array();
            $manage = new MongoClient("mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin");
            $db = $manage->crawl;
            switch ($col) {
                case '产业新闻':
                    $collection = $db->CrawlHtml;
                    break;

                case '市场观察':
                    $collection = $db->CrawlHtml;
                    break;

                case '行业展览':
                    $collection = $db->CrawlHtml;
                    break;
                
                default:
                    $collection = $db->CrawlHtml;
                    break;
            }
            
            $cursor = $collection->find($where)->limit($pagesize)->skip(($page_now - 1) * $pagesize);
            foreach ($cursor as $doc) {
                $data_arr[] = $doc;
            }
            return $data_arr;
        }

        // 根据content_id字段查找详细内容
        public function getDetailPage($content_id){
            $data_arr = array();
            $manage = new MongoClient("mongodb://bitcs:huajian2017@124.193.169.159:54016/?authSource=admin");
            $db = $manage->crawl;
            $collection = $db->CrawlHtmlSource;
            $content_id = new MongoId($content_id);
            $where = array('_id'=>(object)$content_id);
            $cursor = $collection->findOne($where);
            // foreach ($cursor as $doc) {
            //     $data_arr[] = $doc;
            // }
            // return $data_arr;
            return $cursor;
        }


    }