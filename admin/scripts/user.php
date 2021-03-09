<?php

function createUser($user_data)
{
    // checking of works
    // return var_export($user_data, true);

    // 1. run proper SQL query to insert user
    $pdo = Database::getInstance()->getConnection();
    
    //this query using execute and prepare is safe from hacking database
    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email)';
    $create_user_query .= ' VALUES(:fname, :name, :pass, :email)';
    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set->execute(
        array(
            ':fname'=>$user_data['fname'],
            ':name'=>$user_data['username'],
            ':pass'=>$user_data['password_encrypt'],
            ':email'=>$user_data['email'],
        )
    );
    // 2. redirect to index.html if create user successfully (maybe with some messages???)
    // otherwise show error message

    if ($create_user_result) {
        $mailSent = sendMail($user_data);
        if (!$mailSent) {
            $_SESSION['message'] = sprintf('New user %s has been created. Check your email to get the password. Thank you!', $user_data['username']);
            redirect_to('index.php');
        } else {
            return 'Mail was not sent';
        }
    } else {
        return 'The user did not fo through!';
    }
}
