<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");

//name:za[0],phone:za[1],carid:za[2],color:za[3],address:za[4],sef:za[5],time:za[6],orderstatus:za[7],orderid:value.orderid

//var_dump($_POST);
//die();

if($_POST['orderstatus']!=="")
{
$assorder = new Sae_Mysql;
$orderselect = $assorder->orderselect('order','orderstatus',$_POST['orderstatus'],'time','desc');
$order = json_encode($orderselect);
//var_dump($orderselect);
echo $order;
}
/*if($_POST['orderid']!==""){
    $a = new Sae_Mysql;
$a->simpleupdate('order','orderid',$_POST['orderid'],'orderstatus','98');
echo "订单已经取消";
}*/
?>