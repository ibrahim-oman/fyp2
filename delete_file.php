<?php ob_start() ?>
<?php
// Make sure an ID was passed
//echo $_GET['id'];
if(isset($_GET['id'])) {
// Get the ID
    $id = intval($_GET['id']);
    $name=($_GET['name']);
 
    // Make sure the ID is in fact a valid ID
    if($id <= 0) {
        die('The ID is invalid!');
    }
    else {
        // Connect to the database
        $dbLink = new mysqli('localhost', 'root', 'root', 'FYP2');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 


        $result = $dbLink->query("DELETE FROM file WHERE  id=$id");
        if ( $result) {
           delete_file_from_dir($name);
        }
        else{
             
            die("Error> file not deleted!");
        }
        @mysqli_close($dbLink);
header("location:list_files.php");
    }
}
else {
    echo 'Error! No ID was passed.';
}
?>


<?php
function delete_file_from_dir($name){

$dir='uploadingFile/';
      $result=unlink($dir.$name) ;

}
?>