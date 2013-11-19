

<html>

<head>
    <title>MySQL file upload example</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body>
    
    
    <form action="add_file.php" method="post" enctype="multipart/form-data">
        <input name="uploaded_file" type="file"  id="uploaded_file"><br>
        <input type="submit" value="Upload file">
    </form>
    
    <p>
        <a href="list_files.php">See all files</a>
    </p>
</body>
</html>