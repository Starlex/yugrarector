<?php 
include 'admin/block/db.php';
include 'blocks/header.php';
include 'blocks/menu.php';
?>

<div id="content"><h2 align="center">Новости Совета</h2>
<?php
$sql = "SELECT p_content FROM rectorugra_page WHERE p_name = 'main'";
$query = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($query);
echo $row['p_content'];
?>
</div>
	
<?php
include 'blocks/footer.php';
?>
