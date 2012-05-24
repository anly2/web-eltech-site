<?php include_once 'wrapper.frame.en.php'; ?>
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
   $imgs = glob($path.'/*.*', GLOB_NOSORT);

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

   $content = array();
   $content['videos']   = array();
   $content['pictures'] = array();

   $i = -1;
   foreach($imgs as $pic){
      //If page behaviour is desired, uncomment this
//      $i++;
//      if($i >= ($offset+$limit) ) break;
//      if($i < $offset) continue;
      $code = '';
      $videoWidth = 240; $videoHeight = 196;

      if(stripos($pic, ".mov")){
         //It's a local video
         $code .= '<div class="video">'."\n";
         $code .= '   <object width="'.$videoWidth.'" height="'.$videoHeight.'">'."\n";
         $code .= '      <param name="movie" value="'.$pic.'"></param>'."\n";
         $code .= '      <param name="allowFullScreen" value="true"></param> <param name="allowscriptaccess" value="always"></param>'."\n\n";
         $code .= '      <embed src="'.$pic.'" type="application/x-shockwave-flash" width="'.$videoWidth.'" height="'.$videoHeight.'" allowscriptaccess="always" allowfullscreen="true"></embed>'."\n";
         $code .= '   </object>'."\n";
         $code .= '</div>'."\n";

         $content['videos'][] = $code;
      }else if(stripos($pic, ".link")){
         //It's a youtube video

         $code .= '<div class="video">'."\n";
         $code .= '   <iframe width="'.$videoWidth.'" height="'.$videoHeight.'" src="http://www.youtube.com/embed/'.str_replace(".link", "", basename($pic)).'?rel=0" frameborder="0" allowfullscreen></iframe>'."\n";
         $code .= '</div>'."\n";

         $content['videos'][] = $code;
      }else{
         //It's a picture
         $code .= '<div class="picture">'."\n";
         $code .= '   <a href="'.$pic.'" rel="lightbox">'."\n";
         $code .= '      <img src="'.$pic.'" alt="'.basename($pic).'">'."\n";
         $code .= '      <div class="title">'.basename($pic).'</div>'."\n";
         $code .= '   </a>'."\n";
         $code .= '</div>'."\n";

         $content['pictures'][] = $code;
      }
   }

   if(count($content['videos'])>0)
      $videos   = join("\n", $content['videos']);
   if(count($content['pictures'])>0)
   $pictures = join("\n", $content['pictures']);

   if(!isset($pictures) && !isset($videos)){
      echo '<div style="margin: 35px 0px 0px 175px;">No available materials</div>'."\n";
   }else if(!isset($pictures) || !isset($videos)){
      if(isset($pictures))
         echo $pictures;

      if(isset($videos))
         echo $videos;
   }else{
      echo '<div class="videos">'."\n";
      echo '   <div class="section">'."\n";
      echo '      <div class="header">Video</div>'."\n";
      echo '      <hr />'."\n";
      echo '   </div>'."\n\n";
      echo $videos."\n";
      echo '</div>'."\n";

      echo '<div class="pictures">'."\n";
      echo '   <div class="section">'."\n";
      echo '      <div class="header">Photos</div>'."\n";
      echo '      <hr />'."\n";
      echo '   </div>'."\n\n";
      echo $pictures."\n";
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

      if(!function_exists('isVideo')){
         function isVideo($path){
            $pic = basename($path);

            if(stripos($pic, ".mov"))
               return true;
            if(stripos($pic, ".link"))
               return true;

            return false;
         }
      }
      if(!function_exists('isPhoto')){
         function isPhoto($path){
            $pic = basename($path);

            if(stripos($pic, ".db"))
               return false;
            if(stripos(" ".$pic, "thumbnail"))
               return false;
            if(stripos($pic, ".mov"))
               return false;
            if(stripos($pic, ".link"))
               return false;

            return true;
         }
      }
      $vids = array_filter($imgs, 'isVideo');
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
      echo '   <div class="count">'.count($imgs).' '.(count($imgs)==1? 'photo' : 'photos').'</div>'."\n";
      echo '   <div class="count">'.count($vids).' '.(count($vids)==1? 'video' : 'videos').'</div>'."\n";
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