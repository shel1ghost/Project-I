function fetch_social_pass() {
    document.getElementsByClassName('social')[0].style.backgroundColor = "#0099ff";
    document.getElementsByClassName('social')[0].style.color = "white";
    document.getElementsByClassName('banking')[0].style.backgroundColor = "transparent";
    document.getElementsByClassName('email')[0].style.backgroundColor = "transparent";
    document.getElementsByClassName('others')[0].style.backgroundColor = "transparent";
    fetch('social_passwords.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}
function fetch_banking_pass() {
    document.getElementsByClassName('banking')[0].style.backgroundColor = "#0099ff";
    document.getElementsByClassName('banking')[0].style.color = "white";
    document.getElementsByClassName('social')[0].style.backgroundColor = "transparent";
    document.getElementsByClassName('email')[0].style.backgroundColor = "transparent";
    document.getElementsByClassName('others')[0].style.backgroundColor = "transparent";
    fetch('banking_passwords.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}
function fetch_email_pass() {
    document.getElementsByClassName('email')[0].style.backgroundColor = "#0099ff";
    document.getElementsByClassName('email')[0].style.color = "white";
    document.getElementsByClassName('social')[0].style.backgroundColor = "transparent";
    document.getElementsByClassName('banking')[0].style.backgroundColor = "transparent";
    document.getElementsByClassName('others')[0].style.backgroundColor = "transparent";
    fetch('email_passwords.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}
function fetch_others_pass() {
    document.getElementsByClassName('others')[0].style.backgroundColor = "#0099ff";
    document.getElementsByClassName('others')[0].style.color = "white";
    document.getElementsByClassName('banking')[0].style.backgroundColor = "transparent";
    document.getElementsByClassName('email')[0].style.backgroundColor = "transparent";
    document.getElementsByClassName('social')[0].style.backgroundColor = "transparent";
    fetch('others_passwords.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

window.onload = function () {
    var url = window.location.href;

    // Create a new URLSearchParams object with the URL's query string
    var params = new URLSearchParams(url.split('?')[1]);

    // Get the value of a specific query parameter
    var category = params.get('category');

    // Check if the parameter exists
    if (category === "social") {
        fetch_social_pass();
    } else if (category === "banking") {
        fetch_banking_pass();
    } else if (category === "email") {
        fetch_email_pass();
    } else if (category === "others") {
        fetch_others_pass();
    }
}

function toggle_password (pass_num) {
    let password_box = document.getElementsByClassName("password_box")[pass_num];
    let btn = document.getElementsByClassName('view_pass_btn')[pass_num];
    let btn_value = document.getElementsByClassName('view_pass_btn')[pass_num].innerHTML;
    let password_label = document.getElementsByClassName('password_label')[pass_num];
    if(btn_value === "View Password"){
        password_box.style.display = "inline";
        password_label.style.display = "inline";
        btn.innerHTML = "Hide Password";
    }else if(btn_value === "Hide Password"){
        password_box.style.display = "none";
        btn.innerHTML = "View Password";
        password_label.style.display = "none";
    }
}

const form = document.getElementById('search_form');

form.addEventListener('submit', function(event){
    const query = document.getElementsByClassName('search_field')[0].value;
    const user_id = document.getElementsByClassName('hidden_user_id')[0].value;
    event.preventDefault();
    fetch(`search_passwords.php?query=${query}&user_id=${user_id}`)
            .then(response => response.text())
            .then(data => {
                if(data === "No passwords found."){
                    alert(data);
                }else{
                    document.getElementById('content').innerHTML = data;
                    category = document.getElementsByClassName('hidden_category_info')[0].innerHTML;
        
                    if (category === "social") {
                        document.getElementsByClassName('social')[0].style.backgroundColor = "#0099ff";
                        document.getElementsByClassName('social')[0].style.color = "white";
                        document.getElementsByClassName('banking')[0].style.backgroundColor = "transparent";
                        document.getElementsByClassName('email')[0].style.backgroundColor = "transparent";
                        document.getElementsByClassName('others')[0].style.backgroundColor = "transparent";
                    } else if (category === "banking") {
                        document.getElementsByClassName('banking')[0].style.backgroundColor = "#0099ff";
                        document.getElementsByClassName('banking')[0].style.color = "white";
                        document.getElementsByClassName('social')[0].style.backgroundColor = "transparent";
                        document.getElementsByClassName('email')[0].style.backgroundColor = "transparent";
                        document.getElementsByClassName('others')[0].style.backgroundColor = "transparent";
                    } else if (category === "email") {
                        document.getElementsByClassName('email')[0].style.backgroundColor = "#0099ff";
                        document.getElementsByClassName('email')[0].style.color = "white";
                        document.getElementsByClassName('social')[0].style.backgroundColor = "transparent";
                        document.getElementsByClassName('banking')[0].style.backgroundColor = "transparent";
                        document.getElementsByClassName('others')[0].style.backgroundColor = "transparent";
                    } else if (category === "others") {
                        document.getElementsByClassName('others')[0].style.backgroundColor = "#0099ff";
                        document.getElementsByClassName('others')[0].style.color = "white";
                        document.getElementsByClassName('banking')[0].style.backgroundColor = "transparent";
                        document.getElementsByClassName('email')[0].style.backgroundColor = "transparent";
                        document.getElementsByClassName('social')[0].style.backgroundColor = "transparent";
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching search results:', error);
            });
});
