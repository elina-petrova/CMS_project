<?php
require_once '../load.php';

//redirect if already logged in
if(isset($_SESSION['user_id'])){
    redirect_to('index.php');
}

$user_name_value= '';

$ip = $_SERVER['REMOTE_ADDR'];
$login_attempts = 0;

if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // $password_not = trim($_POST['password']);
    // $password = sha1($password_not);


    $user_name_value = $username;
    
    if (!empty($username) && !empty($password)){
        $result = login($username, $password, $ip);
        $message = $result;
        $login_attempts = $_SESSION['user_count'];
    } else {
        $message = 'Please fill out required fields';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/main.css">
    <title>Welcome to the admin panel</title>
</head>
<body>
<!-- if message is not empty echo it or echo nothing-->


<div class="form-wrapper">
    <form action="admin_login.php" method="post">
        <div class="error"><?php echo !empty($message)?$message:'';?></div>
        <label for="username">Username:</label>
        <input id="username" type="text" name="username" value="<?php echo $user_name_value ?>">
        <label for="password">Password:</label>
        <input id="password" type="password" name="password">
        <button class="button" name="submit" type="submit">Login</button>
    </form>
    </div>  
</body>
</html>