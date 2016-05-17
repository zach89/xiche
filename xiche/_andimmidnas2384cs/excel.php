<?php

define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");

if(is_numeric($_REQUEST['year'])
   && is_numeric($_REQUEST['month'])
   && is_numeric($_REQUEST['day'])
   && $_REQUEST['year']>=2015 
   && $_REQUEST['month']>=1 
   && $_REQUEST['month']>=12 
   && $_REQUEST['day']>=1 
   && $_REQUEST['day']<=31 )
{
    $where = 'time like "'.$_REQUEST['year'].'-'.$_REQUEST['month'].'-'.$_REQUEST['day'].'%"';
}
else
     die('请输入正确日期');

$a = new Sae_Mysql;
$res = $a->selectwhere('order',$where);

if(!empty($res)){

    function quote($s) {
      $s = str_replace("\r\n", "\n", $s); // 清除容易产生干扰的 CR
      $s = str_replace("\n\n", "\r\n", $s); // CRLF
      $s = str_replace('"', '""', $s); // 转义引号
      return '"' . $s . '"';
    }
    
    
    header('Content-Type:text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="'.$_REQUEST['year'].'-'.$_REQUEST['month'].'-'.$_REQUEST['day'].'.csv"');
    
    
    echo quote('订单号').','.quote('openid').','.quote('名字').','.quote('手机号码').','.quote('车牌').','.quote('型号').','.quote('地址').','.quote('备注地址').','.quote('经度').','.quote('纬度').','.quote('洗车员工openid').','.quote('下单时间').','.quote('派单时间').','.quote('洗车时间').','.quote('订单状态').','.quote('订单关闭时间').','.quote('评分').','.quote('完成时间').','.quote('预定服务')."\r\n";
    
    foreach ($res as $row) {
      foreach ($row as $col => $cell) {
        echo quote($cell);
        echo ($col == 'sef') ?  "\r\n":',' ;
      }
    }
}

else
    echo '该日无订单';
