<?php 
include 'admin/block/db.php';
include 'blocks/header.php';
include 'blocks/menu.php';
?>

<div id='content'>

<?php

echo '<h2 align="center">Планы совета</h2>';
$sql = "SELECT p_id, p_rus_name FROM rectorugra_page WHERE p_submenu = 1 AND p_parrent = 'plans'";
$query = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_assoc($query))
{
	echo '<a style="font-size:18px;" href="subcontent.php?p_id='.$row['p_id'].'">'.str_replace("_", " ", $row['p_rus_name']).'</a><br /><br />';
}
?>

</div>
<?php include 'blocks/footer.php';?>