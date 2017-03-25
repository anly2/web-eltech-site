<?php
@session_start();
function wrapper_frame_head($pad=''){
   global $page;

   $bn = basename($_SERVER['SCRIPT_FILENAME']);
   $file_ = (strpos($bn, "."))? join(".",explode(".", basename($_SERVER['SCRIPT_FILENAME']), -1)) : $bn;
   $file_ = join("", explode(".en", $file_));
   unset($bn);

   if(!isset($page))
      $page = $file_;


   echo $pad.'<title>Eltech - '.ucfirst($page).'</title>';
   echo "\n";
   echo $pad.'<link rel="stylesheet" href="master.css" />'."\n";
   echo $pad.'<link rel="stylesheet" href="'.$file_.'.css" />'."\n";
   echo $pad.'<script type="text/javascript" src="../jquery/jquery.js"></script>'."\n";
}

function wrapper_frame_header($pad=''){
   echo $pad.'<div class="header">'."\n";
   echo $pad.'   <a href="http://www.mgberon.com/html/indexEn.php"><img id="emblem" src="img/mg_logo.png" /></a>'."\n";
   echo $pad.'   <div class="title"><a href="index.en.php" class="simple">Applicable Electrics and Electronics club</a></div>'."\n";
   echo "\n";
   echo $pad.'   <ul class="nav">'."\n";
   echo $pad.'      <li><a href="index.en.php">Home</a></li>'."\n";
   echo $pad.'      <li><a href="about.en.php">About us</a></li>'."\n";
   echo $pad.'      <li><a href="project.en.php">The Project</a></li>'."\n";
   echo $pad.'      <li><a href="gallery.en.php">Gallery</a></li>'."\n";
   echo $pad.'      <li><a href="?forum">Forum</a></li>'."\n";
   echo $pad.'      <li><a href="blog.en.php">Blog</a></li>'."\n";
   echo $pad.'   </ul>'."\n";
   echo "\n";
   echo $pad.'   <div class="languages">'."\n";
   $url_en = (stripos(" ".$_SERVER['REQUEST_URI'], ".php"))? ( str_replace(".php", ".en.php", str_replace(".en", "", substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "/")+1))) )  :   ( join("index.en.php", explode("?", $_SERVER['REQUEST_URI'])) );
   $url_bg = (stripos(" ".$_SERVER['REQUEST_URI'], ".php"))? ( str_replace(".en", "", substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "/")+1)) )   :   ( join("index.php", explode("?", $_SERVER['REQUEST_URI'])) );
   echo $pad.'      <a href="'.$url_en.'" class="active"><img src="img/flag_en.gif" /></a>'."\n";
   echo $pad.'      <a href="'.$url_bg.'"><img src="img/flag_bg.gif" /></a>'."\n";
   if(!isset($_SESSION['user']))
      echo $pad.'      <a href="login.en.php"><img src="img/login.gif" title="Login"/></a>'."\n";
   else
      echo $pad.'      <a href="login.en.php?logout"><img src="img/login.gif" title="Logout"/></a>'."\n";
   echo $pad.'   </div>'."\n";
   echo $pad.'</div>'."\n";
}
function wrapper_frame_footer($pad=''){
   echo $pad.'<div class="footer">'."\n";
   echo $pad.'   <ul class="nav">'."\n";
   echo $pad.'      <li><a href="index.en.php">Home</a></li>'."\n";
   echo $pad.'      <li><a href="about.en.php">About us</a></li>'."\n";
   echo $pad.'      <li><a href="project.en.php">The Project</a></li>'."\n";
   echo $pad.'      <li><a href="gallery.en.php">Gallery</a></li>'."\n";
   echo $pad.'      <li><a href="?forum">Forum</a></li>'."\n";
   echo $pad.'      <li><a href="blog.en.php">Blog</a></li>'."\n";
   echo $pad.'   </ul>'."\n";
   echo $pad.'   <hr />'."\n";
   echo $pad.'   <small>'."\n";
   echo $pad.'      Design by'."\n";
   echo $pad.'      <a href="http://nickchoubg.deviantart.com/">Nickchou</a>'."\n";
   echo $pad.'   </small>'."\n";
   echo $pad.'   <br />'."\n";
   echo $pad.'   <small>'."\n";
   echo $pad.'      Development by'."\n";
   echo $pad.'      <a href="http://46.10.101.59:22080/?projects">Anko Anchev</a>'."\n";
   echo $pad.'   </small>'."\n";
   echo $pad.'</div>'."\n";

   //Remove the trailing blank space from below the footer by anchoring it at the bottom
   echo $pad.'<script type="text/javascript">'."\n";
   echo $pad.'   function footer_check(){'."\n";
   echo $pad.'      $(\'body>.footer\').removeClass(\'anchored\');'."\n";
   echo "\n";
   echo $pad.'      var contentheight = parseInt(document.body.scrollHeight);'."\n";
   echo $pad.'      var viewportheight = (typeof window.innerHeight != \'undefined\')? window.innerHeight : document.documentElement.clientHeight;'."\n";
   echo "\n";
   echo "\n";
   echo $pad.'      if(contentheight <= viewportheight)'."\n";
   echo $pad.'         $(\'body>.footer\').addClass(\'anchored\');'."\n";
   echo $pad.'   }'."\n";
   echo $pad.'   $(window).ready( footer_check );'."\n";
   echo $pad.'   $(window).on(\'resize\', footer_check );'."\n";
   echo $pad.'</script>'."\n";
}
?>