<?php
require_once 'templates/header.php';
if (isset($_GET['id'])) {
    extract($_GET);
}
if (isset($_GET['c'])) {
    $cat = $_GET['c'];
} else {
    $cat = "";
}
?>

<div class="container" id="container">
    <input type="hidden" name="" id="id" value="<?php
                                                echo $id;
                                                ?>">
    <input type="hidden" name="" id="p-one-cat" value=<?php
                                                        echo $cat;
                                                        ?>>
    <div class="all-posts" id="all">
        <div class="sections">
            <div class="post-container">
                <!-- <div class="reply">
                    <h3>Leave a Reply</h3>
                    <textarea name="" id="comment" cols="30" rows="10"></textarea>
                    <input type="text" placeholder="name">
                </div> -->
            </div>
            <div class="nav-sections ">
                <div class="recent">
                    <div class="div-title">
                        <h2>Related Posts</h2>
                    </div>
                    <div class="small-post">

                    </div>
                </div>
                <div class="categories">
                    <div class="div-title">
                        <h2>Categories</h2>
                    </div>
                    <div class="post-cats">
                        <div class="category">
                            <p>Photography</p>
                        </div>
                        <div class="category">
                            <p>Movies</p>
                        </div>
                        <div class="category">
                            <p>Tech</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/JS/post.js?v=<?php
                                    echo time();
                                    ?>"></script>
<?php
// require_once 'templates/footer.php';
?>