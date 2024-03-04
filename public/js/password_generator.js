function generateRandomPassword(length) {
  const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+";
  let password = "";

  for (let i = 0; i < length; i++) {
    const randomIndex = Math.floor(Math.random() * charset.length);
    password += charset.charAt(randomIndex);
  }

  return password;
}

function displayRandomPassword() {
  const passwordLength = document.getElementById("password_length").value;
  const generatedPassword = generateRandomPassword(passwordLength);
  document.getElementById("password_field").value = generatedPassword;
  document.getElementById("copy_status").innerText = "COPY";
}

function copy_password() {
  var password = document.getElementById("password_field").value;
  var copy_status = document.getElementById("copy_status");
  navigator.clipboard.writeText(password)
    .then(() => {
      copy_status.innerText = "COPIED";
    });
}

function toggle_copy() {
  var copy_status = document.getElementById("copy_status").innerText;
  if (copy_status === "COPIED") {
    document.getElementById("copy_status").innerText = "COPY";
  }
}

var copy_element = document.querySelector('.copy');
copy_element.addEventListener('mouseenter', toggle_copy);
copy_element.addEventListener('click', copy_password);

var pass_generator = document.querySelector('.generate_button');
pass_generator.addEventListener('click', displayRandomPassword);


