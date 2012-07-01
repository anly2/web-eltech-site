<?php
include "mysql.php";
include_once 'wrapper.frame.php';
?>
<html>
<head>
<?php wrapper_frame_head('   '); ?>

    <script src="kendo/kendo.web.min.js"></script>
    <script src="kendo/console.js"></script>
    <link href="kendo/styles/kendo.common.min.css" rel="stylesheet" />
    <link href="kendo/styles/kendo.blueopal.min.css" rel="stylesheet" />
</head>
<body>

<?php wrapper_frame_header(); ?>

<?php
if(isset($_REQUEST['inspiration'])){
   $category = mysql_("SELECT Category FROM blog WHERE BID=".trim(addslashes($_REQUEST['inspiration'])));
}else
if(isset($_REQUEST['edit'])){
   $post = mysql_("SELECT * FROM blog WHERE BID=".trim(addslashes($_REQUEST['edit'])), MYSQL_ASSOC);

   $title = $post['Title'];
   $category = $post['Category'];
   $contents = $post['Contents'];
}
?>

<div class="contents" style="text-align: center;">
   <form action="blog.php?<?php echo (isset($_REQUEST['edit'])? 'edit' : 'new'); ?>" method="POST">
   <?php
      if(isset($_REQUEST['edit'])) echo '      <input type="hidden" name="BID" value="'.$_REQUEST['edit'].'" />'."\n";
   ?>
      <table width="100%" style="min-width: 700px;">
         <tr>
            <td align="left">

               <label>
                  Заглавие<br />
                  <input type="text" name="title" <?php if(isset($title)) echo 'value="'.$title.'" '; ?>/>
               </label>

            </td>
            <td width="160" align="right">

               <label style="margin-left: 20px;">
                  Категория<br />
                  <select name="category">
                     <?php
                     $categories = mysql_("SELECT Category, BG_Name FROM blog_categories", MYSQL_ASSOC);
                     foreach($categories as $i=>$c)
                        echo '            <option value="'.$c['Category'].'"'.((isset($category) && $category==$i)? ' selected' : '').'>'.$c['Name'].'</option>'."\n";
                     ?>
                  </select>
               </label>

            </td>
         </tr>
      </table>

      <textarea id="editor"  name="content" rows="10" cols="30"><?php if(isset($contents)) echo $contents; ?></textarea>
      <script type="text/javascript">$(document).ready(function(){ $("#editor").kendoEditor(); });</script>

      <input type="submit" value="Submit" />
   </form>
</div>

<?php wrapper_frame_footer();?>

</body>
</html>