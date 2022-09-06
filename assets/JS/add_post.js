let btn_upload = document.getElementById('btn-upload');
let popup_user = document.getElementById('popup-user');
let container = document.getElementById('container');
let message_tag = document.getElementById('message');

function goToLogin() {
    window.location.href = "login.php";
}
function validateUploads() {
    let post_title = document.getElementById('post_title').value;
    let post_desc = document.getElementById('desc').value;
    let select = document.getElementById('categories');
    let post_cat = select.options[select.selectedIndex].text;
    let post_thumb = document.getElementById('post_thumb');

    if (empty(post_title) || empty(post_desc)) {
        showMessage('empty fields');
    } else if (post_thumb.files.length === 0) {
        showMessage("upload image");
    } else {
        addPost(post_title, post_desc, post_cat);
        // console.log(post_title, post_desc, post_cat, post_thumb.files);
    }
}

function addPost(title, desc, category) {
    var fd = new FormData;

    let image = document.getElementById('post_thumb').files;
    fd.append('post_img', image[0]);
    fd.append('post_title', title);
    fd.append('post_desc', desc);
    fd.append('post_cat', category);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if(request.readyState === 4) {
            if (request.status === 200) {
                // console.log(request.responseText);
                showMessage(request.responseText);
            }
        }
    }

    request.open("POST", "includes/insert.inc.php");
    request.send(fd);
}

function popup() {
    if(popup_user.classList.contains("popped")) {
        popup_user.classList.remove("popped");
    } else {
        popup_user.classList.add("popped");
    }
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

function showMessage (message) {
    if (message === "success") {
        message_tag.innerHTML = "Post uploaded successfully!!";
        message_tag.classList.add('visible');

        removeMessage();
    } else if (message === "unsupported") {
        message_tag.innerHTML = "please upload image file types!!";
        message_tag.classList.add('visible');
        message_tag.classList.add('error');

        removeMessage();
    } else if (message === "upload err") {
        message_tag.innerHTML = "Error occurred uploading the file!!";
        message_tag.classList.add('visible');
        message_tag.classList.add('error');

        removeMessage();
    } else if (message === "empty fields") {
        message_tag.innerHTML = "please fill in all the fields!!";
        message_tag.classList.add('visible');
        message_tag.classList.add('error');

        removeMessage();
    } else if (message === "upload image") {
        message_tag.innerHTML = "please upload an image file!!";
        message_tag.classList.add('visible');
        message_tag.classList.add('error');

        removeMessage();
    }
}

function removeMessage () {
    setTimeout(() => {
        message_tag.classList.remove('visible');
        message_tag.classList.remove('error');
    }, 3000);
}

function empty(name) {
    if (name.trim().length === 0) {
        return true;
    } else {
        return false;
    }
}

container.addEventListener('click', () => {
    popup_user.classList.remove("popped");
});
