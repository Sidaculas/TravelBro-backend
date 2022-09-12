<?php

include 'config.php';
session_start();

if(isset($_POST['signin'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `register` WHERE email = '$email' AND password = '$password'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:profile.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Login</title>
    <!--Linkind CSS and Fonts-->
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,700;1,100;1,200;1,300;1,400;1,700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
    <div class="login-form">
        <h1>Log<span class="logo-bro">in</span></h1>
        <form action="" method="post">
            <p>Email</p>
            <input type="email" name="email" placeholder="Email">
            <p>Password</p>
            <input type="password" name="password" placeholder="password">
            <button type="submit" name="signin">Sign in</button> <br>

            <p class="sign-para">Not signed up yet?</p>
            <a class="sign-up" href="signup.php">Sign up</a>


        </form>
    </div>

</body>
</html>