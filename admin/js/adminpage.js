function exchange(v) {
    str = v;
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
var tsub;
document.getElementById('toolbox').style.display='none';
function tool() {
    var a=document.getElementById('toolbox');
	if(a.style.display=='none'){
		a.style.display='block';
	}else{
        a.style.display='none'; 
    }	
}
function saves() {
    var title = document.getElementById('pagetitle').value;
    var content = document.getElementById('mainc').value;
    var date = document.getElementById('pagedate').value;
    var tag = document.getElementById('pagetag').value;
    localStorage.pagesave = document.getElementById('mainc').value;
    localStorage.ptitlesave = title;
    localStorage.ptagsave = tag;
    localStorage.pdatesave = date;
    alert("草稿保存成功！\n " + localStorage.pagesave);
}
document.onkeydown = function(e) { //监听按键保存
    console.log('KeyboardEvent');
    var ctrlKey = e.ctrlKey;
    var keyCode = e.keyCode;
    if (ctrlKey && keyCode == 83) {
        saves();
        e.preventDefault();
        return true;
    } else {
        return true;
    }
    e.preventDefault();
    return true;
}
function template() {
    if (confirm("确定要加载 搜索页 模板？这会覆盖你之前的内容")) {
        document.getElementById('mainc').value = "<p>输入文章内容或者标题以搜索....(回车)</p><style>input{border:1px solid#ccc;border-radius:2px;color:#000;font-family:'Open Sans',sans-serif;font-size:1em;height:50px;padding:0 16px;transition:background 0.3s ease-in-out;width:200px}input:focus{outline:none;border-color:#9ecaed;box-shadow:0 0 10px#9ecaed}</style><p style='text-align: center;'><input id='stxt'type='text'placeholder='回车搜索文章'></p><script language='javascript'>document.onkeydown=function(){if(event.keyCode==13){var setxt=document.getElementById('stxt').value;window.open('?search='+setxt,'_self')}}</script>";
        document.getElementById('pagetitle').value = "搜索页OvO";
        document.getElementById('pagedate').value = "20180331";
        document.getElementById('pagetag').value = "search";
    }
}
function readsaves() {
    if (confirm("确定要读取草稿？这会覆盖你之前的内容")) {
        document.getElementById('mainc').value = localStorage.pagesave;
        document.getElementById('pagetitle').value = localStorage.ptitlesave;
        document.getElementById('pagedate').value = localStorage.pdatesave;
        document.getElementById('pagetag').value = localStorage.ptagsave;
    }
}
function submit() {
    if (confirm("确定发布嘛~\n你可能是误点了哦~QwQ")) {
        var title = document.getElementById('pagetitle').value;
        var content = document.getElementById('mainc').value;
        var date = document.getElementById('pagedate').value;
        var tag = document.getElementById('pagetag').value;
        document.getElementById('titlep').value = title;
        document.getElementById('contentp').value = content;
        document.getElementById('tagp').value = tag;
        document.getElementById('datep').value = date;
        document.getElementById('subform').submit();
    }
}
function createnew() {
    window.open('editpages.php', '_self');
}
function deletepage(pnum) {
    if (confirm("真的要删除这个页面吗？！QAQ")) {
        window.open('delpage.php?pageid=' + pnum, '_self');
    }
}