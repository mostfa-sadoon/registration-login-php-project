<?php
$dsn='mysql:host=localhost;dbname=users';
$user="root";
$pass="";
try{

    $conn=new PDO($dsn,$user,$pass);
   
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}


?>