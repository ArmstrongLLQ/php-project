
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> 
<HTML> 
<HEAD> 
<TITLE>表格翻页---www.jb51.net</TITLE> 
<style> 
body, td{ 
font-size: 9pt; 
} 
a:link { 
color: #FF0000; 
} 
a:visited { 
color: #FF0000; 
} 
a:hover { 
color: #006600; 
} 
</style> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- 
var record = 4;//每页显示多少条记录 
var count = 24;//记录总数 
var pageTotal = ((count+record-1)/record)|0;//总页数 
var pagenum = 1;//将要显示的页码 


Cookie = { 
Set : function (){ 
var name = arguments[0], value = escape(arguments[1]), days = 365, path = "/"; 
if(arguments.length > 2) days = arguments[2]; 
if(arguments.length > 3) path = arguments[3]; 
with(new Date()){ 
setDate(getDate()+days); 
days=toUTCString(); 
} 
document.cookie = "{0}={1};expires={2};path={3}".format(name, value, days, path); 
}, 
Get : function (){ 
var returnValue=document.cookie.match(new RegExp("[\b\^;]?" + arguments[0] + "=([^;]*)(?=;|\b|$)","i")); 
return returnValue?unescape(returnValue[1]):returnValue; 
} 
} 
String.prototype.format = function(){ 
var tmpStr = this; 
var iLen = arguments.length; 
for(var i=0;i<iLen;i++){ 
tmpStr = tmpStr.replace(new RegExp("\\{" + i + "\\}", "g"), arguments[i]); 
} 
return tmpStr; 
} 
function setPagenum(){//整理Cookie 
pagenum = Cookie.Get("pagenum"); 
if(pagenum=="" || pagenum<1){ 
pagenum=1; 
} 
} 

setPagenum(); 

//重新整理当前页码，如果页面小于1，则赋值为1，如果大于总页数，则等于总页数 
coordinatePagenum(pagenum); 

//根据当前要显示的页码取得当前面里第一条记录的号码 
var pageBegin = (record*(pagenum-1)+1)|0; 

//根据当前要显示的页码取得当前面里最后一条记录的号码 
var pageEnd = record*pagenum; 

function showhiddenRecord(pagenum){ 
number.innerHTML=pagenum; 
if(pagenum<=1){ 
theFirstPage.innerHTML="第一页"; 
thePrePage.innerHTML="上一页"; 
}else{ 
theFirstPage.innerHTML="<a href=\"javascript:firstPage()\">第一页</a>"; 
thePrePage.innerHTML="<a href=\"javascript:prePage()\">上一页</a>"; 
} 
if(pagenum>=pageTotal){ 
theNextPage.innerHTML="下一页"; 
theLastPage.innerHTML="最后一页"; 
}else{ 
theNextPage.innerHTML="<a href=\"javascript:nextPage()\">下一页</a>"; 
theLastPage.innerHTML="<a href=\"javascript:lastPage()\">最后一页</a>"; 
} 
document.getElementById('goto').value=pagenum; 
//根据当前要显示的页码取得当前面里第一条记录的号码 
pageBegin = (record*(pagenum-1)+1)|0; 

//根据当前要显示的页码取得当前面里最后一条记录的号码 
pageEnd = record*pagenum; 
for(var i=1;i<=count;i++){ 
if(i>=pageBegin && i<=pageEnd){ 
mytable.rows[i].style.display=""; 
}else{ 
mytable.rows[i].style.display="none"; 
} 
} 
Cookie.Set("pagenum", pagenum); 
} 

function firstPage(){ 
pagenum=1; 
showhiddenRecord(pagenum); 
} 

function lastPage(){ 
showhiddenRecord(pageTotal); 
} 

//重新整理当前页码，如果页面小于1，则赋值为1，如果大于总页数，则等于总页数 
function coordinatePagenum(num){ 
if(num<1){ 
num="1"; 
}else if(num>pageTotal){ 
num=pageTotal; 
} 
} 

function prePage(){ 
pagenum--; 
coordinatePagenum(pagenum); 
showhiddenRecord(pagenum); 
} 

function nextPage(){ 
pagenum++; 
coordinatePagenum(pagenum); 
showhiddenRecord(pagenum); 
} 

function gotoPage(num){ 
coordinatePagenum(pagenum); 
showhiddenRecord(num); 
} 
//--> 
</SCRIPT> 
</HEAD> 

<BODY onLoad="showhiddenRecord(pagenum)"> 
<center> 
共 6 页 当前第 <span id="number">1</span> 页 
<span id="theFirstPage"><a href="javascript:firstPage()">第一页</a></span> 
<span id="thePrePage"><a href="javascript:prePage()">上一页</a></span> 
<span id="theNextPage"><a href="javascript:nextPage()">下一页</a></span> 
<span id="theLastPage"><a href="javascript:lastPage()">最后一页</a></span> 
转到第<select onChange="gotoPage(this.value)" name="goto"> 
<option value=1>1</option> 
<option value=2>2</option> 
<option value=3>3</option> 
<option value=4>4</option> 
<option value=5>5</option> 
<option value=6>6</option> 
</select>页 
</center> 

<TABLE id="mytable" cellpadding=4 cellspacing=1 border=0 bgcolor=#999999 width=500 align=center> 
<TR bgcolor=#ffffff><TD>标题</TD></TR> 
<TR bgcolor=#ffffff><TD>1</TD></TR> 
<TR bgcolor=#ffffff><TD>2</TD></TR> 
<TR bgcolor=#ffffff><TD>3</TD></TR> 
<TR bgcolor=#ffffff><TD>4</TD></TR> 
<TR bgcolor=#ffffff><TD>5</TD></TR> 
<TR bgcolor=#ffffff><TD>6</TD></TR> 
<TR bgcolor=#ffffff><TD>7</TD></TR> 
<TR bgcolor=#ffffff><TD>8</TD></TR> 
<TR bgcolor=#ffffff><TD>9</TD></TR> 
<TR bgcolor=#ffffff><TD>10</TD></TR> 
<TR bgcolor=#ffffff><TD>11</TD></TR> 
<TR bgcolor=#ffffff><TD>12</TD></TR> 
<TR bgcolor=#ffffff><TD>13</TD></TR> 
<TR bgcolor=#ffffff><TD>14</TD></TR> 
<TR bgcolor=#ffffff><TD>15</TD></TR> 
<TR bgcolor=#ffffff><TD>16</TD></TR> 
<TR bgcolor=#ffffff><TD>17</TD></TR> 
<TR bgcolor=#ffffff><TD>18</TD></TR> 
<TR bgcolor=#ffffff><TD>19</TD></TR> 
<TR bgcolor=#ffffff><TD>20</TD></TR> 
<TR bgcolor=#ffffff><TD>21</TD></TR> 
<TR bgcolor=#ffffff><TD>22</TD></TR> 
<TR bgcolor=#ffffff><TD>23</TD></TR> 
<TR bgcolor=#ffffff><TD>24</TD></TR> 
</TABLE> 
</BODY> 
</HTML> 
