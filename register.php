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
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
   
    $name = test_input($_POST["name"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $confirm_password = test_input($_POST["confirm_password"]);
    /*************validate name ****************** */
    if(empty($name))
    {
       $formerr["name"]="the name can't be empty";
    }
    elseif(strlen($name)>25)
    {
      $formerr["name"]="the name is soo long";
  
    }
    elseif(strlen($name)<3)
    {
      $formerr["name"]="the name is soo short";
    }
  
    /*********************end validate name************************** */
    /*************validate username ****************** */
    $user=checkuser($username);
    if(empty($username))
    {
       $formerr["username"]="the username can't be empty";
    }
    elseif(strlen($username)>25)
    {
      $formerr["username"]="the username is soo long";
  
    }
    elseif(strlen($username)<4)
    {
      $formerr["username"]="the username is soo short";
    }
  
    if($user>0)
    {
        $formerr["username"]="the username is already token";
    }
 
    /*********************end validate username************************** */

    /*******************validate password********************* */
          if(empty($password))
          {
              $formerr["password"]="the password can't be empty";
          }
          elseif(strlen($password)>25)
            {
            $formerr["password"]="the name is soo long";
        
            }
            elseif(strlen($password<6))
            {
            $formerr["password"]="the password is soo short";
            }
            else{
               
                    if($password==$confirm_password)
                    {
                    $password= password_hash($password, PASSWORD_DEFAULT);
                    }
                    else{
                        $formerr["confirmpassword"]="thw confirm password don't identical password";
                    }
                }
    /******************end validate password************************ */
      if(empty($formerr))
      {
          $stmt=$conn->prepare("insert into users (name,username,password) values(?,?,?)");
          $stmt->execute([$name,$username,$password]);
          $count=$stmt->rowCount();
          if($count>0)
          {       
             $_SESSION["name"]=$name;
             $_SESSION["username"]=$username;
             header('location: home.php');
          }
      }
  }  
  ?>
  <div class="container form-page">
       <h1 class="text-center"> <span class="register">  register</span></h1>
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="login">
          <div class="form-group">
             <lable> enter your name</lable>
             <input class="form-control" type="text" name="name">
             <p class="alert-danger"><?php if(isset($formerr['name'])){echo  $formerr["name"]; } ?></p>
          </div>
          <div class="form-group">
             <lable> enter your username</lable>
             <input class="form-control" type="text" name="username">
             <p class="alert-danger"><?php  if(isset($formerr['username'])){echo  $formerr["username"];}   ?></p>
          </div>
          <div class="form-group">
             <lable> enter your password</lable>
             <input class="form-control" type="password" name="password">
             <p class="alert-danger"><?php if(isset($formerr['password'])){echo  $formerr["password"];}   ?></p>
          </div>
          <div class="form-group">
             <lable> confirm password</lable>
             <input class="form-control" type="password" name="confirm_password">
             <p class="alert-danger"><?php if(isset($formerr['confirmpassword'])){echo  $formerr["confirmpassword"];}  ?></p>
          </div>
          <input type="submit" class="btn btn-primary" name="register" value="register">
       </form>
  </div>
<?php
include "include/templet/footer.php";
?>