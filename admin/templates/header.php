<?php
	session_start();
	if(!isset($_SESSION['loggedin']) && !isset($_SESSION['user'])){
		echo '<script type="text/javascript"> window.location.href = "login.php"; </script>';
		exit;
	}
?>
<html>
	<head>
		<title>Администраторски панел</title>
		<link rel="stylesheet" type="text/css" href="http://localhost/Zornitza/admin/css/adminstyle.css" />      
		<script src="http://localhost/Zornitza/admin/js/jquery.min.js"></script>
		<script src="http://localhost/Zornitza/admin/js/kendo.web.min.js"></script>
		<script src="http://localhost/Zornitza/admin/js/console.js"></script>
		<link href="http://localhost/Zornitza/admin/css/kendo.common.min.css" rel="stylesheet" />
		<link href="http://localhost/Zornitza/admin/css/kendo.default.min.css" rel="stylesheet" />
		<meta charset="utf-8" />
		<script>
			function showUserPref(){
				var a=document.getElementById("topLineRightPartUserDiv");
				a.style.display="block";				
			}
		</script>
	</head>
	<body>
<!--START OF HEADER-->
		<div id="header">
            <div id="innerHeaderDiv">
				<div id="innerHeaderDivLeftPart">
					<h1>Админ панел</h1>
					<a href="http://localhost/Zornitza/index.php" target="_blank"><img title="Изглед" src="http://localhost/Zornitza/admin/img/home_page.png" 
					class="logoLinkImage"/></a>
				</div>
				<div id="innerHeaderDivRightPart">
					<span id="innerHeaderDivRightPartWelcome">Добре дошъл,</span> 
					<span id="innerHeaderDivRightPartUser"  onClick="showUserPref();"><?php echo $_SESSION['user']; ?></span>
						<div id="innerHeaderDivRightPartUserDiv">
							<!--User Preferences-->	
							<a href="http://localhost/Zornitza/admin/logout.php">Изход</a>							
						</div>
					<img src="http://localhost/Zornitza/admin/img/user.png" 
					class="adminImage"/>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>			
<!--END OF HEADER-->

<!--START OF MAIN MENU-->
		<div id="menu">				
			<ul id="menuUl">
				<li class="menuUlLi"><a class="menuUlLiA" href="http://localhost/Zornitza/admin/index.php">Табло</a>
				<li class="menuUlLi"><a class="menuUlLiA" href="http://localhost/Zornitza/admin/index.php">Информация</a>
				<li class="menuUlLi" class="liSecond"><a class="menuUlLiA" href="http://localhost/Zornitza/admin/index.php">Медия</a>
					<ul class="subMenuUl">
						<li class="subMenuUlLi"><a class="subMenuUlLiA" href="http://localhost/Zornitza/admin/gallery/gallery.php">Галерия</a></li>
					</ul>
				<li class="menuUlLi" class="liSecond"><a class="menuUlLiA" href="http://localhost/Zornitza/admin/news/show.php">Новини</a>
					<ul class="subMenuUl">
						<li class="subMenuUlLi"><a class="subMenuUlLiA" href="http://localhost/Zornitza/admin/news/add.php">Добави</a></li>
						<li class="subMenuUlLi"><a class="subMenuUlLiA" href="">Редактирай</a></li>
					</ul>
				</li>
			</ul>         
  		</div>   
<!--END OF MENU-->		