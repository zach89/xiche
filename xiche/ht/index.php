<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!--<script type="text/javascript" src="../js/style-table.js"></script>-->
    <style>
.left{ width:300px; height:200px; float:left; text-align:left; background:#FF0;}
.right{ width:300px; height:200px; float:right; text-align:right; background:#F00;}
</style>
<div class="left">左边这个宽300像素左对齐高200 背景颜色为黄</div>
<div class="right">右边这个宽300像素右对齐高200背景颜色为红</div>
<script>
window.onload = function(){
    var h = $(window).height();
    var w = document.documentElement.clientWidth;
    //$("#map").attr("style","width:"+w+"px;height:"+h+);
    $(".left").css("width",0.2*w).css("height",0.9*h+"px");
    $(".right").css("width",0.73*w+"px").css("height",0.9*h+"px");
}

</script>
    
</html>