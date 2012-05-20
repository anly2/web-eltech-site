<?php include_once 'wrapper.frame.php'; ?>
<html>
<head>
<?php wrapper_frame_head('   '); ?>

   <script src="lightbox.js" type="text/javascript"></script>
   <link rel="stylesheet" href="lightbox.css" type="text/css" media="screen">

   <script type="text/javascript">
    $(function(){ $('a[rel=lightbox]').lightBox(); });
    </script>
</head>
<body>

<?php wrapper_frame_header(); ?>


<div class="contents">

<?php
if(isset($_REQUEST['album'])){
   $album = trim($_REQUEST['album']);
   $path  = "Gallery/".$album;
   $imgs = glob($path.'/*.*');

   if(!function_exists('isPhoto')){
      function isPhoto($path){
         $pic = basename($path);

         if(stripos($pic, ".db"))
            return false;
         if(stripos(" ".$pic, "thumbnail"))
            return false;

         return true;
      }
   }
   $imgs = array_filter($imgs, 'isPhoto');

   if(isset($_REQUEST['limit']))
      $limit = $_REQUEST['limit'];
   else if(isset($_REQUEST['perPage']))
      $limit = $_REQUEST['perPage'];
   else
      $limit = 9;

   if(isset($_REQUEST['offset']))
      $offset = $_REQUEST['offset'];
   else if(isset($_REQUEST['start']))
      $offset = $_REQUEST['start'];
   else if(isset($_REQUEST['from']))
      $offset = $_REQUEST['from'];
   else
      $offset = 0;

   $i = -1;
   foreach($imgs as $pic){
      //If page behaviour is desired, uncomment this
//      $i++;
//      if($i >= ($offset+$limit) ) break;
//      if($i < $offset) continue;

      echo '<div class="picture">'."\n";
      echo '<a href="'.$pic.'" rel="lightbox">'."\n";
      echo '   <img src="'.$pic.'" alt="'.basename($pic).'">'."\n";
      echo '   <div class="title">'.basename($pic).'</div>'."\n";
      echo '</a>'."\n";
      echo '</div>'."\n";
   }

   echo '<a class="back link" href="?">Back to Albums</a>'."\n";
}
else{
   $albums = glob('Gallery/*', GLOB_ONLYDIR);

   if(!function_exists('sortAlbums')){
      function sortAlbums($a, $b){
         $a = basename($a);
         $b = basename($b);

         $a_ = strtotime($a);
         $b_ = strtotime($b);
         if(!$a_ || !$b_) return 0;
         return ($a_ - $b_);
      }
   }
   usort($albums, 'sortAlbums');

   foreach($albums as $album){
      $path  = rtrim($album, "/\\");
      $album = basename($album);
      $imgs  = glob($path.'/*.*');

      if(!function_exists('isPhoto')){
         function isPhoto($path){
            $pic = basename($path);

            if(stripos($pic, ".db"))
               return false;
            if(stripos(" ".$pic, "thumbnail"))
               return false;

            return true;
         }
      }
      $imgs = array_filter($imgs, 'isPhoto');



      $thumbnail = reset(glob($path."/thumbnail*"));

      if(file_exists($path."/title"))
         $title = file_get_contents($path."/title");
      else
         $title = $album;

      if(file_exists($path."/description"))
         $description = file_get_contents($path."/description");

      echo '<div class="album">'."\n";

      echo '   <div class="thumb"><a href="?album='.$album.'"><img src="'.$thumbnail.'" /></a></div>'."\n";
      echo '   <div class="title">'.$title.'</div>'."\n";
      if(isset($description))
         echo '   <div class="description">'.$description.'</div>'."\n";
      echo '   <div class="count">'.count($imgs).'</div>'."\n";
      echo '</div>'."\n";

      unset($path, $album, $imgs);
      unset($thimbnail, $title, $description);
   }
}
?>

</div>

<?php wrapper_frame_footer(); ?>

</body>
</html>