<?php
$mysql = new SaeMysql();


$sql ="UPDATE  `order` SET `orderstatus` = '98' WHERE (NOW( ) -  `time`) >7200 AND  `orderstatus` = 1 ";
$mysql->runSql($sql);
if ($mysql->errno() != 0)
{
    die("Error:" . $mysql->errmsg());
}

$mysql->closeDb();
?>

