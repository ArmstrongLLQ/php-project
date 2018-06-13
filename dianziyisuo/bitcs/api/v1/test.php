<?php 
	
require_once "BitcsService.class.php";
//$responseData = array(
//      1 => array('name' => '托福班', 'count' => 18),
//      2 => array('name' => '雅思班', 'count' => 20),
//  );
    
$where = array();
    $bitcs_server = new BitcsService();
    $responseData = $bitcs_server->getPageData(1, 1, $where, 'informatization', 'inforday');
// print_r($responseData);

// foreach($responseData as $row){
//                 $responseData['_id'] = $row['_id'];

//                 $date_trans1 = getdate($row['time']->sec);
//                 $row['time'] = 'HELLO';
//                 // $date_trans1['year']."-".$date_trans1['mon']."-".$date_trans1['mday'];

//                 $date_trans2 = getdate($row['fromTime']->sec);
//                 $row['fromTime'] = $date_trans2['year']."-".$date_trans2['mon']."-".$date_trans2['mday'];
//             }

// for($i=0; $i<count($responseData); $i++){
//     $id_string = " " . $responseData[$i]['_id'] . " ";
//     $responseData[$i]['_id'] = trim($id_string);
//     $date_trans1 = getdate($responseData[$i]['time']->sec);

//     $responseData[$i]['time'] = $date_trans1['year']."-".$date_trans1['mon']."-".$date_trans1['mday'];

//     $date_trans2 = getdate($responseData[$i]['fromTime']->sec);
    
//     $responseData[$i]['fromTime'] = $date_trans2['year']."-".$date_trans2['mon']."-".$date_trans2['mday'];
//     print_r($responseData[$i]['_id']);
// }
// print_r($responseData);
// // echo json_encode($responseData, JSON_UNESCAPED_UNICODE);

// $test_arr = array(array('a' => 'fd', 'b' => 'asd'),array('a' => 'qwe', 'b' => 'rewq'));

// print_r($test_arr);

// foreach ($test_arr as $row) {
    
//     $row['a'] = 111;
// }

// $test_arr[0]['a'] = 111;
// print_r($test_arr);
    class A{
        private $menu_list = array(
            array('menuid' => md5('信息化'), 'menuname' => '信息化', 'submenu' => array(array('menuid' => md5('信息化建设'), 'menuname' => '信息化建设'),array('menuid' => md5('信息化每周报送'), 'menuname' => '信息化每周报送'), array('menuid' => md5('工业互联网'), 'menuname' => '工业互联网'))),
            array('menuid' => md5('网络安全'), 'menuname' => '网络安全', 'submenu' => array(array('menuid' => md5('网络安全建设'), 'menuname' => '网络安全建设'),array('menuid' => md5('网络安全每周报送'), 'menuname' => '网络安全每周报送'), array('menuid' => md5('工业网络安全'), 'menuname' => '工业网络安全'))),
            array('menuid' => md5('采集源'), 'menuname' => '采集源', 'submenu' => array(array('menuid' => md5('新华网'), 'menuname' => '新华网'),array('menuid' => md5('人民网'), 'menuname' => '人民网'))),
        );

        public static print_menu(){
            print_r($menu_list);
        }
    }
    
    $a = A();
    $a->print_menu;
    
    // print_r($menu_list);
    // echo json_encode($menu_list, JSON_UNESCAPED_UNICODE);
 ?>
