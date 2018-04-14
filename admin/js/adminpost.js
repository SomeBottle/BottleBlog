 	function exchange(v){
        str=v;
        var str2 = str.replace(/"/g, "'");
        return str2;  
        }
var meditor=$('#editor').summernote({
        placeholder: '',
        tabsize: 2,
        height: 250,
		lang: 'zh-CN'
      });
	  $('#editor').on('summernote.change', function(we, contents, $editable) {
      document.getElementById('psdaima').value=meditor.summernote('code');
});
/*去除编辑器BUG造成的开头空格*/
function trimLeft(s){  
    if(s == null) {  
        return "";  
    }  
    var whitespace = new String(" \t\n\r");  
    var str = new String(s);  
    if (whitespace.indexOf(str.charAt(0)) != -1) {  
        var j=0, i = str.length;  
        while (j < i && whitespace.indexOf(str.charAt(j)) != -1){  
            j++;  
        }  
        str = str.substring(j, i);  
    }  
    return str;  
}  
meditor.summernote('code', trimLeft(meditor.summernote('code')));

                       function settxt(){
						   var mains=document.getElementById('psdaima').value;
						   meditor.summernote('code', mains);
					   }
					   var tsub;
					   function calling(){
						   clearInterval(tsub);
						   tsub=setInterval(settxt,1500);
					   }
		function saves(){
			var title=document.getElementById('posttitle').value;
			var content=meditor.summernote('code');
			var date=document.getElementById('postdate').value;
			var tag=document.getElementById('posttag').value;
			localStorage.postsave=meditor.summernote('code');
			localStorage.titlesave=title;
			localStorage.tagsave=tag;
			localStorage.datesave=date;
			alert("草稿保存成功！\n "+localStorage.postsave);
		}
		document.onkeydown = function(e) {//监听按键保存
		console.log('KeyboardEvent');
    var ctrlKey = e.ctrlKey;
	var keyCode = e.keyCode;
	if(ctrlKey && keyCode == 83) {
            saves();
			e.preventDefault();
			return true;
    }else{
		return true;
	}
	 e.preventDefault();
	  return true;
	}
		function readsaves(){
			if(confirm("确定要读取草稿？这会覆盖你之前的内容")){
				meditor.summernote('code', localStorage.postsave);
				document.getElementById('posttitle').value=localStorage.titlesave;
				document.getElementById('postdate').value=localStorage.datesave;
				document.getElementById('posttag').value=localStorage.tagsave;
			}
		}
		function submit(){
			if(confirm("确定发布嘛~\n你可能是误点了哦~QwQ\n\n日期排序器可能要耗费您一点时间~")){
				var myDate = new Date();
			var title=document.getElementById('posttitle').value;
			var content=meditor.summernote('code');
			var date=document.getElementById('postdate').value;
			var tag=document.getElementById('posttag').value;
			document.getElementById('titlep').value=title;
			document.getElementById('contentp').value=content;
			document.getElementById('tagp').value=tag;
			document.getElementById('datep').value=date;
			localStorage.fbmintime=myDate.getMinutes();
			localStorage.fbsectime=myDate.getSeconds();
			document.getElementById('subform').submit();
			}
		}
		function createnew(){
			window.open('editposts.php','_self');
		}
		function deletepost(pnum){
			if(confirm("真的要删除这篇文章吗？！QAQ")){
			window.open('delpost.php?postid='+pnum,'_self');
			}
		}