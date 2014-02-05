<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
/**
 * @version 0.1
 * @author recens
 * @license GPL
 * @copyright Гельтищева Нина (http://recens.ru)
 */

/**
* Масштабирование изображения
*
* Функция работает с PNG, GIF и JPEG изображениями.
* Масштабирование возможно как с указаниями одной стороны, так и двух, в процентах или пикселях.
*
* @param string Расположение исходного файла
* @param string Расположение конечного файла
* @param integer Ширина конечного файла
* @param integer Высота конечного файла
* @param bool Размеры даны в пискелях или в процентах
* @return bool
*/
function resize($file_input, $file_output, $w_o, $h_o, $percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo 'Невозможно получить длину и ширину изображения';
		return;
    }
    $types = array('','gif','jpeg','png');
    $ext = $types[$type];
    if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
    } else {
    	echo 'Некорректный формат файла';
		return;
    }
	if ($percent) {
		$w_o *= $w_i / 100;
		$h_o *= $h_i / 100;
	}
	if (!$h_o) $h_o = $w_o/($w_i/$h_i);
	if (!$w_o) $w_o = $h_o/($h_i/$w_i);
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
	if ($type == 2) {
		return imagejpeg($img_o,$file_output,100);
	} else {
		$func = 'image'.$ext;
		return $func($img_o,$file_output);
	}
}

/**
* Обрезка изображения
*
* Функция работает с PNG, GIF и JPEG изображениями.
* Обрезка идёт как с указанием абсоютной длины, так и относительной (отрицательной).
*
* @param string Расположение исходного файла
* @param string Расположение конечного файла
* @param array Координаты обрезки
* @param bool Размеры даны в пискелях или в процентах
* @return bool
*/
function crop($file_input, $file_output, $crop = 'square',$percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo 'Невозможно получить длину и ширину изображения';
		return;
    }
    $types = array('','gif','jpeg','png');
    $ext = $types[$type];
    if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
    } else {
    	echo 'Некорректный формат файла';
		return;
    }
	if ($crop == 'square') {
		$min = $w_i;
		if ($w_i > $h_i) $min = $h_i;
		$w_o = $h_o = 800;//$min;
	} else {
		list($x_o, $y_o, $w_o, $h_o) = $crop;
		if ($percent) {
			$w_o *= $w_i / 100;
			$h_o *= $h_i / 100;
			$x_o *= $w_i / 100;
			$y_o *= $h_i / 100;
		}
    	if ($w_o < 0) $w_o += $w_i;
	    $w_o = 800;//-= $x_o;
	   	if ($h_o < 0) $h_o += $h_i;
		$h_o = 800;//-= $y_o;
	}
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
	if ($type == 2) {
		return imagejpeg($img_o,$file_output,100);
	} else {
		$func = 'image'.$ext;
		return $func($img_o,$file_output);
	}
}

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
				echo '<li><a href="../subcontent.php?p_id='.$p_id.'">'.$p_rus_name.'</a></li>';
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
			echo '<li><a href="../gallery.php?g_id='.$g_id.'">'.$g_rus_name.'</a></li>';
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

function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 88) {
    $quality=88;

    if (!file_exists($src)) {
        return false;
    }
    $size = getimagesize($src);
    if ($size === false) {
        return false;
    }
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    $icfunc = 'imagecreatefrom'.$format;
    if (!function_exists($icfunc)) {
        return false;
    }

    $x_ratio = $width  / $size[0];
    $y_ratio = $height / $size[1];

    if ($height == 400 && $width == 0) {
        $x_ratio = $y_ratio;
        $width=$x_ratio * $size[0];
        if ($width >800) {$width =800;}
    }

    if ($height == 0) {
        $y_ratio = $x_ratio;
        $height  = $y_ratio * $size[1];
    } elseif ($width == 0) {
        $x_ratio = $y_ratio;
        $width   = $x_ratio * $size[0];
    }
    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);
    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
    $isrc  = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);
    imagefill($idest, 0, 0, $rgb);
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);
    imagejpeg($idest, $dest, $quality);
    imagedestroy($isrc);
    imagedestroy($idest);
    return true;
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