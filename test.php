<?php 

include_once 'config/database_old.php';
include_once 'config/database.php';

#starting with this point please measure the time for the following execution untill i call microtime(true)-start
$start = microtime(true);

#repeat 100 times db connection on PHP
$i = 0;
while($i < 1000){
    $database = new Database_Old();
    $db = $database -> getConnection();
    $i ++;
}

$old_time_cal = microtime(true) - $start;

# run the new code
$start = microtime(true);

#repeat 100 times db connection on PHP
$i = 0;
while($i < 1000){
    $database = Database::getInstance();
    $db = $database -> getConnection();
    $i ++;
}

$new_time_cal = microtime(true) - $start;
$diff = ($old_time_cal - $new_time_cal)/1000;
$percentage = ($new_time_cal / $old_time_cal) * 100;
printf('DB Old Connection Call ==> %s ms'.PHP_EOL, $old_time_cal*1000);
printf('DB New Connection Call ==> %s ms'.PHP_EOL, $new_time_cal*1000);

printf('You saves %s per connection'.PHP_EOL, $diff*1000);
printf('New connection only takes %s%% od old connection'.PHP_EOL, $percentage);