<?php
class callFiles{
function css($value)
{	
	return '<link rel="stylesheet" href="http://'.$_SERVER['HTTP_HOST'].'/'.$value[0].'/wp-content/plugins/'.$value[1].'/css/'.$value[2].'.css">';
}
function js($value)
{	
	return '<script type="text/javascript" src="http://'.$_SERVER['HTTP_HOST'].'/'.$value[0].'/wp-content/plugins/'.$value[1].'/js/'.$value[2].'.js"></script>';
}
function custom_File($value)
{	
	include($value);
}
function file_Url($value)
{	
	return 'http://'.$_SERVER['HTTP_HOST'].'/'.$value[0].'/wp-content/plugins/'.$value[1].'/lib/'.$value[2].'.php';
}
function image_Url($value,$size)
{	
	return '<img src="http://'.$_SERVER['HTTP_HOST'].'/'.$value[0].'/wp-content/plugins/'.$value[1].'/lib/'.$value[2].'/'.$value[3].'" style="width:'.$size[0].'px; height:'.$size[1].'px;" alt="loading.." />';
}
function image_Url_2($value,$size)
{	
	return '<img src="http://'.$_SERVER['HTTP_HOST'].'/'.$value[0].'/wp-content/plugins/'.$value[1].'/'.$value[2].'/'.$value[3].'" style="width:'.$size[0].'px; height:'.$size[1].'px;" alt="loading.." />';
}
function image_Src($value)
{	
	return '"http://'.$_SERVER['HTTP_HOST'].'/'.$value[0].'/wp-content/plugins/'.$value[1].'/lib/'.$value[2].'/'.$value[3].'"';
}	
}
?>