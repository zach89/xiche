<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
//$a = $_POST['orderid'];
//echo $a;
$a = new Sae_Mysql;
$a->simpleupdate('order','orderid',$_POST['orderid'],'orderstatus','98');
echo "订单已经取消";
//$order = json_encode($orderselect);
//var_dump($orderselect);
//echo $order;