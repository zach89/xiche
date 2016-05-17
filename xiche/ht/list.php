<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>A Beautiful Table</title>
    <link rel="stylesheet" type="text/css" media="screen" href="./css-table.css" />
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../js/style-table.js"></script>
</head>

<body>

<table id="travel" summary="Travel times to work by main mode (Autumn 2006) - Source: London Travel Report 2007 http://www.tfl.gov.uk/assets/downloads/corporate/London-Travel-Report-2007-final.pdf">
    		<tr id='order'>
            <th>表单号</th>
            <th>姓名</th>
            <th>电话</th>
            <th>车牌号码</th>
            <th>车型</th>
            <th style="width:400px">地址</th>
            <th>停放地</th>   
            <th style="width:400px">服务</th>
            <th>下单时间</th>
            <th>订单状态</th>
            <th>按钮<th>
       </tr>
        </table>
    </body>
    <script>
        function zach(){
            $.post("./pdb.php",{orderstatus:"2"},function(data){ 
                $(data).each(function(num,value){
                    var a= $("<tr id="+num+"></tr>")//
                    //var b= $("<td><input id='"+num+"'value='"+value.orderid+"' readonly= 'true'></td>")
                    var b= $("<td>"+value.orderid+"</td><td><input style='width:40px' value='"+value.name+"' readonly= 'true'></td><td><input style='width:80px' value='"+value.phone+"' readonly= 'true'></td><td><input style='width:75px' value='"+value.carid+"' readonly= 'true'></td><td><input value='"+value.color+"' readonly= 'true'></td><td><input style='width:350px'value='"+value.address+"' readonly= 'true'></td><td><input style='width:150px'value='"+value.address1+"' readonly= 'true'></td><td><input style='width:220px' value='"+value.sef+"' readonly= 'true'></td><td><input value='"+value.time+"' readonly= 'true'></td><td><input style='width:40px' value='"+value.orderstatus+"' readonly= 'true'></td>");
                    var c = $("<td><button id='"+num+"bj'>编辑</button><button id='"+num+"tj'>提交</button></td>")                    
                    $("#order").after(a);
                    $(a).append(b,c);
                    $("#"+num+"tj").hide();
                     $("#"+num).find(":input").css("border-style","none").css("background","#d5eaf0");
                    $("#"+num+"bj").removeAttr("style");
                    $("button#"+num+"bj").click(function(){
                        $("#"+num).find(":input").removeAttr("readonly");
                        $("#"+num).find(":input").css("border-style","inset").css("background","#FFFFFF");
                        $("button#"+num+"tj").removeAttr("style");
                        
                        		$(this).hide();
                        // var d = $("<button id="+num+num+num+">提交</button>");
                        //$(c).append(d);
                       			 $("#"+num+"tj").show();
                    });
                    $("button#"+num+"tj").click(function(){
                        	var z = $("#"+num).find(":input");
                        	$(z).css("border-style","none").css("background","#d5eaf0");
                        	$("#"+num+"bj").removeAttr("style");
                            var za =new Array();
                                $(z).each(function(n,k){
                                    //alert(n);
                                    za[n] = $(this).val();
										});
                        $.post('./pdd.php',{name:za[0],phone:za[1],carid:za[2],color:za[3],address:za[4],address1:za[5],sef:za[6],time:za[7],orderstatus:za[8],orderid:value.orderid},function(data){
                                alert(data);
                            });
                                            $(this).hide();
                        					$("#"+num+"bj").show();
                        //var cc=$("<button id="+num+num+">编辑</button>");
                        //$(c).append(cc);
                        $(z).attr("readonly","true");
                        });
        
  									
                    
                });
                
             },"json");
        };
        $(document).ready(function(){
        zach();
        });
    </script>
</html>