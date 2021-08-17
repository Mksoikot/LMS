<?php

require_once '../dbcon.php';
 session_start();
    if(isset($_SESSION['student_login'])){
    header('location:index.php');
    }

if (isset($_POST['student_register'])) {
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];
   $username = $_POST['username'];
   $password = trim($_POST['password']);
   $roll = $_POST['roll'];
   $reg = $_POST['reg'];
   $phone = $_POST['phone'];

   $input_errors = array();
   if(empty($firstname)){
       $input_errors ['firstname'] = "First name field is requried";
   }
   if(empty($lastname)){
    $input_errors ['lastname'] = "Last name field is requried";
}
if(empty($email)){
    $input_errors ['email'] = "Email name field is requried";
}
if(empty($username)){
    $input_errors ['username'] = "User name field is requried";
}
if(empty($password)){
    $input_errors ['password'] = "Password is requried";
}
if(empty($roll)){
    $input_errors ['roll'] = "Roll field is requried";
}
if(empty($reg)){
    $input_errors ['reg'] = "Reg field is requried";
}
if(empty($phone)){
    $input_errors ['phone'] = "Phone number field is requried";
}
if(count( $input_errors) == 0){

      $email_check = mysqli_query($con,$query = "SELECT * FROM `students` WHERE `email`='$email'");
      $email_check_row = mysqli_num_rows($email_check);
      echo  $email_check_row;
      if($email_check_row == 0){
        $username_check = mysqli_query($con,$query = "SELECT * FROM `students` WHERE `username`='$username'");
        $username_check_row = mysqli_num_rows($username_check);
        if($username_check_row == 0){
            if(strlen($username) > 5){
                if(strlen($password) > 5){
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $result = mysqli_query($con , $query ="INSERT INTO `students`( `firstname`, `lastname`, `roll`, `reg`, `email`, `username`, `password`, `status`, `phone`) VALUES ('$firstname','$lastname','$roll','$reg','$email','$username','$hashed_password','0','$phone')");
    if($result){
        $success =  "Your Registation successfully!";
    }else{
        $error = "Something Wrong!";
    }
                }else{
                    $password_exists ='Password More Then5 Characters';  
                }

            }else{
            $username_exists ='Username More Then 5 Characters';
        }
        }else{
            $username_exists ='This Username Already Exists';
        }
      }else{
          $email_exists ='This Email Already Exists';
      } 
}   

}
?>


<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>LMS</title>
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
    <div class="wrap">
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body animated slideInDown">
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--LOGO-->
            <div class="logo">
                <h1 style="text-align: center;">LMS</h1>
                <?php
                if(isset($success)){
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?= $success ?>
                </div>
                <?php
                }
                ?>
                <?php
                if(isset($error)){
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?= $error ?>
                </div>
                <?php
                }
                ?>
                <?php
                if(isset($email_exists )){
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?= $email_exists  ?>
                </div>
                <?php
                }
                
                ?>

                <?php
                if(isset($username_exists )){
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?= $username_exists ?>
                </div>
                <?php
                }
                
                ?>

                <?php
                if(isset($password_exists )){
                ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <?= $password_exists ?>
                </div>
                <?php
                }
                
                ?>

            </div>
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="First Name" name="firstname"
                                        value="<?= isset($firstname) ? $firstname:'' ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if(isset($input_errors ['firstname'])){
                                    echo '<span style="color: red";>'.$input_errors ['firstname'].'</span>';
                                }
                            ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastname"
                                        value="<?= isset($lastname) ? $lastname:'' ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if(isset($input_errors ['lastname'])){
                                    echo '<span style="color: red";>'.$input_errors ['lastname'].'</span>';
                                }
                            ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        value="<?= isset($email) ? $email:'' ?>">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <?php
                                if(isset($input_errors ['email'])){
                                    echo '<span style="color: red";>'.$input_errors ['email'].'</span>';
                                }
                            ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="Username" name="username"
                                        value="<?= isset($username) ? $username:'' ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if(isset($input_errors ['username'])){
                                    echo '<span style="color: red";>'.$input_errors ['username'].'</span>';
                                }
                            ?>
                            </div>
                            <div class="form-group">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    <i class="fa fa-key"></i>
                                </span>
                                <?php
                                if(isset($input_errors ['password'])){
                                    echo '<span style="color: red";>'.$input_errors ['password'].'</span>';
                                }
                            ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="Roll-No" name="roll"
                                        value="<?= isset($roll) ? $roll:'' ?>" pattern="[0-9]{6}">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if(isset($input_errors ['roll'])){
                                    echo '<span style="color: red";>'.$input_errors ['roll'].'</span>';
                                }
                            ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="Reg-No" name="reg"
                                        value="<?= isset($reg) ? $reg:'' ?>" pattern="[0-9]{6}">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if(isset($input_errors ['reg'])){
                                    echo '<span style="color: red";>'.$input_errors ['reg'].'</span>';
                                }
                            ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="01*********" name="phone"
                                        value="<?= isset($phone) ? $phone:'' ?>" <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if(isset($input_errors ['phone'])){
                                    echo '<span style="color: red";>'.$input_errors ['phone'].'</span>';
                                }
                            ?>
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" name="student_register"
                                    value="Register">
                            </div>
                            <div class="form-group text-center">
                                Have an account?, <a href="sign-in.php">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>
    </div>
    <!--BASIC scripts-->
    <!-- ========================================================= -->
    <script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
    <!--TEMPLATE scripts-->
    <!-- ========================================================= -->
    <script src="../assets/javascripts/template-script.min.js"></script>
    <script src="../assets/javascripts/template-init.min.js"></script>
    <!-- SECTION script and examples-->
    <!-- ========================================================= -->
</body>

</html>