let popup_user = document.getElementById('popup-user');
let container = document.getElementById('container');
let nav_sections = document.querySelector('.nav-sections');
let featured_posts = document.querySelector('.featured-posts');
let post_container = document.querySelector('.post-container');
let rec_post = document.querySelector('.small-post');

var shouldScroll = true;

function check() {
    if (isScrollable(featured_posts) && canScroll() && shouldScroll) {
        setTimeout(() => {
            setTimeout(() => {
                // featured_posts.scrollTo(featured_posts.scrollLeft + 190, 0);
                featured_posts.scrollTo(featured_posts.scrollWidth, 0);
                // console.log(featured_posts.scrollLeft, featured_posts.scrollWidth);
                // console.log(featured_posts.scrollLeft + featured_posts.clientWidth);
                // console.log(featured_posts.scrollLeft);
                canScroll();
                check();
            }, 1000);
        }, 100);
    } else {
        // console.log("cannot be scrolled again");
        if(shouldScroll) {
            setTimeout(() => {
                setTimeout(() => {
                    // featured_posts.scrollTo(featured_posts.scrollLeft - 190, 0);
                    featured_posts.scrollTo(0, 0);
                    // console.log(featured_posts.scrollLeft, featured_posts.scrollWidth);
                    // console.log(featured_posts.scrollLeft + featured_posts.clientWidth);
                    // console.log(featured_posts.scrollLeft);
                    // canScroll();
                    check();
                }, 10);
            }, 1000);
        }
    }
}

// stop the scrolling on mouse hover
featured_posts.addEventListener('mouseenter', () => {
    shouldScroll = false;
});

featured_posts.addEventListener('mousemove', () => {
    shouldScroll = false;
});

// resume the scrolling on mouse leave
featured_posts.addEventListener('mouseleave', () => {
    shouldScroll = true;
    check();
});

function getPosts() {
    var fd = new FormData;

    fd.append("get_all_posts", "1");

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if(request.readyState === 4) {
            if (request.status === 200) {
                // console.log(request.responseText);
                post_container.innerHTML += request.responseText;
            }
        }
    }

    request.open('POST', 'includes/display.inc.php');
    request.send(fd);
}

function getRecentPosts() {
    var fd = new FormData;

    fd.append("get_recent", "1");

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if(request.readyState === 4) {
            if (request.status === 200) {
                // console.log(request.responseText);
                rec_post.innerHTML += request.responseText;
            }
        }
    }

    request.open('POST', 'includes/display.inc.php');
    request.send(fd);
}

window.addEventListener('load', () => {
    check();
    getPosts();
    getRecentPosts();
});


window.addEventListener('scroll', () => {
    if(window.scrollY > 300) {
        nav_sections.classList.add('fixed');
    } else if (window.scrollY < 300) {
        nav_sections.classList.remove('fixed');
    }
});

function canScroll() {
    if(featured_posts.scrollLeft + featured_posts.clientWidth === featured_posts.scrollWidth) {
        return false;
    } else {
        return true;
    }
}

// check if an element is scrollable
function isScrollable (element) {
    return element.scrollWidth > element.clientWidth;
}

container.addEventListener('click', () => {
    popup_user.classList.remove("popped");
});

function popup() {
    if(popup_user.classList.contains("popped")) {
        popup_user.classList.remove("popped");
    } else {
        popup_user.classList.add("popped");
    }
}

function goToLogin() {
    window.location.href = "login.php";
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

                window.location.href = `post.php?id=${id}&post=${title}`;
            }
        }
    }

    request.open("POST", "includes/display.inc.php");
    request.send(fd);
}

function logout() {
    var logout = "true";

    var fd = new FormData;

    fd.append("logout", logout);
    var request = new XMLHttpRequest();

    request.onreadystatechange = () =>{
        if(request.readyState === 4) {
            if (request.status === 200) {
                if(request.responseText === "true") {
                    window.location.reload();
                }
            }
        }
    }

    request.open("POST", "includes/logout.inc.php");
    request.send(fd);
}

function empty(name) {
    if (name.trim().length === 0) {
        return true;
    } else {
        return false;
    }
}