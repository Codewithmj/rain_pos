<?php 
session_start();
$conn = new mysqli('localhost', 'root', '', 'rain_pos');

$admins = array("persleyann3@gmail.com", "uzodinmamaryjane@gmail.com");


function days_ago($timestamp){
    $current_time = time();
    $time_difference = $current_time - strtotime($timestamp);
    $days = floor($time_difference/(60*60*24));

    if ($days == 1){
            return "yesterday";
    }else if($days == 0){
        return "today";
    }else{
        return $days." days ago";
    }
    
}
?>


