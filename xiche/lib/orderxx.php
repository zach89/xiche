<?php
//header("Content-type: text/html; charset=utf-8");
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/orderno.php");
require_once (ROOT."/xiche/lib/saemysql.php");
	$carid = $_POST['carid'];
	$sef = $_POST['sef'];
	$cartype = $_POST['color'];
    $name = $_POST['name'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$address1 = $_POST['address1'];
	$openid = $_POST['openid'];
if($openid=="")
{
    $url = 'http://1.yijiexun.sinaapp.com/xiche/orderx.php';
	Header("Location:$url");
    die();
}

//if($_POST['openid']=="")die();
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$orderstatus = 1 ;
	$orderno = build_order_no();
	$time = date('Y-m-d H:i:s');
	$orderarr = array('orderid' => $orderno,
                      'openid' => $openid,
                      'name' => $name,
                      'phone' => $phone,
                      'carid' => $carid,
                      'color' => $cartype,
                      'phone' => $phone,
                      'sef' => $sef,
                      'address' => $address,
                      'address1' => $address1,
                      'time' => $time,
                      'orderstatus' => $orderstatus,
                      );
$a = new Sae_Mysql;
	$a->saeinsert('order',$orderarr);
	/*
	$orderId = array('orderid'=>$orderno);
    $dorder = new Sae_Mysql;
    $ddata = $dorder->select('order',$orderId);
    $dname = $ddata[0]['name'];
    $dphone = $ddata[0]['phone'];
    $dtime = $ddata[0]['time'];
    $dadd = $ddata[0]['address'];
    $dopenid = $ddata[0]['openid'];
	$dnickname = $ddata[0]['nickname'];*/
if ($sef == "服务：洗车，标准时间40分钟"){ $totalfree = "1";}
else if ($sef == "服务：打蜡，标准时间120分钟"){$totalfree = "2";}
else {$totalfree = "3";};//设置价格
//统一下单
require_once (ROOT."/wxpay/lib/WxPay.Api.php");
require_once (ROOT."/wxpay/example/WxPay.JsApiPay.php");
require_once (ROOT."/wxpay/example/log.php");
$logHandler= new CLogFileHandler("http://yijiexun-wxpay.stor.sinaapp.com/test/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//①、获取用户openid
$tools = new JsApiPay();
$openId = $_POST["openid"];
//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody($sef);//服务详情
$input->SetAttach($orderno);//附加数据
//$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetOut_trade_no($orderno);
$input->SetTotal_fee($totalfree);//支付金额
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
//$input->SetGoods_tag("test");//卡券 代金券
$input->SetNotify_url("http://1.yijiexun.sinaapp.com/xiche/lib/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);

$order = WxPayApi::unifiedOrder($input);
$prepayidinsert = new Sae_Mysql;
/*
$ppii = $order;
$ppii['orderid']=$orderno;
if($ppii['appid'] == 'wx79f5bb8c0eb2d4c6' && $ppii['mch_id'] == '1295279801'){
unset($ppii['appid']);
unset($ppii['mch_id']);
$prepayidinsert->saeinsert('prepay',$ppii);
}
else{
exit;
}
$jp = json_ecode($order);
$jpa = base64_encode($jp);

*/
//jsapi认证数据供JS调用
$prepay = $order['prepay_id'];

$jsApiParameters = $tools->GetJsApiParameters($order);
//$jpa = base64_encode($jsApiParameters);
//$jor = json_encode($order);
//$jord = base64_encode($jor);
//echo $jsApiParameters;
$jspay = array("orderid"=>$orderno,"prepay"=>$prepay);
$prepayidinsert->saeinsert('jspay',$jspay);
/*require_once (ROOT."/wechat/autoload.php");
use Overtrue\Wechat\Notice;//模版消息

$appId  = 'wx79f5bb8c0eb2d4c6';
$secret = 'e04093fe9ca993b3a97b516cd6a6e965';

$notice = new Notice($appId, $secret);

$userId = $openId;
$templateId = 'IY-Z-gzy3Ek5tW-TDciQzCHKVpVyiY_B06khKU7X7as';
$url = 'http://1.yijiexun.sinaapp.com/xiche/lib/myorder.php';
$color = '#FF0000';
$data = array(
         "first"    => $orderno."下单成功",
         "keyword1" => $name,
         "keyword2" => $phone,
         "keyword3" => $address.$address1,
    	 "keyword4" => $sef,
    	 "keyword5" => $time,
         "remark"   => "客服电话：0755-2888888",
        );
$messageId = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();*/
//echo $jsApiParameters;*/
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
                		<h2>用户：<?php echo $name;?> 您已经下单成功！</h2>
              </div>
              <div class="ui-body ui-body-a">
                		<p>订单号:<?php echo $orderno;?></p>
                        <p>车辆:<?php echo $carid."车型:".$cartype;?></p>
                        <p><?php echo $sef;?></p>                            
                        <p>姓名:<?php echo $name;?></p>
                        <p>电话:<?php echo $phone;?></p>
                        <p>地址:<?php echo $address.$address1;?></p>
                        <p>时间:<?php echo $time;?></p>
                        <hr>
                  <h2><font color = 'red'>该笔订单支付金额为:<?php echo $totalfree/100?>元</font></h2>
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

		