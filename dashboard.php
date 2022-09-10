<?php
require 'templates/header.php';
?>
<div class="dash-container">
    <div class="dashboard">
        <div class="sides">
            <div class="tabs">
                <li class="active"><a href="">Manage Posts</a></li>
                <li><a href="addPost.php">Add Posts</a></li>
            </div>
            <div class="user-posts">
                <h1>Manage Posts</h1>
                <p id="message" class="dash_message"></p>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="table">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="assets/JS/dashboard.js?v=<?php
    echo time();
?>"></script>