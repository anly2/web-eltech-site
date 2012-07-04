	<?php
		require('../templates/header.php');
	?>
        <div id="content" style="width: 1000px;">
            <?php
				include('../config.php');
				mysql_set_charset('utf8');
				$news_id = mysql_real_escape_string($_GET['news_id']);
				$sql_get_news_det="SELECT news_header, news_content	FROM news WHERE P_Id = $news_id";
			    $result_select_my_news=mysql_query($sql_get_news_det);
			    while($row_news=mysql_fetch_assoc($result_select_my_news)){
				$news_header=$row_news['news_header'];
				$news_content=$row_news['news_content'];		
				if(isset($_REQUEST['update'])){
					echo "bau";
				}
			?>

            
				<script>
				$(document).ready(function() {
					$("#tabStrip").kendoTabStrip();
				});</script>
            <div id="tabStrip">
                <ul>
					<li class="k-state-active">Редактирай</li>
					<li>Дата</li>
				</ul>
				<div style="float: right;">
					<form action="?news_id=<?php echo $news_id; ?>" method="post" style="float: left;">
     					<div id="example" class="k-content">
							<textarea id="editor" name="news_content" rows="10" cols="30" style="width:460px;height:440px">
								<?php echo $news_content;?>
							</textarea>
							<script>
								$(document).ready(function() {
									$("#editor").kendoEditor();
								});
							</script>
						</div>
     					
     					<input name="submit" type="submit" value="Изпрати"/>
     					<?php } ?>
     				</form>
					<div style="clear:both;"></div>
				</div>
				<div>Second tab content
					
				</div>
			</div>
     				
     				<?php
     					if(isset($_REQUEST['submit'])){
     					
     					mysql_query("UPDATE news SET news_content='".$_POST['news_content']."' WHERE P_Id='".$news_id."'");
     					echo '<script type="text/javascript"> window.location.href = "show.php"; </script>';}
     				?>
     	</div>

			</div>
		</div>
	</body>
</html>