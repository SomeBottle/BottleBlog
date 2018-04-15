function nextpage(a){
	window.open('index.php?page='+(a+1),'_self');
}
function prepage(a){
	window.open('index.php?page='+(a-1),'_self');
}
function setpage(){
	var a=prompt('请输入页码以到达>-<~','');
	if(a!==""&&isNaN(a)==false){
		if(a==null){
			window.open('index.php','_self');
		}else{
		window.open('index.php?page='+a,'_self');
		}
	}else{
		alert('请输入数字，不要为空.');
		return setpage();
	}
}