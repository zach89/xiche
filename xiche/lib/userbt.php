<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");


use sinacloud\sae\Storage as Storage;

$s = new Storage();
$bucketName ='pic';
$uploadName = $_REQUEST['orderid'].'bf.jpg';
$afuploadName = $_REQUEST['orderid'].'af.jpg';
$s->deleteObject($bucketName, $uploadName);
$s->deleteObject($bucketName, $afuploadName);



$a = new Sae_Mysql;
$a->simpleupdate('order','orderid',$_POST['orderid'],'orderstatus','0');
echo "谢谢使用";
