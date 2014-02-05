<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/db.php'; //подключение к БД
include 'block/header.php';
include 'block/menu.php';
include 'block/fun_lib.php'
?>

<div id="content">
<?php

if (isset($_POST)) //если данные из формы поступили...
{
	//...присваиваем их переменным...
	$oldName = $_POST['oldName'];
	$p_id = $_POST['p_id'];
    $p_name = str_replace(" ", "_", $_POST['p_name']);
    $p_rus_name = str_replace(" ", "_", $_POST['p_rus_name']);
	$p_content = $_POST['p_content'];
	if(isset($_POST['parrents']))
		$p_parrent = $_POST['parrents'];
	else
		$p_parrent = '';
	
	//...проверяем заполнены ли необходимые поля...
	if ($p_rus_name == '')
	{
		echo '<h2>Страница не отредактирована. Заполните все поля формы. <br /><a href = "content_change.php">Назад</a></h2>';
	}
	
	//...обезопасим запрос...
	$p_name = mysql_real_escape_string(trim(strip_tags($p_name)));
	$p_rus_name = mysql_real_escape_string(trim(strip_tags($p_rus_name)));
	
	$sql = "SELECT p_id, p_rus_name FROM rectorugra_page";
	$query = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_assoc($query))
	{
		if ($row['p_rus_name'] == $p_rus_name)
		{
			$eq = false;
		}
		else
		{
			$eq	= true;
		}
	}
	
	if($eq == true or $p_rus_name = $oldName or $p_name != 'sostav')
	{
		//...записываем измененные данные в базу...
		$sql = "UPDATE rectorugra_page SET p_name = '$p_name', p_content = '$p_content', p_rus_name = '$p_rus_name', p_parrent = '$p_parrent' WHERE p_id = '$p_id'";
		$query_sql = mysql_query($sql);
		//...и выдаем результат пользователю
		if ($query_sql)
		{
			echo '<h2>Страница отредактированна. <br /><a href = "content_change.php">Назад</a></h2>';
		}
		else
		{
			echo '<h2>Страница не отредактированна. Повторите попытку позже. <br /><a href = "content_change.php">Назад</a></h2>';
			die();
		}
	}
	else
	{
		echo '<h2>Страница с таким именем уже существует. <br /><a href = "content_change.php">Назад</a></h2>';
	}
}

?>
</div>

<?php include 'block/footer.php';?>