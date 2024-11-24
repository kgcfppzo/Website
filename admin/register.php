
<?php
include '../config.php';
include '../includes/db.php';
include '../includes/user.php';

$db = new Database();
$user = new User($db);

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }
    if($username && $email && $password){
        try{
            $loggedinuser = $user->register($username, $email,  $password);
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $loggedinuser;
            header('Location: ./admin/dashboard.php');
        }catch(Exception $e){
            die();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="register.php">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Email:</label>
        <input type="text" name="email" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
