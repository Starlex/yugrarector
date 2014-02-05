<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/db.php';
include 'block/header.php';
include 'block/menu.php';
?>
<div id="content">
<?php
if(isset($_POST))
{
	$oldName = $_POST['oldName'];
	$g_id = $_POST['g_id'];
	$g_name = str_replace(" ", "_", str_replace("/", "-", $_POST['g_name']));
	$g_rus_name = str_replace(" ", "_", $_POST['g_rus_name']);
	$g_description = $_POST['g_description'];
	$g_path = $_POST['g_path']; //папка в которую загружаются файлы
	
	$g_name = mysql_real_escape_string(trim(strip_tags($g_name)));
	$g_rus_name = mysql_real_escape_string(trim(strip_tags($g_rus_name)));
	$g_path = mysql_real_escape_string(trim(strip_tags($g_path)));
	
	if ($g_rus_name == '')
	{
		echo '<h2>Вы не заполнили все поля формы. Заполните все поля формы и повторите попытку.<br /> <a href="change_gallery.php">Назад</a></h2>';
		die();
	}
	
	$sql = "SELECT g_id, g_rus_name FROM rectorugra_gallery";
	$query = mysql_query($sql) or die(mysql_error());
	
	while ($row = mysql_fetch_assoc($query))
	{
		if ($row['g_rus_name'] == $g_rus_name)
		{
			$eq = false;
		}
		else
		{
			$eq = true;
		}
	}

	if ($eq == true or $g_rus_name == $oldName)//если имя уникальное или такое же как было до редактирования
	{
		$sql_gal = "UPDATE rectorugra_gallery SET g_name = '$g_name', g_rus_name = '$g_rus_name', g_description = '$g_description', g_path = '$g_path' WHERE g_id = '$g_id'" ;
		$query_gal = mysql_query($sql_gal) or die(mysql_error());

		if((is_dir($g_path)) && ($query_gal))
		{
			echo '<h2>Галерея отредактирована. <br /><br /><a href="jQuery-File-Upload/index.html?g_name='.$g_name.'">Добавить фотографии в галерею.</a>&nbsp;&nbsp;&nbsp;<a href="change_gallery.php">Редактировать другую галерею.</a></h2>';
		}
		else
		{
			echo $g_path;
			echo '<h2>При обновлении галереи произошла ошибка. Повторите попытку позже.<br /> <a href="change_gallery.php">Назад</a></h2>';
		}
	}
	else
	{
		echo '<h2>Галерея с таким именем уже существует.<br /> <a href="change_gallery.php">Назад</a></h2>';
		die();
	}
}
?>
</div>
<?php include 'block/footer.php';?>