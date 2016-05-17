<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ALL);
//define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
//require_once (ROOT."/xiche/sign.php");
require_once (ROOT."/xiche/lib/saemysql.php");
require_once ROOT."/wxpay/lib/WxPay.Api.php";
require_once ROOT.'/wxpay/lib/WxPay.Notify.php';


class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery(); // 
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		//Log::DEBUG("query:" . json_encode($result));
        
        
		$array = array('type' => 'query',
						'content' => addslashes(json_encode($result)),
						'time'=>date('Y-m-d H:i:s'));
		$logdebugquery = new Sae_Mysql;
        $logdebugquery->saeinsert('debug',$array);
        

        //die();
        
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
    
	//查询订单
	public function Queryorderout($out_trade_no)
	{
		$input = new WxPayOrderQuery(); // 
		$input->SetOut_trade_no($out_trade_no);
		$result = WxPayApi::orderQuery($input);
		//Log::DEBUG("query:" . json_encode($result));
        
        
        
		$array = array('type' => 'query',
						'content' => addslashes(json_encode($result)),
						'time'=>date('Y-m-d H:i:s'));
		$logdebugquery = new Sae_Mysql;
        $logdebugquery->saeinsert('debug',$array);
        

        //die();
        
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}    
    
    
    
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		//Log::DEBUG("call back:" . json_encode($data));

		$array = array('type' => 'call back',
						'content' => json_encode($data),
						'time'=>date('Y-m-d H:i:s'));
		$logdebugquery = new Sae_Mysql;
		$logdebugquery->saeinsert('debug',$array);

		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}
}


