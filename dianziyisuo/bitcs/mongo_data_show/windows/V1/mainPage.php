
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>s
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="head" align="center"><h1>
        信息化定制采集
      </h1>
  <FORM METHOD="post" ACTION="p?act=search">
<INPUT TYPE="Text" NAME="QueryString">
<INPUT TYPE="Submit" VALUE="搜索">
<input type="button" name="AdvancedSearch" value="高级搜索">
</FORM>
</div>
<div class="container">
  <div class="row clearfix">
    <div class="col-md-1 column">
    </div>
    <div class="col-md-2 column">
      <div class="list-group">
        <a href="mainPage.php" class="list-group-item active">首页</a>
         <a href="#" class="list-group-item active">信息化</a>
        <div class="list-group-item">
          <a href="#">信息化建设</a>
        </div>
        <div class="list-group-item">
          <a href="#">信息化每周报送</a>
        </div>
        <div class="list-group-item">
          <a href="#">工业互联网</a>
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
          <a href="#">新华社</a>
        </div> 
      </div>
    </div>
    <div class="col-md-8 column">
      <div class="btn-group">
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
      </div>
      <table class="table">
        <thead>
          <tr>
            <th width="80%">
              动态信息
            </th>
            <th width="20%">
              时间
            </th>
          </tr>
        </thead>
        <tbody>
        <?php 
            require_once "BitcsService.class.php";
            $bitcs_service = new BitcsService();
            
            $pagesize = 10;
            $page_now = @$_GET['p'] ? $_GET['p'] : 1;
            list($total_row,$page_count) = $bitcs_service->getPageCount($pagesize);
            $page_data = $bitcs_service->getPageData($page_now, $pagesize);

            foreach($page_data as $row){
                echo "<tr>";
                echo "<td>".$row['source']." | <a href='#'>".$row['title']."</td><td>".$row['time']."</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
      </table>
      <ul class="pagination">
        <?php
            //上一页 、下一页
            if ($page_now <= 1){
                $page_now = 1;
                $page_pre = 1;
                $page_ten_pre = 1;
                $page_next = $page_now + 1;
                $page_ten_next = $page_now + 10;
            }elseif($page_now >= $page_count){
                $page_now = $page_count;
                $page_pre = $page_now - 1;
                $page_ten_pre = $page_now - 10;
                $page_next = $page_count;
                $page_ten_next = $page_count;
            }else{
                $page_pre = $page_now - 1;
                $page_next = $page_now + 1;
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
            echo "<a href='mainPage.php?p=1'>Home</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_ten_pre'><<</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_pre'>Prev</a>";
            echo "</li>";
            $start = $page_now;
            if ($page_now + 10 < $page_count) {
                for ($i=$page_now; $i < $start + 10; $i++) { 
                echo "<li>";
                echo "<a href='mainPage.php?p=$i'>$i</a>";
                echo "</li>";
                }
            }else{
                for ($i=$page_now - 10; $i < $start; $i++) { 
                echo "<li>";
                echo "<a href='mainPage.php?p=$i'>$i</a>";
                echo "</li>";
                }
            }
            
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_next'>Next</a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_ten_next'>>></a>";
            echo "</li>";
            echo "<li>";
            echo "<a href='mainPage.php?p=$page_count'>End</a>";
            echo "</li>";
        ?>
      </ul>
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