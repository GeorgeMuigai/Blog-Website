<?php

    require_once 'db.inc.php';

    // delete posts from the dashboard
    if (isset($_POST['delete_post'])) {
        extract($_POST);

        $delete = "DELETE FROM posts WHERE id = ?";

        if ($stmt = $con->prepare($delete)) {
            $stmt->bind_param("i", $delete_post);
            $stmt->execute();

            echo "success";
        }

        $stmt->close();
    }