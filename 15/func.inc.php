<?php 
//�ڲ������ļ�
if(!defined('benba')) {
	exit('404');
}
//����ʱ����
function ZqTime($zqdata,$today){
	$zqdata=strtotime("$zqdata");
	$today=strtotime("$today");
	$compday=$zqdata-$today;
	$compday=$compday/86400;
	echo $compday;
	}
	
//��������ȴ����ύ�Ŀո�Ͳ���ȫ�Ķ���.
function SubForm($var){
		$var = trim($var);
		$var = preg_replace('/\s(?=\s)/', '', $var);
		$var = preg_replace('/[\n\r\t]/', ' ', $var);
		$var = htmlspecialchars($var);
		return 	$var;
}
//���E-mail�ĺ���,���MAIL�ǶԵľͷ�����,������Ǽ�!

//���õ�POSIX�����,POSIX��������ereg_��ʼ,��Ч��û��PCRE������,PCRE��preg_Ϊ��ʼǰ׺��.
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

