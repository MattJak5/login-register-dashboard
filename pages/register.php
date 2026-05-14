<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" id="registration">
        <h1>Register</h1>
        <form method="post" action="register.php">
            <div class="input_field">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
            </div>
            <div class="input_field">
                <label for="email">Email: </label>
                <input type="text" name="email" id="email">
            </div>
             <div class="input_field">
                <label for="password">Password: </label>    
                <input type="text" name="password" id="password">
            </div>
                <div class="input_field">
                <label for="password_check">Re-enter Password: </label>    
                <input type="text" name="password_check" id="password_check">
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
        <div>
            <p>Already have an account?</p> <a href="login.php">Log in here</a>
        </div>
    </div>
    
</body>
</html>

<?php 
    include '../database/db_connection.php';

    if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];

    $securePass = password_hash($password, PASSWORD_DEFAULT);
    if ($securePass != $password_check) { echo 'Passwords do not match'; exit();}

    $stmt = $dbh->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $count = $stmt->rowCount();
    if ($count > 0) {echo 'email already exists'; exit();}

    $stmt = $dbh->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->execute([$_POST['usernam']]);
    $count = $stmt->rowCount();
    if ($count > 0) {echo 'username already exists', exit();}

    $stmt = $dbh->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $secure_pass);

    $stmt->execute();
    header('login.php');
    exit();
    }
?>