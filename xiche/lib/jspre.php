<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
require_once (ROOT."/xiche/lib/pay.php");
$orderid = $_POST['orderid'];
if($orderid=="")
{
    $url = 'http://1.yijiexun.sinaapp.com/xiche/lib/myorder.php';
	Header("Location:$url");
    die();
}
$pay =new JsApiPay();
$myorder = new Sae_Mysql; 
$order =$myorder->simpleselect('jspay','orderid',$orderid);
$pre = $order[0]['prepay'];
//echo $pre;
$orderx = array("appid"=>"wx79f5bb8c0eb2d4c6","prepay_id"=>$pre);

$jsApiParameters = $pay->GetJsApiParameters($orderx);
//echo $jsApiParameters;
if ($_POST['sef'] == "服务：洗车，标准时间40分钟"){ $totalfree = "1";}
else if ($_POST['sef'] == "服务：打蜡，标准时间120分钟"){$totalfree = "2";}
else {$totalfree = "3";};//设置价格
?>
<html>
    <head>
       	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../js/jquery.mobile-1.4.5.min.css">
		<script src="../js/jquery-1.11.3.min.js"></script>
		<script src="../js/jquery.mobile-1.4.5.min.js"></script>
		<meta charset="UTF-8"/>
	</head>
	<body>
		<div data-role="page" id="pageone" data-theme="a">
			<div data-role="header">
			<h1>无水洗车</h1>
			</div>
		<div data-role="content" class="ui-body ui-body-a ui-corner-all"> 
			<div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                     <p align="center">你需要支付的订单详情<p>
                      </div>
                <div class="ui-body ui-body-a">
                        <p>订单号:<?php echo $orderid;?></p>
                        <p>车辆:<?php echo $_POST['carid'];?></p>
                        <p>车型:<?php echo $_POST['color'];?></p>
                        <p><?php echo $_POST['sef'];?></p>                            
                        <p>姓名:<?php echo $_POST['name'];?></p>
                        <p>电话:<?php echo $_POST['phone'];?></p>
                        <p>地址:<?php echo $_POST['address'];?></p>
    					<p>停放地:<?php echo $_POST['address1'];?></p>
                        <hr>
                    <h2><font color = 'red'>该笔订单支付金额为:<?php echo $totalfree/100;?>元</font></h2>
                    	<button onclick="callpay()">支付</button>
                      </div>
                    </div>

					</div> 
		<div data-role="footer">
		<h1>powered by sunnai&zach!</h1>
		</div>
			</div>
        <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters;?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
            //alert(res.err_code+res.err_desc+res.err_msg);
            //res.err_msg=get_brand_wcpay_request:cancel
            //get_brand_wcpay_request:ok
            //alert(res.err_msg);
            if(res.err_msg=="get_brand_wcpay_request:ok"){
                alert("支付成功");
                window.location.href="http://1.yijiexun.sinaapp.com/xiche/lib/myorder.php";
                }
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
		</script>
	</body>
</html>