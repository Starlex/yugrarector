
<?php
include 'admin/block/db.php';
include 'blocks/header.php';
include 'blocks/menu.php';
?>
<h2 align="center">Состав Совета</h2>
<?php

$sql = "SELECT p_content FROM rectorugra_page WHERE p_name = 'sostav'";
$query = mysql_query($sql);
while($row = mysql_fetch_assoc($query))
{
	echo $row['p_content'];
}

include 'blocks/footer.php';?>

