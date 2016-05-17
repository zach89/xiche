<?php
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require_once (ROOT."/wechat/autoload.php");
require_once (ROOT."/xiche/lib/saemysql.php");

define("WX_T","weixin");
define("WX_A","wx79f5bb8c0eb2d4c6");
define("WX_S","e04093fe9ca993b3a97b516cd6a6e965");
define("$TPId","d4624c36b6795d1d99dcf0547af5443d");
define("WX_E","uJvoOjy683CCKhYOZuuz5cRGKAO75WUESwqMU0ObhH5");

use Overtrue\Wechat\Auth;
$auth = new Auth(WX_A, WX_S);
$auth->authorize($to = null, $scope = 'snsapi_userinfo', $state = 'STATE');
$reg = new Sae_Mysql;

if($reg->simpleselect('user','openid',$auth->user()->openid)==NULL){
    if( !empty($auth->user()->openid) && !empty($auth->user()->nickname) && strlen($auth->user()->openid)==28)
    {
        $regarr = array('openid'=>$auth->user()->openid,
                        'nickname'=>$auth->user()->nickname,
                        'time'=>date('Y-m-d H:i:s'),
                       	'usergroup'=>1);
        $reg->saeinsert('user',$regarr);
    }
    else
        die();
}