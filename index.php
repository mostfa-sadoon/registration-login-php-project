<?php
session_start();
include "init.php";
include "connect.php";
if(!isset($_SESSION['user_name']))
{
  header('location:register.php');
}
else
{
    header('location:home.php');
}?>

<div class="zepy">

<h1> trlkmgt</h1>
</div>

<?php

include "include/templet/footer.php";
?>