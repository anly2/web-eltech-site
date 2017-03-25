<?php
if(count($_GET)==1)
   $pic = key($_GET);
else if(isset($_REQUEST['pic']))
   $pic = $_REQUEST['pic'];
//else
//   exit;


$file = 'Gallery/'.'08.04.2012/100_7353.JPG';
    $type = 'image/jpeg';
    header('Content-Type:'.$type);
    header('Content-Length: ' . filesize($file));
    readfile($file);


?>