<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
require_once (ROOT."/xiche/lib/pay.php");

$tools = new JsApiPay();
$openid=$tools->GetOpenid();
$myorder = new Sae_Mysql;
$orderlist = $myorder->orderselect('order','openid',$openid,'time','desc');
$usergourp = $myorder->simpleselect('user','openid',$openid);

if($openid=="")
{
    $url = 'http://1.yijiexun.sinaapp.com/xiche/lib/myorder.php';
	Header("Location:$url");
    die();
}


if(!empty($usergourp)&& $usergourp[0]['usergroup']==2)
{
    $where = '`staffopenid` = "'.$openid.'" order by asstime desc';
    $stafforders = $myorder->selectwhere('order',$where);
?>    
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../js/jquery.mobile-1.4.5.min.css">
		<script src="../js/jquery-1.11.3.min.js"></script>
		<script src="../js/jquery.mobile-1.4.5.min.js"></script>
        <script src="../js/stars.js"></script>
		<meta charset="UTF-8"/>
        <script>
            $("#zelda").click(function(){
								 location.reload();
                                  });
        </script>
           
	</head>
<body>

		<div data-role="page" data-theme="a">
			<div data-role="header">
				<h1>订单查询</h1>
				<button id="zelda" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-home">刷新</button>
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
            
        	?>
            <form action="http://1.yijiexun.sinaapp.com/filebf.php" method="post" enctype="multipart/form-data" data-ajax="false">
                <input type="hidden" name="name" value="<?php echo $value['orderid'];?>">   
			<input type="file" name="file" id="file" />
			<input type="submit" name="submit" value="上传洗车前的照片" />
			</form>
            <button id="<?php echo $key;?>">开始洗车</button>
            <script>
                $(document).ready(function(){
                    $("#<?php echo $key;?>").click(function(){
                        $.post("./ygbt.php",{orderid:<?php echo $value['orderid'];?>,orderstatus:"4",openid:"<?php echo $value['staffopenid'];?>"},function(data){
                                       alert(data);
                                        location.reload();
                                      });
                        $(this).remove();
                                  });
                    });                
            </script>
            <?php
            }
                elseif($value['orderstatus'] == "4"){
             ?>
            <form action="http://1.yijiexun.sinaapp.com/fileaf.php" method="post" enctype="multipart/form-data" data-ajax="false">
                <input type="hidden" name="name" value="<?php echo $value['orderid'];?>">   
			<input type="file" name="file" id="file" />
			<input type="submit" name="submit" value="上传洗车后照片" />
			</form>
            <button id="<?php echo $key;?>">完成洗车</button>
            <script>
                $(document).ready(function(){
                       $("#<?php echo $key;?>").click(function(){
                        $.post("./ygbt.php",{orderid:<?php echo $value['orderid'];?>,orderstatus:"5",openid:"<?php echo $value['staffopenid'];?>"},function(data){
                                       alert(data);
                            			location.reload();	
                                      });
                        $(this).remove();                        
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
        <script>
             $(document).ready(function(){
            $("#zelda").click(function(){
								location.reload();
                                  });
                 });
        </script>   
	</head>
<body>

		<div data-role="page" data-theme="a">
			<div data-role="header">
				<h1>订单查询</h1>
				<button  id="zelda"class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-home">刷新</button>
			</div>
            
		<?php
if(!empty($orderlist)){
    $n=0;
		foreach ($orderlist as $key => $value) {
            if($value['orderstatus']==0 || $value['orderstatus']==98)continue;
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
            if ($value['orderstatus']==1){
                ?>
                <hr>
            			<p>支付状态：没支付</p>
            			<p>注意：请在两小时内完成支付<p>
            			<hr>
                        <form name="form1" action="http://1.yijiexun.sinaapp.com/xiche/lib/jspre.php" method="post" data-ajax="false">
                		<input type="hidden"  name="orderid" value="<?php echo $value['orderid'];?>" data-mini="true"/>
                		<input type="hidden"  name="name" value="<?php echo $value['name'];?>" data-mini="true"/>
                		<input type="hidden"  name="carid" value="<?php echo $value['carid'];?>" data-mini="true"/>
                		<input type="hidden"  name="sef" value="<?php echo $value['sef'];?>" data-mini="true"/>
                		<input type="hidden"  name="phone" value="<?php echo $value['phone'];?>" data-mini="true"/>
                        <input type="hidden"  name="address" value="<?php echo $value['address'];?>" data-mini="true"/>
                        <input type="hidden"  name="address1" value="<?php echo $value['address1'];?>" data-mini="true"/>
                        <input type="hidden"  name="color" value="<?php echo $value['color'];?>" data-mini="true"/>
                        <input type="hidden"  name="sef" value="<?php echo $value['sef'];?>" data-mini="true"/>     
                            
            			<input type="submit" value="支付" data-mini="true">
    			</form>
                                   	
                <?php
                }
            elseif ($value['orderstatus']==2)//支付成功    
            {?>
            <p>支付状态：已支付成功</p>
                <table>
                    <tr>
                        <td width="25%"><?php echo $value['time'];?></td>
                        <td width="20%"><img src="http://1.wushuiapp.sinaapp.com/img/1.png"></td>
                        <td width="50%">已经接单成功！<br>预计到达时间：</tr>                    
            </table>
            <a id = "star" data-role="button" data-mini="true" data-myid="<?php echo $openid; ?>" name = "<?php echo $value['orderid'];?> "data-icon="delete">取消该订单</a>             
            <?php
            }
            elseif ($value['orderstatus']==3)//接单开始洗车
            {?>
            <p>支付状态：已支付成功</p>
            <hr>
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
            </table>
                            
            <?php
            }
            elseif ($value['orderstatus']==4)//员工开始洗车
            {?>
            <p>支付状态：已支付成功</p>
            <hr>
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
                        <td width="60%">洗车师傅到达开始洗车！<td></tr>
            </table>            
            <?php
            }
            elseif ($value['orderstatus']==5)//洗车完成
            {
            ?>
            <p>支付状态：已支付成功</p>
            <hr>
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
			<hr>
            <img id="<?php echo $key.'bf';?>" src="<?php echo $value['imgbefore'];?>">
            <img id="<?php echo $key.'af';?>" src="<?php echo $value['imgafter'];?>">
            
            <button id='<?echo$key;?>'>完成洗车</button>
			<script>
                $(document).ready(function(){
                    var h = $(window).height();
                    var w = $(window).width();
    				
                    $("#<?php echo $key.'bf';?>").css("width",0.9*w+"px").css("height",0.3*h+"px")
                    $("#<?php echo $key.'af';?>").css("width",0.9*w+"px").css("height",0.3*h+"px")
                       $("#<?php echo $key;?>").click(function(){
                        $.post("./userbt.php",{orderid:<?php echo $value['orderid'];?>},function(data){
                                       alert(data);
                                       location.reload();
                                      });
                           $(this).remove();                        
                                  });
                    });                 
            </script>            
            <?php
        	}
            elseif ($value['orderstatus']==99){
                echo '<hr>';
                echo  '<p>订单状态：取消审核中</p>';
            	echo  '<p>审核通过后，在历史订单查看，如没退款，致电客服</p>'; 
            }
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
