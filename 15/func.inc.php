<?php 
//内部函数文件
if(!defined('benba')) {
	exit('404');
}
//倒计时函数
function ZqTime($zqdata,$today){
	$zqdata=strtotime("$zqdata");
	$today=strtotime("$today");
	$compday=$zqdata-$today;
	$compday=$compday/86400;
	echo $compday;
	}
	
//利用正则等处理提交的空格和不安全的东东.
function SubForm($var){
		$var = trim($var);
		$var = preg_replace('/\s(?=\s)/', '', $var);
		$var = preg_replace('/[\n\r\t]/', ' ', $var);
		$var = htmlspecialchars($var);
		return 	$var;
}
//检查E-mail的函数,如果MAIL是对的就返回真,否则就是假!

//利用的POSIX正则库,POSIX正则函数以ereg_开始,但效率没有PCRE正则库高,PCRE以preg_为开始前缀名.
function IsEmail($email){
   if (eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$", $email))
   {
    return true;
	}
  else{
    return false;
	}
}
?>

