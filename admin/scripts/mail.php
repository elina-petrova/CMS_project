<?php
function sendMail($user_data)
{
        $fname = $user_data['fname'];
        $name = $user_data['username'];
        $pass = $user_data['password'];
        $pass_ecnrypt=$user_data['password_encrypt'];
        $email=$user_data['email'];
        $url_to_login = 'localhost/movies_cms/admin/admin_login.php';

        $email_subject = 'New user is created';
        $message = sprintf('Thank you for creating a new user! Your username is: %s, Password is: %s, Sha1 is: %s. Use this URL to login: %s', $fname, $pass, $pass_ecnrypt, $url_to_login);
           
        $email_headers = array(
        'From' => 'noreply@yourdomain.ca',
        'Reply-To' => $email,
        'Topic' => 'New account is created'
);

        $email_result = mail($email, $email_subject, $message, $email_headers); 
        return $email_result;
}