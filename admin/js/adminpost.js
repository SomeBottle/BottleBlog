 	function exchange(v){
        str=v;
        var str2 = str.replace(/"/g, "'");
        return str2;  
        }
		/*工具箱模块*/
function submitpic() {
            console.log("submit event");
            var fd = new FormData(document.getElementById("fileinfo"));
			$("#showmain").html("正在上传到sm.ms....");
            fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "https://sm.ms/api/upload",
              type: "POST",
              data: fd,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				mains=eval(data.data);
				$("#showmain").html("<img style='max-height:80px;' src='"+mains.url+"'></img>");
				document.getElementById('mainc').value=document.getElementById('mainc').value+'\r !['+mains.filename+']('+mains.url+')  ';
            });
            return false;
        }
    $("#smfile").change(function(e) {
        submitpic();
    });
	$("#filed").change(function(e) {
        var a=upweibo('fileinfo2');
		$("#showmain").html("<img style='max-height:80px;' src='"+a+"'></img>");
				document.getElementById('mainc').value=document.getElementById('mainc').value+'\r ![]('+a+')  ';
    });
	function addlink(){
		var check = document.getElementsByName('chose')[0];
		var exports='['+document.getElementById('linkmeta').value+']('+document.getElementById('linkname').value+')';
		if(check.checked==true){
			exports="<a href='"+document.getElementById('linkname').value+"' target='_blank'>"+document.getElementById('linkmeta').value+"</a>";
		}
		exports=exports+'  ';
		console.log(exports);
		document.getElementById('mainc').value=document.getElementById('mainc').value+'\r '+exports;
	}
/*模块结束*/
document.getElementById('toolbox').style.display='none';
function tool() {
    var a=document.getElementById('toolbox');
	if(a.style.display=='none'){
		a.style.display='block';
	}else{
        a.style.display='none'; 
    }	
}
		function saves(){
			var title=document.getElementById('posttitle').value;
			var content=document.getElementById('mainc').value;
			var date=document.getElementById('postdate').value;
			var tag=document.getElementById('posttag').value;
			localStorage.postsave=document.getElementById('mainc').value;
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
				document.getElementById('mainc').value=localStorage.postsave;
				document.getElementById('posttitle').value=localStorage.titlesave;
				document.getElementById('postdate').value=localStorage.datesave;
				document.getElementById('posttag').value=localStorage.tagsave;
			}
		}
		function submit(){
			if(confirm("确定发布嘛~\n你可能是误点了哦~QwQ\n\n日期排序器可能要耗费您一点时间~")){
				var myDate = new Date();
			var title=document.getElementById('posttitle').value;
			var content=document.getElementById('mainc').value;
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