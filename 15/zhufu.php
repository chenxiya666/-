<?php 
@ob_start();
define("benba",'ok'); //����benba�ľ�̬����,��ֹ�Ƿ�����.����޸�!!
@include "config.php";  //������վ�����ļ�
@include "func.inc.php"; //���뺯�������ļ�

//��ʼ�����Ĵ���
$today=date("Y-m-d");  //�����ʱ��
$showday=explode("-",$today); //�ѽ����ʱ����ָ���!
//���PHP�İ汾����5.1.0
if (@phpversion() > '5.1.0'){ 
//����ʱ��Ϊ����,��������������,�����Ҫȥ��,�е�PHP�Լ����˵�,��Ҫ�����ĳЩPHP����ʱ��û�п��� 'date.timezone' ,��ʹʱ��8Сʱ������php5.1��ǰ�İ汾û���������.
	 	date_default_timezone_set('Asia/Chongqing');
		$getad=@file('ad.txt');
}

if ($_POST['content']){
			$name=$_POST['name'];
			$where=$_POST['where'];
			$email=$_POST['email'];
			$content=$_POST['content'];

			$name=SubForm($name);
			$where=SubForm($where);
			$email=SubForm($email);
			$content=SubForm($content);
			$showtime=time(); 
			$ip = getenv("REMOTE_ADDR");
			
			if (strlen($name)<2||strlen($name)>16)
			{
				exit('<SCRIPT language=javascript>alert("������������ȷ���س�,����С��2��Ӣ��(1������),����16��Ӣ��(8������) лл��^_^");top.location=\'zhufu.php\';</SCRIPT>');
			}
						
			if (strlen($where)<4||strlen($where)>12)
			{
				exit('<SCRIPT language=javascript>alert("��������ȷ�ĳ���,����С��4��Ӣ��(2������),����18��Ӣ��(8������)��:�人�� лл��^_^");top.location=\'zhufu.php\';</SCRIPT>');
			}
			if ($email){
					if (!IsEmail($email))
					{
						exit('<SCRIPT language=javascript>alert("��������ȷ��E-mail��ַ,��:goldappleit@gmail.com лл��^_^");top.location=\'zhufu.php\';</SCRIPT>');
					}
			}else{$email="û��д�����ַ";}
			if (strlen($content)<4)
			{
				exit('<SCRIPT language=javascript>alert("�����,����ô������?���������д�ɣ�����Ҳ��2���ְɡ�лл��^_^");top.location=\'zhufu.php\';</SCRIPT>');
			}
			
			if (strlen($content)>600)
			{
				exit('<SCRIPT language=javascript>alert("�����,д��ô��ף�����鷳��300�����ڣ�лл��^_^");top.location=\'zhufu.php\';</SCRIPT>');
			}

			$arr=array(
			"name"=>"$name",
			"where"=>"$where",
			"email"=>"$email",
			"content"=>"$content",
			"showtime"=>"$showtime",
			"ip"=>"$ip");

						$arr=serialize($arr);
						$content=$arr."\n";
						
						$fp=@fopen($datefile,'a');  
						
						if (@fwrite($fp,$content))
						{
							@fclose ($fp);
						} 
						else 
						{ 
							@fclose ($fp); 
							die ("д��{$datefile}ʧ��!"); 
						} 

}
//�������ҳ
$lines = @file("$datefile"); //�ѱ���datefile����ļ�����һ�����������.
$lines=array_reverse($lines);  //���������������.
$total=count($lines); //ͳ��һ���ж�������¼.
$pagesu=ceil($total/$pages);
$page=($_GET['page']?$page=$_GET['page']:$page=1);
$nextpage=$page+1;  //��һҳ
$lastpage=$page-1;  //��һҳ
$forpage=($_GET['page'] ? $forpage=($_GET['page']-1)*$pages : $forpage=0); //�ӵڼ��п�ʼ��ʾ����

$lines=array_slice($lines, $forpage, $pages); //�����ҳ��ʾ;

@include "tm.html.php"; 
 
//������վ��ģ���ļ���!���������ģ�������û������ͷ��.�Լ���˼·Ҳ���.

?>