<?php 

//Выход из административной зоны
//открываем сессию
session_start();
//уничтожаем сессисионную переменную
$_SESSION['u_login'];
session_destroy();
header('Location:../index.php');

?>