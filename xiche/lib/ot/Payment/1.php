<?php
require './Notify.php';
use Overtrue\Wechat\Payment\Notify;


header('Content-Type: text/html; charset=utf-8');
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
//error_reporting(E_ALL);
error_reporting(0);
require_once (ROOT."/xiche/lib/saemysql.php");
require (ROOT."/wxpay/example/notifynai.php");


$verify= new Notify('a','b','c','d');
$fileContent = file_get_contents('php://input');
error_log('通知消息'.print_r($fileContent,true));
error_log('验证消息'.print_r($verify->verify(),true));

if($verify->verify()){
error_log('验证消息1');
}
elseif($verify->verify()==0){
error_log('验证消息0');
}
else
{
	echo 'buzhidao';
}


$xmlResult = simplexml_load_string($fileContent, null, LIBXML_NOCDATA);
$json = json_encode($xmlResult);
$array = json_decode($json,TRUE);

if($verify->verify()){
    
    
    if($array['appid']=='wx79f5bb8c0eb2d4c6' 
        && $array['mch_id']=='1295279801' 
        && strlen($array['nonce_str'])=='32' 
        && strlen($array['sign'])=='32')
    {
 
        $sqldo = new Sae_Mysql;
        $sqldo->saeinsert('pay',$array);        
        
	    echo $verify->reply($array['return_code'],$array['return_msg']);
        
            $a = new PayNotifyCallBack;
            if($a->Queryorder($array['transaction_id']))
            {
                    if($array['return_code'] == 'SUCCESS' && $array['result_code']=='SUCCESS') 
                        {
                            // $postxml = '<xml>
                            //                 <return_code>SUCCESS</return_code>
                            //                 <return_msg>OK</return_msg>
                            //             </xml>';
                            
                            // echo $postxml;
                        $sqldo->simpleupdate('order','orderid',$array['out_trade_no'],'orderstatus','2');
                        } 
                    else
                        exit;
        
            }
    
            }
    else
    exit;

}


//echo 'a';