<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/style.css?v=<?php
                                                        echo time();
                                                        ?>">
    <title>Blog Website</title>
</head>

<body>
    <nav>
        <div class="logo">
            <div class="menu">
                <span></span>
            </div>
            <h4><a href="index.php">BW</a></h4>
        </div>
        <div class="search-bar">
            <input type="search" name="" id="search" placeholder="Search">
        </div>
        <?php
        if (isset($_SESSION['user'])) {
            echo '<div class="user-avatar" id="avatar" onclick= "popup()">
                <img src="assets/profiles/'.$_SESSION['avatar'].'"">
            </div>
            <div class="user-info" id="popup-user">
                <a href="#">Profile</a>
                <a href="dashboard.php">Dashboard</a>
                <a onclick="logout()">Sign Out</a>
            </div>';
        } else {
            echo '<div class="btns">
                <button onclick="goToLogin()">Sign In/Sign Up</button>
            </div>';
        }
        ?>
    </nav>