<?php
include_once 'wrapper.frame.en.php';
?>

<?php
$duration = 19000; //ms

if(!isset($_REQUEST['p']))
   header("Location: index.en.php");

if($_REQUEST['p'] == 0){
   $redir = 'https://skydrive.live.com/redir?resid=D809A0228D4D51A7!937&authkey=!AP8b-TTjdC8Tl5E&app=PowerPoint';
   $local = 'Tok_v_poluprovodnici_1.ppt';
}
if($_REQUEST['p'] == 1){
   $redir = 'https://skydrive.live.com/redir?resid=D809A0228D4D51A7!906&authkey=!AEA4y34Mk5MjFXI&app=PowerPoint';
   $local = 'Tok_v_poluprovodnici_2.pptx';
}
if($_REQUEST['p'] == 2){
   $redir = 'https://skydrive.live.com/redir?resid=D809A0228D4D51A7!935&authkey=!AJvnOIfFtZQKjMA&app=PowerPoint';
   $local = 'Elektrotehnika.pptx';
}
?>
<html>
<head>
<?php wrapper_frame_head('   '); ?>

<style type="text/css">
#notice .container{
   transition:width <?php echo $duration/1000; ?>s;
   -moz-transition:width <?php echo $duration/1000; ?>s; /* Firefox 4 */
   -webkit-transition:width <?php echo $duration/1000; ?>s; /* Safari and Chrome */
   -o-transition:width <?php echo $duration/1000; ?>s;"
}
</style>

</head>
<body>

<?php wrapper_frame_header(); ?>

<div id="notice">
   It is recommended that you download the presentation and view it in PowerPoint.
   <br />That way any loss of effects will be avoided.
   <br /><br />

   <div class="centered">
         <a href="<?php echo $local; ?>" onclick="clearTimeout(redir); var s = document.getElementById('spread'); s.className=s.className.split('spread').join('');">Download</a>
   </div>

   <div class="centered" style="width: 4em;">
      <div class="container" id="spread">
         <a href="<?php echo $redir; ?>">Continue</a>
      </div>
   </div>
</div>

<script type="text/javascript">
   redir = setTimeout( 'window.location.href="<?php echo $redir; ?>";', <?php echo $duration+100; ?>);
   setTimeout( 'document.getElementById("spread").className+=" spread";', 100);
</script>

<?php wrapper_frame_footer();?>

</body>
</html>