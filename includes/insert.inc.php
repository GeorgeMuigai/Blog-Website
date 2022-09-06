<?php
    require_once 'db.inc.php';
    session_start();

    extract($_POST);

    $uploaded = false;
    // upload 
    $target_dir = '../assets/posts/';
    $file_name = $_FILES['post_img']['name'];
    $tmp_name = $_FILES['post_img']['tmp_name'];

    $file_path = $target_dir . $file_name;

    $file_type = pathinfo($file_path, PATHINFO_EXTENSION);
    $accepted_types = array('png', 'jpeg', 'jpg', 'svg');

    if (in_array($file_type, $accepted_types)) {
        if (move_uploaded_file($tmp_name, $file_path)) {
            $uploaded = true;
        } else {
            echo "upload err";
        }
    } else {
        echo "unsupported";
        die();
    }

    if(isset($_POST['post_title']) && $uploaded) {
        extract($_POST);

        $date = date('M d, Y');
        $uid = $_SESSION['id'];

        $upload_post = "INSERT INTO posts (post_title, post_desc, post_img, post_cat, post_date, user_id) VALUES (?, ?, ?, ?, ?, ?)";

        if($stmt = $con->prepare($upload_post)) {
            $stmt->bind_param("sssssi", $post_title, $post_desc, $file_name, $post_cat, $date, $uid);
            $stmt->execute();

            echo "success";
        } else {
            echo "error encountered";
            die ();
        }

        $stmt->close();
    }
?>