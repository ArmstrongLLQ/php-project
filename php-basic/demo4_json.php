<?php
    // 将php变量转换为json
    $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
    echo json_encode($arr) . "\n";

   class Emp {
       public $name = "";
       public $hobbies  = "";
   }
   $e = new Emp();
   $e->name = "sachin";
   $e->hobbies  = "sports";

   echo json_encode($e) . "\n";

   // 将json转换为php变量
   $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

   $array1 = json_decode($json, true);
   var_dump(json_decode($json));
   var_dump(json_decode($json, true));

   print_r($array1);
?>