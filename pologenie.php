<?php 
include 'admin/block/db.php';
include 'blocks/header.php';
include 'blocks/menu.php';
?>

<div id='content'>

<?php

$sql = "SELECT p_id, p_rus_name, p_content FROM rectorugra_page WHERE p_name = 'pologenie'";
$query = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($query);
echo $row['p_content'];

?>

</div>
<?php include 'blocks/footer.php';?>