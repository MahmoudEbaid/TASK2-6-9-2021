<?php
// task 1

$cha = 'A';
$next_cha = ++$cha; 
echo $next_cha."<br>";



// task 2
$link = 'www.example.com/public_html/index.php';
$file_name = substr(strrchr($link, "/"), 1);
echo $file_name ;


?>
