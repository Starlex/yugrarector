<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/db.php';
include 'block/header.php';
include 'block/menu.php';
?>
<div id="content">

<h1 style="text-align:center">Удалить галерею</h1>

<form id="form1" name="form1" method="post" action="delete_gallery_save.php">

<label style="font-weight: bold">Выберите галерею:</label><br />
<select name = "names">
<option selected value = "">-- не выбрано --</option>
<?php
$sql_name = "SELECT g_id, g_name, g_rus_name FROM rectorugra_gallery";
$query_name = mysql_query($sql_name);
while ($row_name = mysql_fetch_assoc($query_name))
{
	echo '<option value = "'.$row_name['g_id'].'">'.str_replace("_", " ", $row_name['g_rus_name']).'</option>';
}
?>
</select>&nbsp;
<input type = "submit" value = "Удалить"><br /><br />
</form>

</div>

<?php include 'block/footer.php';?>