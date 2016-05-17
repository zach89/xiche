<?

//die('hdead');

function randomkeys($length){
$pattern = '1234567890abcdefghijklmnopqrstuvwxyz
ABCDEFGHIJKLOMNOPQRSTUVWXYZ'; //字符池,可任意修改
for($i=0;$i<$length;$i++) {
$key .= $pattern{mt_rand(0,35)}; //生成php随机数
}
return $key;
}







$url='https://api.mch.weixin.qq.com/pay/unifiedorder';
$key = '';
$rand = strtoupper(randomkeys(32));
echo $rand;
die();
$wxpaytest = array('appid' => 'wx79f5bb8c0eb2d4c6', //必填公众账号ID
					'mch_id' =>'1295279801',   //必填商户号
					 'device_info' =>'WEB', //终端设备号(门店号或收银设备ID)，注意：PC网页或公众号内支付请传"WEB"
					 'nonce_str' =>$rand, //必填随机字符串，不长于32位。
					 'sign' => '',//必填签名，详见签名生成算法
					 'body'=>'porsche', //必填商品描述
					 'detail'=> '',//商品详情
					 'attach'=> '',//附加数据
					 'out_trade_no' => 'sdfjhadsf',//必填商户订单号
					 'fee_type'=> '', //货币类型
					 'total_fee'=> '18010000',//必填总金额
					 'spbill_create_ip'=>'101.29.39.23', //必填用户IP
					 'time_start'=> '', //交易起始时间
					 'time_expire'=> '',//交易结束时间
					 'goods_tag'=> '',//商品标记
					 'notify_url'=> 'http://www.baidu.com',//必填通知地址
					 'trade_type'=> 'JSAPI',//必填交易类型
					 'product_id'=> '',//商品ID
					 'limit_pay'=> 'no_credit',//指定支付方式
					 'openid'=> 'wesdfhkj',//必填 用户标识
				 );

ksort($wxpaytest);
var_dump($wxpaytest);