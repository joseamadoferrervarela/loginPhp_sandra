<?php
require "database.php";
$message ='';

if(!empty($_POST['email']) && !empty($_POST['password'])){
    $sql = "INSERT INTO usuarios (email,password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email",$_POST['email']);
    $password =password_hash ($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(":password", $password);

    if($stmt->execute()){
        $message ='sucesfully created new user';
    }else{
        $message= 'Sorry there must have been an isssue creating your account';
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <title>singup</title>
</head>
<body>
    <?php require 'parcials/header.php'?>


    <h1>singUp</h1>
    <span> or <a href="login.php">login</a></span>
    <form action="singup.php" method="post">
        <input type="text" name="email" placeholder="enter your email">
        <input type="password" name="password" placeholder="enter your password">
        <input type="password" name="confirm_password" placeholder="confirm your password">
        <input type="submit" value="send">
    </form>

    <?php if(!empty($message)):?>
    <p> <?= $message ?> </p>
    <?php endif ?>

</body>
</html>