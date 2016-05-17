<?php
header('Content-Type: text/html; charset=utf-8');
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");

$name = addslashes($_POST['name']);
$phone = addslashes($_POST['phone']);
$openid = addslashes($_POST['openid']);


$staff = new Sae_Mysql;
$userinfo = $staff->simpleselect('user','openid',$openid);
//print_r($userinfo);
if($userinfo[0]['usergroup'] == 2)
{
    echo '已经注册。';
	die();
}


if(strlen($openid)==28 && is_numeric($phone) && strlen($phone)==11 && $userinfo[0]['usergroup']==1)
{
    //$staff = new Sae_Mysql;
    $where = array('openid'=>$openid);
    $update = array('name'=>$name,'phone'=>$phone,'usergroup'=>2);
    $staff->saeupdate('user',$where,$update);
    echo '注册成功';
}