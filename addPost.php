<?php
    include_once 'templates/header.php';
?>

<div class="container" id="container">
    <div class="message-box-container">
        <div class="message-box">
            <p id="message" class="">Account Created Successfully!!</p>
        </div>
    </div>
    <div class="title">
        <h2>Add Post</h2>
    </div>
    <div class="form">
        <div class="form-group">
            <label>Post title</label>
            <input type="text" placeholder="post title" id="post_title">
        </div>
        <div class="form-group">
            <label>Post Description</label>
            <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label>Post Category</label>
            <select name="" id="categories">
                <option value=""></option>
                <option value="">Programming</option>
                <option value="">Technology</option>
                <option value="">Movies</option>
                <option value="">Photography</option>
            </select>
        </div>
        <div class="form-group">
            <label>Is featured</label>
            <input type="checkbox" name="" id="">
        </div>
        <div class="form-group">
            <label>Post Thumbnail</label>
            <input type="file" name="post-thumb" id="post_thumb" accept="image/*">
        </div>
        <div class="form-group">
            <?php
                if(isset($_SESSION['user'])) {
                    echo '<div class="btn-add">
                    <button onclick="validateUploads()" id="btn-upload">Upload Post</button>
                </div>';
                } else {
                    echo '<div class="message">
                    <p>please login to add post</p>
                </div>';
                }
            ?>
        </div>
    </div>
</div>
<script src="assets/JS/add_post.js"></script>