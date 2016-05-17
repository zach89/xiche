<?php
require "../wechat/autoload.php";
define("WX_T","weixin");
define("WX_A","wx79f5bb8c0eb2d4c6");
define("WX_S","e04093fe9ca993b3a97b516cd6a6e965");
define("$TPId","d4624c36b6795d1d99dcf0547af5443d");
define("WX_E","uJvoOjy683CCKhYOZuuz5cRGKAO75WUESwqMU0ObhH5");
define("WX_M","1295279801");
define("WX_MI","YGSHOKPVH1ECE82Y93TPQOIKPL85V57T9SJX");
/*use Overtrue\Wechat\Auth;
$auth = new Auth(WX_A, WX_S);
$auth->authorize($to = null, $scope = 'snsapi_userinfo', $state = 'STATE');
if (empty($_SESSION['logged_user'])) {
    $user = $auth->authorize(); // 返回用户 Bag
    $_SESSION['logged_user'] = $user->all();
    // 跳转到其它授权才能访问的页面
} else {
    $user = $_SESSION['logged_user'];
}

//var_dump($user['openid']);

*/ 
use Overtrue\Wechat\Payment;
use Overtrue\Wechat\Payment\Order;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment\UnifiedOrder;

/**
 * 第 1 步：定义商户
 */
$business = new Business(
    WX_A,
    WX_S,
    WX_M,
    WX_MI
);

/**
 * 第 2 步：定义订单
 */
$order = new Order();
$order->body = 'test body';
$order->out_trade_no = md5(uniqid().microtime());
$order->total_fee = '1';    // 单位为 “分”, 字符串类型
$order->openid = 'oYk0Iw61iACXmwUvO3srq9mGa-_k';
$order->notify_url = 'http://1.yijixun.sinaapp.com/wxpay/notify1.php';

/**
 * 第 3 步：统一下单
 */
$unifiedOrder = new UnifiedOrder($business, $order);

/**
 * 第 4 步：生成支付配置文件
 */
$payment = new Payment($unifiedOrder);
echo $payment->getConfig();

?>
<html>
    <head>
        <meta charset="UTF-8"/>

</head>

<button type="button" onclick="WXPayment()">支付 ￥<?php echo ($order->total_fee / 100); ?> 元</button>
<script>
    
    </script>

</html>
