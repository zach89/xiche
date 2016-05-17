<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
use sinacloud\sae\Storage as Storage;
$s = new Storage();
$file = $_FILES["file"]["tmp_name"];
$bucketName = 'pic';
$uploadName = $_POST['name'].'bf.jpg';
$orderid = $_POST['name'];
$s->putObject($s->inputFile($file), $bucketName, $uploadName);
$d = $s->getUrl($bucketName,$uploadName);//获取图片链接 

$saesql = new Sae_Mysql;
$res = $saesql->simpleselect('order','orderid',$orderid);

if(!empty($d) && !empty($res) && count($res) == 1)
{
  	$saesql->simpleupdate('order','orderid',$orderid,'imgbefore',$d);
}
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./xiche/js/jquery.mobile-1.4.5.min.css">
	<script src="./xiche/js/jquery-1.11.3.min.js"></script>
	<script src="./xiche/js/jquery.mobile-1.4.5.min.js"></script>
    <meta charset="utf-8">
</head>
<body style="" class="ui-mobile-viewport ui-overlay-a">
    <div data-role="page" id="one" data-url="one" tabindex="0" class="ui-page ui-page-theme-a ui-page-active" style="">
        <div role="main" class="ui-content">
		<img id="pic" src="<?php echo $d;?>">
            <p>上传图片成功</p>
        </div>
    </div>
    <script>
        $(function(){
                var h = $(window).height();
                var w = $(window).width();
                $("#pic").css("height",0.4*h+"px").css("width",0.73*w+"px");
              });
    </script>
    </body>
</html>

