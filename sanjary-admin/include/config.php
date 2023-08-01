<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
if(strpos($actual_link, 'localhost')) {
	$db_host="localhost"; 
	$db_user="root";
	$db_name="sanjary";
	$db_password="";
}else {
	$db_host="localhost"; 
	$db_user="sanjaryf_admin_sanjary";
	$db_name="sanjaryf_admin_sanjary";
	$db_password="}bDf6hr7}QfI";
}

try
{
	$conn=new PDO("mysql:host={$db_host};dbname={$db_name};port=3306",$db_user,$db_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "connected":
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}
?>