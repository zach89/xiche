<?php
header('Content-Type: text/html; charset=utf-8');
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
//error_reporting(E_ALL);
require_once (ROOT."/saemysql.php");
$orderid = strip_tags($_REQUEST['orderid']);
$openid = strip_tags($_REQUEST['openid']);


$array = array('openid'=>$openid,'orderid'=>$orderid);
$a = new Sae_Mysql;
$res = $a->select('order',$array);

if (!empty($res)&&count($res)==1)
{
	$time = date('Y-m-d H:i:s');
	$a->simpleupdate('order','orderid',$orderid,'orderstatus','99');
	$a->simpleupdate('order','orderid',$orderid,'canceltime',$time);
	echo '您的订单'.$orderid.'已申请取消，请耐心等待。';

}
else
{
	exit();
}
