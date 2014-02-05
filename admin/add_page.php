<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/db.php'; //подключение к базе данных
include 'block/header.php';
include 'block/menu.php';
?>

<div id="content">

<?php
if(isset($_POST))
{
	//присвоение переменным данным поступившим из формы
	$p_name = str_replace(" ", "_", $_POST['p_name']);
	$p_rus_name = str_replace(" ", "_", $_POST['p_rus_name']);
	$p_content = $_POST['p_content'];
	if(isset($_POST['names'])){
		$p_submenu = '1';
		$p_parrent = $_POST['names'];
	}
	else{
		$p_submenu = '0';
		$p_parrent = '';
	}
	
	//проверка на заполнение полей
	if(($p_name == "") || ($p_rus_name == "") || ($p_parrent == ""))
	{
		die('<h2>Страница не добавлена. Заполните все поля формы.<br /> <a href="index.php">Назад</a></h2>');
	}
	
	$sql = "SELECT p_name FROM rectorugra_page";
	$query = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_assoc($query))
	{
		if($p_name == $row['p_name'])
		{
			die('<h2>Страница с таким именем(англ) уже существует. Выберите другое имя.<br />
			<a href="index.php">Назад</a></h2>');
			
		}
	}
		
	//делаем запрос безопасным
	$p_name = mysql_real_escape_string(trim(strip_tags($p_name)));
	$p_rus_name = mysql_real_escape_string(trim(strip_tags($p_rus_name)));
	
	//запрос к БД
	$sql = "INSERT INTO rectorugra_page(p_name, p_rus_name, p_content, p_submenu, p_parrent) VALUES ('$p_name', '$p_rus_name', '$p_content', '$p_submenu', '$p_parrent')";
	$query_sql = mysql_query($sql);
	
	//вывод результата на экран
	if ($query_sql){
		echo '<h2>Страница добавлена. <br /><a href = "index.php">Назад</a></h2>';
	}
	else{
		echo '<h2>Не удалось добавить страницу. Повторите попытку позже. <br /><a href = "index.php">Назад</a></h2>';
	}
}

?>

</div>

<?php include 'block/footer.php';?>