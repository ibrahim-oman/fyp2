<?php
require_once "DirList.php"; 
$test = new DirList($_SERVER['DOCUMENT_ROOT'].'/test'); 
$imgDir = $_SERVER['DOCUMENT_ROOT'].'/images/'; 
echo "<h2>Listing for /test:</h2>\n"; 
echo "<ul>\n"; 
foreach($test->getDirList() as $name => $info) 
{ 
   printf( 
      "<li><img src='/images/%s' alt='%s'> %s %s</li>\n", 
      (file_exists($imgDir.$info['type'].'.png')) ?  
         $info['type'].'.png' : 
         'file.png',  // default image 
      $info['type'], 
      $name, 
      ($info['type'] != 'directory') ? "({$info['size']} bytes)" : ''  
   ); 
} 
echo "</ul>\n";  
?>