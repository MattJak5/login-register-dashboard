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
        <form method="post" action="">
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

            <button type="submit">Submit</button>

        </form>
    </div>
    
</body>
</html>