window.onload=function(){
	var cir_lead = function(r,angle){
//		抓取元素
		this.div = document.getElementById("cir");
		this.sections = this.div.getElementsByTagName("section");
		this.r = r;
		this.angle = angle;
		this.status = 0; 
		This = this;
		
//		点击事件
		this.div.onclick=function(){
			if(This.status ==0 ){
				var one_deg = This.angle/This.sections.length;
				for(var i=0;i<This.sections.length;i++){
	//				 求出角度
					 var this_deg = one_deg*i;
	//				 求出坐标
					 var zb = This.xy(this_deg,This.r);
	//				 把坐标赋值给元素
					 This.sections[i].style.left = zb.x +"px";
					 This.sections[i].style.top = zb.y +"px";
					 This.sections[i].style.transition = "2s "+i*0.5+"s";
					 This.sections[i].style.transform = "rotate(720deg)";
			    }
				This.status = 1;
			}else{
				for(var i=0;i<This.sections.length;i++){

					 This.sections[i].style.left = "5px";
					 This.sections[i].style.top = "5px";
					 This.sections[i].style.transform = "rotate(0deg)";
				}
				This.status = 0;
			}
		}
		
//		计算坐标的函数
		this.xy = function(deg,r){
			 var hudu = (2*Math.PI/360)*deg;
			 var y = Math.sin(hudu)*r;
			 var x = Math.cos(hudu)*r;
			 return {"y":y,"x":x};
		}
		
	};
	
//	实例化
	new cir_lead(100,100);
}
