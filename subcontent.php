<?php
include 'admin/block/db.php';
include 'blocks/header.php';
include 'blocks/menu.php';
?>

<div id='content'>

<?php

$p_id = $_GET['p_id'];

$sql = "SELECT p_id, p_rus_name, p_content FROM rectorugra_page WHERE p_id = $p_id";
$query = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($query);
echo '<h2 align="center">'.str_replace("_", " ", $row['p_rus_name']).'</h2>';
echo $row['p_content'];

?>

</div>
<?php include 'blocks/footer.php';?>