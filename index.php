<?php
header("Content-type: text/html; charset=utf-8");
//define ("ROOT", $_SERVER['DOCUMENT_ROOT']);
require ("./wechat/autoload.php");
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
$appId          = 'wx79f5bb8c0eb2d4c6';
$secret         = 'e04093fe9ca993b3a97b516cd6a6e965';
$token          = 'weixin';
$encodingAESKey = 'uJvoOjy683CCKhYOZuuz5cRGKAO75WUESwqMU0ObhH5';

$server = new Server($appId, $token, $encodingAESKey);

$server->on('event', 'subscribe', function($event) {

    error_log('收到关注事件，关注者openid: ' . $event['FromUserName']);

    return Message::make('text')->content('感谢您关注易捷讯科技');
});
$server->on('message', 'text', function($message) {
    return "你发送的消息是'$message->Content'";
    //return "你发送的消息是$message->Content";
});//可扩展为关键字回复
$server->on('message', 'image', function($message) {
    return Message::make('text')->content('我们已经收到您发送的图片！');
});
$server->on('message', 'location', function($message) {
    return "您的地址是$message->Label";
});
$server->on('event', 'click', function($event) {

    if ($event->EventKey == zach1989)
    return Message::make('news')->items(function(){
    return array(
            Message::make('news_item')->title('测试标题')->picUrl("http://1.wushuiapp.sinaapp.com/img/1.png"),
            Message::make('news_item')->title('测试标题2')->description('好不'),
            Message::make('news_item')->title('测试标题3')->description('不好')->url('http://baidu.com'),
            Message::make('news_item')->title('测试标题4')->url('http://baidu.com/abc.php')->picUrl('http://www.baidu.com/demo.jpg'),
           );
         });
        
});

$result = $server->serve();
echo $result;
//自定义菜单
/*
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
$menuService = new Menu($appId, $secret);
$button1 = new MenuItem("更多");
$button2 = new MenuItem("洗车");
$menus = array(
            new MenuItem("用户须知", 'click', 'zach1989'),
            $button2->buttons(array(
                	new MenuItem('洗车', 'view', 'http://1.yijiexun.sinaapp.com/xiche/orderx.php'),
                	new MenuItem('订单查询', 'view', 'http://1.yijiexun.sinaapp.com/xiche/lib/myorder.php'),
                	new MenuItem('历史订单', 'view', 'http://1.yijiexun.sinaapp.com/xiche/lib/orderhistroy.php'),
                )),
            $button1->buttons(array(
                    
                    new MenuItem('关于我们', 'view', 'http://1.wushuiapp.sinaapp.com/comp.html'),
                )),
        );

try {
  $menuService->set($menus);// 请求微信服务器
  echo '自定义菜单设置成功！';
} catch (\Exception $e) {
  echo '自定义菜单设置失败：' . $e->getMessage();
}*/
?>