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
	$g_name = str_replace("/", "-", str_replace(" ", "_", $_POST['g_name']));
	$g_rus_name = str_replace(" ", "_", $_POST['g_rus_name']);
	$g_description = $_POST['g_description'];
	$upload_path = '../file/galleries/'.$g_name.'/'; //папка в которую загружаются файлы
	if(!is_dir($upload_path))
	{
		mkdir($upload_path, 0777, true);
	}
	
	$g_name = mysql_real_escape_string(trim(strip_tags($g_name)));
	$g_rus_name = mysql_real_escape_string(trim(strip_tags($g_rus_name)));
	$upload_path = mysql_real_escape_string(trim(strip_tags($upload_path)));
	
	if (($g_name == '') || ($g_rus_name == ''))
	{
		echo '<h2>Вы не заполнили все поля формы. Заполните все поля формы и повторите попытку.<br /> <a href="add_gallery.php">Назад</a></h2>';
		die();
	}
	
	$sql = "SELECT * FROM rectorugra_gallery";
	$query = mysql_query($sql) or die(mysql_error());
	
	while ($row = mysql_fetch_assoc($query))
	{
		if ($row['g_name'] == $g_name)
		{
            echo '<h2>Галерея с таким именем уже существует.<br /> <a href="add_gallery.php">Назад</a></h2>';
            die();
		}
	}

	$sql_gal = "INSERT INTO rectorugra_gallery(g_name, g_rus_name, g_description, g_path) VALUES ('$g_name', '$g_rus_name', '$g_description', '$upload_path')";
	$query_gal = mysql_query($sql_gal) or die(mysql_error());

	if(is_dir($upload_path) && $query_gal)
	{
        echo '<h2>Галерея добавлена. <br /><br /><a href="File_Upload/index.php?g_name='.$g_name.'">Загрузить фотографии в галерею</a>
		&nbsp;&nbsp;&nbsp;<a href="add_gallery.php">Добавить новую галерею</a></h2>';
	}
	else
	{
		echo '<h2>При добавлении галереи произошла ошибка. Повторите попытку позже.<br /> <a href="add_gallery.php">Назад</a></h2>';
	}
}
?>
</div>
<?php include 'block/footer.php';?>