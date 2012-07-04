<?php
	session_start();
	session_destroy();
?>
	<head>
	<script>
		function timeDestroy(){
			var t=setTimeout("destroy()",3000);
		}
		function destroy(){
			window.location.href = "login.php";
		}
	</script>
	</head>
<body onLoad="timeDestroy();">
	Успешно излязохте от акаунта си!

</body>