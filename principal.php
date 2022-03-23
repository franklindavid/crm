<?php 
session_start();
if (!isset($_SESSION['user'])){	
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Principal</title>
</head>
<body>
	bienvenido <?php echo $_SESSION['user']; ?>	 
	 <a href="php/sessiondestroy.php">Cerrar sesion</a>
</body>
</html>