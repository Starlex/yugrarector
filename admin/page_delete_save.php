<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/header.php';
include 'block/menu.php';
?>

<div id="content">
<?php
include 'block/db.php';

if(isset($_POST['names'])){
	$p_id = $_POST['names'];

	if($p_id == "")
		die('<h3>Выберите страницу для удаления. <br /><a href="page_delete.php">Назад</a></h3>');

	$sql = "DELETE FROM rectorugra_page WHERE p_id = '".$p_id."'";
	$query_sql = mysql_query($sql)or die(mysql_error());

	if ($query_sql)
	{
		echo '<h2>Страница удалена. <br /><a href = "page_delete.php">Назад</a></h2>';
	}
	else
	{
		echo '<h2>Ошибка при удалении. Страница не удалена. Повторите попытку позже. <br /><a href = "page_delete.php">Назад</a></h2>';
	}
}
?>
</div>

<?php include 'block/footer.php';?>