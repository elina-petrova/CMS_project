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