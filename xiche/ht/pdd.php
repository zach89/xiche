<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");


//name:za[0],phone:za[1],carid:za[2],color:za[3],address:za[4],sef:za[5],time:za[6],orderstatus:za[7],orderid:value.orderid

//echo '<pre>'.print_r($_REQUEST,true).'</pre>';

             $orderid=$_REQUEST['orderid'];




$arr = array('name'=>$_REQUEST['name'],
            'phone'=>$_REQUEST['phone'],
            'carid'=>$_REQUEST['carid'],
            'color'=>$_REQUEST['color'],
            'address'=>$_REQUEST['address'],
            'sef'=>$_REQUEST['sef'],
             //'time'=>$_REQUEST[''];
            'orderstatus'=>$_REQUEST['orderstatus']);
             //'orderid'=>$_REQUEST[''];
            


//$a = $_POST['orderid'];
//echo $a;
$where=array('orderid'=>$orderid);
$a = new Sae_Mysql;
$res = $a->simpleselect('order','orderid',$orderid);

if(count($res)==1 && !empty($res))
{
    $a->saeupdate('order',$where,$arr);
    
    echo "订单已经修改。";

}
//$order = json_encode($orderselect);
//var_dump($orderselect);
//echo $order;