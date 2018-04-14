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
      document.getElementById('pgdaima').value=meditor.summernote('code');
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
						   var mains=document.getElementById('pgdaima').value;
						   meditor.summernote('code', mains);
					   }
					   var tsub;
					   function calling(){
						   clearInterval(tsub);
						   tsub=setInterval(settxt,1500);
					   }
		function saves(){
			var title=document.getElementById('pagetitle').value;
			var content=meditor.summernote('code');
			var date=document.getElementById('pagedate').value;
			var tag=document.getElementById('pagetag').value;
			localStorage.pagesave=meditor.summernote('code');
			localStorage.ptitlesave=title;
			localStorage.ptagsave=tag;
			localStorage.pdatesave=date;
			alert("草稿保存成功！\n "+localStorage.pagesave);
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
		function template(){
			if(confirm("确定要加载 搜索页 模板？这会覆盖你之前的内容")){
				meditor.summernote('code',"<p>输入文章内容或者标题以搜索....(回车)</p><style>input{border:1px solid#ccc;border-radius:2px;color:#000;font-family:'Open Sans',sans-serif;font-size:1em;height:50px;padding:0 16px;transition:background 0.3s ease-in-out;width:200px}input:focus{outline:none;border-color:#9ecaed;box-shadow:0 0 10px#9ecaed}</style><p style='text-align: center;'><input id='stxt'type='text'placeholder='回车搜索文章'></p><script language='javascript'>document.onkeydown=function(){if(event.keyCode==13){var setxt=document.getElementById('stxt').value;window.open('?search='+setxt,'_self')}}</script>");
				document.getElementById('pagetitle').value="搜索页OvO";
				document.getElementById('pagedate').value="20180331";
				document.getElementById('pagetag').value="search";
			}
		}
		function readsaves(){
			if(confirm("确定要读取草稿？这会覆盖你之前的内容")){
				meditor.summernote('code',localStorage.pagesave);
				document.getElementById('pagetitle').value=localStorage.ptitlesave;
				document.getElementById('pagedate').value=localStorage.pdatesave;
				document.getElementById('pagetag').value=localStorage.ptagsave;
			}
		}
		function submit(){
			if(confirm("确定发布嘛~\n你可能是误点了哦~QwQ")){
			var title=document.getElementById('pagetitle').value;
			var content=meditor.summernote('code');
			var date=document.getElementById('pagedate').value;
			var tag=document.getElementById('pagetag').value;
			document.getElementById('titlep').value=title;
			document.getElementById('contentp').value=content;
			document.getElementById('tagp').value=tag;
			document.getElementById('datep').value=date;
			document.getElementById('subform').submit();
			}
		}
		function createnew(){
			window.open('editpages.php','_self');
		}
		function deletepage(pnum){
			if(confirm("真的要删除这个页面吗？！QAQ")){
			window.open('delpage.php?pageid='+pnum,'_self');
			}
		}