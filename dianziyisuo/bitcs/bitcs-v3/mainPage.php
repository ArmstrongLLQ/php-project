
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
    <script type="text/javascript">
        function showTable(str)
        {
          var xmlhttp;    
          if (str=="all")
          {
            return;
          }
          if (window.XMLHttpRequest)
          {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
          }
          else
          {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange=function()
          {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
              document.getElementById("news_list").innerHTML=xmlhttp.responseText;
            }
          }
          xmlhttp.open("GET","get_news_list.php?q="+str,true);
          xmlhttp.send();
        }
        
        function validateForm(){
        	var x = document.forms['searchForm']['QueryString'].value;
        	if(x == null || x == ""){
        		alert('请输入关键字！');
        		return false;
        	}
        }
    </script>
  </head>
  <body>
    <div class="head" align="center"><h1>
        <b>信息化定制采集</b>
      </h1><br>
  <FORM method="post" action="searchPage.php" onsubmit="return validateForm()" name="searchForm">
<INPUT type="Text" name="QueryString">
<INPUT type="Submit" value="搜索">
<input type="button" name="AdvancedSearch" onclick="javascript:window.location.href='AdvSearchPage.php'" value="高级搜索">
</FORM>
</div>
<br><br>
<div class="container">
  <div class="row clearfix">
    <div class="col-md-1 column">
    </div>
    <div class="col-md-2 column">
      <div class="list-group">
        <a href="mainPage.php" class="list-group-item active">首页</a>
         <a href="mainPage.php" class="list-group-item active">信息化</a>
        <div class="list-group-item">
          <a href="mainPage.php?p=1&menu_name=产业新闻">信息化建设</a>
        </div>
        <div class="list-group-item">
          <a href="mainPage.php?p=1&menu_name=市场观察">信息化每周报送</a>
        </div>
        <div class="list-group-item">
          <a href="mainPage.php?p=1&menu_name=行业展览">工业互联网</a>
        </div> 
        <a class="list-group-item active"> 网络安全</a>
        <div class="list-group-item">
          <a href="#">网络安全1</a>
        </div> 
        <div class="list-group-item">
          <a href="#">网络安全2</a>
        </div> 
        <div class="list-group-item">
          <a href="#">网络安全3</a>
        </div> 
        <a class="list-group-item active"> 采集源</a>
        <div class="list-group-item">
          <a href="mainPage.php?p=1&news_source=产业新闻">新华网</a>
        </div> 
        <div class="list-group-item">
          <a href="mainPage.php?p=1&news_source=产业新闻">人民网科技产业动态</a>
        </div> 
      </div>
    </div>
    <div class="col-md-8 column">
      <!-- <div class="btn-group">
         <button class="btn btn-default">全部</button> <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li>
             <a href="#">来源1</a>
          </li>
          <li>
             <a href="#">来源2</a>
          </li>
          <li class="disabled">
             <a href="#">来源3</a>
          </li>
          <li class="divider">
          </li>
          <li>
             <a href="#">其它</a>
          </li>
        </ul>
      </div> -->
      <form>
          <select name="sources" onchange="showTable(this.value)">
              <option value="all">全部</option>
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
              <option value="others">其他</option>
          </select>
      </form>
      <div id="news_list">
      <table class="table" style="table-layout: fixed;width: 100%">
        <thead>
          <tr>
            <th width="85%">
              动态信息
            </th>
            <th width="15%" align="right">
              时间
            </th>
          </tr>
          
        </thead>
        <tbody>
        <?php 

            $pagesize = 20;
            $page_now = @$_GET['p'] ? $_GET['p'] : 1;
            
            $where = array();
            
            list($total_row,$page_count) = $bitcs_service->getPageCount($pagesize, $where, $db, $collection);
            $page_data = $bitcs_service->getPageData($page_now, $pagesize, $where, $db, $collection);

            foreach($page_data as $row){
                $detail_url = "detailPage.php?id=".$row['_id'];
                $date_trans = getdate($row['time']->sec);
                $time = $date_trans['year']."-".$date_trans['mon']."-".$date_trans['mday'];
                $title = $row['title'];
                

                echo "<tr>";
                echo "<td style='white-space: nowrap;;overflow: hidden;text-overflow: ellipsis;'>".$row['Name']." | <a href=$detail_url>".$title."</td><td>".$time."</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
      </table>
    
    <div>
      <ul class="pagination">
        <?php
            //上一页 、下一页
            if ($page_now <= 1){
                $page_now = 1;
                $page_pre = 1;
                $page_ten_pre = 1;
                $page_next = $page_now + 1;
                if ($page_next >= $page_count) {
                    $page_next = $page_count;
                }
                $page_ten_next = $page_now + 10;
                if ($page_ten_next >= $page_count) {
                    $page_ten_next = $page_count;
                }
            }elseif($page_now >= $page_count){
                $page_now = $page_count;
                $page_pre = $page_now - 1;
                $page_ten_pre = $page_now - 10;
                $page_next = $page_count;
                $page_ten_next = $page_count;
            }else{
                $page_pre = $page_now - 1;
                $page_next = $page_now + 1;
                if ($page_next >= $page_count) {
                    $page_next = $page_count;
                }
                $page_ten_pre = $page_now - 10;
                if ($page_ten_pre <= 1) {
                    $page_ten_pre = 1;
                }
                $page_ten_next = $page_now + 10;
                if ($page_ten_next >= $page_count) {
                    $page_ten_next = $page_count;
                }

            }
            echo "<li>";
            echo "<a href='mainPage.php?p=1&collection=$collection'>Home</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_ten_pre&collection=$collection'><<</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_pre&collection=$collection'>Prev</a>";
            echo "</li>";
            $start = $page_now;
            if ($page_count <= 10) {
                for ($i=1; $i <= $page_count; $i++) { 
	                if($i == $page_now){
	                	echo "<li class='active'>";
	                	echo "<a href='mainPage.php?p=$i&collection=$collection'>$i</a>";
	                	echo "</li>";
	                }else{
	                	echo "<li>";
	                	echo "<a href='mainPage.php?p=$i&collection=$collection'>$i</a>";
	                	echo "</li>";
	                }
                
                }
            }elseif ($page_now + 10 > $page_count) {
                for ($i=$page_now; $i <= $page_count; $i++) { 
                if($i == $page_now){
	                	echo "<li class='active'>";
	                	echo "<a href='mainPage.php?p=$i&collection=$collection'>$i</a>";
	                	echo "</li>";
	                }else{
	                	echo "<li>";
	                	echo "<a href='mainPage.php?p=$i&collection=$collection'>$i</a>";
	                	echo "</li>";
	                }
                }
            }else{
                for ($i=$page_now ; $i < $start +10; $i++) { 
                if($i == $page_now){
	                	echo "<li class='active'>";
	                	echo "<a href='mainPage.php?p=$i&collection=$collection'>$i</a>";
	                	echo "</li>";
	                }else{
	                	echo "<li>";
	                	echo "<a href='mainPage.php?p=$i&collection=$collection'>$i</a>";
	                	echo "</li>";
	                }
                }
            }
            
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_next&collection=$collection'>Next</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_ten_next&collection=$collection'>>></a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_count&collection=$collection'>End</a>";
            echo "</li>";
        ?>
      </ul>
    </div>
    </div>
    <div class="col-md-1 column">
    </div>
</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>