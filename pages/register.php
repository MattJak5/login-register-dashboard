<?php 
    include '../database/db_connection.php';
    $errors = []; 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_check = $_POST['password_check'];
   

        if(empty($username)) { $errors[] = 'Username is required'; } 
        if(empty($email)) { $errors[] = 'Email is required'; }
        if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){ $errors[] = 'Invalid email format'; }
        if(empty($password)) { $errors[] = 'Password is required'; }
        if(empty($password_check)) { $errors[] = 'Re-enter password is required'; }

        if($password != $password_check) { $errors[] = 'Passwords do not match'; }

        $stmt = $dbh->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0) { $errors[] = 'Email already exists'; }

        $stmt = $dbh->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if($stmt->rowCount() > 0) { $errors[] = 'Username already exists'; }

        if(empty($errors)) {
            $secure_pass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $dbh->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $secure_pass);
            $stmt->execute();
            header('Location: login.php');
            exit();
        }
    }
?>

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
        <?php if(!empty($errors)): ?>
            <div class="errors">
                <?php foreach($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="register.php">
            <div class="input_field">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
            </div>
            <div class="input_field">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
            </div>
             <div class="input_field">
                <label for="password">Password: </label>    
                <input type="password" name="password" id="password">
            </div>
                <div class="input_field">
                <label for="password_check">Re-enter Password: </label>    
                <input type="password" name="password_check" id="password_check">
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
        <div>
            <p>Already have an account?</p> <a href="login.php">Log in here</a>
        </div>
    </div>
    
</body>
</html>
