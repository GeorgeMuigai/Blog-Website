let table = document.getElementById('table');

function getUserPosts () {
    var fd = new FormData;

    fd.append("user-posts", "1");

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            if (request.status === 200) {
                // console.log(request.responseText);
                table.innerHTML = request.responseText;
            }
        }
    }

    request.open("POST", "includes/display.inc.php");
    request.send(fd);
}

function goToPost(id) {
    // console.log(id);
    var fd = new FormData;

    fd.append("post_id", id);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            if (request.status === 200) {
                var post = JSON.parse(request.responseText);
                var title = post.post_title.replaceAll(" ", "-");
                var cat = post.post_cat;

                window.location.href = `post.php?id=${id}&post=${title}&c=${cat}`;
            }
        }
    }

    request.open("POST", "includes/display.inc.php");
    request.send(fd);
}

function delete_post (id) {
    if(confirm("Do you want to delete post?")) {
        // console.log(`Deleting post by id  ${id}`);
        var fd = new FormData;
        fd.append("delete_post", id);

        var request = new XMLHttpRequest();

        request.onreadystatechange = () => {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    // console.log(request.responseText);
                    getUserPosts();
                }
            }
        }

        request.open("POST", "includes/delete.inc.php");
        request.send(fd);
    }
}

window.addEventListener('load', () => {
    getUserPosts();
});