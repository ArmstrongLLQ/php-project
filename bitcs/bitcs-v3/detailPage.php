
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
  </head>
  <body>
    <div class="head" align="center">
    	<h1>
        <b>信息化定制采集</b>
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
		<div class="col-md-10 column">
			<ul class="breadcrumb">
				<li>
					 <a href="mainPage.php">首页</a>
				</li>
				<li>
					 <a href="mainPage.php">信息化建设</a>
				</li>
				<li class="active">
					正文
				</li>
			</ul>

			<?php 
require_once "BitcsService.class.php";
$bitcs_service = new BitcsService();

$content_id = @$_GET['id'] ? $_GET['id'] : '#';
$db = 'informatization';
$collection = @$_GET['collection'] ? $_GET['collection'] : "inforday";

$page_content = $bitcs_service->getDetailPage($content_id, $db, $collection);

$title = $page_content['title'];
$content = "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$page_content['content'];
$content = str_replace("\r\n", "<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp", $content);

$date_trans = getdate($page_content['time']->sec);
$time = $date_trans['year']."-".$date_trans['mon']."-".$date_trans['mday'];
$url = $page_content['url'];

?>
<br>
<div>
	<h2 align="center"><b><?php echo $title ?></b></h2>
</div>
<br>                                                 
<h4 align="center">发布时间：<?php echo $time ?></h4>
<br>
<p ><font size="4"><?php print($content) ?></font></p>
<p align="right"><a href=<?php echo $url; ?>>查看原文</a></p>
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

