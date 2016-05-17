<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
require_once (ROOT."/xiche/lib/pay.php");

$tools = new JsApiPay();
$openid=$tools->GetOpenid();
$myorder = new Sae_Mysql;
$where = '`openid` = "'.$openid.'" and (`orderstatus` = 98 or `orderstatus` = 0) order by time desc';
$orderlist = $myorder->selectwhere('order',$where);
$usergourp = $myorder->simpleselect('user','openid',$openid);

if($openid=="")
{
    $url = 'http://1.yijiexun.sinaapp.com/xiche/lib/myorder.php';
	Header("Location:$url");
    die();
}

if(!empty($usergourp)&& $usergourp[0]['usergroup']==2)
{
    $stafforders = $myorder->simpleselect('order','staffopenid',$openid);
?>    
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../js/jquery.mobile-1.4.5.min.css">
		<script src="../js/jquery-1.11.3.min.js"></script>
		<script src="../js/jquery.mobile-1.4.5.min.js"></script>
        <script src="../js/stars.js"></script>
		<meta charset="UTF-8"/>
           
	</head>
<body>

		<div data-role="page" data-theme="a">
			<div data-role="header">
				<h1>历史订单</h1>
				<button class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-home">欢迎你!</button>
			</div>
    <?php
    foreach ($stafforders as $key => $value) {
            if($key == 0) 
            {
                echo '<div data-role="collapsible" data-collapsed ="false" data-theme="a" data-content-theme="a">';
                echo '<h4>最新订单号：'; 
            }
            else 
            {
                echo '<div data-role="collapsible" data-theme="a" data-content-theme="a">';
                echo '<h4>订单号：';
            }
			echo $value['orderid'].'</h4>';
            echo '<p>'.$value['sef'].'</p>';
			echo '<p>姓名：'.$value['name'].'</p>';
			echo '<p>手机：'.$value['phone'].'</p>';
			echo '<p>车牌：'.$value['carid'].'</p>';
            echo '<p>车型：'.$value['color'].'</p>';
			echo '<p>地址：'.$value['address'].'</p>';
            echo '<p>补充地址：'.$value['address1'].'</p>';
        	echo '<hr>';
        	if($value['orderstatus']=="3"){
        	echo '<button id="'.$key.'">开始洗车</button>';
        	?>
            <script>
                $(document).ready(function(){
                    $("#<?php echo $key;?>").click(function(){
                        $.post("./ygbt.php",{orderid:<?php echo $value['orderid'];?>,orderstatus:"4",openid:"<?php echo $value['staffopenid'];?>"},function(data){
                                       alert(data);
                                      });
                        
                                  });
                    });                
            </script>
            <?php
            }
                elseif($value['orderstatus'] == "4"){
                echo '<button id="'.$key.'">完成洗车</button>';
             ?>
            <script>
                $(document).ready(function(){
                       $("#<?php echo $key;?>").click(function(){
                        $.post("./ygbt.php",{orderid:<?php echo $value['orderid'];?>,orderstatus:"5",openid:"<?php echo $value['staffopenid'];?>"},function(data){
                                       alert(data);
                                      });
                        
                                  });
                    });                 
            </script>                  
            <?php
                }
        echo '</div>';
    };
        	
    ?>
    </div>
    </body>
    
</html>    
<?php    
}

else

{
    
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../js/jquery.mobile-1.4.5.min.css">
		<script src="../js/jquery-1.11.3.min.js"></script>
		<script src="../js/jquery.mobile-1.4.5.min.js"></script>
        <script src="../js/stars.js"></script>
		<meta charset="UTF-8"/>
           
	</head>
<body>

		<div data-role="page" data-theme="a">
			<div data-role="header">
				<h1>订单查询</h1>
				<button class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-home">欢迎你!</button>
			</div>
            
		<?php
if(!empty($orderlist)){
    $n=0;
		foreach ($orderlist as $key => $value) {
            if($key == 0) 
            {
                echo '<div data-role="collapsible" data-collapsed ="false" data-theme="a" data-content-theme="a">';
                echo '<h4>最新订单号：'; 
            }
            else 
            {
                echo '<div data-role="collapsible" data-theme="a" data-content-theme="a">';
                echo '<h4>订单号：';
            }
			echo $value['orderid'].'</h4>';
            echo '<p>'.$value['sef'].'</p>';
			echo '<p>姓名：'.$value['name'].'</p>';
			echo '<p>手机：'.$value['phone'].'</p>';
			echo '<p>车牌：'.$value['carid'].'</p>';
            echo '<p>车型：'.$value['color'].'</p>';
			echo '<p>地址：'.$value['address'].'</p>';
            echo '<p>补充地址：'.$value['address1'].'</p>';
            if ($value['orderstatus']==0)//评价完成
            {?>
            <p>支付状态：已支付成功</p>
            <table>
                    <tr>
                        <td width="25%"><?php echo $value['time'];?></td>
                        <td width="20%"><img src="http://1.wushuiapp.sinaapp.com/img/1.png"></td>
                        <td width="50%">已经接单成功！<br>预计到达时间：</tr>
                    <tr>
                    <td width="20%"><?php echo $value['asstime'];?></td>
                    <td width="20%"><img src="http://1.wushuiapp.sinaapp.com/img/3.png"></td>
                    <td width="60%"> 已经分派洗车师傅前往你的地址！<br><?php echo $value['sef'].'<br />';
             		$thisstaff = $myorder->simpleselect('user','openid',$value['staffopenid']);
             		$staffname = $thisstaff[0]['name'];
					$staffphone = $thisstaff[0]['phone'];
             		echo  '师傅姓名：'.$staffname.'<br />';
             		echo  '师傅电话：'.$staffphone.'<br />'; 
                        ?></tr>
                    <tr><td width="25%"><?php echo $value['starttime'];?></td>
                        <td width="20%"><img src="http://1.wushuiapp.sinaapp.com/img/2.png"></td>
                        <td width="60%">洗车师傅到达开始完成！<td></tr>
                	<tr><td width="25%"><?php echo $value['fintime'];?></td>
                        <td width="20%"><img src="http://1.wushuiapp.sinaapp.com/img/4.png"></td>
                        <td width="60%">洗车完成！谢谢使用<td></tr>
            </table>            
            <?php
        	}
            elseif ($value['orderstatus']==98)
                echo  '<hr><p>订单状态：订单已经取消</p><p>已经退款</p>';            
            else
                echo  '<p>订单状态：异常，请联系客服</p>';            
            echo '</div> ';
            $n++;
		}
}
else
    echo '您还未下单。';
		?>
		</div>
    	


</body>
</html>
<?php
}
?>
