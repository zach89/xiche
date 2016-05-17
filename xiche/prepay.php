<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/xiche/lib/saemysql.php");
$fileContent = file_get_contents("php://input");
$xmlResult = simplexml_load_string($fileContent, null, LIBXML_NOCDATA);
$json = json_encode($xmlResult);
$array = json_decode($json,TRUE);
$abc = new Sae_Mysql;
$abc->saeinsert('pay',$array);
