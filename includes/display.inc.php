<?php
    require_once 'db.inc.php';

    if(isset($_POST['get_all_posts'])) {

        $get_posts = "SELECT * FROM posts ORDER BY id DESC";

        $result = $con->query($get_posts);

        while($row = $result->fetch_assoc()) {
            $post_id = $row['id'];
            $post_title = $row['post_title'];
            $post_desc = $row['post_desc'];
            $post_cat = $row['post_cat'];
            $post_date = $row['post_date'];
            $post_img = $row['post_img'];
            $user_id = $row['user_id'];

            // get the user name and avatar
            $user_data = get_user($user_id, $con);
            $user_name = $user_data['user_name'];
            $user_avatar = $user_data['user_avatar'];

            echo '<div class="post-items">
                    <div class="post-img-container">
                        <img src="assets/posts/'.$post_img.'" alt="" srcset="">
                    </div>
                    <div class="details">
                        <h2>'.$post_title.'</h2>
                        <div class="p-details">
                            <div class="user">
                                <img src="assets/profiles/'.$user_avatar.'" alt="author">
                                <p>'.$user_name.'</p>
                            </div>
                            <div class="date">
                                <p>'.$post_date.'</p>
                            </div>
                        </div>
                        <div class="description">
                            <p>'.$post_desc.'
                            </p>
                        </div>
                        <div class="btn">
                            <button onclick="goToPost('.$post_id.')">Continue Reading</button>
                        </div>
                    </div>
                </div>';
        }
    }

    if (isset($_POST['get_recent'])) {
        $recent_five = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";

        $recent_res = $con->query($recent_five);

        while ($row = $recent_res->fetch_assoc()) {
            $post_id = $row['id'];
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_img = $row['post_img'];

            // echo $post_title, $post_date, $post_img;
            echo '<div class="recent-post" onclick="goToPost('.$post_id.')">
            <div class="round-container">
                <img src="assets/posts/'.$post_img.'" alt="" srcset="">
            </div>
            <div class="date-title">
                <p class="small-p-date">'.$post_date.'</p>
                <p class="small-p-title">'.$post_title.'</p>
            </div>
        </div>';
        }
    }

    if (isset($_POST['post_id'])) {
        extract($_POST);
        // get the post
        $get_post = "SELECT * FROM posts WHERE id = ?";

        if ($stmt = $con->prepare($get_post)) {
            $stmt->bind_param("i", $post_id);
            $stmt->execute();

            $post_info = $stmt->get_result();

            if ($row = $post_info->fetch_assoc()) {

                $post = json_encode($row);
                echo $post;
            }
        }

        $stmt->close();
    }
    function get_user($id, $conn) {
        $user = "SELECT * FROM users WHERE id = ?";

        if($stmt = $conn->prepare($user)) {
            $stmt->bind_param('i', $id);
            $stmt->execute();

            $res = $stmt->get_result();

            if($row = $res->fetch_assoc()) {
                return $row;
            }
        }
    }
?>