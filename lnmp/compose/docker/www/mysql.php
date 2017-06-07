<?php
    $conn = new PDO('mysql:host=db;port=3306;dbname=mysql;charset=utf8', 'root', '123456');
    
    if($conn){
	echo 'success';
    } else {
    echo 'Connection failed: ' . $e->getMessage();
    }
?>
