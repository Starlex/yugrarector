<?php
include 'admin/block/db.php';
include 'blocks/header.php';
include 'blocks/menu.php';
?>

<div id='content'>

    <?php
    $count=0;
    echo '<h2 align="center">Информация Российского Союза Ректоров</h2>';
    $sql = "SELECT p_id, p_rus_name FROM rectorugra_page WHERE p_submenu = 1 AND p_parrent = 'rsrinfo'";
    $query = mysql_query($sql) or die(mysql_error());
    while($row = mysql_fetch_assoc($query))
    {
        $count++;
        echo '<a style="font-size:18px;" href="subcontent.php?p_id='.$row['p_id'].'">'.str_replace("_", " ", $row['p_rus_name']).'</a><br /><br />';
    }
    if($count==0)
    {
        $sql_con="SELECT p_content FROM rectorugra_page WHERE p_name = 'rsrinfo'";
        $query_con=mysql_query($sql_con) or die(mysql_error());
        $row_con=mysql_fetch_assoc($query_con);
        echo $row_con['p_content'];

    }
    ?>

</div>
<?php include 'blocks/footer.php';?>