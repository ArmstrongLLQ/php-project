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
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <h2 align="center">
        信息化定制采集
      </h2>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-1 column">
    </div>
    <div class="col-md-2 column">
      <div class="list-group">
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
            $page_now = 1;

            $page_data = $bitcs_service->getPageData($page_now, $pagesize);
            
            foreach($page_data as $row){
                echo "<tr>";
                echo "<td>".$row['Name']." | <a href='#'>".$row['title']."</td><td>".$row['time']."</td>";
                echo "</tr>";
            }
            
        ?>
        </tbody>
      </table>
      <ul class="pagination">
        <li>
           <a href="test.php?p=1">Prev</a>
        </li>
        <li>
           <a href="test.php?p=1">1</a>
        </li>
        <li>
           <a href="test.php?p=2">2</a>
        </li>
        <li>
           <a href="test.php?p=3">3</a>
        </li>
        <li>
           <a href="test.php?p=4">4</a>
        </li>
        <li>
           <a href="test.php?p=5">5</a>
        </li>
        <li>
           <a href="test.php?p=5">Next</a>
        </li>
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