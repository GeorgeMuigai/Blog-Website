<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/login.css?v=<?php
        echo time();
    ?>">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="message-box-container">
            <div class="message-box">
                <p id="message" class="">Account Created Successfully!!</p>
            </div>
        </div>
        <div class="box">
            <div class="login">
                <div class="title">
                    <H2>Login</H2>
                </div>
                <div class="form">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" placeholder="enter your username" id="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="enter your password" id="password">
                    </div>
                    <div class="form-group btns">
                        <button onclick="validateLogin()">Login</button>
                    </div>
                </div>
                <p>don't have an account? <a onclick="signUp()">Sign Up</a></p>
            </div>
            <div class="sign-up">
                <div class="title">
                    <H2>Sign Up</H2>
                </div>
                <div class="form">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" placeholder="enter your username" id="reg_user">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="enter your password" id="reg_pass">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" placeholder="confirm your password" id="reg_pass_con">
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" name="user-avatar" id="user-avatar" accept="image/*">
                    </div>
                    <div class="form-group btns">
                        <button onclick="validateSignUp()">Create Account</button>
                    </div>
                </div>
                <p>already have an account? <a onclick="signIn()">Login</a></p>
            </div>
        </div>
    </div>
    <script src="assets/JS/login.js?v=<?php
                                        echo time();
                                        ?>"></script>
</body>

</html>