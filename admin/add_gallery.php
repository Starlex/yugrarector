<?php
include 'block/auth.php'; //проверка авторизации администратора
include 'block/db.php'; //подключение к БД
include 'block/header.php';
include 'block/menu.php';
?>
<div id='content'>

<h1 style="text-align:center">Добавить галерею</h1>
<!--форма создания новой галереи-->
<form name="gallery" method="post" action="gallery_save.php" enctype="multipart/form-data">

<label style="font-weight:bold">Название галереи(англ):</label><br /><!--имя папки в которой будут находиться фото этой галереи-->
<input name="g_name" type="text" value="" size="50" /><br /><br />

<label style="font-weight:bold">Название галереи(рус):</label><br /><!--отображаемое имя галереи-->
<input name="g_rus_name" type="text" value="" size="50" /><br /><br />

<label style="font-weight:bold">Краткое описание:</label><br /><!--КАПИТАН?!!-->
<!--замена <textarea> на редактор текста CKeditor-->
<textarea class="ckeditor" name="g_description"></textarea><br />
<input name="submit" type="submit" value="Добавить" />&nbsp; <input type="reset" value="Очистить" />

</form>

</div>

<?php include 'block/footer.php';?>