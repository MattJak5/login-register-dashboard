<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" id="registration">
        <h1>Log in</h1>
        <form method="post" action="">
            <div class="input_field">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
            </div>
             <div class="input_field">
                <label for="user_password">Password: </label>    
                <input type="password" name="password" id="user_password">
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
        <div>
            <p>Haven't got an account?</p>
             <a href="register.php">Register here</a>
        </div>
       
    </div>
    
</body>
</html>

<?php
session_start();
include '../database/db_connection.php';

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $dbh->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$row) {
        echo 'Username does not exist';
        exit();
    }

    if(!password_verify($password, $row['password'])) {
        echo 'Incorrect password';
        exit();
    }

    $_SESSION['user_id'] = $row['id'];
    header('Location: dashboard.php');
    exit();
}
?>