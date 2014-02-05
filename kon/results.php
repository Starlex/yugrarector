<?php 
require_once '../admin/block/db.php';
require_once '../admin/block/fun_lib.php';
require_once 'block/header.php';
require_once 'block/menu.php';
?>
<div id="content">
	<form name="result" method="post" action="">
		<select name="author">
			<option value="" selected>-- Выберите автора --</optinon>
			<?php
			$sql = "SELECT id, fio FROM rectorugra_konc";
			$query = mysql_query($sql) or die(mysql_error());
			while($row = mysql_fetch_assoc($query)){
				?>
				<option value="<?=$row['id'];?>"><?=$row['fio'];?></optinon>
				<?php
			}	
			?>
		</select>  
		<input name="send" type="submit" value="Показать">
	</form><br><br>
<?php
	if(isset($_POST['send'])){
		$author_id = $_POST['author'];
		
		if($author_id === ""){
			echo "<h3>Вы не выбрали автора.</h3>";
			require_once '../blocks/footer.php';
			exit;
		}
		
		$sql = "SELECT * FROM rectorugra_konc WHERE id = '$author_id'";
		$query = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($query)
		?>
		<h2>Ф.И.О.</h2>
		<?=$row['fio'];?><br><br><br>
		<h2>Организация</h2>
		<?=$row['org'];?><br><br><br>
		<h2>I. Введение</h2>
		<?=$row['I'];?><br><br><br>
		<h2>II. Тенденции развития науки и инноваций в России</h2>
		<?=$row['II'];?><br><br><br>
		<h2>III. Современное состояние развития науки и инноваций в Ханты-Мансийском автономном округе - Югра</h2>
		<?=$row['III'];?><br><br><br>
		<h2>IV. Цели и задачи развития науки и инноваций в Ханты-Мансийском автономном округе - Югра</h2>
		<?=$row['IV'];?><br><br><br>
		<h2>V. Основные направления и этапы реализации Концепции:</h2>
		<h2>Направление 1. Фундаментальные и прикладные научные исследования</h2>
		<?=$row['V1'];?><br><br><br>
		<h2>Направление 2. Формирование современной материально-технической базы сектора исследований и разработок</h2>
		<?=$row['V2'];?><br><br><br>
		<h2>Направление 3. Международное сотрудничество в сфере науки</h2>
		<?=$row['V3'];?><br><br><br>
		<h2>Направление 4. Повышение качества кадрового потенциала науки и инноваций и разработка и внедрение механизмов эффективного контракта</h2>
		<?=$row['V4'];?><br><br><br>
		<h2>VI. Механизмы реализации Концепции</h2>
		<?=$row['VI'];?><br><br><br>
		<h2>VII. Целевые индикаторы реализации Концепции</h2>
		<?=$row['VII'];?><br><br><br>
		<h2>VIII. План мероприятий по реализации Концепции</h2>
		<a href="./files/<?=$row['VIII'];?>">Ссылка на скачивание файла</a><br><br>
		<?php
	}
?>
</div>
<?php
require_once '../blocks/footer.php';
?>