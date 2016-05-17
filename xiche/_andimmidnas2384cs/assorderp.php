<?php
header("Content-type: text/html; charset=utf-8"); 
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
//require "./test.php";
$assorder = new Sae_Mysql;

foreach ($_REQUEST['openid'] as $key => $value) {

		if($value!=='')
		{
			$where['orderid']=$_REQUEST['orderid'][$key];
			$update = array('orderstatus' => 3,'staffopenid'=>$_REQUEST['openid'][$key], 'asstime'=>date('Y-m-d H:i:s'));

			$assorder->saeupdate('order',$where,$update);

		}
	}

$url = 'http://1.yijiexun.sinaapp.com/xiche/_andimmidnas2384cs/assorder.php';
Header("Location:$url");