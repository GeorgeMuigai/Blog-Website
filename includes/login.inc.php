<?php
    require_once 'db.inc.php';

    extract($_POST);

    $get_user = "SELECT * FROM users WHERE user_name = ?";

    if ($stmt = $con->prepare($get_user)) {
        $stmt->bind_param("s", $user_name);
        $stmt->execute();

        $user = $stmt->get_result();

        if($row = $user->fetch_assoc()) {
            $user_id = $row['id'];
            $user_nm = $row['user_name'];
            $user_avatar = $row['user_avatar'];
            $hashed_pass = $row['user_pass'];

            $is_equal = password_verify($user_pass, $hashed_pass);

            if($is_equal) {
                session_start();
                $_SESSION['avatar'] = $user_avatar;
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $user_id;
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
?>