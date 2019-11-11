<?php 
@ob_start();
define("benba",'ok'); //设置benba的静态变量,防止非法引用.请别修改!!
@include "config.php";  //导入网站配置文件
@include "func.inc.php"; //导入函数处理文件

//开始变量的处理
$today=date("Y-m-d");  //今天的时间
$showday=explode("-",$today); //把今天的时间给分割呢!
//如果PHP的版本大于5.1.0
if (@phpversion() > '5.1.0'){ 
//设置时区为重庆,哈哈我是重庆人,这个不要去改,有的PHP自己改了的,主要是针对某些PHP配置时候没有开启 'date.timezone' ,至使时差8小时的问题php5.1以前的版本没有这个问题.
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
				exit('<SCRIPT language=javascript>alert("请输入您的正确的呢称,不能小于2个英文(1个汉字),大于16个英文(8个汉字) 谢谢！^_^");top.location=\'zhufu.php\';</SCRIPT>');
			}
						
			if (strlen($where)<4||strlen($where)>12)
			{
				exit('<SCRIPT language=javascript>alert("请输入正确的城市,不能小于4个英文(2个汉字),大于18个英文(8个汉字)如:武汉市 谢谢！^_^");top.location=\'zhufu.php\';</SCRIPT>');
			}
			if ($email){
					if (!IsEmail($email))
					{
						exit('<SCRIPT language=javascript>alert("请输入正确的E-mail地址,如:goldappleit@gmail.com 谢谢！^_^");top.location=\'zhufu.php\';</SCRIPT>');
					}
			}else{$email="没有写邮箱地址";}
			if (strlen($content)<4)
			{
				exit('<SCRIPT language=javascript>alert("不会吧,就这么几个字?拜托认真点写吧！最少也得2个字吧。谢谢！^_^");top.location=\'zhufu.php\';</SCRIPT>');
			}
			
			if (strlen($content)>600)
			{
				exit('<SCRIPT language=javascript>alert("不会吧,写这么多祝福，麻烦在300字以内！谢谢！^_^");top.location=\'zhufu.php\';</SCRIPT>');
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
							die ("写入{$datefile}失败!"); 
						} 

}
//计算多少页
$lines = @file("$datefile"); //把变量datefile这个文件读到一个数组变量里.
$lines=array_reverse($lines);  //倒序数组里的内容.
$total=count($lines); //统计一下有多少条记录.
$pagesu=ceil($total/$pages);
$page=($_GET['page']?$page=$_GET['page']:$page=1);
$nextpage=$page+1;  //下一页
$lastpage=$page-1;  //上一页
$forpage=($_GET['page'] ? $forpage=($_GET['page']-1)*$pages : $forpage=0); //从第几行开始显示数据

$lines=array_slice($lines, $forpage, $pages); //数组分页显示;

@include "tm.html.php"; 
 
//导入网站的模板文件呢!分离后让做模板的朋友没有这样头晕.自己的思路也清楚.

?>