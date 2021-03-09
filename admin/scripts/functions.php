<?php

function redirect_to($location=null)
{
    if($location!=null){
        header('Location: '.$location);
        exit;
    }
}

function update_table($column_to_change, $new_value, $user_id)
{
    $pdo = Database::getInstance()->getConnection();
    $update_data_query = 'UPDATE tbl_user SET '.$column_to_change.'= :new_value WHERE user_id=:user_id';
            $update_data_set = $pdo->prepare($update_data_query);
            $update_data_set->execute(
                array(
                ':new_value'=>$new_value,
                ':user_id'=>$user_id
                )
            );
}

function createPassword() {
    // characters the password can contain
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_-+=\/?.,|{}[]';
    $pass = array(); 
    // length of the alpabet - 1 because index starts with 0
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        // get a random index 
        // random_int() because it is cryptographically secure
        $n = random_int(0, $alphaLength);
        //puch a character of that random index from alphabet
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function verifyPassword($password_entered, $password_stored){
        if (password_verify($password_entered, $password_stored)) {
            return true;
         } else {
            return false;
        }
}