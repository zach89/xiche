<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" media="screen" href="./css-table.css" />
		<link rel="stylesheet" href="../js/jquery.mobile-1.4.5.min.css">
		<script src="../js/jquery-1.11.3.min.js"></script>
		<script src="../js/jquery.mobile-1.4.5.min.js"></script>
        <script type="text/javascript" src="../js/style-table.js"></script>
    </head>
    <body>
        <table id="tarvel">
        <tr id='order'>
            <th>表单号</th>
            <th>微信名</th>
            <th>姓名</th>
            <th>电话</th>
            <th>车牌号码</th>
            <th>车型</th>
            <th style="width:200px">地址</th>
            <th>服务</th>
            <th>下单时间</th>
            <th>订单状态</th>
            <th>按钮<th>
       </tr>   
        </table>
    </body>
    <script>
        function zach(){
            $.post("./pdb.php",{orderstatus:"99"},function(data){ 
                $(data).each(function(num,value){
                    var a= $("<tr id="+num+"></tr>")
                    var b= $("<td>"+value.orderid+"</td><td>"+value.openid+"</td><td>"+value.name+"</td><td>"+value.phone+"</td><td>"+value.carid+"</td><td>"+value.color+"</td><td>"+value.address+value.address1+"</td><td>"+value.sef+"</td><td>"+value.time+"</td><td>"+value.orderstatus+"</td>");
                    var c = $("<td><button id='"+num+"qx'>确认取消订单</button></td>")
                    $("#order").after(a);
                    $("tr#"+num).after(b,c);
                    
                    $("button#"+num+"qx").click(function(){
                        $.post("./pdc.php",{orderid:value.orderid},function(data){
                               alert(data);
                               });
                        		$(this).remove();
  									});            
        
                });
                
             },"json");
        };
        $(document).ready(function(){
        zach();
        });
    </script>
</html>