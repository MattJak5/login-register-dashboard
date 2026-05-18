<?php
session_start();
include '../database/db_connection.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$stmt = $dbh->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$username = $row['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main-container">
        <h1>Welcome to the dashbord</h1>
        <h2><?php echo $username; ?></h2>
    </div>
</body>
</html>
