<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/db.php'; //подключение к БД
include 'block/header.php';
include 'block/menu.php';
?>
<div id='content'>

<h1 style="text-align:center">Редактировать галерею</h1>

<!--форма данных для выбора страницы для редактирования-->
<form id="form1" name="form1" method="post" action="">

<label style="font-weight: bold">Выберите галерею:</label><br />
<select name = "names">
<option selected value = "">-- не выбрано --</option>
<?php
//заполнение списка данными из БД
$sql_name = "SELECT g_name, g_rus_name FROM rectorugra_gallery";
$query_name = mysql_query($sql_name) or die(mysql_error());
while ($row_name = mysql_fetch_assoc($query_name))
{
	echo "<option value = '".$row_name['g_name']."'>".str_replace("_", " ", $row_name['g_rus_name'])."</option>";
}
?>
</select>&nbsp;&nbsp;
<input type = "submit" value = "Редактировать" /><br /><br />
</form>

<?php
// открытие и заполнение формы данными страницы после ее выбора
if(isset($_POST['names']))
{
	$tmp = $_POST['names'];
	if($tmp == "")
		echo '<h3>Выберите галерею для редактирования.</h3>';
	else
	{
		$sql_edit = "SELECT g_id, g_name, g_rus_name, g_path FROM rectorugra_gallery WHERE g_name = '".$tmp."'";
		$query_edit = mysql_query($sql_edit) or die(mysql_error());
		$row_edit = mysql_fetch_assoc($query_edit);
		?>
		<form name="galUPD" method="post" action="change_gallery_save.php">
		<input name = "oldName" type = "hidden" value = <?= "'".$row_edit['g_rus_name']."'";?> />
		<input name = "g_id" type = "hidden" value = <?= $row_edit['g_id'];?> />
		<input name = "g_name" type = "hidden" value = <?= $row_edit['g_name'];?> />
		<input name = "g_path" type = "hidden" value = <?= $row_edit['g_path'];?> />
		<label style="font-weight: bold">Название галереи:</label><br />
		<input name = "g_rus_name" type = "text" value = <?= "'".str_replace("_", " ", $row_edit['g_rus_name'])."'";?> size = "50" /><br /><br />
			
		<label style="font-weight: bold">Краткое описание:</label><br />
		<!--замена <textarea> на редактор текста CKeditor-->
		<textarea class="ckeditor" name="g_description" cols="45" rows="5">
		<?php
		$sql_content= "SELECT g_description FROM rectorugra_gallery WHERE g_name ='".$tmp."'";
		$query_content = mysql_query($sql_content) or die(mysql_error());
		while ($row_content = mysql_fetch_assoc($query_content))
		{
			echo $row_content['g_description'];
		}
		?>
		</textarea><br />

		<input type = "submit" value = "Сохранить" /> &nbsp;&nbsp;
		<input name = "reset" type = "reset" value = "Сбросить" />
<?php
	}
}
?>
</form>
</div>

<?php include 'block/footer.php';?>