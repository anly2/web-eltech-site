<?php
session_start();
include "mysql";

////Test Purposes
$_SESSION['user'] = 'Andy';
$_SESSION['admin'] = mysql_("SELECT UID FROM users WHERE Username='".$_SESSION['user']."' AND Rights>5",true)>0;


$sql  = "SELECT ";
$sql .= "a.BID as BID, a.Title as title, a.Author as author, b.Name as category, a.Date as date, a.Contents as contents, a.Comments as comments, a.Tags as tags ";
$sql .= "FROM blog as a, blog_categories as b ";
$sql .= "WHERE a.Category = b.Category ";
$sql .= "ORDER BY date DESC";
$articles = mysql_($sql, MYSQL_ASSOC);

head:{
   echo '<html>'."\n";
   echo '<head>'."\n";
   echo '   <title>Blog</title>'."\n";
   echo '   <link rel="stylesheet" href="blog.css" />'."\n";
   echo '</head>'."\n";
   echo '<body>'."\n";
}
body:{
   $pad = '';
   menus:{
      echo $pad.'<div class="menus">'."\n\n";
      $pad .= '   ';

      search:{ //A search box to look through topics

      }

      create:{ //Link to write a blog post

      }

      categories:{ //The list of categories
         $categories = mysql_("SELECT Category as cid, Name as name FROM blog_categories", MYSQL_ASSOC);

         echo $pad.'<div class="menu">'."\n";
         echo $pad.'   <div class="header">'."\n";
         echo $pad.'      Categories'."\n";
         echo $pad.'   </div>'."\n";
         echo $pad.'   <div class="content">'."\n";
         echo $pad.'      <ul>'."\n";
         foreach($categories as $category)
            echo $pad.'         <li><a href="?search&cat='.$category['cid'].'">'.$category['name'].'</a></li>'."\n";
         echo $pad.'      </ul>'."\n";
         echo $pad.'   </div>'."\n";
         echo $pad.'</div>'."\n";
      }

      archive:{
         echo $pad.'<div class="menu">'."\n";
         echo $pad.'   <div class="header">'."\n";
         echo $pad.'      Archive'."\n";
         echo $pad.'   </div>'."\n";
         echo $pad.'   <div class="content">'."\n";
         echo $pad.'      <ul>'."\n";
         echo $pad.'         <li>2012</li>'."\n";
         echo $pad.'         <li>2011</li>'."\n";
         echo $pad.'         <li>2010</li>'."\n";
         echo $pad.'      </ul>'."\n";
         echo $pad.'   </div>'."\n";
         echo $pad.'</div>'."\n";
      }

      hot:{ //Topics with a lot of comments

      }

      posters:{ //The users that post

      }

      tags:{ //The tags from the shown topics gathered at one place

      }

      $pad = substr($pad, 0, -3);
      echo "\n".$pad.'</div>'."\n";;
   }
   articles:{
      echo $pad.'<div class="articles">'."\n\n";
      $pad .= '   ';

      foreach($articles as $article){
         if(isset($first)) echo "\n"; else $first = false;
         echo $pad.'<div class="article">'."\n";
         echo $pad.'   <div class="body">'."\n";
         echo $pad.'      <div class="left column">'."\n";
         echo $pad.'         <div class="banner">'."\n";
         echo $pad.'            <div class="date">'."\n";
         echo $pad.'               '.date_format(date_create($article['date']), 'j<b\r />F')."\n";
         echo $pad.'            </div>'."\n";
         echo $pad.'            <div class="category">'."\n";
         echo $pad.'               <img src="img/blog_category_'.strtolower($article['category']).'.png" />'."\n";
         echo $pad.'            </div>'."\n";
         echo $pad.'         </div>'."\n";
         echo $pad.'         <div class="share">'."\n";
         echo $pad.'            <div class="button" onclick="if(this.active){ this.parentNode.className = this.parentNode.className.split(\'active\').join(\'\'); this.active = false; }else{ this.parentNode.className += \' active\'; this.active = true; }">Share</div>'."\n";
         echo $pad.'            <div id="share:'.$article['BID'].'" class="dropdown">'."\n";
         echo $pad.'               <img src="img/twitter.jpg"  alt="t" />'."\n";
         echo $pad.'               <img src="img/facebook.jpg" alt="f" />'."\n";
         echo $pad.'               <img src="img/mail.jpg"     alt="m" />'."\n";
         echo $pad.'            </div>'."\n";
         echo $pad.'         </div>'."\n";
         echo $pad.'      </div>'."\n";
         echo $pad.'      <div class="right column">'."\n";
         if($_SESSION['admin']){
            echo $pad.'         <div class="control">'."\n";
            echo $pad.'            <a href="?new&inspiration='.$article['BID'].'">New</a>'."\n";
            echo $pad.'            <a href="?edit='.$article['BID'].'">Edit</a>'."\n";
            echo $pad.'            <a href="?delete='.$article['BID'].'">Delete</a>'."\n";
            echo $pad.'         </div>'."\n";
         }
         echo $pad.'         <div class="header">'."\n";
         echo $pad.'            '.$article['title']."\n";
         echo $pad.'         </div>'."\n";
         echo $pad.'         <div class="content">'."\n";
         echo $pad.join("\n            ", explode("\n", $article['contents']))."\n";
         echo $pad.'         </div>'."\n";
         echo $pad.'         <span class="more">'."\n";
         echo $pad.'            <a href="?article='.$article['BID'].'">Continue reading &rarr;</a>'."\n";
         echo $pad.'         </span>'."\n";
         echo $pad.'         <div class="additional">'."\n";
         echo $pad.'            <div class="comments" title="Comments">'."\n";
         echo $pad.'               '.$article['comments'].' Comment'.($article['comments']>1? 's' : '')."\n";
         echo $pad.'            </div>'."\n";
         echo $pad.'            <div class="tags" title="Tags">'."\n";
         echo $pad.'               <span>'.join(explode(' ', $article['tags']), '</span> <span>').'</span>'."\n";
         echo $pad.'            </div>'."\n";
         echo $pad.'         </div>'."\n";
         echo $pad.'      </div>'."\n";
         echo $pad.'   </div>'."\n";
         echo $pad.'</div>'."\n";
      }

      $pad = substr($pad, 0, -3);
      echo "\n".$pad.'</div>'."\n";
   }
}
foot:{
   echo '</body>'."\n";
   echo '</html>'."\n";
}
exit;
?>

<div class="menus">

   <div class="menu">
      <div class="header">
         Archive
      </div>
      <div class="content">
         <ul>
            <li>2012</li>
            <li>2011</li>
            <li>2010</li>
         </ul>
      </div>
   </div>

</div>