<?php

include 'config.php';

if(isset($_POST['signup'])){

   $name = mysqli_real_escape_string($conn, $_POST['username']);
   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `register` WHERE email = '$email' AND password = '$password'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `register`(username, firstname, lastname, email, password) VALUES('$name', '$firstname', '$lastname', '$email', '$password')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/TravelBro/css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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
        <h1>Sign<span class="logo-bro">up</span></h1>
        <form action="" method="post">
            <p>User Name</p>
            <input type="text" name="username" placeholder="User Name">
            <p>First Name</p>
            <input type="text" name="firstname" placeholder="First Name">
            <p>Last Name</p>
            <input type="text" name="lastname" placeholder="Last Name">
            <p>Email</p>
            <input type="email" name="email" placeholder="Email">
            <p>Password</p>
            <input type="password" name="password" placeholder="password">
            <p>Confirm Password</p>
            <input type="password" name="cpassword" placeholder="Confirm password">
            <button type="submit" name="signup">Sign up</button> <br>

        </form>
    </div>
    
</body>
</html>