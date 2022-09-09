let post_id = document.getElementById('id').value;
let post_container = document.querySelector('.post-container');
let popup_user = document.getElementById('popup-user');
let related_posts = document.querySelector('.small-post');

var cat = document.getElementById('p-one-cat').value;

function getPost () {
    var fd = new FormData;

    fd.append("po_id", post_id);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            if (request.status === 200) {
                post_container.innerHTML += request.responseText;
            }
        }
    }

    request.open("POST", "includes/display.inc.php");
    request.send(fd);
}

function get_related(id) {
    var fd = new FormData;

    fd.append("get_related", cat);
    fd.append("dis_post", id);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            if (request.status === 200) {
                related_posts.innerHTML = request.responseText;
                // console.log(request.responseText);
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

window.addEventListener('load', () => {
    // console.log("loaded");
    getPost();
    get_related(post_id);
});

function popup() {
    if(popup_user.classList.contains("popped")) {
        popup_user.classList.remove("popped");
    } else {
        popup_user.classList.add("popped");
    }
}