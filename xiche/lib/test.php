<html>
    <head>
	<script src="../js/jquery-1.11.3.min.js"></script>
    </head>
    <script>
		function pay(){
                         $.post("./jspre.php",{ orderid: "2015121652541005"},function(data){
										if(data===undefined){
                                              setTimeout(function(){
                                              pay();
                                             },2000);
                            				return;
                        					};
											
                                      function jsApiCall()
                                            {
                                        WeixinJSBridge.invoke(
                                            'getBrandWCPayRequest';data,
                                                function(res){
                                                    WeixinJSBridge.log(res.err_msg);
                                                    alert(res.err_code+res.err_desc+res.err_msg);
                                                        }
                                            );
                                            }
                                        function callpay(){
                                                if (typeof WeixinJSBridge == "undefined"){
                                            if( document.addEventListener ){
                                                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                                            }else if (document.attachEvent){
                                                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                                                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                                            }
                                        }else{
                                            jsApiCall();
                                        }    
                                       };//callpay
									   callpay();
											
                                        });
						};
    </script>
    
</html>