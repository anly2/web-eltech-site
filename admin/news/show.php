<?php
require('../templates/header.php');
?>

			<div id="content">
				<div style="width: 960px;">
					<div id="contentHeader" style="width: 100%; line-height: 40px; background-color: #4b8ef9; border-top-left-radius: 15px; border-top-right-radius: 15px; text-align: center;">
						<h1 style="color: #fff;">Новини</h1>
					</div>
					<table class="table">
						<thead>
							<tr>
								<td id="pId">№</td>
								<td id="news_content">Съдържание</td>
								<td id="news_date">Дата</td>
								<td id="action_edit">Редактирай</td>
								<td id="action_delete">Изтрий</td>
							</tr>
						</thead>
				
					<?php
							include('../config.php');
							$sql_select_my_news="SELECT P_Id, news_content, news_date FROM news ORDER BY P_Id ";
							$result_select_my_news=mysql_query($sql_select_my_news);
							while($row_news=mysql_fetch_array($result_select_my_news)){
							$news_id=$row_news['P_Id'];
							$news_content=$row_news['news_content'];
							$news_date=$row_news['news_date'];
					?>
						<tr>
							<td ><?php echo $news_id; ?></td>
							<td style="height: 35px; max-width: 550px;"><span><?php $news_content1=html_entity_decode($news_content); echo $news_content1;/*substr("$news_content1",0,50);*/  ?></span></td>
							<td><span><?php echo $news_date;?></span></td>						
							<td><span><a href="edit.php?news_id=<?php echo $news_id?>">Редактирай</a></span></td>
							<td><span>[<a href="">Изтрий</a>]</span></td>
						</tr>
					<?php } ?>					
					</table>
				</div>
			</div>
		</div>
	</body>
</html>