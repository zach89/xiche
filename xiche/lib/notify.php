<?php
header('Content-Type: text/html; charset=utf-8');
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
error_reporting(0);
require_once (ROOT."/xiche/lib/saemysql.php");
require (ROOT."/wxpay/example/notifynai.php");



//接收传送的数据
//转换为simplexml对象

$fileContent = file_get_contents('php://input');
error_log('通知消息'.print_r($fileContent,true));


$xmlResult = simplexml_load_string($fileContent, null, LIBXML_NOCDATA);
$json = json_encode($xmlResult);
$array = json_decode($json,TRUE);


if($array['appid']=='wx79f5bb8c0eb2d4c6' 
	&& $array['mch_id']=='1295279801' 
	&& strlen($array['nonce_str'])=='32' 
	&& strlen($array['sign'])=='32')
{
    
	$abc = new Sae_Mysql;
	$abc->saeinsert('pay',$array);

   
    
  		$a=new PayNotifyCallBack;
        if($a->Queryorder($array['transaction_id']))
        {
            	if($array['return_code'] == 'SUCCESS' && $array['result_code']=='SUCCESS') 
                    {
                        $postxml = '<xml>
                                        <return_code>SUCCESS</return_code>
                                        <return_msg>OK</return_msg>
                                    </xml>';
                        
                        echo $postxml;
                    $abc->simpleupdate('order','orderid',$array['out_trade_no'],'orderstatus','2');
                    } 
                else
          	  		exit;
    
        }

    
    
  

		}
else
exit;