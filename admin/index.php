<?php
require_once '../load.php';
confirm_ligged_in();

$message = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to admin panel</title>
</head>
<body>

<h1><?php echo $message; ?></h1>

    <h2>Welcome to admin panel, <?php echo $_SESSION['user_name'];?>!</h2>

    <p>Last successful login: <?php echo $_SESSION['user_date'];?></p>
    <p> Succesfully loged in <?php echo $_SESSION['user_login_success'];?> </p>

    <a href="admin_createuser.php">Create User</a>
    <a href="admin_logout.php">Sign out</a>
</body>
</html>