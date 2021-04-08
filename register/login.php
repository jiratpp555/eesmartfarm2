<?php 
    include('server.php'); 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=REgister, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="css/style.css">
    <div>
    </div>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">

       
</head>
<body>

<div class="header">
    <h2>Log in</h2>
</div>

<form action="login_db.php" method="post">
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
    <p style="background-image: url("css/KMITL.png"); width: 30px; height: 30px; background-attachment: fixed;"></p>
    <p style="color: sienna; font-size: 25px;text-align: center" >Electronics Engineering KMITL</p>
    <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" name="login_user" class="btn">Log in</button>
    </div>
    <p>Are you a member yet?<a href="register.php"><br>Sign up</a></p>  
</form>

    
</body>
</html>