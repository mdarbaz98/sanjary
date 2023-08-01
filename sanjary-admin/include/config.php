<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
if(strpos($actual_link, 'localhost')) {
	$db_host="localhost"; 
	$db_user="root";
	$db_name="sanjary";
	$db_password="";
}else {
	$db_host="localhost"; 
	$db_user="sanjaryf_sanjaryf_final_user";
	$db_name="sanjaryf_final_database";
	$db_password="4FIK3ck2mP@P";
}

try
{
	$conn=new PDO("mysql:host={$db_host};dbname={$db_name};port=3306",$db_user,$db_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "connected":
}
catch(PDOEXCEPTION $e)
{
	echo "not connect";	
	echo $e->getMessage();

}
?>