<!--

var widths=790;  //焦点图片宽
var w=0;
var widthss=widths+w;
var heights=360; //焦点图片高
var heightss=heightss+w;
var heightt=0;
var counts=12;    //总条数
//img1=new Image();在这里是声明了一个图片元素的对象
//后面是对图像的属性进行赋值或设置,如imgs.src="xxxx.jpg"是指定图片的索引地址.
//这个代码一般用于head区,用于预加载图片,即加快图片显示.
//只有用new Images()得到的图片IE7才认,
//而IE6和firefox可认得imgUrl[1]="/y9q9ms7lbgbt.jpg";得到的图片
//抗灾、TI最大分销商、DVS6446发布、TI的代理商身份、Xilinx大学计划。


img1=new Image();img1.src='jsimages/1.jpg';
url1=new Image();url1.src='#';
txt1=new Image();txt1.txt='';


img2=new Image();img2.src='jsimages/2.jpg';
url2=new Image();url2.src='#';
txt2=new Image();txt2.txt='';



img3=new Image();img3.src='jsimages/3.gif';
url3=new Image();url3.src='#';
txt3=new Image();txt3.txt='';

img4=new Image();img4.src='jsimages/4.jpg';
url4=new Image();url4.src='#';
txt4=new Image();txt4.txt='';

img5=new Image();img5.src='jsimages/5.jpg';
url5=new Image();url5.src='#';
txt5=new Image();txt5.txt='';

img6=new Image();img6.src='jsimages/6.jpg';
url6=new Image();url6.src='#';
txt6=new Image();txt6.txt='';

img7=new Image();img7.src='jsimages/7.jpg';
url7=new Image();url7.src='#';
txt7=new Image();txt7.txt='';

img8=new Image();img8.src='jsimages/8.jpg';
url8=new Image();url8.src='#';
txt8=new Image();txt8.txt='';

img9=new Image();img9.src='jsimages/9.jpg';
url9=new Image();url9.src='#';
txt9=new Image();txt9.txt='';

img10=new Image();img10.src='jsimages/10.jpg';
url10=new Image();url10.src='#';
txt10=new Image();txt10.txt='';

img11=new Image();img11.src='jsimages/11.jpg';
url11=new Image();url11.src='#';
txt11=new Image();txt11.txt='';

img12=new Image();img12.src='jsimages/12.jpg';
url12=new Image();url12.src='#';
txt12=new Image();txt12.txt='';
    

                
var nn=1; //当前所显示的滚动图
var key=0;  //标识是否为第一次开始执行
var tt;  //标识作用

function change_img()
{
if(key==0){key=1;} //如果第一次执行KEY=1，表示已经执行过一次了。
else if(document.all)//document.all仅IE6/7认识，firefox不会执行此段内容
{
document.getElementById("pic").filters[0].Apply(); //将滤镜应用到对像上
document.getElementById("pic").filters[0].Play(duration=2);  //开始转换
document.getElementById("pic").filters[0].Transition=23;//转换效果
}

eval('document.getElementById("pic").src=img'+nn+'.src');   //替换图片
eval('document.getElementById("url").href=url'+nn+'.src'); //替换URL
eval('document.getElementById("title").value=txt'+nn+'.txt'); //替换ALT 

for (var i=1;i<=counts;i++)
{
  document.getElementById("xxjdjj"+i).className='axx';   //将下面黑条上的所有链接变为未选中状态
}
document.getElementById("xxjdjj"+nn).className='bxx';    //将当前页面的ID设置为选中状态
nn++;
if(nn>counts){nn=1;}  //如果ID大于总图片数量。则从头开始循环
tt=setTimeout('change_img()',3000);  //在2秒后重新执行change_img()方法.
}
function changeimg(n)//点击黑条上的链接执行的方法。
{
nn=n; //当前页面的ID等于传入的N值,
window.clearInterval(tt); //清除用于循环的TT
//重新执行change_img();但change_img()内所调用的图片ID已经在此处被修改,会从新ID处开始执行.
change_img();
}
//样式表
document.write('<style>');
document.write('.axx{float:left; display:block; width:8px; height:8px; border-radius:4px; text-align:center; line-height:12px; font-size:12px; margin:1px 2px;}');
document.write('a.axx:link,a.axx:visited{text-decoration:none;color:#fff;background-color:#666;}');
document.write('a.axx:active,a.axx:hover{text-decoration:none;color:#fff;background-color:#999;}');
document.write('.bxx{float:left; display:block; width:8px; height:8px; border-radius:12px;text-align:center; line-height:12px; margin:1px 2px;}');
document.write('a.bxx:link,a.bxx:visited{text-decoration:none;color:#fff;background-color:#fff;}');
document.write('a.bxx:active,a.bxx:hover{text-decoration:none;color:#fff;background-color:#fff;}');
document.write('</style>');
//内容部分
document.write('<div style="width:'+widthss+'px;height:'+heights+'px;overflow:hidden;text-overflow:clip;float:left;">');
document.write('<div><a id="url" target="_blank"><img id="pic" style="border:0px #cbcbcb solid;FILTER: progid:DXImageTransform.Microsoft.RevealTrans (duration=2,transition=23)" width='+widths+' height='+heights+' /></a></div>');
document.write('<div style="filter:alpha(style=1,opacity=10,finishOpacity=90);width:100%-10px;text-align:right;left:620px; top:-24px;position:relative;margin:1px;height:14px;border:0px;padding-top:1px;z-index:1;"><div>');
for(var i=1;i<counts+1;i++){document.write('<a href="javascript:changeimg('+i+');" id="xxjdjj'+i+'" class="axx" target="_self">'+'</a>');}
document.write('</div></div></div>');
document.write('<div align=center><input id="title" type="txt" style="border:0px solid #f2f6fb;width:'+widthss+'px;color:#fff;font-size:9pt;position:relative;line-height:20px;text-align:center;"></div>');
//document.write('</div>');
//开始执行滚动操作
change_img();

//-->