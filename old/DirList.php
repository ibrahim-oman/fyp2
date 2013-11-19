<?php 
class DirList 
{ 
   private $dir; 
   private $listing; 
    
   public function DirList($dir) 
   { 
      if(!is_dir($dir)) 
      { 
         user_error("DirList(): '$dir' is not a valid directory"); 
         return(FALSE); 
      } 
      $this->dir = $dir; 
      $this->buildList(); 
      uasort($this->listing, array($this, 'SortList')); 
   } 
    
   public function getDirName() 
   { 
      return($this->dir); 
   } 
    
   public function getDirList() 
   { 
      return($this->listing); 
   } 
    
   private function buildList() 
   { 
      $files = glob($this->dir . '/*'); 
      foreach($files as $file) 
      { 
         $name = basename($file); 
         if(is_dir($file)) 
         { 
            $this->listing[$name] = array( 
               'type' => 'directory', 
               'size' => '' 
            ); 
         } 
         else 
         { 
            $this->listing[$name]['type'] = $this->getType($file); 
            $this->listing[$name]['size'] = filesize($file); 
         } 
      } 
   } 
    
   public function getType($file) 
   { 
      if(is_dir($file)) 
      { 
         return('directory'); 
      } 
      $parts = explode('.', basename($file)); 
      return((count($parts) > 1) ? strtolower(array_pop($parts)) : 'file'); 
   } 
    
   private function sortList($a, $b) 
   { 
      if($a['type'] == 'directory' and $b['type'] != 'directory') 
      { 
         return -1; 
      } 
      elseif($b['type'] == 'directory' and $a['type'] != 'directory') 
      { 
         return 1; 
      } 
      else 
      { 
         return(strcmp($a, $b)); 
      } 
   } 
}
?>