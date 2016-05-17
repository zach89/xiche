<?php
header("Content-type: text/html; charset=utf-8"); 
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
//require "./test.php";
//require "./saemysql.php";

$assorder = new Sae_Mysql;
$unass = array('orderstatus' => 2,);
$unassorder = $assorder->select('order',$unass);

$staff2 = array('usergroup' =>2);
$staffgroup = $assorder->select('user',$staff2);


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>A Beautiful Table</title>
    <link rel="stylesheet" type="text/css" media="screen" href="./css/css-table.css" />
    <script type="text/javascript" src="./js/jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="./js/style-table.js"></script>
</head>

<body>

<table id="travel" summary="Travel times to work by main mode (Autumn 2006) - Source: London Travel Report 2007 http://www.tfl.gov.uk/assets/downloads/corporate/London-Travel-Report-2007-final.pdf">

	<caption>订单分派系统</caption>
    
    <thead>    
    	<tr>
            <th scope="col" rowspan="2">未分派的订单</th>
            <th scope="col" colspan="6">订单详情</th>
        </tr>
        
        <tr>
            <th scope="col">姓名</th>
            <th scope="col">车牌</th>
            <th scope="col">手机</th>
            <th scope="col">地址</th>
            <th scope="col">下单时间</th> 
            <th scope="col">分派</th>
         
        </tr>        
    </thead>
    
    
    <tbody>        
        <form method="post" action="./assorderp.php">
        <?php
		$i=0;
		if(!empty($unassorder)){
            foreach ($unassorder as $key => $value) {
                echo '<tr>';
                //echo '<form method="post" action="./assorderp.php">';
                echo '<th scope="row">'.$value['orderid'].'</th>';
                echo '<td>'.$value['name'].'</td>';
                echo '<td>'.$value['carid'].'</td>';
                echo '<td>'.$value['phone'].'</td>';
                echo '<td>'.$value['address'].'</td>';
                echo '<td>'.$value['time'].'</td>';
                //echo '<input type="hidden" name="" value="'.$value['orderid'].'"/>';
                echo '<td>';
                echo '<select name ="openid['.$i.']">';
                echo '<option></option>';
                foreach ($staffgroup as $key1 => $value1) {
                    echo '<option value="'.$value1['openid'].'">'.$value1['nickname'].'</option>';
                }
                echo '</select>';
                echo '<input type="hidden" name="orderid['.$i.']" value="'.$value['orderid'].'"/>';            
                echo '</td>';
                echo '</tr>';
                $i++;
                # code...
            }
		}
		else
             die();
        ?>
        <input type="submit" />
        </form>

        
    </tbody>

</table>


</body>
</html>