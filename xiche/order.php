<?php
header("Content-type: text/html; charset=utf-8");
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);

$carid = $_POST['carid'];
$sef = $_POST['sef'];
$color = $_POST['color'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$openid = $_POST['openid'];

require_once (ROOT."/xiche/lib/saemysql.php");
require_once (ROOT."/xiche/lib/orderno.php");


	$address1 = $_POST['address1'];
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
                      'color' => $color,
                      'phone' => $phone,
                      'sef' => $sef,
                      'service' => '1',
                      'address' => $address,
                      'address1' => $address1,
                      'time' => $time,
                      'orderstatus' => $orderstatus,
                      'lat'=>$lat,
                      'lng'=>$lng
                      );
	$a = new Sae_Mysql;
	$a->saeinsert('order',$orderarr);
?>