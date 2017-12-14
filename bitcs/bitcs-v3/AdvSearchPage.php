
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>信息化定制采集</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>s
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    	function validateForm(){
    		var start_year = document.forms['myform']['start_year'].value.parseInt();
    		var start_month = document.forms['myform']['start_month'].value.parseInt();
    		var end_year = document.forms['myform']['end_year'].value.parseInt();
    		var end_month = document.forms['myform']['end_month'].value.parseInt();
    		
    				if(!((1000<start_year)&&(start_year<2050)&&(end_year>1000)&&(end_year<2050)&&(start_month>=1)&&(start_month<=12)&&(end_month>=1)&&(end_month<=12))){
    			alert('请输入正确的时间');
    			return false;
    		}
    	}
    </script>
  </head>
  <body>
    <div class="head" align="center">
        <h1>
        <b>信息化定制采集</b>
        </h1>
<br>
<br>
</div>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-2 column">
        </div>
        <div class="col-md-8 column">
            <ul class="breadcrumb">
                <li>
                     <a href="mainPage.php">首页</a>
                </li>
                
                <li class="active">
                    高级搜索
                </li>
            </ul>
            <form class="form-horizontal" name="myform" role="form" method="post" action="AdvSearchTestPage.php">
                <div class="form-group">
                     <label for="input_key_1" class="col-sm-4 control-label">包含以下任意一个关键词</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="input_key_1" placeholder="多个关键词用空格分隔。例如：中国 国务院" name="key_involve_one" autofocus>
                    </div>
                </div>
                <div class="form-group">
                     <label for="input_key_2" class="col-sm-4 control-label">包含以下全部关键词</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="input_key_2" name="key_involve_all">
                    </div>
                </div>
                <div class="form-group">
                     <label for="input_key_3" class="col-sm-4 control-label">不包含以下关键词</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="input_key_3" name="key_not_involve">
                    </div>
                </div>
                <div class="form-group">
                     <label for="input_key_4" class="col-sm-4 control-label">完整不拆分的关键词</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="input_key_4" name="key_not_split">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">来源</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="source">
                            <option value="">全部</option>
							              <?php
							              	require_once "BitcsService.class.php";
							            	  $bitcs_service = new BitcsService();
							            	  
							              	$db = 'informatization';
							            		$collection = @$_GET['collection'] ? $_GET['collection'] : "inforday";
							            		
							            		//查询来源的种类，动态生成来源列表
							            		$retval = $bitcs_service->getSourceList($db, $collection);
							            		
							            		foreach($retval as $value){
							            			echo '<option value='.$value.'>'.$value.'</option>';
							            		}
							              ?>
							              <option value="null">其他</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">时间段选择</label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="text" placeholder="年" class="form-control" size="2" name="start_year">
                        </label>
                        <label class="radio-inline">
                            <input type="text" placeholder="月" class="form-control" size="1" name="start_month">
                        </label>
                        <label class="radio-inline">
                            到
                        </label>
                        <label class="radio-inline">
                            <input type="text" placeholder="年" class="form-control" size="2" name="end_year">
                        </label>
                        <label class="radio-inline">
                            <input type="text" placeholder="月" class="form-control" size="1" name="end_month">
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">搜索词位置</label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <input type="radio" name="radio-1" id="inlineCheckbox1" value="in_title" checked> 在标题中
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="radio-1" id="inlineCheckbox2" value="in_content"> 在正文中
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">显示条数</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="result_number">
                            <option value="1">每页显示10条结果</option>
                            <option value="2">每页显示15条结果</option>
                            <option value="3">每页显示20条结果</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7">
                         <input type="submit" class="btn btn-default" value="检索">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                         <input type="reset" class="btn btn-default" value="重置">
                    </div>
                    
                </div>
            </form>
  
</div>
        <div class="col-md-2 column">
        </div>
    </div>
</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

