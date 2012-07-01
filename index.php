<?php
include_once 'wrapper.frame.php';
$page = 'Начало';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php wrapper_frame_head('   '); ?>

   <script type="text/javascript">
   picWidth = 400; //px of width for each image in the slideshow

   function showTab(i){
      if(typeof tabs == 'undefined')
         tabs = $('.tabs>.tab');

      if(typeof active == 'number')
         $(tabs[active]).removeClass('active');

      $('.image.container').animate({'margin-left': (-picWidth)*i}, {duration: 1000});
      $(tabs[i]).addClass('active');

      active = i;
   }
   function prevTab(){
      var i = (active-1)>=0? active-1 : tabs.length-1;
      showTab(i);
   }
   function nextTab(){
      var i = (active+1)%tabs.length;
      showTab(i);
   }

   </script>
</head>
<body>

<?php wrapper_frame_header(); ?>

<div class="contents">
   <div class="header" style="text-align: center; margin-bottom: 30px; font-family: Romul; font-size: 1em;">
      <a href="about.php#the-project"><img src="img/pr_success.png" style="height: 5em; margin: 0em 24em -5em -24em;" /></a>
      <i style="line-height: 3em; display: block;">"Да направим училището привлекателно за младите хора"</i>
      <small>Съфинансиран от ЕСФ по ОП "Развитие на човешките ресурси" 2007-2013г</small>
   </div>

   <div class="gallery section">
      <div class="window">
         <div class="image container">
<?php
$imgs = glob('Gallery/thumbnail*');
foreach($imgs as $pth)
   echo '            <a href="gallery.php"><img src="'.$pth.'" /></a>'."\n";
unset($pth);
unset($imgs);
?>
         </div>
      </div>
      <div class="left arrow"></div>
      <div class="right arrow"></div>
      <div class="tabs"></div>
      <script type="text/javascript">
         var t = $('.tabs');
         var imgs = $('.image.container img');

         var r;
         for(r = 0; r<imgs.length; r++){
            var tmp = document.createElement('div');
            t[0].appendChild(tmp);
            tmp.className = 'tab';
            tmp.I = r;
            tmp.onclick = function(){ showTab(this.I); };
         }

         active = 0;
         showTab(active);

         $('.arrow.left' ).on('click', prevTab);
         $('.arrow.right').on('click', nextTab);

         gallery_window_hover = false;
         $('.gallery .window').mouseover( function(){ gallery_window_hover = true;  } );
         $('.gallery .window').mouseout(  function(){ gallery_window_hover = false; } );
         iCycle = setInterval( function(){ if(!gallery_window_hover) nextTab()}, 7000);
      </script>
   </div>

   <!--
   <div class="posts section">
      <div class="left">
         <div class="header">Новини от Блога</div>
         <div class="content">
            <a href="gallery.php?album=31.03.2012">Посещение на ТУ – 31.03.2012г.</a>
            <a href="gallery.php?album=08.04.2012">Посещение на ТУ – 8.04.2012г.</a>
         </div>
      </div>
      <div class="right">
         <div class="header">Интересно от Форума</div>
         <div class="content">
            <a href="?">От къде да започна?</a>
            <a href="?">Къде се бърка най-често?</a>
            <a href="?">Интересни неща които мога да си направя</a>
            <a href="?">Как да си направя: Радиопредавател и применик?</a>
         </div>
      </div>
   </div>
   -->

   <div class="posts section">
      <div class="left">
         <div class="header">Проекти по физика</div>
         <div class="content">
            <a href="http://www.tvppr.hit.bg/INDEX_frame">Ток в полупроводници</a>
            <a href="http://free.hit.bg/condensers/">Кондензатори</a>
            <a href="http://www.magnitni-vzaimodejstviq.hit.bg/">Магнитни взаимодействия</a>
         </div>
      </div>
      <div class="right">
         <div class="header">Интересно от Форума</div>
         <div class="content">
            <a href="?">От къде да започна?</a>
            <a href="?">Къде се греши най-често?</a>
            <a href="?">Интересни идеи за устройства</a>
         </div>
      </div>
      <div class="center">
         <div class="header glow" style="margin-bottom: 0px;">Изработено от нас</div>
         <div class="content" style="min-height: 0px; margin-bottom: -10px;">
            <a href="gallery.php?album=created_by_us">Албум със снимки</a>
            <a href="gallery.php?album=izlojba">Изложба</a>
            <a href="presentation.php?p=2">Презентация</a>
         </div>
      </div>
   </div>
   <div class="posts section">
      <div class="left">
         <div class="header">Изучи сам</div>
         <div class="content">
            <a href="presentation.php?p=0" target="_BLANK">V-A характеристика на полупроводников диод</a>
            <a href="presentation.php?p=1" target="_BLANK">Логически операции „И“, „ИЛИ“ и „НЕ“</a>
         </div>
      </div>
      <div class="right">
         <div class="header">Полезни Връзки</div>
         <div class="content">
            <!--<a class="link" href="http://bg.farnell.com/jsp/home/homepage.jsp?CMP=KNC-GBG-FBG-GEN-PFB&s_kwcid=TC|15388|farnell.||S|b|16339953766">Електронен каталог Farnell</a>-->
            <a class="link" href="http://www.alldatasheet.com/?gclid=CITR5dq8_a8CFUZd3wod2yYFTg">Електронен каталог</a>
            <a class="link" href="http://vbox7.com/play:902f6bea">Направи Сам</a>
            <a class="link" href="http://www.mgberon.com">МГ - Варна</a>
            <a class="link" href="http://www.tu-varna.bg">ТУ - Варна</a>
         </div>
      </div>
   </div>
</div>

<?php wrapper_frame_footer(); ?>

</body>
</html>