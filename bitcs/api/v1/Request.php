<?php

/**
 * 数据操作类
 */
require_once "data.php";

class Request
{
    //允许的请求方式
    private $method_type = array('get', 'post', 'put', 'patch', 'delete');
    //测试数据
//  private static $test_class = array(
//      1 => array('name' => '托福班', 'count' => 18),
//      2 => array('name' => '雅思班', 'count' => 20),
//  );
	
    public function getRequest()
    {
        //请求方式
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if (in_array($method, $this->method_type)) {
            //调用请求方式对应的方法
            $data_name = $method . 'Data';
            return self::$data_name($_REQUEST);
        }
        return false;
    }

    //GET 获取信息
    public function getData($request_data)
    {
    	$the_data = new data();
        $class = $request_data['class'];
        if($class == 'contents'){
            if(!empty($request_data['id'])){
                $test_class = $the_data->getDataById($request_data);
            }else{
                $test_class = $the_data->getAllData($request_data);
            }
        }else{
            $test_class = $the_data->getMenu($request_data);
            
        }
        
		
        return $test_class;
    }


    //POST /class：新建一个班
    public function postData($request_data)
    {
        if (!empty($request_data['name'])) {
            $data['name'] = $request_data['name'];
            $data['count'] = (int)$request_data['count'];
            $this->test_class[] = $data;
            return $this->test_class;//返回新生成的资源对象
        } else {
            return false;
        }
    }

    //PUT /class/ID：更新某个指定班的信息（全部信息）
    private function putData($request_data)
    {
        $class_id = (int)$request_data['class'];
        if ($class_id == 0) {
            return false;
        }
        $data = array();
        if (!empty($request_data['name']) && isset($request_data['count'])) {
            $data['name'] = $request_data['name'];
            $data['count'] = (int)$request_data['count'];
            $this->test_class[$class_id] = $data;
            return $this->test_class;
        } else {
            return false;
        }
    }

    //PATCH /class/ID：更新某个指定班的信息（部分信息）
    private function patchData($request_data)
    {
        $class_id = (int)$request_data['class'];
        if ($class_id == 0) {
            return false;
        }
        if (!empty($request_data['name'])) {
            $this->test_class[$class_id]['name'] = $request_data['name'];
        }
        if (isset($request_data['count'])) {
            $this->test_class[$class_id]['count'] = (int)$request_data['count'];
        }
        return $this->test_class;
    }

    //DELETE /class/ID：删除某个班
    private function deleteData($request_data)
    {
        $class_id = (int)$request_data['class'];
        if ($class_id == 0) {
            return false;
        }
        unset($this->test_class[$class_id]);
        return $this->test_class;
    }
}
?>