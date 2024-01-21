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
  }