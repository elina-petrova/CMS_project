<!-- dashboard page -->

<?php
require_once '../load.php';
confirm_ligged_in();
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
    <h2>Welcome to admin panel, <?php echo $_SESSION['user_name'];?>!</h2>

    <p>Last successful login: <?php echo $_SESSION['user_date'];?></p>
    <p> Succesfully loged in <?php echo $_SESSION['user_login_success'];?> </p>
    <a href="admin_logout.php">Sign out</a>
</body>
</html>