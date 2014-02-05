<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/db.php'; //подключение к БД
include 'block/header.php';
include 'block/menu.php';
include 'block/fun_lib.php';
?>
<div id='content'>

<h1 style="text-align:center">Редактировать страницу</h1>

<!--форма данных для выбора страницы для редактирования-->
<form id="form1" name="form1" method="post" action="">

<label style="font-weight: bold">Выберите страницу:</label><br />
<select name = "names">
<option selected value = "">-- не выбрано --</option>
<?php
//заполнение списка данными из БД
$sql_name = "SELECT p_name, p_rus_name, p_submenu FROM rectorugra_page";
$query_name = mysql_query($sql_name) or die(mysql_error());
while ($row_name = mysql_fetch_assoc($query_name))
{
	if($row_name['p_submenu'] == '0' or $row_name['p_submenu'] == '1')
		echo "<option value = '".$row_name['p_name']."'>".str_replace("_", " ", $row_name['p_rus_name'])."</option>";
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
	if($tmp == '')
		echo "<h3>Выберите пункт меню для редактирования</h3>";
	else
	{
		$sql_edit = "SELECT p_id, p_name, p_rus_name, p_submenu, p_parrent FROM rectorugra_page WHERE p_name = '".$tmp."'";
		$query_edit = mysql_query($sql_edit) or die(mysql_error());
		$row_edit = mysql_fetch_assoc($query_edit)

			//форма для редактирования с заполненными полями
			?>
			<form id = "form2" name = "form2" method = "post" action = "content_save.php">
			<?php		
			//если выбраны главные пункты меню, то выводиться форма без возможности выбора родительского меню
			if($row_edit['p_submenu'] == '0'){
				?>
				<input name = "oldName" type = "hidden" value = <?= "'".$row_edit['p_rus_name']."'";?> />
				<input name = "p_id" type = "hidden" value = <?= $row_edit['p_id'];?> />
				<input name = "p_name" type = "hidden" value = <?= $row_edit['p_name'];?> />
				<input name = "p_rus_name" type = "hidden" value = <?= "'".$row_edit['p_rus_name']."'";?> />
				<?php
			}
			//в остальных случаях выводим форму с возможностью выбора родительского меню
			else{
				?>
				<input name = "oldName" type = "hidden" value = <?= "'".$row_edit['p_rus_name']."'";?> />
				<input name = "p_id" type = "hidden" value = <?= $row_edit['p_id'];?> />
				<input name = "p_name" type = "hidden" value = <?= $row_edit['p_name'];?> />
				<label style="font-weight: bold">Название страницы:</label><br />
				<input name = "p_rus_name" type = "text" value = <?= "'".str_replace("_", " ", $row_edit['p_rus_name'])."'";?> size = "50" /><br /><br />
				<label style="font-weight: bold">Родительское меню:</label><br />
				<?php
				$sql_parrent = "SELECT p_name, p_rus_name, p_parrent FROM rectorugra_page WHERE p_name = '".$row_edit['p_parrent']."'";
				$query_parrent = mysql_query($sql_parrent) or die(mysql_error());
				$row_parrent = mysql_fetch_assoc($query_parrent);
				?>
				<select name = "parrents">
				
				<?php
				//заполнение списка данными из БД
				$sql = "SELECT p_name, p_rus_name, p_submenu FROM rectorugra_page";
				$query = mysql_query($sql) or die(mysql_error());
				while ($row = mysql_fetch_assoc($query))
				{
					if($row['p_name'] == $row_edit['p_parrent']) //вывод родительского меню в зависимости от выбранной страницы
						echo "<option selected value = ".$row_edit['p_parrent'].">".str_replace("_", " ", $row_parrent['p_rus_name'])."</option>";
					else if($row['p_submenu'] == '0' and $row['p_name'] != 'gallery') //условие вывода только основных пунктов меню кроме галереи
						echo "<option value = ".$row['p_name'].">".str_replace("_", " ", $row['p_rus_name'])."</option>";
				}
				echo '</select><br /><br />';
			}
			?>
			
			<label style="font-weight: bold">Содержимое страницы <span style="text-decoration:underline; font-style:italic;">(<?= $row_edit['p_rus_name'];?>)</span>:</label><br />
			<!--замена <textarea> на редактор текста CKeditor-->
			<textarea class="ckeditor" name="p_content" cols="45" rows="5">
			<?php

			$sql_content= "SELECT p_name, p_content FROM rectorugra_page WHERE p_name ='".$tmp."'";
			$query_content = mysql_query($sql_content) or die(mysql_error());
			while ($row_content = mysql_fetch_assoc($query_content))
				{
					echo $row_content['p_content'];
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