function change_category_style(category) {
    let catgories = ['social', 'banking', 'email', 'others'];
    catgories.forEach((element)=>{
        if(element == category){
            document.getElementsByClassName(element)[0].style.backgroundColor = "#0099ff";
            document.getElementsByClassName(element)[0].style.color = "white";
        }else{
            document.getElementsByClassName(element)[0].style.backgroundColor = "transparent";
        }
    });
}

function fetch_social_pass() {
    change_category_style('social');
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
    change_category_style('banking');
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
    change_category_style('email');
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
    change_category_style('others');
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
    var params = new URLSearchParams(url.split('?')[1]);
    var category = params.get('category');
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
                        change_category_style('social');
                    } else if (category === "banking") {
                        change_category_style('banking');
                    } else if (category === "email") {
                        change_category_style('email');
                    } else if (category === "others") {
                        change_category_style('others');
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching search results:', error);
            });
});
