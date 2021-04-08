<?php 
    include('server.php'); 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=REgister, initial-scale=1.0">
    <title>Register Page</title>

    <link rel="stylesheet" href="css/style.css">
    <div>
    </div>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">

</head>
<body>


<div class="header">
    <h2>Register</h2>
</div>


<!-- form input -->
<form action="register_db.php" method="post">
    <?php include('errors.php'); ?>
    <?php if(isset($_SESSION['error'])) : ?>
        <div class="error"> 
            <h3>
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email">
    </div>
    <div class="input-group">
        <label for="password_1">Password</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label for="password_2">Confirm Password</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" name="reg_user" class="btn">Register</button>
    </div>
    <p>Already a member?<a href="login.php"><br>Go back to login</a></p>
</form>

    
</body>
</html>