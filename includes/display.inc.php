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

    if (isset($_POST['po_id'])) {
        extract($_POST);

        $get_post = "SELECT * FROM posts WHERE id = ?";

        if ($stmt = $con->prepare($get_post)) {
            $stmt->bind_param("i", $po_id);
            $stmt->execute();

            $post_info = $stmt->get_result();

            if ($row = $post_info->fetch_assoc()) {
                $post_title = $row['post_title'];
                $post_desc = $row['post_desc'];
                $post_img = $row['post_img'];
                $post_cat = $row['post_cat'];
                $post_date = $row['post_date'];
                $user_id = $row['user_id'];

                $user_info = get_user($user_id, $con);
                $user_name = $user_info['user_name'];
                $user_avatar = $user_info['user_avatar'];

                $prev = get_prev_id($po_id, $con);
                if ($prev != null) {
                    $prev_post_id = $prev['id'];
                    $prev_post_img = $prev['post_img'];
                    $prev_post_title = $prev['post_title'];
                    $prev_post_date = $prev['post_date'];
                }

                $next = get_next_id($po_id, $con);
                if ($next != null) {
                    $next_post_id = $next['id'];
                    $next_post_img = $next['post_img'];
                    $next_post_title = $next['post_title'];
                    $next_post_date = $next['post_date'];
                }

                $post =  '<div class="post-items one-post">
                <div class="post-img-container post-one-img">
                    <img src="assets/posts/'.$post_img.'">
                </div>
                <div class="one-details">
                    <h2>'.$post_title.'</h2>
                    <div class="p-details">
                        <div class="user">
                            <img src="assets/profiles/'.$user_avatar.'" alt="">
                            <p>'.$user_name.'</p>
                        </div>
                        <div class="date">
                            <p>'.$post_date.'</p>
                        </div>
                    </div>
                    <div class="desc">
                        <p>'.$post_desc.'</p>
                    </div>
                </div>
           </div>
           <div class="user-data">
                    <div class="profile-container">
                        <img src="assets/profiles/'.$user_avatar.'">
                    </div>
                    <div class="user-name">
                        <h3 style="text-align: center;">'.$user_name.'</h3>
                    </div>
                    <div class="user-bio">
                        <p style="text-align: center;">
                            Enabling people realize their capabilities and their abilities
                        </p>
                    </div>
                </div>';

                if ($prev != null) {
                    $post .= '<h3 class="nav-post">Previous post</h2>
                    <div class="prev-post" onclick="goToPost('.$prev_post_id.')">
                    <img src="assets/posts/'.$prev_post_img.'" alt="">
                    <div class="prev-overlay"></div>
                    <div class="prev-button">
                        <img src="assets/icons/previous.png">
                    </div>
                    <div class="prev-date">
                        <p>'.$prev_post_date.'</p>
                    </div>
                    <div class="prev-title">
                        <h2>'.$prev_post_title.'</h4>
                    </div>
                </div>';
                } else {
                    $post . "prev is null";
                }

                if ($next != null) {
                    $post .= '<h3 class="nav-post heading-next">Next post</h3>
                    <div class="next-post" onclick="goToPost('.$next_post_id.')">
                    <img src="assets/posts/'.$next_post_img.'" alt="">
                    <div class="next-overlay"></div>
                    <div class="next-button">
                        <img src="assets/icons/next.png">
                    </div>
                    <div class="next-date">
                        <p>'.$next_post_date.'</p>
                    </div>
                    <div class="next-title">
                        <h2>'.$next_post_title.'</h4>
                    </div>
                </div>';
                } else {
                    $post . "next is null";
                }

                echo $post;
            }
        }

        $stmt->close();
    }

    if (isset($_POST['get_related'])) {
        extract($_POST);

        $posts = "SELECT * FROM posts WHERE post_cat = ? ORDER BY id DESC LIMIT 5";

        if ($stmt = $con->prepare($posts)) {
            $stmt->bind_param("s", $get_related);
            $stmt->execute();

            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $post_id = $row['id'];
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];
                $post_img = $row['post_img'];

                // echo $post_title, $post_date, $post_img;
                if ($post_id == $dis_post) {
                    echo '';
                } else {
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
        }
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

    function get_prev_id ($id, $conn) {
        $previous = "SELECT * FROM posts ORDER BY id DESC";

        $result = $conn->query($previous);

        while ($row = $result->fetch_assoc()) {
            $post_id = $row['id'];

            if ($post_id < $id) {
                return $row;
            }
        }
    }
    
    function get_next_id ($id, $conn) {
        $next = "SELECT * FROM posts";

        $result = $conn->query($next);

        while ($row = $result->fetch_assoc()) {
            $post_id = $row['id'];

            if ($post_id > $id) {
                return $row;
            }
        }
    }
?>