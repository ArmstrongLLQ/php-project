<!DOCTYPE html>
<html>
<head>
    <title>test</title>
    <meta charset="utf-8">

    <script type="text/javascript">
        // 使用ajax实现页面表格显示内容的切换
        function showTable(str)
        {
          var xmlhttp;    
          if (str=="")
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
          xmlhttp.open("GET","ajax_test.php?q="+str,true);
          xmlhttp.send();
        }
    </script>
</head>
<body>
<a href="#" onclick="showTable('xinxihua')">dianji</a>
<button onclick="showTable('xinxihua')">dianji</button>
<button onclick="showTable('xinxianquan')">dianji</button>
<div id="news_list">这里输出</div>
</body>
</html>