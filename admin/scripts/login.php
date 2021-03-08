<?php
function login($username, $password, $ip)
{
    $pdo = Database::getInstance()->getConnection();
    // find matching username
    $get_user_name_query = 'SELECT * FROM tbl_user WHERE user_name ="'.$username.'"';
    $user_set = $pdo->query($get_user_name_query);
    $found_user = $user_set->fetch(PDO::FETCH_ASSOC);
    

    if($found_user){
        // if matched username was found, save user-id and get user-count from db
        $found_user_id = $found_user['user_id'];
        $_SESSION['user_count'] = $found_user['user_count'];

        // check if password is matched and if user-count is not blocked
        if($found_user['user_pass']==$password && $_SESSION['user_count'] != 3 ){

            // indicate that user has been logged in 
            // for confirm_logged_in() function
            $_SESSION['user_id'] = $found_user_id;
            $_SESSION['user_name'] = $found_user['user_fname'];

            // set user-count back to 0 if the password was matched and update db
            $_SESSION['user_count'] = 0;
            update_table('user_count', $_SESSION['user_count'], $found_user_id);

            // get totall successfully login number of the account and update db
            $_SESSION['user_login_success'] = $found_user['user_login_success'] + 1;
            update_table('user_login_success', $_SESSION['user_login_success'], $found_user_id);

            //update user IP in database by current ip
            update_table('user_ip', $ip, $found_user_id);

            //get last date from database, fet current date and time and then update db
            $_SESSION['user_date'] = $found_user['user_date'];
            date_default_timezone_set('America/Toronto');
            $date = date("Y-m-d H:i:s");
            update_table('user_date', $date, $found_user_id);
    
            //redirect user back to index.php
            redirect_to('index.php');
            return 'Successfully logged in'; 
        } else { 
            if ($_SESSION['user_count'] < 3){
                $_SESSION['user_count'] += 1;
                update_table('user_count', $_SESSION['user_count'], $found_user_id);
                $user_name_value = $username;
            } 
            $attempts_left = 3 - $_SESSION['user_count'];
            if($attempts_left > 0){
            return 'Wrong password.You now have '.$attempts_left.' available attempts before block';
            } else {
                return 'You made too many attempts. Your account is  blocked';
            }
        }
    } else {
        return 'There is no such user';
    }
}

function confirm_ligged_in()
{
    //only logged in users would have their user Id in the session
    //if session orid does not exist this is not a logged in user

    if(!isset($_SESSION['user_id'])){
        redirect_to("admin_login.php");
    }
}

function logout(){
    session_destroy();

    redirect_to('admin_login.php');
}