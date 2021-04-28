<?php
session_start();
include "init.php";
include  "connect.php";

   if(isset($_SESSION['username']))
   {

    echo "<h1> hallo ".$_SESSION['username']."</h1>";
    
   }
   
include  "include/templet/footer.php"; 
?>