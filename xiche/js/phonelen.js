    function checkform() 
    { 

        
        if (document.form1.name.value=="")
        {
           alert("名字不能为空！") 
        	document.form1.name.focus(); 
        	return false; 
        }
        
        if(document.form1.phone.value.length!=11) 
       {   
        //验证手机号为11位 
        alert("您的手机号长度不对哦！") 
        document.form1.phone.focus(); 
        return false; 
       }
           
        if(document.form1.address.value=="")
        
        {
            alert("地址不能为空!")
        	document.form1.address.focus(); 
        	return false; 
        } 
//        if(document.form1.authcode.value!==)
  //         {
  //         alert("验证码错误")
  //         document.form1.address.focus(); 
  //      	return false; 
  //      } 
  //         }
        
        
        var re=/^[\u4e00-\u9fa5]{1}[A-Za-z]{1}[A-Za-z_0-9]{5}$/;
		if(window.document.getElementById("carid").value.search(re)==-1)

            {

                alert("输入的车牌格式应该为 粤B2G128");

                return false;

            }
        
        
        
        
        
       var mobile=document.form1.phone.value; 
       var reg0=/^13\d{5,9}$/; //130--139。至少7位 
       var reg1=/^15\d{5,9}$/; //15至少7位 
       var reg2=/^18\d{5,9}$/; //18 
       
       var my=false; 
       if (reg0.test(mobile))my=true; 
       if (reg1.test(mobile))my=true; 
       if (reg2.test(mobile))my=true; 
       if (!my){ 
        alert("您的手机号不正确哦") 
        document.form1.phone.focus(); 
        return false; 
       } 
    } 



function carupper()
{
var x=document.getElementById("carid");
x.value=x.value.toUpperCase();
}
