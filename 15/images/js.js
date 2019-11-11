function check(){
if(document.form1.name.value.length<1){
  	    alert("你不留下你的名字，我怎么知道是谁写的祝福呢！^_^");
		  document.form1.name.focus();
		return false;
 		}else if(document.form1.where.value.length<1){
		alert("看看你来自哪里!^_^");
		  document.form1.where.focus();
		return false;
 		}else if(document.form1.content.value.length<1){
		alert("看嘛!又忘记写祝福的内容了呢!!^_^");
		  document.content.where.focus();
		return false;
 		}else if(document.form1.content.value.length>600){
		  document.form1.content.focus();
		alert("不会吧,写这么多祝福，麻烦在300字以内！^_^");
		return false;

	} else{
     return true;
   }
}