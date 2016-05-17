<?php
//require_once "../sign.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <script>
        function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			{"appId":"wx79f5bb8c0eb2d4c6",
"nonceStr":"7bjjwoxygp9802c9mj82a1nkhf7k0x6k",
"package":"prepay_id=wx201512150239168ac3b4dbc10044954578",
"signType":"MD5",
"timeStamp":"1450118357",
"paySign":"0BBC9D4EEF25C3CC50DAE7778FB19720"},
			function(res){
				WeixinJSBridge.log(res.err_msg);
				alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    WeixinJSBridge.invoke(
        'getBrandWCPayRequest', {"appId":"wx79f5bb8c0eb2d4c6",
"nonceStr":"7bjjwoxygp9802c9mj82a1nkhf7k0x6k",
"package":"prepay_id=wx201512150239168ac3b4dbc10044954578",
"signType":"MD5",
"timeStamp":"1450118357",
"paySign":"0BBC9D4EEF25C3CC50DAE7778FB19720"}, function(res) {
        switch(res.err_msg) {
            case 'get_brand_wcpay_request:cancel':
                alert('用户取消支付！');
                break;
            case 'get_brand_wcpay_request:fail':
                alert('支付失败！（'+res.err_desc+'）');
                break;
            case 'get_brand_wcpay_request:ok':
                alert('支付成功！');
                break;
            default:
                alert(JSON.stringify(res));
                break;
        }
    });
		}
	}
        callpay();
</script>
    <button onclick="WXpayment()">支付</button>
</html>