<?php 
class ExcelToArrary{

       public function __construct() {

              /*导入phpExcel核心类    注意 ：你的路径跟我不一样就不能直接复制*/
               include_once('./phpexcel/Classes/PHPExcel.php');
       }

     /* 导出excel函数*/
    public function set_para()
    {

          error_reporting(E_ALL);
          date_default_timezone_set('Europe/London');
         $objPHPExcel = new PHPExcel();

        /*以下是一些设置 ，什么作者  标题啊之类的*/
         $objPHPExcel->getProperties()->setCreator("armstrong")
                               ->setLastModifiedBy("armstrong")
                               ->setTitle("数据EXCEL导出")
                               ->setSubject("数据EXCEL导出")
                               ->setDescription("备份数据")
                               ->setKeywords("excel")
                              ->setCategory("result file");
        return $objPHPExcel;
    }
        public function push_data($data, $objPHPExcel)
        {
         /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
            foreach($data as $k => $v)
            {

                 $num=$k+1;
                 $objPHPExcel->setActiveSheetIndex(0)

                             //Excel的第A列，uid是你查出数组的键值，下面以此类推
                              ->setCellValue('A'.$num, $v['id'])    
                              ->setCellValue('B'.$num, $v['title']);
            }
            return $objPHPExcel;
        }
        public function save_file($name, $objPHPExcel)
        {
             $objPHPExcel->getActiveSheet()->setTitle('User');
            $objPHPExcel->setActiveSheetIndex(0);
             header('Content-Type: application/vnd.ms-excel');
             header('Content-Disposition: attachment;filename="'.$name.'.xls"');
             header('Cache-Control: max-age=0');
             $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
             $objWriter->save('php://output');
             exit;
        
        }
           
}

function connectMysql($my_host, $my_username, $my_password, $my_database)
{
    //连接数据库
    $con = mysqli_connect($my_host, $my_username, $my_password, $my_database);
    mysqli_query($con, "SET NAMES 'utf8'");
    mysqli_query($con, "SET CHARACTER SET utf8");
    if(!$con)
    {
        die("连接失败: " . mysqli_connect_error());
    }
    return $con;
}

$name='Excelfile';    //生成的Excel文件文件名
$res= new ExcelToArrary();
$objPHPExcel = $res->set_para();

$con = connectMysql("172.16.155.11","doaj","Doa123!@#j", "doaj");
$pagesize = 100; 
$total_sql = "select COUNT(*) from doaj_data where id";
$total_result = mysqli_query($con, $total_sql); 
$total_row_arr = mysqli_fetch_row($total_result); 
$total_row = $total_row_arr[0];   //总条数 
//总页数 
$total = ceil($total_row / $pagesize); 

for ($i=0; $i < $total; $i++) {
    $offset = $i * $pagesize;
    $sql = "select * from doaj_data order by id limit {$offset},{$pagesize}";
    $result = mysqli_query($con, $sql);
    while($sql_arr = mysqli_fetch_assoc($result))
    {
        $data_row[] = $sql_arr;
    }
     //查出数据
    $objPHPExcel = $res->push_data($data_row, $objPHPExcel);  
}

$res->save_file($name, $objPHPExcel);
   
    
?>