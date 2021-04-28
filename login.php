<?php
session_start();
include "init.php";
include  "connect.php";
$formerr=array();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
   
    
    $username=test_input($_POST['username']);
    $password=test_input($_POST['password']);
    $password= password_hash($password, PASSWORD_DEFAULT);
    $user=checkuser($username);
    if($user>0)
    {
            $stmt=$conn->prepare("select  password from users where username=?");
            $stmt->execute([$username]);
            $row=$stmt->fetch();
            $count=$stmt->rowcount();
              if($count>0)
              {
                 if($password=$row['password'])
                 {
                    $_SESSION["username"]=$username;
                    header('location: home.php');
                  }  
              }
    }
    else{
       $formerr['username']="the username not exist";
    }

}
     ?>
<div class="container form-page">
       <h1 class="text-center"> <span class="login"> login </span></h1>
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="login">
       <div class="form-group">
             <lable> enter your username</lable>
             <input class="form-control" type="text" name="username">
             <p class="alert-danger"><?php  if(isset($formerr['username'])){echo  $formerr["username"];}   ?></p>
          </div>
          <div class="form-group">
             <lable> enter your password</lable>
             <input class="form-control" type="password" name="password">
             <p class="alert-danger"><?php if(isset($formerr['password'])){echo  $formerr["password"];}   ?></p>
             <input type="submit" class="btn btn-primary" name="login" value="login">
            <a href="register.php" class="btn btn-success">register</a>

          </div>
       </form>
       </div>


   <?php
     include "include/templet/footer.php";
   ?>