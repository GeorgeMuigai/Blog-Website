let login_box = document.querySelector('.login');
let sign_up_box = document.querySelector('.sign-up');
let message_tag = document.getElementById('message');


function signUp() {
    sign_up_box.style.display = "block";
    login_box.style.display = "none";
}

function signIn() {
    sign_up_box.style.display = "none";
    login_box.style.display = "block";
}

function validateSignUp() {
    let inp_reg_user = document.getElementById('reg_user').value;
    let inp_reg_pass = document.getElementById('reg_pass').value;
    let inp_reg_pass_con = document.getElementById('reg_pass_con').value;
    let inp_avatar = document.getElementById('user-avatar');

    if(empty(inp_reg_pass) || empty(inp_reg_user) || 
        empty(inp_reg_pass_con)) {
            alert ("empty fields");
    } else if (inp_avatar.files.length === 0) {
        alert ("no image selected");
    } else if (inp_reg_pass != inp_reg_pass_con) {
        alert ("passwords do not match");
    } else {
        registerUser(inp_reg_user, inp_reg_pass);
    }
}

function validateLogin() {
    let inp_user = document.getElementById('username').value;
    let inp_pass = document.getElementById('password').value;
    if (empty(inp_user) || empty(inp_pass)) {
        alert ("empty fields");
    } else {
        authenticateUser(inp_user, inp_pass);
    }
}

function authenticateUser(user, password) {
    var fd = new FormData;

    fd.append("user_name", user);
    fd.append("user_pass", password);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if(request.readyState === 4) {
            if(request.status === 200) {
                if(request.responseText === "success") {
                    // console.log("should login");
                    window.location.href = "index.php";
                } else {
                    showMessage(request.responseText);
                }
            }
        }
    };

    request.open("POST", "includes/login.inc.php");
    request.send(fd);
}

function registerUser(user, password) {
    var avatar = document.getElementById('user-avatar').files;
    var fd = new FormData;

    fd.append('user-avatar', avatar[0]);
    fd.append('reg_user_name', user);
    fd.append('reg_user_pass', password);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if(request.readyState === 4) {
            if (request.status === 200) {
                if(request.responseText === "success") {
                    signIn();
                }
                // console.log(request.responseText);
                showMessage(request.responseText);
            }
        }
    }

    request.open("POST", "includes/signup.inc.php");
    request.send(fd);
}

function empty(name) {
    if (name.trim().length === 0) {
        return true;
    } else {
        return false;
    }
}

function showMessage (message) {
    if (message === "success") {
        message_tag.innerHTML = "Account created successfully!!";
        message_tag.classList.add('visible');

        removeMessage();
    } else if (message === "exists") {
        message_tag.innerHTML = "Username already taken!!";
        message_tag.classList.add('visible');
        message_tag.classList.add('error');

        removeMessage();
    } else if (message === "error") {
        message_tag.innerHTML = "Incorrect username or password!!";
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