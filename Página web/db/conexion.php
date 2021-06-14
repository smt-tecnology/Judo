<?php 
    $con = new mysqli('localhost', 'interjud_admin', 'judointerfederativo', 'interjud_ranking', '3306');

    if($con->connect_error){
        echo $con->connect_error;
    }

    $con->set_charset('utf8');
?>