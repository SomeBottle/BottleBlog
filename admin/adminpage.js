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