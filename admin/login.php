<?php
	session_start();
	unset($_SESSION['loggedin']);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>ДТА ЗОРНИЦА</title>
	</head>
	<body>
		<div style="width: 300px; margin: 0 auto; height: 500px; position: absolute; top:10%; bottom: 10%; left:10%; right: 10%;">
			<form accept-charset="utf-8" action="login.php" method="POST">		
				Име: <input type="text" name="name" /><br/>
				Парола: <input type="password" name="password" />
				<input name="submit" type="submit" />
			</form>
		</div>
		<?php
			if(!isset($_REQUEST['submit'])) exit;
			include('config.php');
			$name=$_POST['name'];
			$password=mysql_real_escape_string($_POST['password']);
			$sql="SELECT username, password FROM admin_users WHERE username='$name' AND password='$password'";
			mysql_query($sql);
			if(mysql_affected_rows()==1){
				$_SESSION['loggedin']=true;
				$_SESSION['user']=$_POST['name'];
				echo '<script type="text/javascript"> window.location.href = "index.php"; </script>';
				exit;		
			}
			else{
				echo "Sorry. Wrong username or password.";
			}
		?>	
  </body>
</html>