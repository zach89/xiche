<?php

define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/sign.php");
require_once (ROOT."/xiche/lib/saemysql.php");
$openid = $auth->user()->openid;
$user = new Sae_Mysql;
$userinfo = $user->simpleselect('user','openid',$openid);


if(empty($openid) || $userinfo ==NULL)
    exit;
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
		<link rel="stylesheet" href="./js/jquery.mobile-1.4.5.min.css">
		<script src="./js/jquery-1.11.3.min.js"></script>
		<script src="./js/jquery.mobile-1.4.5.min.js"></script>
	</head>
<body>
<form action="http://1.yijiexun.sinaapp.com/xiche/_andimmidnas2384cs/sdfwensdfdfse.php" method="POST">
    请输入真实姓名:  <input type="text" name="name"><br>
    请输入手机号码: <input type="text" name="phone"><br>
    <input type="hidden" name="openid" value= "<?php echo $openid;?>">
    <input type="submit" name="submit" value="成就伟业">
    
    
</form>
    </body>
</html>