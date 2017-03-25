<?php
session_start();
include "mysql.php";
include_once 'wrapper.frame.php';

$_SESSION['admin'] = isset($_SESSION['user'])? (mysql_("SELECT UID FROM users WHERE Username='".$_SESSION['user']."' AND Rights>5",true)>0) : false;
?>
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
if(isset($_REQUEST['album']) && trim($_REQUEST['album'])=='new'){
   if(isset($_SESSION['user']) && isset($_SESSION['admin']) && $_SESSION['admin']){

      if(isset($_REQUEST['submit'])){
         $album = trim($_REQUEST['name']);

         if(!is_dir('gallery/'.$album))
            mkdir('gallery/'.$album);

         if(isset($_REQUEST['title'])){
            $title = trim($_REQUEST['title']);
            if(strlen($title)>0)
               file_put_contents('gallery/'.$album.'/title', $title);
            else
               if(file_exists('gallery/'.$album.'/title'))
                  unlink('gallery/'.$album.'/title');
         }
         if(isset($_REQUEST['title_en'])){
            $title_en = trim($_REQUEST['title_en']);
            if(strlen($title_en)>0)
               file_put_contents('gallery/'.$album.'/title.en', $title_en);
            else
               if(file_exists('gallery/'.$album.'/title.en'))
                  unlink('gallery/'.$album.'/title.en');
         }

         if(isset($_REQUEST['description'])){
            $description = trim($_REQUEST['description']);
            if(strlen($description)>0)
               file_put_contents('gallery/'.$album.'/description', $description);
            else
               if(file_exists('gallery/'.$album.'/description'))
                  unlink('gallery/'.$album.'/description');
         }
         if(isset($_REQUEST['description_en'])){
            $description_en = trim($_REQUEST['description_en']);
            if(strlen($description_en)>0)
               file_put_contents('gallery/'.$album.'/description.en', $description_en);
            else
               if(file_exists('gallery/'.$album.'/description.en'))
                  unlink('gallery/'.$album.'/description.en');
         }

         echo '<script type="text/javascript">window.location.href="?"</script>'."\n";
      }
      else if(isset($_REQUEST['fill'])){
         if(isset($_REQUEST['content'])){
            if($_REQUEST['content'] == 'link'){
               file_put_contents('gallery/'.trim($_REQUEST['fill']).'/'.trim($_REQUEST['vid']).'.link', 'Added by '.$_SESSION['user']."\n".'on '.date('r'));
            }
            if($_REQUEST['content'] == 'video'){
               move_uploaded_file($_FILES['vfile']['tmp_name'], 'gallery/'.trim($_REQUEST['fill']).'/'.basename($_FILES['vfile']['name']));
            }
            if($_REQUEST['content'] == 'picture'){
               move_uploaded_file($_FILES['picture']['tmp_name'], 'gallery/'.trim($_REQUEST['fill']).'/'.basename($_FILES['picture']['name']));
            }
            echo '<script type="text/javascript">window.location.href="?album='.trim($_REQUEST['fill']).'";</script>';
         }
         else{
            echo '<div class="videos">'."\n";
            echo '   <div class="section">'."\n";
            echo '      <div class="header">Видеоклип от Youtube</div>'."\n";
            echo '      <hr />'."\n";
            echo '   </div>'."\n\n";
            echo '   <form action="?album=new&fill='.trim($_REQUEST['fill']).'&content=link" method="POST" style="margin-left: 160px;">'."\n";
            echo '      <label title="Уникалното име на клипа в youtube">'."\n";
            echo '         Уникален идентификатор:<br />'."\n";
            echo '         <input type="text" name="vid" title="Пример: VWD-fMS6arI" />'."\n";
            echo '      </label>'."\n";
            echo '      <br /><input type="submit" value="Добави" />'."\n";
            echo '   </form>'."\n";
            echo '</div>'."\n";
            echo '<div class="videos">'."\n";
            echo '   <div class="section">'."\n";
            echo '      <div class="header">Видеоклип (файл)</div>'."\n";
            echo '      <hr />'."\n";
            echo '   </div>'."\n\n";
            echo '   <form enctype="multipart/form-data" action="?album=new&fill='.trim($_REQUEST['fill']).'&content=video" method="POST" style="margin-left: 160px;">'."\n";
            echo '      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />'."\n";
            echo '      <label title="Видео файл">'."\n";
            echo '         Видео Файл:<br />'."\n";
            echo '         <input type="file" name="vfile" title="Пример: C://Videos/DSC_1795.MOV" onchange="if(this.value.toLowerCase().indexOf(\'.mov\')==-1){ alert(\'Грешен тип файл!\'); this.value=\'\'; }" />'."\n";
            echo '      </label>'."\n";
            echo '      <br /><input type="submit" value="Добави" />'."\n";
            echo '   </form>'."\n";
            echo '</div>'."\n";
            echo '<div class="videos">'."\n";
            echo '   <div class="section">'."\n";
            echo '      <div class="header">Снимка</div>'."\n";
            echo '      <hr />'."\n";
            echo '   </div>'."\n\n";
            echo '   <form enctype="multipart/form-data" action="?album=new&fill='.trim($_REQUEST['fill']).'&content=picture" method="POST" style="margin-left: 160px;">'."\n";
            echo '      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />'."\n";
            echo '      <label title="Изображение">'."\n";
            echo '         Снимка:<br />'."\n";
            echo '         <input type="file" name="picture" title="Пример: C://Pictures/100_7336.JPG" onchange="var v=this.value.toLowerCase(); if(v.indexOf(\'.jpg\')==-1 && v.indexOf(\'.png\')==-1 && v.indexOf(\'.bmp\')==-1 && v.indexOf(\'.gif\')==-1){ alert(\'Грешен тип файл!\'); this.value=\'\'; }" />'."\n";
            echo '      </label>'."\n";
            echo '      <br /><input type="submit" value="Добави" />'."\n";
            echo '   </form>'."\n";
            echo '</div>'."\n";
         }
      }
      else{
         if(isset($_REQUEST['renew'])){
            $album = trim($_REQUEST['renew']);
            if(file_exists('gallery/'.$album.'/title'))
               $title          = file_get_contents('gallery/'.$album.'/title');
            if(file_exists('gallery/'.$album.'/title.en'))
               $title_en       = file_get_contents('gallery/'.$album.'/title.en');
            if(file_exists('gallery/'.$album.'/description'))
               $description    = file_get_contents('gallery/'.$album.'/description');
            if(file_exists('gallery/'.$album.'/description.en'))
               $description_en = file_get_contents('gallery/'.$album.'/description.en');
         }

         echo '<div class="central">'."\n";
         echo '   <div class="notice" style="display: none;">Оставете празно за стоиностите по подразбиране</div>'."\n";
         echo '   <form action="?album=new&submit" method="POST">'."\n";
         echo '      <label title="Името не може да бъде празно и може да съдържа само букви, цифри, точки, тирета и подчерти. Ако има зададено заглавие името ще се замести от него.">'."\n";
         echo '         <b>Име</b> / <b>Name</b><br />'."\n";
         echo '         <input type="text" name="name" value="'.(isset($album)? $album : date('d.m.Y')).'" />'."\n";
         echo '      </label>'."\n";
         echo '      <br /><br />'."\n";
         echo '      <div class="left">'."\n";
         echo '         <label title="Ако не бъде въведено заглавие ще се показва името на албума">'."\n";
         echo '            <b>Заглавие</b> <small>(Български)</small><br />'."\n";
         echo '            <input type="text" name="title" '.(isset($title)? 'value="'.$title.'" ' : '').'/>'."\n";
         echo '         </label>'."\n";
         echo '         <br /><br />'."\n";
         echo '         <label title="Описанието може да бъде празно. Препоръчително е да не е много дълго">'."\n";
         echo '            <b>Описание</b> <small>(Български)</small><br />'."\n";
         echo '            <textarea name="description">'.(isset($description)? $description : '').'</textarea>'."\n";
         echo '         </label>'."\n";
         echo '      </div>'."\n";
         echo '      <div class="right">'."\n";
         echo '         <label title="If no title is entered the name of the album will be displayed">'."\n";
         echo '            <b>Title</b> <small>(English)</small><br />'."\n";
         echo '            <input type="text" name="title_en" '.(isset($title_en)? 'value="'.$title_en.'" ' : '').'/>'."\n";
         echo '         </label>'."\n";
         echo '         <br /><br />'."\n";
         echo '         <label title="The description can be empty. It is recommended to be kept short">'."\n";
         echo '            <b>Description</b> <small>(English)</small><br />'."\n";
         echo '            <textarea name="description_en">'.(isset($description_en)? $description_en : '').'</textarea>'."\n";
         echo '         </label>'."\n";
         echo '      </div>'."\n";
         echo '      <div class="notice" style="clear: both; padding-top: 20px;">'."\n";
         echo '         Thumbnail-ът се избира като качите изображение с име \'thumbnail_*.*\''."\n";
         echo '      </div>'."\n";
         echo '      <div>'."\n";
         echo '         <input type="submit" value="Готово" />'."\n";
         echo '      </div>'."\n";
         echo '   </form>'."\n";
         echo '</div>'."\n";
      }
   }else
      echo '<script type="text/javascript">window.location.href="?"</script>'."\n";
}else
if(isset($_REQUEST['album'])){
   $album = trim($_REQUEST['album']);
   $path  = "gallery/".$album;
   $imgs = glob($path.'/*.*', GLOB_NOSORT);

   sort($imgs);

   if(!function_exists('isContent')){
      function isContent($path){
         $pic = basename($path);

         if(stripos($pic, ".db"))
            return false;
         if(stripos($pic, ".en"))
            return false;
         if(stripos(" ".$pic, "thumbnail"))
            return false;

         return true;
      }
   }
   $imgs = array_filter($imgs, 'isContent');

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
            $link = str_replace(".link", "", basename($pic));
            if(strpos($link, ".")) $link = next(explode(".", $link, 2));
         $code .= '   <iframe width="'.$videoWidth.'" height="'.$videoHeight.'" src="http://www.youtube.com/embed/'.$link.'?rel=0" frameborder="0" allowfullscreen></iframe>'."\n";
         $code .= '</div>'."\n";

         unset($link);

         $content['videos'][] = $code;
      }else{
         //It's a picture
         $code .= '<div class="picture">'."\n";
         $code .= '   <a href="'.$pic.'" rel="lightbox">'."\n";
         $code .= '      <img src="'.$pic.'" alt="'.basename($pic).'">'."\n";
            $nm = basename($pic);
            $nm = substr($nm, 0, strrpos($nm, "."));
            if(strpos($nm, ".")) $nm = next(explode(".", $nm, 2));
         $code .= '      <div class="title">'.$nm.'</div>'."\n";
         $code .= '   </a>'."\n";
         $code .= '</div>'."\n";

         unset($nm);

         $content['pictures'][] = $code;
      }
   }

   if(count($content['videos'])>0)
      $videos   = join("\n", $content['videos']);
   if(count($content['pictures'])>0)
   $pictures = join("\n", $content['pictures']);

   if(!isset($pictures) && !isset($videos)){
      echo '<div style="margin: 35px 0px 0px 175px;">Няма достъпни материали</div>'."\n";
   }else if(!isset($pictures) || !isset($videos)){
      if(isset($pictures))
         echo $pictures;

      if(isset($videos))
         echo $videos;
   }else{
      echo '<div class="videos">'."\n";
      echo '   <div class="section">'."\n";
      echo '      <div class="header">Видео</div>'."\n";
      echo '      <hr />'."\n";
      echo '   </div>'."\n\n";
      echo $videos."\n";
      echo '</div>'."\n";

      echo '<div class="pictures">'."\n";
      echo '   <div class="section">'."\n";
      echo '      <div class="header">Снимки</div>'."\n";
      echo '      <hr />'."\n";
      echo '   </div>'."\n\n";
      echo $pictures."\n";
      echo '</div>'."\n";
   }


   echo '<a class="back link" href="?" style="width: 100px;">Назад към Албумите</a>'."\n";

   if(isset($_SESSION['user']) && isset($_SESSION['admin']) && $_SESSION['admin'])
      echo '<a class="back link" href="?album=new&fill='.$album.'" style="width: 100px; margin-top: 80px;">Добави материал</a>'."\n";
}
else{
   $albums = glob('gallery/*', GLOB_ONLYDIR);

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
   sort($albums); //usort($albums, 'sortAlbums');

   foreach($albums as $album){
      $path  = rtrim($album, "/\\");
      $album = basename($album);
      $imgs  = glob($path.'/*.*');

      if($album == 'new' && !(isset($_SESSION['user']) && isset($_SESSION['admin']) && $_SESSION['admin']))
         continue;

      if(file_exists($path."/hidden"))
         continue;

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
            if(stripos($pic, ".link"))
               return false;
            if(stripos($pic, ".mov"))
               return false;
            if(stripos($pic, ".en"))
               return false;
            if(stripos(" ".$pic, "thumbnail"))
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
      if($album != 'new'){
         echo '   <div class="count">'.count($imgs).' '.(count($imgs)==1? 'снимка' : 'снимки').'</div>'."\n";
         echo '   <div class="count">'.count($vids).' '.(count($vids)==1? 'клип' : 'клипа').'</div>'."\n";

         if(isset($_SESSION['user']) && isset($_SESSION['admin']) && $_SESSION['admin'])
            echo '   <div class="edit"><a href="?album=new&renew='.$album.'">Редактирай</a></div>'."\n";
      }
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