<?php if(isset($_REQUEST['pwd'])){ echo md5(trim($_REQUEST['pwd'])); exit; }?>
<form action="?" method="POST"><input type='password' name='pwd' /><br /><input type="submit" value="Encrypt" /></form>
<?php exit; ?><html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
   <title>Electrotech</title>
   <link rel="stylesheet" href="Eltech/master.css">
<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="jquery/jquery-css-transform.js"></script>
<script type="text/javascript" src="jquery/jquery-animate-css-rotate-scale.js"></script>
<script type="text/javascript">
function findPos(obj){
   var curleft = curtop = 0;

   if(obj.offsetParent)
      do{
         curleft += obj.offsetLeft;
         curtop += obj.offsetTop;
      }while(obj = obj.offsetParent);

   return [curleft,curtop];
}
function findSize(obj){
   var measures = new Array();

   var ovrflw_x = celeb.style.overflowX;
   var ovrflw_y = celeb.style.overflowY;

   obj.style.overflowX = 'scroll';
   obj.style.overflowY = 'scroll';

   measures[0] = obj.scrollWidth;
   measures[1] = obj.scrollHeight;

   obj.style.overflowX = ovrflw_x;
   obj.style.overflowY = ovrflw_y;

   return measures;
}
function inter(c0, c1){
   var x0 = c0.center[0];
   var y0 = c0.center[1];
   var r0 = c0.radius;
   var x1 = c1.center[0];
   var y1 = c1.center[1];
   var r1 = c1.radius;

   var dx = x1 - x0;
   var dy = y1 - y0;

   var d = Math.sqrt((dy*dy) + (dx*dx));

   if(d > (r0 + r1))
       return 0;
   if(d < Math.abs(r0 - r1))
       return -1;

   var a = ((r0*r0) - (r1*r1) + (d*d)) / (2*d);

   var x2 = x0 + (dx * a/d);
   var y2 = y0 + (dy * a/d);

   var h = Math.sqrt((r0*r0) - (a*a));

   var rx = (-dy) * (h/d);
   var ry =   dx  * (h/d);

   var xi1 = x2 + rx;
   var yi1 = y2 + ry;
   var xi2 = x2 - rx;
   var yi2 = y2 - ry;


   if( (xi1 == xi2) && (yi1 == yi2) )
      return [xi1, yi1];

   return [[xi1, yi1], [xi2, yi2]];
}</script>
</head>
<body contenteditable="true">

<div style="border: 1px solid red; width: 146px; overflow: hidden;"><input type="file" size="20"/></div>

<div>

   <div class="area">
      <header class="celebrity">Information</header>
   </div>
   <div class="area">
      <header class="celebrity">Activity<br>
</header>
   </div>
   <div class="area">
      <header class="celebrity">Gallery</header>
      <div class="fan">
         <a href="?picture=1" class="picture" style="background-image: url('Eltech/Gallery/100_7358.JPG'); background-position: -284px -212px; background-size: 714px 536px;"></a>
         <a href="?picture=2" class="picture" style="background-image: url('Eltech/Gallery/100_7352.JPG'); background-position: -280px -130px; background-size: 529px 404px;"></a>
         <a href="?picture=3" class="picture" style="background-image: url('Eltech/Gallery/100_7372.JPG'); background-position: -100px -23px; background-size: 200px 154px;"></a>
      </div>
   </div>
   <div class="area">
      <header class="celebrity">Forum</header>
      <div class="fan">
         <a style="top: 510px; left: 129px;" href="http://localhost/forum/?tid=1">Как да си направя радиоприемник?</a>
         <a style="top: 539px; left: 337px;" href="http://localhost/forum/?tid=2">Как да стабилизирам напрежение?</a>
         <a style="top: 595px; left: 314px;" href="http://localhost/forum/?tid=3">Как да изправя ток?</a>
         <a style="top: 579px; left: 125px;" href="http://localhost/forum/?tid=4">Съвети от практиката</a>
      </div>
   </div>
   <div class="area">
      <header class="celebrity">Blog</header>
      <div class="fan">
         <a style="top: 503px; left: 906px;" href="http://localhost/test.php?blogpost=1">Честит великден!</a>
         <a style="top: 533px; left: 998px;" href="http://localhost/test.php?blogpost=2">Посещение в ТУ-Варна</a>
         <a style="top: 580px; left: 990px;" href="http://localhost/test.php?blogpost=3">Инструментите пристигнаха!</a>
         <a style="top: 610px; left: 883px;" href="http://localhost/test.php?blogpost=4">Метриалите са поръчани</a>
         <a style="top: 579px; left: 798px;" href="http://localhost/test.php?blogpost=5">Занятието се отлага</a>
         <a style="top: 539px; left: 755px;" href="http://localhost/test.php?blogpost=6">Материалите пристигнаха!</a>
      </div>
   </div>
   <div class="area">
      <header class="celebrity">Links</header>
      <div class="fan">
         <a style="top: 714px; left: 507px;" class="link" href="http://www.tu-varna.bg/">TU-Varna<br>http://www.tu-varna.bg</a>
         <a style="top: 740px; left: 667px;" class="link" href="http://bg.wikipedia.org/wiki/%D0%95%D0%BB%D0%B5%D0%BA%D1%82%D1%80%D0%BE%D1%82%D0%B5%D1%85%D0%BD%D0%B8%D0%BA%D0%B0">Wiki<br>http://bg.wikipedia.org/wiki/Електротехника</a>
         <a style="top: 803px; left: 605px;" class="link" href="http://www.napravisam.bg/forum/viewforum.php?f=11">НаправиСам<br>http://www.napravisam.bg/</a>
         <a style="top: 776px; left: 433px;" class="link" href="http://www.tpetrov.com/search.php?maincat=%D0%95%D0%9B%D0%95%D0%9A%D0%A2%D0%A0%D0%9E%D0%A2%D0%95%D0%A5%D0%9D%D0%98%D0%9A">TPetrov<br>http://www.tpetrov.com/search.php?maincat=ЕЛЕКТРОТЕХНИКА</a>
      </div>
   </div>

</div>

<style type="text/css">
   .fan>*{ position: absolute; }
</style>

<script type="text/javascript">scriptHolderArray4</script>



</body></html>