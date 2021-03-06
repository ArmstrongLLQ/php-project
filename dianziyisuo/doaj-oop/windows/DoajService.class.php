<?php
    require_once 'SqlHelper.class.php';
    //该类是业务逻辑类，完成对doaj表的操作
    // 一个函数获取总共有多少页，
    class DoajService{
        public function getPageCount($sql, $pagesize){
           $page_para = array();
           $sql_helper = new SqlHelper();
           $result = $sql_helper->executeDql($sql);
           
           if ($row = mysqli_fetch_row($result)){
               $total_row = $row[0];
               $page_count = ceil($total_row / $pagesize);
               $page_para[] = $total_row;
               $page_para[] = $page_count;
           }
           
           mysqli_free_result($result);
           $sql_helper->closeConnect();
           
           return $page_para;
        }
        
        // 一个函数获取应当显示的数据
        public function getDoajData($page_now, $pagesize){
            $sql = "select * from doaj_data order by id limit ".($page_now - 1) * $pagesize.",".$pagesize; 
            $sql_helper = new SqlHelper();
            $result = $sql_helper->executeDql2($sql);
            $sql_helper->closeConnect();
            return $result;
        }
        
    }
?>