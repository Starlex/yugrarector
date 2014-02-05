<?php
	include "block/fun_lib.php";
	$denied_filetype = array('.php', '.js', '.cs', '.cpp', '.vb', '.PHP', '.JS', '.CS', '.CPP', '.VB'); //разрешенные к загрузке типы файлов
    $callback = $_GET['CKEditorFuncNum'];
    $file_name = str_ireplace(" ", "_", rus2translit($_FILES['upload']['name']));
	$ext = substr($file_name, strpos($file_name, '.'), strlen($file_name)-1); //расширение файла
    $file_name_tmp = $_FILES['upload']['tmp_name'];
	$row = mysql_fetch_assoc($query);
    $file_new_name = '../file/protocols/';
	$full_path = $file_new_name.'/'.$file_name;
    $http_path = '/file/protocols/'.$file_name;
    $error = '';
	if(in_array($ext, $denied_filetype))
			die();
    if( move_uploaded_file($file_name_tmp, $full_path) )
	{

    } 
	else
	{
		$error = 'При загрузке произошла ошибка. Повторите попытку позже.';
		$http_path = '';
    }
    echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(".$callback.",  \"".$http_path."\", \"".$error."\" );</script>";
?>