<?php
    $server = "localhost";
    $db_user = "root";
    $db_name = "b_website";


    $con = new mysqli($server, $db_user, "", $db_name);

    if(!$con) {
        die ($con->errno);
    }
?>