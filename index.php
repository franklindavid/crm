<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bienvenido</title>
</head>
<body>
	<form id= "iniciar" method="post" onsubmit="iniciarsesion(); return false">
		<center>
			<input type="text" name="user" required>
			<br>
			<input type="password" name="password" required>
			<br>
			<input type="submit">	
		</center>	
	</form>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>	
</body>
</html>