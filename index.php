<?php
include_once 'wrapper.frame.php';
$page = 'home';
?>
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
      </script>
   </div>

   <div class="posts section">
      <div class="left">
         <div class="header">Blog Posts</div>
         <div class="content">
            <a href="?">Честит Великден!</a>
            <a href="?">Материалите са поръчани</a>
            <a href="?">Посещение в ТУ</a>
            <a href="?">Отново в ТУ!</a>
         </div>
      </div>
      <div class="right">
         <div class="header">Forum Posts</div>
         <div class="content">
            <a href="?">От къде да започна?</a>
            <a href="?">Къде се бърка най-често?</a>
            <a href="?">Интересни неща които мога да си направя</a>
            <a href="?">Как да си направя: Радиопредавател и применик?</a>
         </div>
      </div>
   </div>

   <div class="posts section">
      <div class="center">
         <div class="header">Related Links</div>
         <div class="content">
            <a class="link" href="http://www.tu-varna.bg">TU-Varna</a>
            <a class="link" href="http://www.napravisam.bg/forum/viewforum.php?f=11">НаправиСам</a>
            <a class="link" href="http://www.tpetrov.com/search.php?maincat=%D0%95%D0%9B%D0%95%D0%9A%D0%A2%D0%A0%D0%9E%D0%A2%D0%95%D0%A5%D0%9D%D0%98%D0%9A">TPetrov</a>
            <a class="link" href="http://bg.wikipedia.org/wiki/%D0%95%D0%BB%D0%B5%D0%BA%D1%82%D1%80%D0%BE%D1%82%D0%B5%D1%85%D0%BD%D0%B8%D0%BA%D0%B0">Wiki</a>
         </div>
      </div>
   </div>
</div>

<?php wrapper_frame_footer(); ?>

</body>
</html>