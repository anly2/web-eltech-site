<?php
session_start();
include_once 'wrapper.frame.en.php';

if(isset($_REQUEST['logout'])){
   session_destroy();
   echo '<script type="text/javascript">window.location.href="'.(isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : 'index.en.php' ).'";</script>'."\n";
   exit;
}

if(isset($_SESSION['user'])){
   echo '<script type="text/javascript">window.location.href="'.(isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : 'index.en.php' ).'";</script>'."\n";
   exit;
}

if(isset($_REQUEST['login'], $_REQUEST['username'], $_REQUEST['password'])){
   include "mysql";

   $user = preg_replace("/[^A-Za-z0-9_.\-]/", "", trim($_REQUEST['username']));
   $pwd  = md5(trim($_REQUEST['password']));
   unset($_REQUEST['password'], $_GET['password'], $_POST['password']);

   if(mysql_("SELECT * FROM users WHERE Username='".$user."' AND Password='".$pwd."'",true)){
      $_SESSION['user'] = $user;
      echo '<script type="text/javascript">window.location.href="'.(isset($_REQUEST['back'])? $_REQUEST['back'] : 'index.en.php' ).'";</script>'."\n";
      exit;
   }else
      $error = 'Името или паролата бяха грешни';
}

?>

<html>
<head>
<?php wrapper_frame_head('   '); ?>

</head>
<body>

<?php wrapper_frame_header(); ?>

<div class="central">
   <?php
      if(isset($error))
         echo '<div class="error">'.$error.'</div>'."\n";
   ?>
   <form action="?login" method="POST">
      <label>
         Име:<br />
         <input type="text" name="username" />
      </label>
      <br /><br />
      <label>
         Парола:<br />
         <input type="password" name="password" />
      </label>
      <?php
      if(isset($_SERVER['HTTP_REFERER']))
         echo '      <input type="hidden" name="back" value="'.$_SERVER['HTTP_REFERER'].'" />'."\n";
      ?>
      <br /><br />
      <input type="submit" value="Login" />
   </form>
</div>

<?php wrapper_frame_footer();?>

</body>
</html>