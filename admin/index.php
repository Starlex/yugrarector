<?php 
include 'block/auth.php'; //проверка авторизации администратора
include 'block/header.php';
include 'block/menu.php';
include 'block/db.php';

?>
<script language="javascript">

function selEnable()
{
	document.getElementById('sel').disabled = '';
}

</script>
<div id='content'>

<h1 style="text-align:center">Добавить новую страницу</h1>

<!--Форма данных будущей страницы-->
<form name="new_page_form" method="post" action="add_page.php">

<label style="font-weight: bold">Название страницы (англ):</label><br />
<input name = "p_name" type = "text" value = "" size = "50"><br /><br />
<label style="font-weight: bold">Название страницы (рус):</label><br />
<input name = "p_rus_name" type = "text" value = "" size = "50"><br /><br />
<label style="font-weight: bold">Родительское меню:</label><br />
<select id = "sel" name = "names">
<option selected value = "">-- не выбрано --</option>
<?php
//заполнение списка данными из БД
$sql_name = "SELECT p_name, p_rus_name, p_submenu FROM rectorugra_page";
$query_name = mysql_query($sql_name);
while ($row_name = mysql_fetch_assoc($query_name))
{
	if($row_name['p_submenu'] == '0' and $row_name['p_name'] != 'gallery')
		echo "<option value = ".$row_name['p_name'].">".str_replace("_", " ", $row_name['p_rus_name'])."</option>";
}
?>
</select><br /><br />

<label style="font-weight: bold">Содержимое страницы:</label><br />
<!--замена <textarea> на редактор текста CKeditor-->
<textarea class="ckeditor" name="p_content" id="editor1" cols="45" rows="5"></textarea><br />

<input type = "submit" value = "Сохранить"> &nbsp;&nbsp;
<input id = "ch1" name = "reset" type = "reset" value = "Сбросить">

</form>

</div>
<?php include 'block/footer.php';?>