
<!doctype html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/reset.css"> 
<link rel="stylesheet" type="text/css" href="css/style-browse.css">
<link rel="stylesheet" type="text/css" href="css/text.css">

<meta charset="UTF-8">
<script>
    function open_dialog(){
        var filebox=document.getElementById("uploaded_file");
        var txt_path=document.getElementById("txt_file_path");
        filebox.click();
        txt_path.value=filebox.value;
    }
    </script>
<title>FYLES SYNCORNZIATION SYSTEM</title>
</head>

<body>

<div class="container_12">
<div class="ian">
<div class="grid_12 HeaderTap ">
    <ul>
    <li id="li_1">Files Upload</li>
    <li id="li_2">Synchronize Teaching Materials System</li>
    </ul>
</div>
<div class="grid_12 BlueTap">
        <div class="BrowseFilesBox">
            <a href="list_files.php" >Browse Files</a>
        </div>
        <div class="FilesUploadBox">
            <a href="index.html" >Upload Files</a>
        </div>
</div>

<div class="grid_12 underTap "></div>

<div class="grid_12 BudyContainer">
    <div class="php-layout">
<!--     phpphpphpphpphpphpphpphpphpphpphpphpphpphpphpphpphpphpphpphpphpphpphp- -->

<?php
// Connect to the database

 $dbLink = new mysqli('localhost', 'root', 'root', 'FYP2');
if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
}
 
// Query for a list of all existing files
$sql = 'SELECT `id`, `name`, `mime`, `size`, `created` FROM `file`';
$result = $dbLink->query($sql);
 
// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no files in the database</p>';
    }
    else {
       // $count=$result->num_rows; // to show the total number of rows in the database
        $count=1;

                     // Print the top of a table
        echo '<table width="100%">
                <tr>
                    <td><b>No.</b></td>
                    <td><b>Name</b></td>
                    <td><b>Mime</b></td>
                    <td><b>Size</b></td>
                    <td><b>Created</b></td>
                    <td><b>&nbsp;</b></td>
                </tr>';
        // Print each file
        
        while($row = $result->fetch_object()) {
            
           $size_units= Get_formatSizeUnits($row->size);
           $OfficeExtension= Get_OfficeExtension(basename($row->mime));
          
            echo "
                <tr>
                    <td>$count</td>
                    <td>{$row->name}</td>
                    <td>$OfficeExtension</td>
                    <td>$size_units</td>
                    <td>{$row->created}</td>
                    <td><a href='get_file.php?id={$row->id}'>Download</a></td>
                    <td><a href='delete_file.php?id={$row->id}&name={$row->name}'>Delete</a></td>
                </tr>";

                $count++;
        }

 
        // Close table
        echo '</table>';
    }

 
    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}
 
// Close the mysql connection
$dbLink->close();
?>


<?php

function Get_formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

function Get_OfficeExtension($type){


if($type=='vnd.openxmlformats-officedocument.presentationml.presentation')
    return 'pptx';
else if($type=='vnd.openxmlformats-officedocument.spreadsheetml.sheet')
    return 'xlsx';
else if($type=='vnd.openxmlformats-officedocument.spreadsheetml.template')
    return 'xltx';
else if($type=='vnd.openxmlformats-officedocument.presentationml.template')
    return 'potx';
else if($type=='vnd.openxmlformats-officedocument.presentationml.slideshow')
    return 'ppsx';
else if($type=='vnd.openxmlformats-officedocument.presentationml.slide')
    return 'sldx';
else if($type=='vnd.openxmlformats-officedocument.wordprocessingml.document')
    return 'docx';
else if($type=='application/vnd.ms-excel.addin.macroEnabled.12')
    return 'xlam';

else
    return $type;

/*

Extension MIME Type
.xlsx   application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
.xltx   application/vnd.openxmlformats-officedocument.spreadsheetml.template
.potx   application/vnd.openxmlformats-officedocument.presentationml.template
.ppsx   application/vnd.openxmlformats-officedocument.presentationml.slideshow
.pptx   application/vnd.openxmlformats-officedocument.presentationml.presentation
.sldx   application/vnd.openxmlformats-officedocument.presentationml.slide
.docx   application/vnd.openxmlformats-officedocument.wordprocessingml.document
.dotx   application/vnd.openxmlformats-officedocument.wordprocessingml.template
.xlam   application/vnd.ms-excel.addin.macroEnabled.12
.xlsb   application/vnd.ms-excel.sheet.binary.macroEnabled.12



*/
}
?>

</div>
</div><!-- BudyContainer-->
</div> <!-- end ian-->



</div><!-- end Container-->
</body>
</html>












