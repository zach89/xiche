$(document).ready(function(){
    
    
  $("a#star").click(function(){
      
    if (confirm("您要取消订单号为"+$(this).attr('name')+"的订单吗？")){
      $.post("./star.php",
        {
          orderid:$(this).attr('name'),
          openid:$(this).attr('data-myid'),
        },
               //test,
    function(data,status){
      //alert("数据：" + data + "\n状态：" + status);
        alert(data);
      }
      );
        $(this).remove();
    }

  });
});