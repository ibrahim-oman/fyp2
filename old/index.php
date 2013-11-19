<?php
 
$mask = "images";
 
// Add your own custom code here to verify that you can download something or view this index.
 

function human_filesize($size) {
    if (is_file($size)) {
        $size = filesize($size);
    }
    if ($size == 0) {
        $size = 1;
    }
    $filesizename = array("bytes", "kb", "mb", "gb", "tb", "pb", "eb", "zb", "yb");
    return round($size/pow(1000, ($i = floor(log($size, 1000)))), 2) . $filesizename[$i];
 
}
 
$dirs = array();
 
chdir($mask);
if (isset($_GET['d']) && !preg_match("/\.\./", $_GET['d'])) {
    $dirs = explode("/", $_GET['d']);
    if (file_exists($_GET['d'])) {
        $files = glob("{$_GET['d']}/*");
    }
} else {
    $files = glob("*");
}
chdir("..");
 
$legend = "<a href=\"{$_SERVER['PHP_SELF']}\">home</a>";
$curdir = "";
foreach ($dirs as $k=>$dir) {
    if ($k > 0) {
        $curdir = $curdir . "/" . $dir;
    } else {
        $curdir = $dir;
    }
    $legend .= " / <a href=\"{$_SERVER['PHP_SELF']}?d=" . urlencode($curdir)  . "\">" . $dir . "</a>";
}
 
$index = "<ul>";
foreach ($files as $k=>$f) {
    $print = preg_replace("/^.*\/(.*)$/", "\${1}", $f);
    if (is_dir($mask . "/" . $f")) {
        $index .= "<li>d: <a href=\"{$_SERVER['PHP_SELF']}?d=" . urlencode($f) . "\">" . $print . "</a></li>";
    } else {
        $fs = human_filesize($mask . "/" . $f);
        $index .= "<li>f: <a href=\"d.php?file=" . urlencode($f) . "\">" . $print . "</a> " . $fs . "</li>";
    }
}
$index .= "</ul>";
 
$html .= <<<eof
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Index</title>
<style type="text/css">
body {
    font-family:monospace;
    font-size:100%;
}
li {
    list-style-type:none;
    margin:0;
    padding:2px 4px;
}
li:hover {
    background-color:#e0e0e0;
}
a, a:link {
    color:maroon;
    text-decoration:none;
}
a:hover {
    color:#404040;
    text-decoration:underline;
}
a:visited {
    color:navy;
}
</style>
</head>
<body>
eof;
 
$html .= $legend;
 
$html .= <<<eof
<br />
eof;
 
$html .= $index;
 
$html .= <<<eof
</body>
</html>
eof;
 
print($html);