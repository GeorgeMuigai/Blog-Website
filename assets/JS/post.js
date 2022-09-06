let post_id = document.getElementById('id').value;

function getPost () {
    var fd = new FormData;

    fd.append("post_id", post_id);

    var request = new XMLHttpRequest();

    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            if (request.status === 200) {
                console.log(request.responseText);
            }
        }
    }

    request.open("POST", "includes/display.inc.php");
    request.send(fd);
}

window.addEventListener('load', () => {
    // console.log("loaded");
    getPost();
})