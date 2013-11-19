//<?php ob_start() ?>
<?php 
$localhost='localhost'; 
$user='root'; 
$pass='root'; 
$my_db='FYP2'; 
$table="upload"; 



 $db_handle= @mysql_connect($localhost,$user,$pass,$my_db); 


 $db_result= mysql_select_db($my_db); 
 if (!$db_result){
 mysql_close($db);
 die('selection proble');
 
  }

 
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) 
{ 
$fileName = $_FILES['userfile']['name']; 
$tmpName  = $_FILES['userfile']['tmp_name']; 
$fileSize = $_FILES['userfile']['size']; 
$fileType = $_FILES['userfile']['type']; 

$fp      = fopen($tmpName, 'r'); 
$content = fread($fp, filesize($tmpName)); 
$content = addslashes($content); 
fclose($fp); 

if(!get_magic_quotes_gpc()) 
{ 
   
    $fileName = addslashes($fileName); 
} 



$query = "INSERT INTO upload (fileName, fileSize, fileType, content ) ". 
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')"; 

mysql_query($query) or die('Error, query failed'); 

echo "$fileName, $fileSize, $fileType........$$tmpName";
//echo "<br>File $fileName uploaded<br>"; 

}  
echo 'omg';
//header("Refresh: 5; upload.php");
//header("Location: 2; upload.php");

?>
<!--<html>
<head>
    <title>Redirecting...</title>
    <meta http-equiv="refresh" 
content="2;upload.php">
</head>
<body>
    uploading is done,<br/>
    You are being automatically redirected to a new location.<br />
    If your browser does not redirect you in 2 seconds, or you do
    not wish to wait, <a href="upload.php">click here</a>. 
</body>
</html>-->