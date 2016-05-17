<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>简单地图</title>
<link rel="stylesheet" href="./js/jquery.mobile-1.4.5.min.css">
<script src="./js/jquery.mobile-1.4.5.min.js"></script>    
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">    
<script src="./js/jquery-1.11.3.min.js"></script>    
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&libraries=convertor"></script>
<script src="./js/map.js"></script>
<script>
window.onload = function(){
    //var h = $(window).height();
    //var w = $(window).width();
    //$("#map").attr("style","width:"+w+"px;height:"+h+);
    //$("#map").css("width",w+"px").css("height",0.78*h+"px");
    getLocation();
}
</script>
</head>
<body >
<!--   定义地图显示容器   -->
<div id="map" style="width:600px;height:767px;"></div>
    <p id="zac"></p>
    <p id='za'></p>
    
</body>
</html>
