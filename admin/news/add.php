	<?php
		include('../templates/header.php');
		include('../config.php');
		mysql_set_charset('utf8');
	?>
			<div id="content">
				<h1>Добавяне на новина</h1>
				<form method="post">
					<div id="example" class="k-content">
						<textarea id="editor" name="news_content" rows="10" cols="30" style="width:480px;height:440px"></textarea>
						<input type="submit" name="submit" value="Изпрати" />
						<script>
							$(document).ready(function() {
								$("#editor").kendoEditor();
							});
						</script>
					</div>
					<?php
						$date=date("Y-m-d");
						/*$decoded=($_POST[news_content]);
						$decoded1=html_entity_decode($decoded);*/
     					if(isset($_REQUEST['submit'])){
							mysql_query("INSERT INTO news (news_header, news_content, news_date)
							VALUES ('html_entity_decode($_POST[news_content])', '$_POST[news_content]','$date')
							");
     					echo '<script type="text/javascript"> window.location.href = "show.php"; </script>';}						
     				?>
				</form>
			</div>
		</div>
	</body>
</html>