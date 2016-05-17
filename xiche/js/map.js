function getLocation(){
  //判断是否支持 获取本地位置
  if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="浏览器不支持定位.";
      }
  }
function showPosition(position)
  {
	var lat=position.coords.latitude; 
	var lng=position.coords.longitude;
		//调用地图命名空间中的转换接口   type的可选值为 1:gps经纬度，2:搜狗经纬度，3:百度经纬度，4:mapbar经纬度，5:google经纬度，6:搜狗墨卡托
	qq.maps.convertor.translate(new qq.maps.LatLng(lat,lng), 1, function(res){//异步处理
		latlng = res[0];
		var map = new qq.maps.Map(document.getElementById("map"),{//创建地图
        center:  latlng,
        zoom: 15
		});
    //设置中心标记
		var marker = new qq.maps.Marker({
            map : map,
            position : map.getCenter()
        });
		var locationChanged=function(){//移动地图                 
        	var geocoder = new qq.maps.Geocoder({complete : function(result){//获取地址
                //$(marker).html("hello");
                $('#txt-addr').val(result.detail.addressComponents.city+result.detail.addressComponents.district+result.detail.addressComponents.street+result.detail.nearPois[0].name);
                $('#mp').html("<font color='red'>地址:"+result.detail.addressComponents.city+result.detail.addressComponents.district+result.detail.addressComponents.street+result.detail.nearPois[0].name+"<font>");
                $('#zac').html(result.detail.addressComponents.city+result.detail.addressComponents.district+result.detail.addressComponents.street+result.detail.nearPois[0].name);
                //$('#za').html(result.detail.address);
				}
			});
            geocoder.getAddress(map.getCenter());
        	marker.setPosition(map.getCenter()); 
			};
        	locationChanged();
          	//当地图中心属性更改时触发事件
			qq.maps.event.addListener(map, 'center_changed', function() {
                				locationChanged();
            });  
    });         
  }