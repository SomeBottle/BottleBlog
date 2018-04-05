 function exchange(v){
                       str=v;
                      var str2 = str.replace(/"/g, "'");
                     return str2;  
                       }
 var E = window.wangEditor
        var editor = new E('#editor')
		  editor.customConfig.onchange = function (html) {
        document.getElementById('pgdaima').value=exchange(html);
    }
        // 或者 var editor = new E( document.getElementById('editor') )
        editor.create()
		function saves(){
			var title=document.getElementById('pagetitle').value;
			var content=exchange(editor.txt.html());
			var date=document.getElementById('pagedate').value;
			var tag=document.getElementById('pagetag').value;
			localStorage.pagesave=exchange(editor.txt.html());
			localStorage.ptitlesave=title;
			localStorage.ptagsave=tag;
			localStorage.pdatesave=date;
			alert("草稿保存成功！\n "+localStorage.pagesave);
		}
		function template(){
			if(confirm("确定要加载 搜索页 模板？这会覆盖你之前的内容")){
				editor.txt.html("<p>输入文章内容或者标题以搜索....(回车)</p><style>input{border:1px solid#ccc;border-radius:2px;color:#000;font-family:'Open Sans',sans-serif;font-size:1em;height:50px;padding:0 16px;transition:background 0.3s ease-in-out;width:200px}input:focus{outline:none;border-color:#9ecaed;box-shadow:0 0 10px#9ecaed}</style><p style='text-align: center;'><input id='stxt'type='text'placeholder='回车搜索文章'></p><script language='javascript'>document.onkeydown=function(){if(event.keyCode==13){var setxt=document.getElementById('stxt').value;window.open('?search='+setxt,'_self')}}</script>");
				document.getElementById('pagetitle').value="搜索页OvO";
				document.getElementById('pagedate').value="20180331";
				document.getElementById('pagetag').value="search";
			}
		}
		function readsaves(){
			if(confirm("确定要读取草稿？这会覆盖你之前的内容")){
				editor.txt.html(localStorage.pagesave);
				document.getElementById('pagetitle').value=localStorage.ptitlesave;
				document.getElementById('pagedate').value=localStorage.pdatesave;
				document.getElementById('pagetag').value=localStorage.ptagsave;
			}
		}
		function submit(){
			if(confirm("确定发布嘛~\n你可能是误点了哦~QwQ")){
			var title=document.getElementById('pagetitle').value;
			var content=exchange(editor.txt.html());
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