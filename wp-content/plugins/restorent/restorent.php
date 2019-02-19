<?php
/*
Plugin Name: Ace Restorent
Plugin URI: www.acetz.com
Description: This is an easy Item Menu plugin.
Author: Sudhanshu
Author URI: www.acetz.com
Version: 1.0.0
*/
function ace_install_ace()
{
mysql_query("CREATE TABLE IF NOT EXISTS `lrn_category` (
  `id` int(55) NOT NULL,
  `category_name` varchar(255) NOT NULL
)");
mysql_query("CREATE TABLE IF NOT EXISTS `lrn_subcategory` (
  `id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL
)");
mysql_query("CREATE TABLE IF NOT EXISTS `lrn_menupdf` (
  `id` int(55) NOT NULL,
  `menu_pdf` varchar(255) NOT NULL
)");
mysql_query("CREATE TABLE IF NOT EXISTS `lrn_newsletter` (
  `id` int(55) NOT NULL,
  `con_email` varchar(255) NOT NULL,
  `con_date` datetime NOT NULL
)");
mysql_query("CREATE TABLE IF NOT EXISTS `lrn_menu` (
  `id` int(55) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_discription` longtext NOT NULL,
  `menu_price` decimal(10,0) NOT NULL,
  `menu_image` varchar(255) NOT NULL,
  `menu_ingredients` varchar(255) NOT NULL,
  `menu_caregory` varchar(255) NOT NULL,
  `menu_caregory_id` int(55) NOT NULL,
  `menu_subcaregory` varchar(255) NOT NULL,
  `menu_subcaregory_id` int(55) NOT NULL,
  `menu_recipe` longtext NOT NULL
)");
	$path = __DIR__ . '/menu_images';
	if (!is_dir($path)) 
	{
		mkdir($path, 0755, true);
	}
	$path = __DIR__ . '/service_logoimages';
	if (!is_dir($path)) 
	{
		mkdir($path, 0755, true);
	}
}
function ace_deactivate_ace()
{
	mysql_query("drop table lrn_category");
	mysql_query("drop table lrn_subcategory");
	mysql_query("drop table lrn_menupdf");
	mysql_query("drop table lrn_newsletter");
	mysql_query("drop table lrn_menu");
}
function ace_page_ace()
{
	add_menu_page('AceRestorent_Page','Add Menus','manage_options','Add_Menus','addMenus393_layout');
	add_submenu_page('Add_Menus','Menu_List','Menu List','manage_options','Menu_List','menuList393_layout');
	add_submenu_page('Add_Menus','Add_Category','Add Category','manage_options','Add_Category','addCategory393_layout');
	add_submenu_page('Add_Menus','Add_subCategory','Add sub-Category','manage_options','Add_subCategory','addsubCategory393_layout');
	add_submenu_page('Add_Menus','Add_menuPDF','Menu PDF','manage_options','Add_menuPDF','addmenuPDF393_layout');
	add_submenu_page('Add_Menus','News_Letter','News Letter','manage_options','News_Letter','NewsLetter393_layout');
}
include_once("lib/function.php");
include_once("lib/config.php");
function addMenus393_layout()
{ 
$call=new callFiles();
echo $call->css(array('lorenzo','restorent','bootstrap_ace'));
echo $call->css(array('lorenzo','restorent','seeting'));
echo $call->css(array('lorenzo','restorent','custom'));
echo $call->js(array('lorenzo','restorent','ckeditor/ckeditor'));
$call->custom_File("menu_form.php");
echo $call->js(array('lorenzo','restorent','custom_ace'));
}
function menuList393_layout()
{
$Category=new callFiles();
echo $Category->css(array('lorenzo','restorent','bootstrap_ace'));
echo $Category->css(array('lorenzo','restorent','seeting'));
echo $Category->css(array('lorenzo','restorent','custom'));
echo $Category->js(array('lorenzo','restorent','custom_ace'));
$Category->custom_File("menu_list.php");
}
function addCategory393_layout()
{
$Category=new callFiles();
echo $Category->css(array('lorenzo','restorent','bootstrap_ace'));
echo $Category->css(array('lorenzo','restorent','seeting'));
echo $Category->css(array('lorenzo','restorent','custom'));
echo $Category->js(array('lorenzo','restorent','custom_ace'));
$Category->custom_File("category_form.php");
}
function addsubCategory393_layout()
{
$call=new callFiles();
echo $call->css(array('lorenzo','restorent','bootstrap_ace'));
echo $call->css(array('lorenzo','restorent','seeting'));
echo $call->css(array('lorenzo','restorent','custom'));
echo $call->js(array('lorenzo','restorent','google_ace'));
echo $call->js(array('lorenzo','restorent','custom_ace'));
$call->custom_File("subcategory_form.php");
}
function addmenuPDF393_layout()
{
$call=new callFiles();
echo $call->css(array('lorenzo','restorent','bootstrap_ace'));
echo $call->css(array('lorenzo','restorent','seeting'));
echo $call->css(array('lorenzo','restorent','custom'));
echo $call->js(array('lorenzo','restorent','google_ace'));
echo $call->js(array('lorenzo','restorent','custom_ace'));
$call->custom_File("menupdf_form.php");
}
function NewsLetter393_layout()
{
$Category=new callFiles();
echo $Category->css(array('lorenzo','restorent','bootstrap_ace'));
echo $Category->css(array('lorenzo','restorent','seeting'));
echo $Category->css(array('lorenzo','restorent','custom'));
echo $Category->js(array('lorenzo','restorent','custom_ace'));
$Category->custom_File("newsletter_form.php");
}
register_activation_hook(__FILE__,'ace_install_ace');
register_deactivation_hook(__FILE__,'ace_deactivate_ace');
add_action('admin_menu','ace_page_ace');
?>