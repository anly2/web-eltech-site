<?php
session_start();
include "mysql.php";
include_once "wrapper.frame.php";
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


function translate($str){
   $en = array();
   $bg = array();
   equivalents:{
      $en[] = 'January'; $bg[] = 'Януари';
      $en[] = 'February'; $bg[] = 'Февруари';
      $en[] = 'March'; $bg[] = 'Март';
      $en[] = 'April'; $bg[] = 'Април';
      $en[] = 'May'; $bg[] = 'Май';
      $en[] = 'June'; $bg[] = 'Юни';
      $en[] = 'July'; $bg[] = 'Юли';
      $en[] = 'August'; $bg[] = 'Август';
      $en[] = 'September'; $bg[] = 'Септември';
      $en[] = 'October'; $bg[] = 'Октомври';
      $en[] = 'November'; $bg[] = 'Ноември';
      $en[] = 'December'; $bg[] = 'Декември';
//      $en[] = 'q'; $en[] = 'Q'; $bg[] = 'я'; $bg[] = 'Я';
//      $en[] = 'w'; $en[] = 'W'; $bg[] = 'в'; $bg[] = 'В';
//      $en[] = 'e'; $en[] = 'E'; $bg[] = 'е'; $bg[] = 'Е';
//      $en[] = 'r'; $en[] = 'R'; $bg[] = 'р'; $bg[] = 'Р';
//      $en[] = 't'; $en[] = 'T'; $bg[] = 'т'; $bg[] = 'Т';
//      $en[] = 'y'; $en[] = 'Y'; $bg[] = 'ъ'; $bg[] = 'Ъ';
//      $en[] = 'u'; $en[] = 'U'; $bg[] = 'у'; $bg[] = 'У';
//      $en[] = 'i'; $en[] = 'I'; $bg[] = 'и'; $bg[] = 'И';
//      $en[] = 'o'; $en[] = 'O'; $bg[] = 'о'; $bg[] = 'О';
//      $en[] = 'p'; $en[] = 'P'; $bg[] = 'п'; $bg[] = 'П';
//      $en[] = '['; $en[] = '{'; $bg[] = 'ш'; $bg[] = 'Ш';
//      $en[] = ']'; $en[] = '}'; $bg[] = 'щ'; $bg[] = 'Щ';
//      $en[] = '\\';$en[] = '|'; $bg[] = 'ю'; $bg[] = 'Ю';
//      $en[] = 'a'; $en[] = 'A'; $bg[] = 'а'; $bg[] = 'А';
//      $en[] = 's'; $en[] = 'S'; $bg[] = 'с'; $bg[] = 'С';
//      $en[] = 'd'; $en[] = 'D'; $bg[] = 'д'; $bg[] = 'Д';
//      $en[] = 'f'; $en[] = 'F'; $bg[] = 'ф'; $bg[] = 'Ф';
//      $en[] = 'g'; $en[] = 'G'; $bg[] = 'г'; $bg[] = 'Г';
//      $en[] = 'h'; $en[] = 'H'; $bg[] = 'х'; $bg[] = 'Х';
//      $en[] = 'j'; $en[] = 'J'; $bg[] = 'й'; $bg[] = 'Й';
//      $en[] = 'k'; $en[] = 'K'; $bg[] = 'к'; $bg[] = 'К';
//      $en[] = 'l'; $en[] = 'L'; $bg[] = 'л'; $bg[] = 'Л';
//      $en[] = 'z'; $en[] = 'Z'; $bg[] = 'з'; $bg[] = 'З';
//      $en[] = 'x'; $en[] = 'X'; $bg[] = 'ь'; $bg[] = 'Ь';
//      $en[] = 'c'; $en[] = 'C'; $bg[] = 'ц'; $bg[] = 'Ц';
//      $en[] = 'v'; $en[] = 'V'; $bg[] = 'ж'; $bg[] = 'Ж';
//      $en[] = 'b'; $en[] = 'B'; $bg[] = 'б'; $bg[] = 'Б';
//      $en[] = 'n'; $en[] = 'N'; $bg[] = 'н'; $bg[] = 'Н';
//      $en[] = 'm'; $en[] = 'M'; $bg[] = 'м'; $bg[] = 'М';
   }
   return str_replace($en, $bg, $str);
}


$sql  = "SELECT ";
$sql .= "a.BID as BID, a.Title as title, a.Author as author, b.BG_Name as category, a.Date as date, a.Contents as contents, a.Comments as comments, a.Tags as tags ";
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
         $categories = mysql_("SELECT Category as cid, BG_Name as name FROM blog_categories", MYSQL_ASSOC);

         echo $pad.'<div class="menu">'."\n";
         echo $pad.'   <div class="header">'."\n";
         echo $pad.'      Категории'."\n";
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
         echo $pad.'      Архив'."\n";
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
      echo $pad.'   <style type="text/css">'."\n";
      echo $pad.'   .article .author:before{ content: "От ";}'."\n";
      echo $pad.'   </style>'."\n\n";
      $pad .= '   ';

      foreach($articles as $article){
         if(isset($first)) echo "\n"; else $first = false;

         echo $pad.'<div class="article">'."\n";
         echo $pad.'   <div class="top">'."\n";
         echo $pad.'      <div class="category">'.ucfirst(strtolower($article['category'])).'</div>'."\n";
         echo $pad.'      <div class="date">'.translate(date_format(date_create($article['date']), 'j F Y')).'</div>'."\n";
         if($_SESSION['admin']){
            echo $pad.'      <span class="control">'."\n";
            echo $pad.'         <a href="editor.php?inspiration='.$article['BID'].'">Ново</a>'."\n";
            echo $pad.'         <a href="editor.php?edit='.$article['BID'].'">Промени</a>'."\n";
            echo $pad.'         <a href="#remove" onclick="if(confirm(\'Сигурни ли сте че искате да изтриете този пост?\')) window.location.href=\'?remove='.$article['BID'].'\';">Изтрии</a>'."\n";
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
         echo $pad.'         <a href="?article='.$article['BID'].'">Повече</a>'."\n";
         echo $pad.'      </div>'."\n";
         echo $pad.'   </div>'."\n";
         echo $pad.'   <div class="bottom">'."\n";
         echo $pad.'      <div class="comments" title="Коментари">'."\n";
         echo $pad.'         <a href="?article='.$article['BID'].'&comments">'.$article['comments'].' Коментар'.($article['comments']!=1? 'а' : '').'</a>'."\n";
         echo $pad.'      </div>'."\n";
         echo $pad.'      <div class="tags" title="Ключови думи">'."\n";
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