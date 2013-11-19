<?php
ob_start();

// Connect to the database
       $dbLink = new mysqli('localhost', 'root', 'root', 'FYP2');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required data
        $name = $dbLink->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $dbLink->real_escape_string($_FILES  ['uploaded_file']['tmp_name']);
        $size = intval($_FILES['uploaded_file']['size']);
        $folder="uploadingFile/"; //$dir="uploadingFile/".$name;
 if(isset($name))
        {
            if(empty($name)){
                header("refresh:1;url= index.html");
                die("Please select a file");
            }
        }

// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {

             $exists = file_exists($folder.$name);
             
            if ($exists) {
                unlink($data);
                header("refresh:1;url= index.html");
               die("file is exists!");
            }
        

        // Create the SQL query
        $query = "
            INSERT INTO `file` (
                `name`, `mime`, `size`, `folder`,`data`, `created`
            )
            VALUES (
                '{$name}', '{$mime}', '{$size}','{$folder}','{$data}', NOW()
            )";
 
        // Execute the query
        $result = $dbLink->query($query);
 
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';

            move_uploaded_file($data,$folder.$name);

            
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
header("location:index.html");
//echo '<p>Click <a href="uploading.php">here</a> to go back</p>';
ob_flush();
?>
 
 