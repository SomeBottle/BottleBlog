 var E = window.wangEditor
        var editor = new E('#editor')
        // 或者 var editor = new E( document.getElementById('editor') )
        editor.create()
		function exchange(v){
        str=v;
        var str2 = str.replace(/"/g, "'");
        return str2;  
        }
		function saves(){
			var title=document.getElementById('posttitle').value;
			var content=exchange(editor.txt.html());
			var date=document.getElementById('postdate').value;
			var tag=document.getElementById('posttag').value;
			localStorage.postsave=exchange(editor.txt.html());
			localStorage.titlesave=title;
			localStorage.tagsave=tag;
			localStorage.datesave=date;
			alert("草稿保存成功！\n "+localStorage.postsave);
		}
		function readsaves(){
			if(confirm("确定要读取草稿？这会覆盖你之前的内容")){
				editor.txt.html(localStorage.postsave);
				document.getElementById('posttitle').value=localStorage.titlesave;
				document.getElementById('postdate').value=localStorage.datesave;
				document.getElementById('posttag').value=localStorage.tagsave;
			}
		}
		function submit(){
			var myDate = new Date();
			if(confirm("确定发布嘛~\n你可能是误点了哦~QwQ")){
			localStorage.fbmintime=myDate.getMinutes();
			localStorage.fbsectime=myDate.getSeconds();
			var title=document.getElementById('posttitle').value;
			var content=exchange(editor.txt.html());
			var date=document.getElementById('postdate').value;
			var tag=document.getElementById('posttag').value;
			document.getElementById('titlep').value=title;
			document.getElementById('contentp').value=content;
			document.getElementById('tagp').value=tag;
			document.getElementById('datep').value=date;
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