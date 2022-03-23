<?php
if(!empty($_POST)){
	session_start();
	require 'conexion.php';
	$user=$_POST['user'];
	$pass=$_POST["password"];
	$sql="SELECT * FROM usuarios WHERE username='$user'";
	$consulta=mysqli_query($conexion,$sql)or die(mysqli_error());
	if($fila=mysqli_fetch_assoc($consulta)){
		if($pass==$fila['password']){
			$_SESSION['user']=$user;
			echo "1";
		}else{
		echo "contraseña incorrecta";
	}
	}else{
		echo"usuario no existe";
	}
}
?>