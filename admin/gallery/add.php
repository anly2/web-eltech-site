<?php
	require('../templates/header.php');
?>
		<div id="general">
<!--START OF LEFT COLUMN-->
			<div id="leftColumn">
				<div class="leftColumnDiv">
					<h1 class="leftColumnDivHeading">Категории</h1>
					<ul class="leftColumnDivUl">
						<li><a href="#">Папка 1</a></li>
						<li><a href="#">Папка 2</a></li>
						<li><a href="#">Папка 3</a>
							<ul style="list-style-type: none; margin: 7px 0 7px 25px;">
								<li><a href="#">Подпапка 1</a></li>
								<li><a href="#">Подпапка 2</a></li>
								<li><a href="#">Подпапка 3</a></li>
								<li><a href="#">Подпапка 4</a></li>
							</ul>
						</li>
						<li><a href="#" style="font-size: 15px; color: #fff; text-decoration: none; text-shadow: 1px 1px #000;">Папка 4</a></li>
					</ul>
				</div>
							
				<div class="leftColumnDiv">
					<h1 class="leftColumnDivHeading">Настройки</h1>
					<ul class="leftColumnDivUl">
						<li><img src="http://localhost/Zornitza/admin/img/gallery/add.png" style=" float: left; margin-right: 5px;"/><a href="add.php">Добави снимка</a></li>
						<li><a href="add_folder.php">Добави папка</a></li>
						<li><a href="#">Папка 3</a></li>
						<li><a href="#">Папка 4</a></li>
					</ul>
				</div>
			</div>
<!--END OF LEFT COLUMN-->
			
<!--START OF MAIN CONTENT-->
			<div id="content">
				<div id="contentDiv"><!--background-color: #666;-->
					<h1 id="pageInfo">Някакво заглавие</h1>
					<h3 id="imageAddress">Галерия/Папка 3/Подпапка 2</h3>
					<div id="imageList">
						<form action="upload.php" method="post" enctype="multipart/form-data">
							<label for="file">Filename:</label>
							<input type="file" name="file" id="file" /> 
							<br />
							<input type="submit" name="submit" value="Submit" />
						</form>
					</div>
				</div>							
			</div>
<!--END OF MAIN CONTENT-->
			<div style="clear: both;"></div>
		</div>