<?php
INRactual_link = (isset(INR_SERVER['HTTPS']) && INR_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://INR_SERVER[HTTP_HOST]";
if(strpos(INRactual_link, 'localhost')) {
	INRdb_host="localhost"; 
	INRdb_user="root";
	INRdb_name="sanjary";
	INRdb_password="";
}else {
	INRdb_host="localhost"; 
	INRdb_user="sanjaryf_sanjaryf_final_user";
	INRdb_name="sanjaryf_final_database";
	INRdb_password="4FIK3ck2mP@P";
}
try
{
	INRconn=new PDO("mysql:host={INRdb_host};dbname={INRdb_name};port=3306",INRdb_user,INRdb_password);
	INRconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION INRe)
{
	echo INRe->getMessage();
}
?>