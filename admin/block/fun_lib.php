<?php
//функция добавления подменю
function submenuAdd($par)
{
	$count = 0;
	
	$sql = "SELECT p_id, p_name, p_rus_name, p_submenu, p_parrent FROM rectorugra_page WHERE p_parrent = '".$par."' AND p_submenu = 1";
	$query = mysql_query($sql) or die(mysql_error());
	
	while($row = mysql_fetch_assoc($query))
	{
		$p_submenu = $row['p_submenu'];
		$p_parrent = $row['p_parrent'];
		if($p_submenu == '1' and $p_parrent == $par)
		{
			$count++; 
		}
			
	}
	if($count>0)
	{
		$sql = "SELECT p_id, p_rus_name, p_submenu, p_parrent FROM rectorugra_page WHERE p_parrent = '".$par."' AND p_submenu = 1";
		$query = mysql_query($sql) or die(mysql_error());
		echo '<ul>';
		while($row = mysql_fetch_assoc($query))
		{
			$p_id = $row['p_id'];
            str_replace("_", " ", $p_rus_name = str_replace("_", " ", $row['p_rus_name']));
			$p_submenu = $row['p_submenu'];
			$p_parrent = $row['p_parrent'];
			if($p_submenu == '1' and $p_parrent == $par)
			{
				echo '<li><a href="subcontent.php?p_id='.$p_id.'">'.$p_rus_name.'</a></li>';
			}
		}
		echo '</ul>';
	}
}

function galleryAdd()
{
	$count = 0;
	$sql_gal = "SELECT g_id, g_rus_name FROM rectorugra_gallery";
	$query_gal = mysql_query($sql_gal) or die(mysql_error());
	while($row_gal = mysql_fetch_assoc($query_gal))
	{
		$count++; 
	}
	if($count>0)
	{
		$sql_gal = "SELECT g_id, g_name, g_rus_name FROM rectorugra_gallery";
		$query_gal = mysql_query($sql_gal) or die(mysql_error());
		echo '<ul>';
		while($row_gal = mysql_fetch_assoc($query_gal))
		{
			$g_id = $row_gal['g_id'];
			$g_rus_name = str_replace("_", " ", $row_gal['g_rus_name']);
			echo '<li><a href="gallery.php?g_id='.$g_id.'">'.$g_rus_name.'</a></li>';
		}
		echo'</ul>';
	}
}

function removeDirectory($dir)
{
	if ($objs = glob($dir."/*"))
	{
		foreach($objs as $obj)
		{
			is_dir($obj) ? removeDirectory($obj) : unlink($obj);
		}
	}
	rmdir($dir);
}

function rus2translit($string)
{
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => "'",  'ы' => 'y',   'ъ' => "'",
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
 
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => "'",  'Ы' => 'Y',   'Ъ' => "'",
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		'№' => '',
    );
    return strtr($string, $converter);
}

function fileContent($path)
{
    if(file_exists($path))
    {
        echo readfile($path);
    }
    else
    {
        echo "Невозможно открыть файл";
    }
}

function saveFileContent($path, $newContent)
{
    if(!file_exists($path))
    {
        echo '<h2>Файла не существует. <br /><a href="content_change.php">Назад</a></h2>';
    }
    else
    {
        if(!is_writable($path))
        {
            echo '<h2>Не удалось сохранить данные. Повторите попытку позже.<br /><a href="content_change.php">Назад</a></h2>';
        }
        else
        {
            $file=fopen($path, 'w+');
            $action = fwrite($file, $newContent);
            if ($action)
            {
                echo '<h2>Страница отредактирована.<br /><a href="content_change.php">Назад</a></h2>';
                fclose($file);
            }
            else
            {
                echo '<h2>Страница не отредактирована. Повторите попытку позже.<br /><a href="content_change.php">Назад</a></h2>';
            }

        }
    }
}

?>