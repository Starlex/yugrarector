<?php
session_start();
include 'block/db.php';

if($_POST)
{
	//присваеваем переменым данные из формы
	$u_login = $_POST['u_login'];
	$u_pass = md5($_POST['u_pass']);
	
	//делаем запрос к БД безопасным
	$u_login = mysql_real_escape_string(trim(strip_tags($u_login)));
	$u_pass = mysql_real_escape_string(trim(strip_tags($u_pass)));
	
	//запрос к БД
	$sql_auth = "SELECT count(*) FROM rectorugra_users WHERE u_login = '$u_login' AND u_pass = '$u_pass' AND u_admin = 1";
	$query_auth = mysql_query($sql_auth);
	
	//считаем колличество рядов результата запроса
	$num = mysql_fetch_row($query_auth);
	
	if($num[0] == 0) //если нет совпадений
	{
		include 'block/header.php';
		include 'block/menu.php';
		?>

		<div id="content">
		<h3>Неверные логин и/или пароль.</h3><br />
		<form name="login_form" action="login_action.php" method="post">

		<label style="font-weight: bold">Введите логин</label><br />
		<input name="u_login" type="text" /><br /><br />
		<label style="font-weight: bold">Введите пароль</label><br />
		<input name="u_pass" type="password" /><br /><br />
		<input name="submit" type="submit" value="Вход" />

		</form>

		</div>

		<?php include 'block/footer.php';
		
	}
	else
	{
		$_SESSION['u_login'] = $u_login;
		header('Location:index.php');
	}
}

?>