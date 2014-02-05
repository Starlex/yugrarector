<?php 

//Авторизация в админ зоне
session_start();

if(isset($_SESSION['u_login']))
{
	$u_login = $_SESSION['u_login'];
}
if(!$u_login)
{
	header('Location:login.php');
}

?>