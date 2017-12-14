<?php
	require_once "BitcsService.class.php";
class Data{
    public static $menu_list = array(
        array('menuname' => '信息化', 'submenu' => array('信息化建设', '信息化每周报送','工业互联网')),
        array('menuname' => '网络安全', 'submenu' => array('网络安全建设', '网络安全每周报送','工业网络安全')),
        array('menuname' => '采集源', 'submenu' => array('新华网', '人民网')),
    );

	public function getAllData($request_data){
		$where = array();
		$bitcs_server = new BitcsService();
        $offset = !empty($request_data['offset']) ? $request_data['offset'] : 1;
        $limit = !empty($request_data['limit']) ? $request_data['limit'] : 20;
        $collection = !empty($request_data['collection']) ? $request_data['collection'] : 'inforday';

		$test_class = $bitcs_server->getPageData($offset, $limit, $where, 'informatization', $collection);

        list($total_row, $page_count) = $bitcs_server->getPageCount($limit, $where, 'informatization', $collection);

        if(!empty($test_class)){
            for($i=0; $i<count($test_class); $i++){
                $id_string = " " . $test_class[$i]['_id'] . " ";
                $test_class[$i]['_id'] = trim($id_string);

                $date_trans1 = getdate($test_class[$i]['time']->sec);
                $test_class[$i]['time'] = $date_trans1['year']."-".$date_trans1['mon']."-".$date_trans1['mday'];

                $date_trans2 = getdate($test_class[$i]['fromTime']->sec);
                $test_class[$i]['fromTime'] = $date_trans2['year']."-".$date_trans2['mon']."-".$date_trans2['mday'];
                }
            $result_data['error_code'] = 0;
            $result_data['total'] = $total_row;
            $result_data['count'] = $limit;
            $result_data['data'] = $test_class;
        }else{
            $result_data['error_code'] = 2001;
        }
        
		return $result_data;
	}

    public function getDataById($request_data){
        $bitcs_server = new BitcsService();
        $collection = !empty($request_data['collection']) ? $request_data['collection'] : 'inforday';
        $id = $request_data['id'];
        
        $test_class = $bitcs_server->getDetailPage($id, 'informatization', $collection);
        $result_data['error_code'] = 0;
        $result_data['data'] = $test_class;

        if(!empty($test_class)){
            $result_data['error_code'] = 0;
            $result_data['data'] = $test_class;
        }else{
            $result_data['error_code'] = 2001;
        }
        return $result_data;
    }

    public function getMenu($request_data){
        $result_data['error_code'] = 0;
        $result_data['data'] = self::$menu_list;
        return $result_data;
    }

}
?>