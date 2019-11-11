<?php
if(!defined('benba')){
		exit('404');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title><?=$title?><?php if($seotitle){echo $seotitle;}?></title>
<?php if($keywords){?>
<meta name="keywords" content="<?=$keywords?>" />
<?php } if($description){?>
<meta name="description" content="<?=$description?>" /><?php }?>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<LINK media=screen href="images/marry.css" type=text/css rel=stylesheet>
<script src="<?=$siteurl?>/images/js.js" type="text/javascript"></script>
</head> 
<DIV class=join>
<DIV class=box>
<DIV class=joinlist>
<H1>收到的祝福</H1>
<UL class=bookList>

<!-- 这里开始输入祝福内容! -->

<?php
foreach ($lines as $line_num => $data) 
{
			$data=unserialize($data);		
			$showdate=date("Y-m-d h:m:s", $data[showtime]);
			
		echo "<LI>
  <P class=n>{$data[name]}&nbsp;<span>Come from:{$data[where]}</span><br><span class=\"time\">{$showdate}</span></P>
				<P class=c>
				{$data[content]}
				</p>
				";
}

?>
</LI></UL>
<P>共收到<SPAN><?=$total;?></SPAN>份祝福</P></DIV>

<DIV class="joinform bg2">
<form action="zhufu.php" method="post" name="form1">
<FIELDSET><LEGEND>写下祝福</LEGEND>
<DIV>
<LABEL for=username>您的姓名</LABEL> <INPUT class=text2 title=至少能让我能知道你是谁。 name="name" type="text"> 
<LABEL for=email>您的邮箱</LABEL> <INPUT class=text2 title=不会被公开，请放心。没有可不写 name="email" type="text"> 
<LABEL for=address>来自何方</LABEL> <INPUT class=text2 name="where" type="text"> 
<LABEL for=uText>对我们说点啥</LABEL> 
<TEXTAREA class=text2 id=news title=您还想跟我们说点啥祝福的话语？ name=content rows=8></TEXTAREA> 
</DIV><INPUT class=btnClass onclick="return check();" type=submit value=发送祝福> 
</FIELDSET> </FORM>
</DIV>
</DIV></DIV>
<p style=color:#f60;><font size=2>今天是<? echo $showday[0].'年'.$showday[1].'月'.$showday[2].'日';?>
 距离婚礼还有<?php @ZqTime($years,$today);?>天 <?php ShowBenba()?></font></p>

 <div style="display:none"></div>
</BODY>
</HTML>