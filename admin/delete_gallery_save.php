<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/header.php';
include 'block/menu.php';
include 'block/fun_lib.php';
include 'block/db.php';
?>

<div id="content">
<?php
if(isset($_POST['names'])){
	$g_id = $_POST['names'];
	if($g_id == "")
	{
		die('<h2>Выберите галерею для удаления. <br /><a href="delete_gallery.php">Назад</a></h2>');
	}
	
	$sql_del = "SELECT g_path FROM rectorugra_gallery WHERE g_id = '".$g_id."'";
	$query_del = mysql_query($sql_del);
	$row_del = mysql_fetch_assoc($query_del);
    if(!is_dir($row_del['g_path']))
    {
        die('<h2>Галерея не обнаружена. <br /><a href="delete_gallery.php">Назад</a></h2>');
    }
	$remDir = removeDirectory($row_del['g_path']);

	$sql = "DELETE FROM rectorugra_gallery WHERE g_id = '".$g_id."'";
	$query = mysql_query($sql) or die(mysql_error());

	if ($query)
	{
		echo '<h2>Галерея удалена. <br /><a href = "delete_gallery.php">Назад</a></h2>';
	}
	else
	{
		echo '<h2>Ошибка при удалении. Галерея не удалена. Повторите попытку позже. <br /><a href = "delete_gallery.php">Назад</a></h2>';
	}
}
?>
</div>

<?php include 'block/footer.php';?>