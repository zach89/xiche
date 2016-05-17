<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
require_once (ROOT."/xiche/lib/pay.php");

$tools = new JsApiPay();
$openid=$tools->GetOpenid();
if($openid=="")
{
    $url = 'http://1.yijiexun.sinaapp.com/xiche/orderx.php';
	Header("Location:$url");
    die();
}
$assorder = new Sae_Mysql;
$orderselect = $assorder->orderselect('order','openid',$openid,'time','desc');
$name = $orderselect[0]['name'];
$phone = $orderselect[0]['phone'];
$carid = $orderselect[0]['carid'];
$color = $orderselect[0]['color'];

?>
<html calss="ui-mobile">
    <head>
      <meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="./js/jquery.mobile-1.4.5.min.css">
    	<script src="./js/jquery-1.11.3.min.js"></script>
    	<script src="./js/jquery.mobile-1.4.5.min.js"></script>
      <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&libraries=convertor"></script>
    	<script src="./js/map.js"></script>
    </head>    
    <body style="" class="ui-mobile-viewport ui-overlay-a">
      <!-- Start of first page: #one -->
      <div data-role="page" id="one" data-url="one" tabindex="0" class="ui-page ui-page-theme-a ui-page-active" style="">

        	<div data-role="header" role="banner" class="ui-header ui-bar-inherit">
        		<h1 class="ui-title" role="heading" aria-level="1">无水洗车</h1>
        	</div><!-- /header -->

          <div role="main" class="ui-content">
      		    <form name="form1" action="http://1.yijiexun.sinaapp.com/xiche/lib/orderxx.php" method="post" data-ajax="false" onsubmit="return checkform()">
                    <div class="ui-corner-all custom-corners">

                        <div class="ui-bar ui-bar-a">
                            <h3>联系人</h3>
                        </div>

                        <input name="name" id="textinput-name" type="text" placeholder="姓名" value="<?php echo $name?>">
                        <input name="phone" id="textinput-4" type="text" placeholder="11位电话号码" value="<?php echo $phone?>" >
                    </div>

                    <div class="ui-corner-all custom-corners">
                        <div class="ui-bar ui-bar-a">
                              <h3>车辆</h3>
                        </div>
                        <input name="carid" id="carid" type="text" placeholder="你的车牌号码" onchange = "carupper()" value="<?php echo $carid?>" >
                        <input name="color" id="textinput-4" type="text" placeholder="车辆颜色型号" value="<?php echo $color?>" >
                    </div>

                    <div class="ui-corner-all custom-corners">

                        <div class="ui-bar ui-bar-a">
                            <h3>地址</h3>
                        </div>   

                        <input id="txt-addr" name="address" id="textinput-4" type="hidden" placeholder="地址" value="">
                        <ul data-role="listview" data-inset="true" class="ui-nodisc-icon ui-alt-icon" >
                     	      <li><a href="#two" id="zac">点击选择地址</a></li>
                            </ul>   
                        <input name="address1" id="textinput-4" type="text" placeholder="停放地" value="" >
                    </div>

                        <label for="select-choice-1" class="select"></label>
                				<select name="sef" id="select-choice-1">
                              <option value="服务：洗车，标准时间40分钟">服务：洗车，标准时间40分钟</option>
                              <option value="服务：打蜡，标准时间120分钟">服务：打蜡，标准时间120分钟</option>
                        </select>
                				<input type="hidden"  name="openid" value="<?php echo $openid;?>" />
                				<input type="submit" value="提交">
      			</form>
      	</div><!-- /content -->

      	<div data-role="footer" data-theme="a" role="contentinfo" class="ui-footer ui-bar-a">
      		<h4 class="ui-title" role="heading" aria-level="1">powered by sunnai&zach!</h4>
      	</div><!-- /footer -->
      </div><!-- /page one -->

    <!-- Start of second page: #two -->
      <div data-role="page" id="two" data-theme="a" data-url="two" tabindex="0" class="ui-page ui-page-theme-a" style="min-height: 395px;">

      	<div data-role="header" role="banner" class="ui-header ui-bar-inherit">
      		<p id="mp" align="center">地图</p>
      	</div><!-- /header -->
        <div role="main" class="ui-content" id="map"><!--创建地图--></div><!-- /content -->
        <p><a href="#one" class="ui-btn ui-shadow ui-corner-all">确认</a></p>
        <script>
            $(function(){
              var h = $(window).height();
              $("#map").css("height",0.73*h+"px");
              getLocation();
            });
        </script> 
    </div><!-- /page two -->
    <div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon-loading"></span><h1>loading</h1></div>
  </body>
</html>