<?php 
require_once '../admin/block/db.php';
require_once 'block/fun_lib.php';
require_once 'block/header.php';
require_once 'block/menu.php';
if(!isset($_POST['sub'])){
?>

<div id="content">
	<div class="concform">
		<h2>КОНЦЕПЦИЯ РАЗВИТИЯ НАУКИ И ИННОВАЦИЙ И ПЛАН МЕРОПРИЯТИЙ (ДОРОЖНАЯ КАРТА) В ХАНТЫ-МАНСИЙСКОМ АВТОНОМНОМ ОКРУГЕ - ЮГРА НА ПЕРИОД ДО 2020 ГОДА</h1>
		<form name="someform" method="post" action="" enctype="multipart/form-data">
			<label>
				<span>Ф.И.О.</span>
				<input type="text" name="fio" id="" size="50">
			</label>
			<label>
				<span>Организация</span>
				<input type="text" name="org" id="" size="50">
			</label>
			<label>
				<span>I. Введение (до 1000 знаков)</span>
				<i class="txtLen" id="idI2"></i>
				<textarea name="I" id="idI" rows="10" onBlur='txtLength("idI", "idI2");'></textarea>
			</label>
			<label>
				<span>II. Тенденции развития науки и инноваций в России (до 3000 знаков)</span>
				<i class="txtLen" id="idII2"></i>
				<textarea name="II" id="idII" rows="10" onBlur='txtLength("idII", "idII2");'></textarea>
			</label>
			<label>
				<span>III. Современное состояние развития науки и инноваций в Ханты-Мансийском автономном округе - Югра (до 5000 знаков)</span>
				<i class="txtLen" id="idIII2"></i>
				<textarea name="III" id="idIII" rows="10" onBlur='txtLength("idIII", "idIII2");'></textarea>
			</label>
			<label>
				<span>IV. Цели и задачи развития науки и инноваций в Ханты-Мансийском автономном округе - Югра (до 3000 знаков)</span>
				<i class="txtLen" id="idIV2"></i>
				<textarea name="IV" id="idIV" rows="10" onBlur='txtLength("idIV", "idIV2");'></textarea>
			</label>
			<label>
				<span>V. Основные направления и этапы реализации Концепции:</span>
			</label>
			<label>
				<span>Направление 1. Фундаментальные и прикладные научные исследования (до 2000 знаков)</span>
				<i class="txtLen" id="idV12"></i>
				<textarea name="V1" id="idV1" rows="10" onBlur='txtLength("idV1", "idV12");'></textarea>
			</label>
			<label>
				<span>Направление 2. Формирование современной материально-технической базы сектора исследований и разработок (до 2000 знаков)</span>
				<i class="txtLen" id="idV22"></i>
				<textarea name="V2" id="idV2" rows="10" onBlur='txtLength("idV2", "idV22");'></textarea>
			</label>
			<label>
				<span>Направление 3. Международное сотрудничество в сфере науки (до 2000 знаков)</span>
				<i class="txtLen" id="idV32"></i>
				<textarea name="V3" id="idV3" rows="10" onBlur='txtLength("idV3", "idV32");'></textarea>
			</label>
			<label>
				<span>Направление 4. Повышение качества кадрового потенциала науки и инноваций и разработка и внедрение механизмов эффективного контракта (до 2000 знаков)</span>
				<i class="txtLen" id="idV42"></i>
				<textarea name="V4" id="idV4" rows="10" onBlur='txtLength("idV4", "idV42");'></textarea>
			</label>
			<label>
				<span>VI. Механизмы реализации Концепции (до 3000 знаков)</span>
				<i class="txtLen" id="idVI2"></i>
				<textarea name="VI" id="idVI" rows="10" onBlur='txtLength("idVI", "idVI2");'></textarea>
			</label>
			<label>
				<span>VII. Целевые индикаторы реализации Концепции (до 3000 знаков)</span>
				<i class="txtLen" id="idVII2"></i>
				<textarea name="VII" id="idVII" rows="10" onBlur='txtLength("idVII", "idVII2");'></textarea>
			</label>
			<label>
				<span>VIII. План мероприятий по реализации Концепции (в виде отдельного файла до 4000 знаков. Размер файла не должен превышать 5 мегабайт)</span>
				<input type="file" name="VIII">
			</label>
			<input name="sub" type="submit" value="Отправить">
		</form>
	</div>

<?php
}
if(isset($_POST['sub'])){
	$fio = mysql_real_escape_string(strip_tags(trim($_POST['fio'])));
	$org = mysql_real_escape_string(strip_tags(trim($_POST['org'])));
	$I = mysql_real_escape_string(strip_tags(trim($_POST["I"])));
	$II = mysql_real_escape_string(strip_tags(trim($_POST["II"])));
	$III = mysql_real_escape_string(strip_tags(trim($_POST["III"])));
	$IV = mysql_real_escape_string(strip_tags(trim($_POST["IV"])));
	$V1 = mysql_real_escape_string(strip_tags(trim($_POST["V1"])));
	$V2 = mysql_real_escape_string(strip_tags(trim($_POST["V2"])));
	$V3 = mysql_real_escape_string(strip_tags(trim($_POST["V3"])));
	$V4 = mysql_real_escape_string(strip_tags(trim($_POST["V4"])));
	$VI = mysql_real_escape_string(strip_tags(trim($_POST["VI"])));
	$VII = mysql_real_escape_string(strip_tags(trim($_POST["VII"])));
	$VIII = mysql_real_escape_string(strip_tags(trim(rus2translit(time().'-'.$_FILES["VIII"]["name"]))));
	$fsize = $_FILES['VIII']['size'];
	$tmp_name = $_FILES['VIII']['tmp_name'];
	$ext = strtolower(pathinfo($VIII, PATHINFO_EXTENSION));
	$dest = "./files/";
	$path = $dest.$VIII;
	$allowedfiles = array('doc', 'docx', 'xls', 'xlsx');

	if($fio == "" || $org == "" || $I == "" || $II == "" || $III == "" || $IV == "" || $V1 == "" || $V2 == "" || $V3 == "" || $V4 == "" || $VI == "" || $VII == "" || $VII == ""){
		echo '<h3><p>Вы не заполнили все поля формы.</p><a href="">Назад</a></h3></div>';
		require_once '../blocks/footer.php';
		exit;
	}
	/*if(strlen($I) > 1000 || strlen($II) > 3000 || strlen($III) > 5000 || strlen($IV) > 3000 || strlen($V1) > 2000 || strlen($V2) > 2000 || strlen($V3) > 2000 || strlen($V4) > 2000 || strlen($VI) > 3000 || strlen($VII) > 3000){
		echo '<h3><p>Одно из текстовых полей превышает допустимое количество символов.</p><a href="">Назад</a></h3></div>';
		require_once '../blocks/footer.php';
		exit;
	}*/
	if($fsize > 5242880){
		echo '<h3><p>Размер загружаемого вами файла слишком велик.</p><a href="">Назад</a></h3></div>';
		require_once '../blocks/footer.php';
		exit;
	}
	if(!in_array($ext, $allowedfiles)){
		echo '<h3><p>Загрузка данного типа файла запрещена.</p><a href="">Назад</a></h3></div>';
		require_once '../blocks/footer.php';
		exit;
	}

	$sql = "INSERT INTO rectorugra_konc(fio, org, I, II, III, IV, V1, V2, V3, V4, VI, VII, VIII) VALUES ('$fio', '$org', '$I', '$II', '$III', '$IV', '$V1', '$V2', '$V3', '$V4', '$VI', '$VII', '$VIII')";
	$query = mysql_query($sql) or die(mysql_error());
	if($query == true){
		if(move_uploaded_file($tmp_name, $path)){
			echo '<h3><p>Ваши данные успешно сохранены.</p><a href="">Назад</a></h3>';
			$message = wordwrap("Была заполнена форма концепции развития науки и инноваций на сайте http://ректорыюгры.рф.\n", 70);
			mail('mahutov@mail.ru, staralforwork@gmail.com', 'Уведомление', $message, "From:rektoriyugri@nggu.ru");
		}
	}
	else{
		echo '<h3><p>Ошибка при сохранении данных.</p><a href="./form.php">Назад</a></h3>';
	}
}
?>
</div>
<?php
require_once '../blocks/footer.php';
?>