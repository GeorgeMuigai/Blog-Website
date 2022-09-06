<?php
    if(isset($_POST['logout'])) {
        session_start();
        if(session_destroy()){
            echo "true";
        } else {
            echo "false";
        }
    }
?>