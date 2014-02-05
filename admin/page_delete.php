<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/db.php';
include 'block/header.php';
include 'block/menu.php';
?>
<div id="content">

<h1 style="text-align:center">Удалить страницу</h1>

<form id="form1" name="form1" method="post" action="page_delete_save.php">

<label style="font-weight: bold">Выберите страницу:</label><br />
<select name = "names">
<option selected value = "">-- не выбрано --</option>
<?php
$sql_name = "SELECT p_id, p_rus_name, p_submenu FROM rectorugra_page";
$query_name = mysql_query($sql_name) or die(mysql_error());
while ($row_name = mysql_fetch_assoc($query_name))
	{
		if($row_name['p_submenu'] == '1' )
			echo '<option value = "'.$row_name['p_id'].'">'.str_replace("_", " ", $row_name['p_rus_name']).'</option>';
	}
?>
</select>&nbsp;
<input type = "submit" value = "Удалить"><br /><br />
</form>

</div>

<?php include 'block/footer.php';?>