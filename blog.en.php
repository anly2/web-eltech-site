<?php
session_start();
include "mysql.php";
include_once "wrapper.frame.en.php";
$page = 'blog';

$_SESSION['admin'] = isset($_SESSION['user'])? (mysql_("SELECT UID FROM users WHERE Username='".$_SESSION['user']."' AND Rights>5",true)>0) : false;

if(isset($_SESSION['user']) && isset($_SESSION['admin']) && $_SESSION['admin']){
   if(isset($_REQUEST['new'])){
      $_REQUEST['content'] = str_replace(array("&lt;", "&gt;"), array("<", ">"), $_REQUEST['content']);

      mysql_("INSERT INTO blog values(".
         mysql_("SELECT MAX(BID)+1 FROM blog").", ".
         "'".trim(addslashes($_REQUEST['title']))."', ".
         "'".$_SESSION['user']."', ".
         "'".trim(addslashes($_REQUEST['content']))."', ".
         trim(addslashes($_REQUEST['category'])).", ".
         '0'.", ".
         "'', ".
         "NOW()".
      ")");

      echo '<script type="text/javascript">window.location.href="?";</script>'."\n";
      exit;
   }
   if(isset($_REQUEST['edit'])){
      $_REQUEST['content'] = str_replace(array("&lt;", "&gt;"), array("<", ">"), $_REQUEST['content']);

      mysql_("UPDATE blog SET ".
         "Title = '".trim(addslashes($_REQUEST['title']))."', ".
         "Author ='".$_SESSION['user']."', ".
         "Contents = '".trim(addslashes($_REQUEST['content']))."', ".
         "Category = ".trim(addslashes($_REQUEST['category'])).", ".
         "Date = NOW()".
      " WHERE BID = ".trim(addslashes($_REQUEST['BID'])) );

      echo '<script type="text/javascript">window.location.href="?";</script>'."\n";
      exit;
   }
   if(isset($_REQUEST['remove'])){
      mysql_("DELETE FROM blog WHERE BID = ".trim(addslashes($_REQUEST['remove'])) );

      echo '<script type="text/javascript">window.location.href="?";</script>'."\n";
      exit;
   }
}

$sql  = "SELECT ";
$sql .= "a.BID as BID, a.Title as title, a.Author as author, b.Name as category, a.Date as date, a.Contents as contents, a.Comments as comments, a.Tags as tags ";
$sql .= "FROM blog as a, blog_categories as b ";
$sql .= "WHERE a.Category = b.Category ";
$sql .= "ORDER BY date DESC";
$articles = mysql_($sql, MYSQL_ASSOC|MYSQL_TABLE);

head:{
   echo '<html>'."\n";
   echo '<head>'."\n";

   echo "\n", wrapper_frame_head('   '), "\n";

   echo '</head>'."\n";
   echo '<body>'."\n";
}
body:{
   $pad = '';

   echo "\n", wrapper_frame_header($pad), "\n";

   echo "\n".$pad.'<div class="contents">'."\n\n";
   $pad .= '   ';

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
         echo $pad.'   <div class="top">'."\n";
         echo $pad.'      <div class="category">'.ucfirst(strtolower($article['category'])).'</div>'."\n";
         echo $pad.'      <div class="date">'.date_format(date_create($article['date']), 'j F Y').'</div>'."\n";
         if($_SESSION['admin']){
            echo $pad.'      <span class="control">'."\n";
            echo $pad.'         <a href="editor.en.php?inspiration='.$article['BID'].'">New</a>'."\n";
            echo $pad.'         <a href="editor.en.php?edit='.$article['BID'].'">Edit</a>'."\n";
            echo $pad.'         <a href="#remove" onclick="if(confirm(\'Are you sure you want to delete this post?\')) window.location.href=\'?remove='.$article['BID'].'\';">Delete</a>'."\n";
            echo $pad.'      </span>'."\n";
         }
         echo $pad.'   </div>'."\n";
         echo $pad.'   <div>'."\n";
         echo $pad.'      <div class="header">'.$article['title'].'</div>'."\n";
         echo $pad.'      <div class="author"><a href="?search&user='.strtolower($article['author']).'">'.$article['author'].'</a></div>'."\n";
         echo $pad.'      <div class="content">'."\n";
         echo $pad.'         '.join("\n".$pad."         ", explode("\n", $article['contents']))."\n";
         echo $pad.'      </div>'."\n";
         echo $pad.'      <div class="continue">'."\n";
         echo $pad.'         <a href="?article='.$article['BID'].'">Read More</a>'."\n";
         echo $pad.'      </div>'."\n";
         echo $pad.'   </div>'."\n";
         echo $pad.'   <div class="bottom">'."\n";
         echo $pad.'      <div class="comments" title="Comments">'."\n";
         echo $pad.'         <a href="?article='.$article['BID'].'&comments">'.$article['comments'].' Comment'.($article['comments']!=1? 's' : '').'</a>'."\n";
         echo $pad.'      </div>'."\n";
         echo $pad.'      <div class="tags" title="Tags">'."\n";
         echo $pad.'         <span>'.join(explode(' ', $article['tags']), '</span> <span>').'</span>'."\n";
         echo $pad.'      </div>'."\n";
         echo $pad.'   </div>'."\n";
         echo $pad.'</div>'."\n";
      }

      $pad = substr($pad, 0, -3);
      echo "\n".$pad.'</div>'."\n";
   }

   $pad = substr($pad, 0, -3);
   echo "\n".$pad.'</div>'."\n\n";

   echo "\n", wrapper_frame_footer($pad), "\n";
}
end:{
   echo '</body>'."\n";
   echo '</html>'."\n";
}
?>