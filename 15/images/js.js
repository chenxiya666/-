function check(){
if(document.form1.name.value.length<1){
  	    alert("�㲻����������֣�����ô֪����˭д��ף���أ�^_^");
		  document.form1.name.focus();
		return false;
 		}else if(document.form1.where.value.length<1){
		alert("��������������!^_^");
		  document.form1.where.focus();
		return false;
 		}else if(document.form1.content.value.length<1){
		alert("����!������дף������������!!^_^");
		  document.content.where.focus();
		return false;
 		}else if(document.form1.content.value.length>600){
		  document.form1.content.focus();
		alert("�����,д��ô��ף�����鷳��300�����ڣ�^_^");
		return false;

	} else{
     return true;
   }
}