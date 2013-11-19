<?php 
$localhost='localhost'; 
$user='root'; 
$pass='root'; 
$my_db='FYP2'; 
$table="upload"; 

$dsn = 'mysql:dbname=FYP2;host=localhost';
$user = 'root';
$pass = 'root';
try{
$dbh= new PDO($dsn, $user, $pass); 
echo "successww!"; 
}catch(PDOException $e){
	echo $e->getMessage();
}
//echo "$dbh";
//$db_handle= @mysql_connect($localhost,$user,$pass); 


// $db_result= mysql_select_db($my_db); 
// if (!$db_result){
	// mysql_close($db);
	// die('selection proble');
// }

/*
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



$query = "INSERT INTO tut (fielName, fileSize, fileType, content ) ". 
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')"; 

mysql_query($query) or die('Error, query failed'); 
; 

echo "<br>File $fileName uploaded<br>"; 
} */
?>