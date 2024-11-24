
<?php
include '../config.php';
include '../includes/db.php';
include '../includes/user.php';

session_start();
$userModel = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        try{
            $loggedinuser = $userModel->login($username, $password);
            if($loggedinuser){
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $loggedinuser->username;
                header('Location: ./dashboard.php');
            }else{
                $error = "Invalid username or password";
            }
        }catch(Exception $e){
            $error = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="shortcut icon" href="/assets/images/logo.png" type="image/x-icon">
</head>
<body>
    <section class='logins'>
        <div class='login-card'>
            <span class='caheader'>
                <h1 class='log'>Login</h1>
            </span>
            <form class='form-group' method="POST" action="login.php">
                <label>Username:</label>
                <input type="text" name="username" autocomplete="username" required>
                <br>
                <label>Password:</label>
                <input type="password" name="password" required>
                <br>
                <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
                <input type="submit" value="Login">
            </form>
        </div>
    </section>
</body>
</html>
