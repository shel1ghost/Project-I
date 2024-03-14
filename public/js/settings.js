function redirectTo(page) {
    if (page === 'delete') {
        window.location.href = "delete_user.php";
    } else {
        window.location.href = "dashboard.php";
    }
}

function toggle_password_visibility(input, img) {
    var password_input = document.querySelector(input);
    var toggle_img = document.querySelector(img);
    if (password_input.type === "password") {
        password_input.type = "text";
        toggle_img.src = "./images/eye-regular-blue.svg";
    } else {
        password_input.type = "password";
        toggle_img.src = "./images/eye-slash-regular.svg";
    }
}