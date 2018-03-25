<?php
function searchword($file,$word){
$mystring = file_get_contents("$file"); 
$findme   = $word;
 $pos = strpos($mystring, $findme);
        if ($pos === false)
{
                return 'no';
          }
        else
          {
                return 'yes';
          }
}
?>