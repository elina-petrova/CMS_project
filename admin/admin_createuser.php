<?php
require_once '../load.php';

//this is an internal page accesible only to logged in users
confirm_ligged_in();


if(isset($_POST['submit'])){

    //retrieve the submission from the post
    //and assign it to a new array

    // get a random password
    $createdPassword = createPassword();
    // make it encrypted
    $hash = password_hash($createdPassword, PASSWORD_DEFAULT, ['cost' => 12]);

    $data = array(
        //get rid of extra space
        'fname' => trim($_POST['fname']),
        'username' => trim($_POST['user_name']),
        'password' => $createdPassword,
        //encrypt it
        //old version
        // 'password_encrypt' => sha1($createdPassword),
        //new version
        'password_encrypt' => $hash,
        'email' => trim($_POST['email'])
    );

    $message = createUser($data);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create user</title>
</head>
<body>
    <h2>Create User</h2>

    <?php echo !empty($message)?$message:'';?>
    <form action="admin_createuser.php" method="post">
    <label for="first_name">First Name</label>
    <input id="first_name" type="text" name="fname" value="">
    <br><br>

    <label for="user_name">Username</label>
    <input id="user_name" type="text" name="user_name" value="">
    <br><br>
    
    <label for="email">Email</label>
    <input id="email" type="email" name="email" value="">
    <br><br>

    <button type="submit" name="submit">Create User</button>

    </form>
</body>
</html>