<?php 

include 'blocks/header.php';
include 'blocks/menu.php';
?>
<div id='content'>
    <?php
    $g_id=$_GET['g_id'];
    $sql_des="SELECT g_description FROM rectorugra_gallery WHERE g_id=".$g_id."";
    $query_des=mysql_query($sql_des) or die(mysql_error());
    while($row_des=mysql_fetch_assoc($query_des))
    {
    echo $row_des['g_description'];
    }
    ?><br /><br />
    <div id="galleria">

        <?php
        $sql="SELECT g_name FROM rectorugra_gallery WHERE g_id=".$g_id."";
        $query=mysql_query($sql) or die(mysql_error());
        $row=mysql_fetch_array($query);
        $dir = 'file/galleries/'.$row['g_name'].'/';   //задаём имя директории
        if(is_dir($dir)) {   //проверяем наличие директории
            //echo $dir.' - директория существует;<br>';
            $files = scandir($dir);    //сканируем (получаем массив файлов)
            array_shift($files); // удаляем из массива '.'
            array_shift($files); // удаляем из массива '..'
            for($i=0; $i<sizeof($files); $i++)
                echo '<a href="'.$dir.$files[$i].'"><img src="'.$dir.$files[$i].'" /></a><br>';  //выводим все файлы
        }
        else echo $dir.' -такой директории нет;<br>';
        ?>

    </div>
    <script>
        Galleria.loadTheme('galleria/themes/classic/galleria.classic.min.js');
        Galleria.run('#galleria');
    </script>
</div><br /><br />
<?php include 'blocks/footer.php';?>