<?php

/**function to check the user name is already exist */
function checkuser($value)
{
    global $conn;
    $stmt=$conn->prepare("SELECT username FROM users WHERE username=?");
    $stmt->execute([$value]);
    $row=$stmt->fetch();
    $count=$stmt->rowcount();
    if($count>0)
    {
        return true;
    }
    else
    {
       return false;
    }
}