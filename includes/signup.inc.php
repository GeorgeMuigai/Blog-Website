<?php
    require_once 'db.inc.php';
    // if (isset($_POST['reg_user_name'])) {
    //     extract($_POST);
    // }
    $uploaded = false;
    
    if(!userExists($_POST['reg_user_name'], $con)) {

        $target_dir = '../assets/profiles/';
        $file_name = $_FILES['user-avatar'] ['name'];
        $tmp_name = $_FILES['user-avatar'] ['tmp_name'];

        $file_path = $target_dir . $file_name;

        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
        $accepted_types = array('png', 'jpeg', 'jpg', 'svg');

        if(in_array($file_extension, $accepted_types)) {
            if(move_uploaded_file($tmp_name, $file_path)) {
                $uploaded = true;
            } else {
                echo "error uploading file";
            }
        } else {
            echo "unsupported";
            die();
        }
    } else {
        echo "user exists";
    }
    if(isset($_POST['reg_user_name']) && $uploaded) {
        extract($_POST);

        if (userExists($reg_user_name, $con)) {
            echo "exists";
        } else {
            $add_user = "INSERT INTO users (user_name, user_pass, user_avatar) VALUES (?, ?, ?)";
    
            $hashed_pass = password_hash($reg_user_pass, PASSWORD_DEFAULT);
    
            if($stmt = $con->prepare($add_user)) {
                $stmt->bind_param("sss", $reg_user_name, $hashed_pass, $file_name);
                $stmt->execute();
    
                echo "success";
            }

            $stmt->close();
        }
    }

    function userExists($name, $conn) {
        $check = "SELECT * FROM users WHERE user_name = ?";

        if($stmt = $conn->prepare($check)) {
            $stmt->bind_param("s", $name);
            $stmt->execute();

            $user = $stmt->get_result();

            if($user->fetch_assoc()) {
                return true;
            } else {
                return false;
            }
        }

        $stmt->close();
    }
?>