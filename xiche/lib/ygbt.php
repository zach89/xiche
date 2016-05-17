<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
//$a = $_POST['orderid'];
//echo $a;
//if($_POST['orderstatus']=="4"){
$openid = $_REQUEST['openid'];
$orderid = $_REQUEST['orderid'];
$orderstatus = $_REQUEST['orderstatus'];



$a = new Sae_Mysql;
$arr = array('staffopenid'=>$openid,'orderid'=>$orderid);
$res = $a->select('order',$arr);

if (!empty($res)&&count($res)==1)
{
$a->simpleupdate('order','orderid',$_POST['orderid'],'orderstatus',$_POST['orderstatus']);
    if($_POST['orderstatus']=='4')
    {
		$a->simpleupdate('order','orderid',$_POST['orderid'],'starttime',date('Y-m-d H:i:s'));
		echo "开始洗车";
    }
    elseif($_POST['orderstatus']=='5')
    {
		$a->simpleupdate('order','orderid',$_POST['orderid'],'fintime',date('Y-m-d H:i:s'));        
        echo '完成洗车';
    }
}
/*require_once (ROOT."/wechat/autoload.php");
use Overtrue\Wechat\Notice;//模版消息

$appId  = 'wx79f5bb8c0eb2d4c6';
$secret = 'e04093fe9ca993b3a97b516cd6a6e965';

$notice = new Notice($appId, $secret);

$userId = $openId;
$templateId = 'VBAgy_qUfQG-rcpRvZNcHsaxchvvxEUP9He7WZ39ri4';
$url = 'http://1.yijiexun.com/xiche/lib/myorder.php';
$color = '#FF0000';
$data = array(
         "first"    => "订单更新",
         "keyword1" => $orderid,
         "keyword2" => $phone,
         "keyword3" => $address.$address1,
         "remark"   => "客服电话：0755-2888888",
        );
$messageId = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();*/