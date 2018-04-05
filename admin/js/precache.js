   var stepn=0;
   function gocache(){
	   stepn+=1;
		   document.getElementById('startcache').innerHTML="正在预缓存，请耐心等待...";
	   document.getElementById('maincontrol').src="cachecontroller.php?step="+stepn;
   }
   $(function(){
    $('#startcache').click(function(){
		gocache();
    });
  })