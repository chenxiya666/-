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
<H1>�յ���ף��</H1>
<UL class=bookList>

<!-- ���￪ʼ����ף������! -->

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
<P>���յ�<SPAN><?=$total;?></SPAN>��ף��</P></DIV>

<DIV class="joinform bg2">
<form action="zhufu.php" method="post" name="form1">
<FIELDSET><LEGEND>д��ף��</LEGEND>
<DIV>
<LABEL for=username>��������</LABEL> <INPUT class=text2 title=������������֪������˭�� name="name" type="text"> 
<LABEL for=email>��������</LABEL> <INPUT class=text2 title=���ᱻ����������ġ�û�пɲ�д name="email" type="text"> 
<LABEL for=address>���Ժη�</LABEL> <INPUT class=text2 name="where" type="text"> 
<LABEL for=uText>������˵��ɶ</LABEL> 
<TEXTAREA class=text2 id=news title=�����������˵��ɶף���Ļ�� name=content rows=8></TEXTAREA> 
</DIV><INPUT class=btnClass onclick="return check();" type=submit value=����ף��> 
</FIELDSET> </FORM>
</DIV>
</DIV></DIV>
<p style=color:#f60;><font size=2>������<? echo $showday[0].'��'.$showday[1].'��'.$showday[2].'��';?>
 ���������<?php @ZqTime($years,$today);?>�� <?php ShowBenba()?></font></p>

 <div style="display:none"></div>
</BODY>
</HTML>